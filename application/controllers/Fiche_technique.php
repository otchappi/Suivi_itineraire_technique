<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Fiche_technique extends MY_Controller{

	public function __construct()
	{
		parent::__construct();
			if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_membre') !='')
            {
                $this->load->model('Account_model');
				$this->load->model('categorie_model');
				$this->load->model('region_model');
				$this->load->model('culture_model');
				$this->load->model('astuce_model');
				$this->load->model('maladie_model');
				$this->load->model('lutte_model');
				$this->load->model('sous_etape_model');
				$this->load->model('document_model');
				$this->load->model('compte_exploitation_model');
				$this->load->model('Site_model');
            }
            else
            {
                $this->session->set_flashdata('incorrect','Identifiez-vous svp !');
                redirect('Index/page_de_connexion');
           	}
	}

	public function index_client()
	{
		$this->session->set_userdata('menu',"Fiches");
		$data1["titre_page"]="Fiches techniques";
		$data1["liste_categorie"]=$this->categorie_model->liste_categorie();
		$data1["liste_region"]=$this->region_model->liste_region();
		$data1["liste_culture"]=$this->culture_model->liste_culture();
		$data3["liste_site"]=$this->Site_model->liste_site_client($this->session->userdata('id_membre'));
		$this->load->view('client/template/header');
		$this->load->view('client/template/head'); 
		$this->load->view('client/template/left-menu',$data3);        
		$this->load->view('client/fiche/fiche_technique',$data1);
		$this->load->view('client/template/footer');
	}
	public function detail_fiche()
	{
		$this->session->set_userdata('menu',"Fiches");
		$data1["titre_page"]="Fiches techniques";
		if($this->uri->segment(3))
		{
			$data1["details_culture"]=$this->culture_model->details_culture($this->uri->segment(3));
			$data1["liste_astuces"]=$this->astuce_model->liste_astuces_recherche($this->uri->segment(3));
			$data1["liste_maladie"]=$this->maladie_model->liste_maladie_culture($this->uri->segment(3));
			$data1["document"]=$this->document_model->fiche_culture($this->uri->segment(3));
			$data1["liste_sous_etape"]=$this->sous_etape_model->liste_sous_etape_culture($this->uri->segment(3));
			$data1["compte_exploitation"]=$this->compte_exploitation_model->compte_exploitation_culture($this->uri->segment(3));
			$methode_lutte=array();
			$i=0;
			if($data1["liste_maladie"]->num_rows()>0)
			{											
				foreach ($data1["liste_maladie"]->result() as $row) 
				{
					$lutte=$this->lutte_model->liste_lutte_maladie($row->id_maladie);
					if($lutte->num_rows()>0)
					{											
						$methode_lutte[$i]="";
						foreach ($lutte->result() as $row) 
						{
							$methode_lutte[$i].="<strong>".$row->designation_methode_lutte."</strong> : <br/>".$row->description_methode_lutte."<br/>";						
						}
					}
					$i=$i+1;
				}
			}
			$data1["liste_solution"]=$methode_lutte;
			$data3["liste_site"]=$this->Site_model->liste_site_client($this->session->userdata('id_membre'));
			$this->load->view('client/template/header');
			$this->load->view('client/template/head'); 
			$this->load->view('client/template/left-menu',$data3);        
			$this->load->view('client/fiche/details_fiche',$data1);
			$this->load->view('client/template/footer');
		}
		else
		{
			redirect('Fiche_technique/index_client');
		}
	}
	public function rechercher_culture()
	{
		$this->session->set_userdata('menu',"Fiches");
		$data1["titre_page"]="Fiches techniques";
		$data1["liste_categorie"]=$this->categorie_model->liste_categorie();
		$data1["liste_region"]=$this->region_model->liste_region();
		$this->session->set_userdata("culture_search",htmlspecialchars($this->input->post('designation')));
		$this->session->set_userdata("region_search",htmlspecialchars($this->input->post('region')));
		$this->session->set_userdata("categorie_search",htmlspecialchars($this->input->post('categorie')));
		$data1["liste_culture"]=$this->culture_model->liste_culture_recherche(htmlspecialchars($this->input->post('designation')),htmlspecialchars($this->input->post('region')),htmlspecialchars($this->input->post('categorie')));
		$data3["liste_site"]=$this->Site_model->liste_site_client($this->session->userdata('id_membre'));
		$this->load->view('client/template/header');
		$this->load->view('client/template/head'); 
		$this->load->view('client/template/left-menu',$data3);        
		$this->load->view('client/fiche/fiche_technique',$data1);
		$this->load->view('client/template/footer');
	}

























	public function etudier()
	{
		if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_etablissement') !='')
		{
		    if($this->uri->segment(3)!='')
		    {
		    	$this->session->set_userdata("id_dossier",$this->uri->segment(3));
			    $data1["infos_dossier"]=$this->Candidacy_model->infos_dossier($this->session->userdata("id_dossier"));
			    $data1["liste_document"]=$this->Candidacy_model->liste_document($this->session->userdata("id_dossier"));
			    $data1["liste_all_notif"]=$this->Notification_model->liste_toute_notification();
			    $data1["liste_dossier_notif"]=$this->Notification_model->liste_notification_dossier($this->session->userdata("id_dossier"));
			    if($this->session->userdata("id_centre_examen_etab")!='')
				{
					$data1["infos_centre"]=$this->Establishment_model->infos_etablissement_base($this->session->userdata('id_etablissement'));
				}
				else
				{
					$id_centre=$this->Establishment_model->centre_examen($this->session->userdata('id_etablissement'));
				    foreach ($id_centre->result() as $key) 
				    {
				    	$data1["infos_centre"]=$this->Establishment_model->infos_etablissement_base($key->etablissement_id);
				    }
				}

				if(count($data1["infos_dossier"])>0)
				{
					$this->load->view('establishment/candidacy/learn',$data1);
				}			    
			    else
			    {
			    	$this->session->set_userdata('faux_dossier','Erreur de chargement !');
					redirect('candidacy');
			    }
		    }
		}
		else
		{
			$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
			redirect('Index/page_de_connexion');
		}
	}
	public function imprimer_candidature()
	{
		if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_etablissement') !='' && $this->session->userdata("id_dossier")!="")
		{
			$data["infos_dossier"]=$this->Candidacy_model->infos_dossier($this->session->userdata("id_dossier"));
			$data["intitule_session"]=$this->Session_model->intitule_session($this->session->userdata('id_session'));
			$data["intitule_examen"]=$this->Exam_model->intitule_examen($this->session->userdata('id_examen'));
			if($this->session->userdata("id_centre_examen_etab")!='')
			{
				$data["infos_centre"]=$this->Establishment_model->infos_etablissement_base($this->session->userdata('id_etablissement'));
			}
			else
			{
				$id_centre=$this->Establishment_model->centre_examen($this->session->userdata('id_etablissement'));
				foreach ($id_centre->result() as $key) 
				{
				    $data["infos_centre"]=$this->Establishment_model->infos_etablissement_base($key->etablissement_id);
				}
			}
			$data["identite"]=$this->identite_model->liste_identite();
			$this->pdf->Options->setIsRemoteEnabled(true);
			$this->pdf->setPaper('A4','portrait')
			->filename('Formulaire')
			->zone('')
			->load_view('establishment/print/formulaire_candidature',$data)
			->generate();
		}
		else
		{
			$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
			redirect('Index/page_de_connexion');
		}
	}
	public function imprimer_liste_candidature()
	{
		if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_etablissement') !='')
		{
			if($this->session->userdata("id_etab_cand")!="")
			{
				$data["liste_candidature"]=$this->Candidacy_model->liste_candidature_etablissement($this->session->userdata("id_etab_cand"));
			}
			else
			{
				$data["liste_candidature"]=$this->Candidacy_model->liste_candidature_etablissement($this->session->userdata("id_etablissement"));
			}
			$data["intitule_session"]=$this->Session_model->intitule_session($this->session->userdata('id_session'));
			$data["intitule_examen"]=$this->Exam_model->intitule_examen($this->session->userdata('id_examen'));
			$data1["intitule_session"]=$data["intitule_session"];
			$data1["intitule_examen"]=$data["intitule_examen"];
			$data1["identite"]=$this->identite_model->liste_identite();
			$data["identite_vue"]=$this->load->view('establishment/print/identite-print',$data1,true);
			$this->pdf->Options->setIsRemoteEnabled(true);
			$this->pdf->setPaper('A4','portrait')
			->filename('Liste des Candidatures')
			->zone('')
			->load_view('establishment/print/liste_candidature_etablissement',$data)
			->generate();
		}
		else
		{
			$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
			redirect('Index/page_de_connexion');
		}
	}
	public function soumettre_candidature()
	{
		if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_etablissement') !='')
		{
		    $liste_candidature_valide=$this->Candidacy_model->liste_candidature_valide_etablissement($this->session->userdata("id_etablissement"));
		    foreach ($liste_candidature_valide->result() as $row)
		    {
		    	$data=array(
		    		"statut_dossier"=>"4"
		    	);
		    	$this->Candidacy_model->valider_dossier($data,$row->id_dossier);
		    }
		    $this->session->set_userdata('operation1','1');
		    redirect('Candidacy');
		}
		else
		{
			$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
			redirect('Index/page_de_connexion');
		}
	}
	public function valider_candidature()
	{
		if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_etablissement') !='')
		{
		    $data=array(
		    	"statut_dossier"=>"1"
		    );
		    $this->Candidacy_model->valider_dossier($data,$this->session->userdata("id_dossier"));
		    $message="<br>   Bonjour,<br> Félicitations votre candidature à été validée par votre établissement d'inscription. <br> Restez attentif à tout changement éventuel.
                <br>Nous restons au coeur de vos préoccupations";
            $this->send_mail($this->session->userdata("mail_candidat"),$message);
		    $this->session->unset_userdata("id_dossier","mail_candidat");
		    $this->session->set_userdata('operation','1');
		    redirect('Candidacy');
		}
		else
		{
			$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
			redirect('Index/page_de_connexion');
		}
	}
	public function refuser_candidature()
	{
		if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_etablissement') !='')
		{
		    $data=array(
		    	"statut_dossier"=>"3"
		    );
		    $this->Candidacy_model->valider_dossier($data,$this->session->userdata("id_dossier"));
		    $message="<br>   Bonjour,<br> Votre candidature à été rejétée par votre établissement d'inscription. <br> Veuillez prendre contact avec votre établissement pour plus d'informations.
                <br>Nous restons au coeur de vos préoccupations";
            $this->send_mail($this->session->userdata("mail_candidat"),$message);
		    $this->session->unset_userdata("id_dossier","mail_candidat");
		    $this->session->set_userdata('operation','1');
		    redirect('Candidacy');
		}
		else
		{
			$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
			redirect('Index/page_de_connexion');
		}
	}
	public function notifier_candidature()
	{
		if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_etablissement') !='')
		{
		    $liste_all_notif=$this->Notification_model->liste_toute_notification();
		    $liste_dossier_id_notif=$this->Notification_model->liste_id_notification_dossier($this->session->userdata("id_dossier"));
		    $notif=0;
		    foreach ($liste_all_notif->result() as $row)
	        {
				if($this->input->post('notif'.$row->id_type_notification)!='')
				{
	           		if(in_array($row->id_type_notification,$liste_dossier_id_notif,true))
	           		{
	           			$data=array(
	           				"etat_notification" => "0"
	           			);
	           			$this->Notification_model->renvoyer_notification($data,$this->session->userdata("id_dossier"));
	           		}
	           		else
	           		{
	           			$data=array(
	           				"date_creation_notification" => date('Y-m-d H:i:s'),
	           				"etablissement_id"=>$this->session->userdata('id_etablissement'),
	           				"dossier_id" => $this->session->userdata("id_dossier"),
	           				"type_notification_id" => $row->id_type_notification,
	           				"etat_notification" => "0"
	           			);
	           			$this->Notification_model->envoyer_notification($data);
	           		}
	           		$notif++;
	           		$this->session->set_userdata('operation','1');
				}
	        }
	        if($notif>0)
	        {
		        $data=array(
			    	"statut_dossier"=>"2"
			    );
			    $infos_mail_cand=$this->Candidacy_model->infos_dossier($this->session->userdata("id_dossier"));
			    foreach ($infos_mail_cand as $key) 
			    {
			    	if($key->email_candidat!='')
			    	{
			    		$this->send_mail_notification($key->email_candidat);
			    	}			    	
			    }
			    
			    $this->Candidacy_model->valider_dossier($data,$this->session->userdata("id_dossier"));
	        }
	        
		    $this->session->unset_userdata("id_dossier");
		    redirect('Candidacy');
		}
		else
		{
			$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
			redirect('Index/page_de_connexion');
		}
	}
	public function send_mail_notification($to)
	{
		$this->load->library('email');
		$config = array(
			'newline' => "\r\n",  
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com', 
			'smtp_port' => 465,  
              	'smtp_user' => 'brayan.tchappi@gmail.com',//'issamanel05@gmail.com', 
              	'smtp_pass' => 'tchappi.brayan',//'fantachristine', 
              	'charset' => 'utf-8',
              	'mailtype' => 'html', 
              	'smtp_timeout'=>'60',
              	'validation' =>TRUE
              );

		$message='<br>   Bonjour,<br> Vous avez recu des notifications concernant votre dossier. Bien vouloir vous connecter dans les bref delais pour apporter les modifications demandées. <br>
		<br>Nous restons au coeur de vos préoccupations';     
		$this->email->initialize($config);
		$this->email->from('brayan.tchappi@gmail.com');
		$this->email->to($to);
		$this->email->subject("Votre candidature ");
		$this->email->message($message);                        

		if($this->email->send())
		{
			return 'true';
		}
		else
		{
			show_error($this->email->print_debugger());
		}   
	}
		public function chercher_candidature()
		{
			$chercher_candidature=$this->Candidacy_model->make_datatables();
			$data=array();
			foreach ($chercher_candidature as $row) {
				$sub_array=array();
				$sub_array[]='<a  href="'.$row->photo_candidat.'" target="_blank"><img src="'.base_url($row->photo_candidat).'" class="img-thumbnail" width="50" height="20"/></a>';
				$sub_array[]=$row->nom_candidat;
				$sub_array[]=$row->prenom_candidat;
				$sub_array[]=$row->sexe;
				$sub_array[]=$row->libelle_type_candidat;
				$sub_array[]=$row->libelle_serie;
				$sub_array[]=$row->date_creation_dossier;
				switch($row->statut_dossier)
				{
					case 0:
						$sub_array[]="<span class='text-primary'>Nouvelle</span>";
					break;
					case 1:
					case 4:
						$sub_array[]="<span class='text-success'>Validée</span>";
					break;
					case 2:
					case 5:
						$sub_array[]="<span class='text-warning'>Incomplète</span>";
					break;
					case 3:
						$sub_array[]="<span class='text-danger'>Refusée</span>";
					break;
				}
				$sub_array[]='<a type="button" name="etudier" href="'.base_url("Candidacy/etudier/".$row->id_dossier).'" class=" a btn btn-primary btn-md">Etudier</a>';
				$data[]=$sub_array;
			}
			$output=array(
				"draw" => intval($_POST["draw"]),
				"recordsTotal" => $this->Candidacy_model->get_all_data(),
				"recordsFiltered" => $this->Candidacy_model->get_filtered_data(),
				"data"  => $data
			);
			echo json_encode($output);
		}

	public function changer_etab()
	{
		if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_etablissement') !='')
		{
		    if($this->session->userdata("id_etablissement")!= htmlspecialchars($this->input->post('etab')))
		    {
		    	$this->session->set_userdata('id_etab_cand',htmlspecialchars($this->input->post('etab'))); 
		    	$infos_etab=$this->Establishment_model->infos_etablissement_base(htmlspecialchars($this->input->post('etab'))); 
		    	foreach ($infos_etab->result() as $row) {
		    		$this->session->set_userdata('nom_etab_cand',$row->nom_etablissement);
		    	}	
		    }
		    else
		    {
		    	$this->session->unset_userdata('id_etab_cand');
		    	$this->session->unset_userdata('nom_etab_cand');
		    }
		    redirect(base_url('Candidacy'));
		}
		else
		{
			$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
			redirect('Index/page_de_connexion');
		}
	}
	public function changer_param()
	{
		if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_etablissement') !='')
		{
		    if(htmlspecialchars($this->input->post('serie'))!="0")
		    {
		    	$this->session->set_userdata('id_serie_cand',htmlspecialchars($this->input->post('serie'))); 
		    	$infos_serie=$this->Serie_model->intitule_serie(htmlspecialchars($this->input->post('serie'))); 
		    	foreach ($infos_serie as $row) {
		    		$this->session->set_userdata('nom_serie_cand',$row->libelle_serie);
		    	}	
		    }
		    else
		    {
		    	$this->session->unset_userdata('id_serie_cand');
		    	$this->session->unset_userdata('nom_serie_cand');
		    }
		    if(htmlspecialchars($this->input->post('etat'))!="5")
		    {
		    	$this->session->set_userdata('id_etat_cand',htmlspecialchars($this->input->post('etat'))); 	
		    }
		    else
		    {
		    	$this->session->unset_userdata('id_etat_cand');
		    }
		    redirect(base_url('Candidacy'));
		}
		else
		{
			$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
			redirect('Index/page_de_connexion');
		}
	}
	public function send_mail($to,$message_envoye)
  	{
     		$this->load->library('email');
        	$config = array(
              	'newline' => "\r\n",  
              	'protocol' => 'smtp',
              	'smtp_host' => 'ssl://smtp.gmail.com', 
              	'smtp_port' => 465,  
              	'smtp_user' => 'brayan.tchappi@gmail.com',//'issamanel05@gmail.com', 
              	'smtp_pass' => 'tchappi.brayan',//'fantachristine', 
              	'charset' => 'utf-8',
              	'mailtype' => 'html', 
              	'smtp_timeout'=>'60',
              	'validation' =>TRUE
            );
             $message=$message_envoye;     
            $this->email->initialize($config);
            $this->email->from('brayan.tchappi@gmail.com');
            $this->email->to($to);
            $this->email->subject("Informations de connexion ");
            $this->email->message($message);                        
              
            if($this->email->send())
            {
                return 'true';
            }
       		else
       		{
        		show_error($this->email->print_debugger());
            }   
  	}






  	/******************************************************************************************************************
												Hermann
		************************************************************************************************************S*****/
		

}
