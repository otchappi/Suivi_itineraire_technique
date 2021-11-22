<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Forum extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		/*if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_etablissement') !='')
    {*/
      $this->load->model('sujet_model');
			$this->load->model('post_model');
			$this->load->model('Account_model');
			$this->load->library('Pdf');
    /*}
    else
    {
      $this->session->set_flashdata('incorrect','Identifiez-vous svp !');
      redirect('Index/page_de_connexion');
    }*/
		
	}
		public function chercher_sujet()
		{
			$chercher_sujet=$this->sujet_model->make_datatables();
			$data=array();
			foreach ($chercher_sujet as $row) {
				$sub_array=array();
				$sub_array[]="<span style='font-size:1.1em;'>".$row->intitule_sujet."</span>";
				$sub_array[]=$this->post_model->nb_post_sujet($row->id_sujet);
				$sub_array[]='<img src="'.base_url($row->photo_membre).'" class="img-thumbnail" width="50" height="20" data-toggle="modal"/> <br>'.$row->nom_membre.' .'.$row->prenom_membre[0];
				$date_sujet= new DateTime($row->date_creation_sujet);
				$sub_array[]="Le <strong>".$date_sujet->format('d / m / Y')."</strong> <br> A <strong>".$date_sujet->format('H : i : s')."</strong>";				
				$sub_array[]='<a type="button" name="consulter" href="'.base_url("Forum/consulter_sujet/".$row->id_sujet).'" class=" btn btn-primary btn-md"><span class="fa fa-eye"></span></a>';
				if($this->session->userdata("categorie_compte")!="" && $this->session->userdata("categorie_compte")==0)
				{
						$sub_array[]='<button type="button" name="supprimer" class="test supprimer_sujet btn btn-danger btn-md" id="'.$row->id_sujet.'" ><span class="fa fa-trash"></span></button>';
				}
				$data[]=$sub_array;
			}
			$output=array(
				"draw" => intval($_POST["draw"]),
				"recordsTotal" => $this->sujet_model->get_all_data(),
				"recordsFiltered" => $this->sujet_model->get_filtered_data(),
				"data"  => $data
			);
			echo json_encode($output);
		}
		public function authentification()
		{
			$identifiant=htmlspecialchars($this->input->post('login'));
			$mot_de_passe=htmlspecialchars($this->input->post('password'));
			if(($id=$this->Account_model->authentifier($identifiant,$mot_de_passe))!=-1)
			{
				$infos_connecte=$this->Account_model->infos_connecte($id);
				if($infos_connecte->num_rows()>0)
				{
					foreach ($infos_connecte->result() as $row) 
					{
						$session_data= array(
							"id_membre" =>$row->id_membre,
							'identifiant' =>$identifiant,
							'mot_de_passe' =>$mot_de_passe,
							'nom_membre' =>$row->nom_membre,
							'prenom_membre' =>$row->prenom_membre
						);
						$this->session->set_userdata($session_data);
						$this->session->set_flashdata('correct','Vous pouvez participer au forum de discussion !');
						if($this->session->userdata("id_sujet")!="")
						{
							redirect("Forum/consulter_sujet/".$this->session->userdata("id_sujet"));
						}
						else
						{
							redirect("Index/forum");
						}
						
					}
				}	
			}
			else
			{
				$this->session->set_flashdata('incorrect','Désolé, vos informations sont incorrectes !');
				$this->session->unset_userdata('identifiant','mot_de_passe','id_membre','nom_membre','prenom_membre');
				redirect('Index/forum');
			}
		}

		public function nouveau_sujet()
		{
			if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_membre') !='')
			{
				$this->form_validation->set_rules("intitule","intitule",'is_unique[sujet.intitule_sujet]',array('is_unique' => 'Cet intitule existe'));
				if($this->form_validation->run())
				{
					$data=array(
						'intitule_sujet' =>  htmlspecialchars($this->input->post('intitule')),
						'date_creation_sujet' =>  date('Y-m-d H:i:s'),
						'id_membre' => $this->session->userdata('id_membre')
					);
					$id=$this->sujet_model->inserer_sujet($data);
					$data=array(
						'contenu_post' =>  htmlspecialchars($this->input->post('post')),
						'date_creation_post' =>  date('Y-m-d H:i:s'),
						'id_membre' => $this->session->userdata('id_membre'),
						'id_sujet'  => $id
					);
					$this->post_model->inserer_post($data);
					redirect('Forum/consulter_sujet/'.$id);
				}
				else
				{
					$this->session->set_flashdata('incorrect_sujet','Ce sujet existe déjà !');
					redirect('Index/forum');
				}
			}
			else
			{
				redirect('Index');
			}
		}

		public function nouveau_post()
		{
			if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_membre') !='')
			{
				$this->form_validation->set_rules("post","post",'required',array('required' => 'Entrez votre reponse'));
				if($this->form_validation->run())
				{
					$data=array(
						'contenu_post' =>  htmlspecialchars($this->input->post('post')),
						'date_creation_post' =>  date('Y-m-d H:i:s'),
						'id_membre' => $this->session->userdata('id_membre'),
						'id_sujet'  => $this->session->userdata('id_sujet')
					);
					$this->post_model->inserer_post($data);
					redirect('Forum/consulter_sujet/'.$this->session->userdata('id_sujet'));
				}
				else
				{
					redirect('Forum/consulter_sujet/'.$this->session->userdata('id_sujet'));
				}
			}
			else
			{
				redirect('Index');
			}
		}

		public function deconnexion()
		{
			$this->session->unset_userdata('identifiant');
			$this->session->unset_userdata('mot_de_passe');
			$this->session->unset_userdata('id_membre');
			$this->session->unset_userdata('nom_membre');
			$this->session->unset_userdata('prenom_membre');
			$this->session->unset_userdata('categorie_compte');
			redirect('index');
		}
		public function supprimer_sujet()
		{
			if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_membre') !='' && $this->session->userdata('categorie_compte') !='' && $this->session->userdata('categorie_compte') ==0)
			{
				if($this->uri->segment(3))
				{
					$this->sujet_model->supprimer_post_sujet($this->uri->segment(3));
					$this->sujet_model->supprimer_sujet($this->uri->segment(3));
				}
			}
			else
			{
				redirect('Index');
			}
		}
		public function supprimer_post()
		{
			if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_membre') !='' && $this->session->userdata('categorie_compte') !='' && $this->session->userdata('categorie_compte') ==0)
			{
				if($this->uri->segment(3))
				{
					$this->post_model->supprimer_post($this->uri->segment(3));
				}
			}
			else
			{
				redirect('Index');
			}
		}
		public function consulter_sujet()
		{
			if($this->uri->segment(3))
			{
				$infos_sujet=$this->sujet_model->infos_sujet($this->uri->segment(3));
				foreach ($infos_sujet->result() as $key) 
				{
					$this->session->set_userdata("titre_sujet",$key->intitule_sujet);
					$this->session->set_userdata("id_sujet",$key->id_sujet);
					$data["liste_post"]=$this->post_model->liste_post($this->uri->segment(3));
					$this->load->view('forum/post',$data);
				}
			}
		}
		public function retour_forum()
		{
			$this->session->unset_userdata('titre_sujet');
			$this->session->unset_userdata('id_sujet');
			redirect('index/forum');
		}


















	public function imprimer_liste_etablissement_rattache()
	{
		if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_etablissement') !='')
		{
			$data["liste_etablissement"]=$this->Establishment_model->liste_etablissement_rattache($this->session->userdata("id_etablissement"));
			$data["intitule_session"]=$this->Session_model->intitule_session($this->session->userdata('id_session'));
			$data["intitule_examen"]=$this->Exam_model->intitule_examen($this->session->userdata('id_examen'));
			$data1["intitule_session"]=$data["intitule_session"];
			$data1["intitule_examen"]=$data["intitule_examen"];
			$data1["identite"]=$this->identite_model->liste_identite();
			$data["identite_vue"]=$this->load->view('print/identite-print',$data1,true);
			$this->pdf->Options->setIsRemoteEnabled(true);
			$this->pdf->setPaper('A4','portrait')
			->filename('Liste des établissements')
			->zone('')
			->load_view('establishment/print/liste_etablissement_rattache',$data)
			->generate();
		}
		else
		{
			$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
			redirect('Index/page_de_connexion');
		}
	}

	public function ajouter_etablissement()
	{
		if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_etablissement') !='')
		{
			$this->session->set_userdata('menu',"Etab_rat");$this->session->unset_userdata('erreur_etablissement');
			$data1["intitule_session"]=$this->Session_model->intitule_session($this->session->userdata('id_session'));
			$data1["intitule_examen"]=$this->Exam_model->intitule_examen($this->session->userdata('id_examen'));
			$data1["liste_region"]=$this->localization_model->liste_region();
			$data1["liste_departement"]=$this->localization_model->liste_departement();
			$data1["liste_arrondissement"]=$this->localization_model->liste_arrondissement();
			$data3["liste_session"]=$this->Session_model->liste_session();
			$data3["liste_examen"]=$this->Exam_model->liste_examen();
			if($this->uri->segment(3))
			{
				$this->session->set_userdata('modification_etablissement',"1");
				$data1["infos_connecte"]=$this->Establishment_model->infos_etablissement($this->uri->segment(3));
			}
			$header=array('titre'=>'Etablissements rattachés');
		    $this->load->view('establishment/template/header',$header);
		    $this->load->view('establishment/template/head'); 
			$this->load->view('establishment/template/left-menu');        
		    $this->load->view('establishment/enregistrer_etablissement',$data1);
			$this->load->view('establishment/template/footer',$data3);
		}
		else
		{
			$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
			redirect('Index/page_de_connexion');
		}
	}

		public function chercher_establishment_rattache()
		{
			$chercher_etablissement=$this->Establishment_model->make_datatables_etab();
			$data=array();
			foreach ($chercher_etablissement as $row) {
				$sub_array=array();
				$sub_array[]='<img src="'.base_url($row->logo_etablissement).'" class="img-thumbnail" width="50" height="20"/>';
				$sub_array[]=$row->code_etablissement;
				$sub_array[]=$row->responsable_etablissement;
				$sub_array[]=$row->nom_etablissement;
				$sub_array[]=$row->telephone_etablissement;
				$sub_array[]=$row->email_etablissement;
				$sub_array[]=$row->adresse_etablissement;
				$sub_array[]='<a type="button" name="modifier" href="'.base_url("Establishment/ajouter_etablissement/".$row->id_etablissement).'" class=" a btn btn-warning btn-md">Modifier</a>';
				$data[]=$sub_array;
			}
			$output=array(
				"draw" => intval($_POST["draw"]),
				"recordsTotal" => $this->Establishment_model->get_all_data_etab(),
				"recordsFiltered" => $this->Establishment_model->get_filtered_data_etab(),
				"data"  => $data
			);
			echo json_encode($output);
		}

		public function liste_departement()
		{
			if($this->input->post('id_region'))
			{
				echo $this->localization_model->liste_departement_region($this->input->post('id_region'));
			}
		}
		public function liste_arrondissement()
		{
			if($this->input->post('id_departement'))
			{
				echo $this->localization_model->liste_arrondissement_departement($this->input->post('id_departement'));
			}
		}
		public function valider_formulaire_ajout_etab()
		{
			if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_etablissement') !='')
			{
				if(!($this->uri->segment(3)) || $this->session->userdata("code_etablissement_modif")!=htmlspecialchars($this->input->post('code')))
				{
					$this->form_validation->set_rules("code","code",'is_unique[Etablissement.code_etablissement]',array('is_unique' => 'Ce code existe déjà'));
				}				
				$this->form_validation->set_rules("nom","nom",'required',array('required' => 'Ce champ est obligatoire'));
				$this->form_validation->set_rules("respo","respo",'required',array('required' => 'Ce champ est obligatoire'));
				$this->form_validation->set_rules("nom_region","nom_region",'required',array('required' => 'Ce champ est obligatoire'));
				$this->form_validation->set_rules("departement","departement",'required',array('required' => 'Ce champ est obligatoire'));
				$this->form_validation->set_rules("arrondissement","arrondissement",'required',array('required' => 'Ce champ est obligatoire'));
				$this->form_validation->set_rules("localisation","localisation",'required',array('required' => 'Ce champ est obligatoire'));
				$this->form_validation->set_rules("tel","tel",'required',array('required' => 'Ce champ est obligatoire'));
				$this->form_validation->set_rules("email","email",'required|valid_email',array('required' => 'Ce champ est obligatoire',"valid_email" => "Adresse mail invalide"));
				if($this->form_validation->run())
				{
					if($this->uri->segment(3))
					{
						$localisation=htmlspecialchars($this->upload_image());
						if($localisation!="")
						{
							$data=array(
								'nom_etablissement' =>  htmlspecialchars($this->input->post('nom')),
								'responsable_etablissement' =>  htmlspecialchars($this->input->post('respo')),
								'code_etablissement' =>  htmlspecialchars($this->input->post('code')),
								'telephone_etablissement' =>  htmlspecialchars($this->input->post('tel')),
								'email_etablissement' =>  htmlspecialchars($this->input->post('email')),
								'adresse_etablissement' =>  htmlspecialchars($this->input->post('localisation')),
								'arrondissement_id' =>  htmlspecialchars($this->input->post('arrondissement')),
								'logo_etablissement' => "assets/images/Logos/". $localisation
							);
						}
						else
						{
							$data=array(
								'nom_etablissement' =>  htmlspecialchars($this->input->post('nom')),
								'responsable_etablissement' =>  htmlspecialchars($this->input->post('respo')),
								'code_etablissement' =>  htmlspecialchars($this->input->post('code')),
								'telephone_etablissement' =>  htmlspecialchars($this->input->post('tel')),
								'email_etablissement' =>  htmlspecialchars($this->input->post('email')),
								'adresse_etablissement' =>  htmlspecialchars($this->input->post('localisation')),
								'arrondissement_id' =>  htmlspecialchars($this->input->post('arrondissement'))
							);
						}
						$this->Establishment_model->modifier_etablissement_rattache($data,$this->session->userdata("id_etablissement_modif"));
						$this->session->unset_userdata('modification_etablissement','code_etablissement_modif','logo_etablissement_modif','id_etablissement_modif');
					}
					else
					{
						$data=array(
							'nom_etablissement' =>  htmlspecialchars($this->input->post('nom')),
							'responsable_etablissement' =>  htmlspecialchars($this->input->post('respo')),
							'code_etablissement' =>  htmlspecialchars($this->input->post('code')),
							'telephone_etablissement' =>  htmlspecialchars($this->input->post('tel')),
							'email_etablissement' =>  htmlspecialchars($this->input->post('email')),
							'adresse_etablissement' =>  htmlspecialchars($this->input->post('localisation')),
							'arrondissement_id' =>  htmlspecialchars($this->input->post('arrondissement')),
							'logo_etablissement' => "assets/images/Logos/". htmlspecialchars($this->upload_image())
							);
						$id_etab=$this->Establishment_model->inserer_etablissement_rattache($data);
						$data=array(
							'etablissement_id' => $id_etab,
							'centre_examen_id' =>  $this->session->userdata("id_centre_examen_etab")
						);
						$this->Establishment_model->inserer_lier_etab_centre($data);
						$login=$this->generate_password(12);
						$mdp=$this->generate_password(12);
						$data=array(
							'login' => $login,
							'password' =>  $mdp,
							"date_creation_compte" => date('Y-m-d H:i:s'),
							"etat_compte" => "1",
							"type_compte" => "0",
							"etablissement_id" => $id_etab,
							"candidat_id" => null
						);
						$this->Account_model->ajouter_compte($data);
						$this->send_mail( htmlspecialchars($this->input->post('email')),$login,$mdp);
						$this->session->unset_userdata('modification_etablissement','code_etablissement_modif','logo_etablissement_modif','id_etablissement_modif');
					}
					$this->session->set_userdata('operation','1');
					redirect(base_url("Establishment/etablissement_rattache"));
				}
				else
				{
					$data1["intitule_session"]=$this->Session_model->intitule_session($this->session->userdata('id_session'));
					$data1["intitule_examen"]=$this->Exam_model->intitule_examen($this->session->userdata('id_examen'));
					$data1["liste_region"]=$this->localization_model->liste_region();
					$data1["liste_departement"]=$this->localization_model->liste_departement();
					$data1["liste_arrondissement"]=$this->localization_model->liste_arrondissement();
					$data3["liste_session"]=$this->Session_model->liste_session();
					$data3["liste_examen"]=$this->Exam_model->liste_examen();
					$this->session->unset_userdata('modification_etablissement');
					$data1["id_etablissement_modif"]=$this->uri->segment(3);
					$data1["id_region"]=htmlspecialchars($this->input->post('nom_region'));
					$data1["id_departement"]=htmlspecialchars($this->input->post('departement'));
					$data1["id_arrondissement"]=htmlspecialchars($this->input->post('arrondissement'));
					$data1["logo_etablissement"]=$this->session->userdata("logo_etablissement_modif");
					$header=array('titre'=>'Etablissements rattachés');
				    $this->load->view('establishment/template/header',$header);
				    $this->load->view('establishment/template/head'); 
					$this->load->view('establishment/template/left-menu');        
				    $this->load->view('establishment/establishment/enregistrer_etablissement',$data1);
					$this->load->view('establishment/template/footer',$data3);
				}
			}
			else
			{
				$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
				redirect('Index/page_de_connexion');
			}
		}
		function upload_image()
		{
			if($_FILES["photos"]['name']!='')
			{
				$new_name=time().str_replace(' ', '',$_FILES["photos"]['name']);
				$config['upload_path']='./assets/images/Logos';
				$config['allowed_types']='jpg|jpeg|png|gif';
				$config['file_name']=$new_name;
				$this->load->library('upload',$config);
				$this->upload->initialize($config);
				if(!$this->upload->do_upload('photos'))
				{
					echo $this->upload->display_errors();
				}
				else
				{
					$data=$this->upload->data();
					return $new_name;
				}
			}
		}
		public function send_mail($to,$login,$password)
  	{
     		$this->load->library('email');
        	$config = array(
              	'newline' => "\r\n",  
              	'protocol' => 'smtp',
              	'smtp_host' => 'ssl://smtp.gmail.com', 
              	'smtp_port' => 465,  
              	'smtp_user' => 'brayan.tchappi@gmail.com',//'issamanel05@gmail.com', 
              	'smtp_pass' => 'tchappi.brayan17',//'fantachristine', 
              	'charset' => 'utf-8',
              	'mailtype' => 'html', 
              	'smtp_timeout'=>'60',
              	'validation' =>TRUE
            );
             
            $message="<br>   Bonjour,<br> nous avons le plaisir de vous informer que la création de votre compte vient d'être effectuée avec succès. <br>Vos identifiants sont les suivants : <br>
                          Identifiant : <strong> ".$login."</strong><br>
                          Mot de passe : <strong>".$password."</strong>
                <br>Merci de changer vos coordonnées lors de votre prochaine connexion pour plus de sécurité.
                <br>Nous restons au coeur de vos préoccupations";     
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
  	public function generate_password($nbreCarac)
  	{
	    $pass="";
	    $chaine_alpha_num="azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN123456789";
	    for ($j=0; $j <$nbreCarac ; $j++) 
	    { 
	       $pass.= $chaine_alpha_num[rand()%strlen($chaine_alpha_num)];
	    }
	    return $pass;
  	}

}
