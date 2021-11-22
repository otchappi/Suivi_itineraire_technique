<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Projet extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_membre') !='')
	        {
	            $this->load->model('Projet_model');
	            $this->load->model('Tache_model');
	            $this->load->model('Sous_tache_model');
	            $this->load->model('Astuce_model');
	            $this->load->model('Culture_model');
	            $this->load->model('Maladie_model');
	            $this->load->model('Compte_exploitation_model');
	            $this->load->model('Document_model');
	            $this->load->model('Sous_etape_model');
	            $this->load->model('Lutte_model');
	            $this->load->model('Activite_model');
	            $this->load->model('Report_model');
	            $this->load->model('Commentaire_model');
	            $this->load->model('Fichier_model');
	        }
	        else
	        {
	           	$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
	            redirect('Index/page_de_connexion');
	        }
		}
		public function Home_projet_client()
		{
			if($this->uri->segment(3)!='')
			{
				$this->session->set_userdata('menu',"tableau_bord");
				$data2["titre_page"]="Projet";
				$data2["liste_tache_proches"]=$this->Tache_model->liste_tache_proche_projet($this->session->userdata('id_projet'));
				if($this->uri->segment(4)!='')
				{
					$data2["id_tache"]=$this->uri->segment(3);
					$data2["infos_tache"]=$this->Tache_model->infos_tache($this->uri->segment(3));
					$liste_tache=$this->Tache_model->liste_tache_en_cours_projet($this->session->userdata('id_projet'));
					$data2["liste_tache"]=$liste_tache;
					$data2["liste_sous_tache"]=$this->Sous_tache_model->liste_sous_tache($this->uri->segment(3));
				}
				else
				{
					$this->session->set_userdata("id_projet",$this->uri->segment(3));
					$liste_tache=$this->Tache_model->liste_tache_en_cours_projet($this->session->userdata('id_projet'));
					$data2["liste_tache"]=$liste_tache;
					$i=0;
					foreach ($liste_tache->result() as $row) 
					{
						$i+=1;
						if($i==1)
						{
							$data2["id_tache"]=$row->id_tache;
							$data2["infos_tache"]=$this->Tache_model->infos_tache($row->id_tache);
							$data2["liste_sous_tache"]=$this->Sous_tache_model->liste_sous_tache($row->id_tache);
							break;
						}
					}
				}
				$infos_projet=$this->Projet_model->infos_projet($this->session->userdata('id_projet'));
				foreach ($infos_projet->result() as $row) 
				{
					$this->session->set_userdata("id_culture",$row->id_culture);
				}
		        $this->load->view('client/template/header');
		        $this->load->view('client/template/head'); 
				$this->load->view('client/template/left-menu-projet');        
		        $this->load->view('client/projet/tableau_bord',$data2);
				$this->load->view('client/template/footer');
			}
			else
			{
				redirect('Home/Home_client');
			}
		}
		public function presentation()
		{
			$this->session->set_userdata('menu',"Presentation");
			$data1["titre_page"]="Présentation-Projet";
			$data1["infos_projet"]=$this->Projet_model->infos_projet($this->session->userdata("id_projet"));
		    $this->load->view('client/template/header');
		    $this->load->view('client/template/head'); 
			$this->load->view('client/template/left-menu-projet');        
		    $this->load->view('client/projet/presentation',$data1);
			$this->load->view('client/template/footer');		
		}
		public function detail_fiche()
		{
			$this->session->set_userdata('menu',"Culture");
			$data1["titre_page"]="Culture";
			
			$data1["details_culture"]=$this->Culture_model->details_culture($this->session->userdata("id_culture"));
			$data1["liste_astuces"]=$this->Astuce_model->liste_astuces_recherche($this->session->userdata("id_culture"));
			$data1["liste_maladie"]=$this->Maladie_model->liste_maladie_culture($this->session->userdata("id_culture"));
			$data1["liste_document"]=$this->Document_model->liste_document_culture($this->session->userdata("id_culture"));
			$data1["liste_sous_etape"]=$this->Sous_etape_model->liste_sous_etape_culture($this->session->userdata("id_culture"));
			$data1["compte_exploitation"]=$this->Compte_exploitation_model->compte_exploitation_culture($this->session->userdata("id_culture"));
			$methode_lutte=array();
			$i=0;
			if($data1["liste_maladie"]->num_rows()>0)
			{											
				foreach ($data1["liste_maladie"]->result() as $row) 
				{
					$lutte=$this->Lutte_model->liste_lutte_maladie($row->id_maladie);
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
			$this->load->view('client/template/header');
			$this->load->view('client/template/head'); 
			$this->load->view('client/template/left-menu-projet');        
			$this->load->view('client/projet/culture',$data1);
			$this->load->view('client/template/footer');
		}
		public function agenda()
		{
			$this->session->set_userdata('menu',"Agenda");
			$data1["titre_page"]="Agenda";
			$data1["liste_tache"]=$this->Tache_model->liste_tache_projet($this->session->userdata('id_projet'));
		    $this->load->view('client/template/header');
		    $this->load->view('client/template/head'); 
			$this->load->view('client/template/left-menu-projet');        
		    $this->load->view('client/projet/agenda',$data1);
			$this->load->view('client/template/footer');		
		}
		public function rapport()
		{
			$this->session->set_userdata('menu',"Rapports");
			$data1["titre_page"]="Rapports";
			$data1["liste_rapport"]=$this->Report_model->liste_rapport_projet();
		    $this->load->view('client/template/header');
		    $this->load->view('client/template/head'); 
			$this->load->view('client/template/left-menu-projet');        
		    $this->load->view('client/projet/report',$data1);
			$this->load->view('client/template/footer');		
		}
		public function tache()
		{
			$this->session->set_userdata('menu',"tache");
			$data1["titre_page"]="Tâches";
			if ($this->uri->segment(3)) 
			{
				$data1["modif_tache"]=$this->Tache_model->infos_tache($this->uri->segment(3));
			}
			$data1["liste_etape"]=$this->Tache_model->liste_etape($this->session->userdata("id_projet"));
			$data1["liste_tache"]=$this->Tache_model->liste_tache_projet($this->session->userdata("id_projet"));
		    $this->load->view('client/template/header');
		    $this->load->view('client/template/head'); 
			$this->load->view('client/template/left-menu-projet');        
		    $this->load->view('client/projet/tache',$data1);
			$this->load->view('client/template/footer');		
		}
		public function sous_tache()
		{
			$this->session->set_userdata('menu',"tache");
			$data1["titre_page"]="Sous-tâche";
			if ($this->uri->segment(3) && $this->uri->segment(4)) 
			{
				$data1["modif_sous_tache"]=$this->Sous_tache_model->infos_sous_tache($this->uri->segment(4));
			}
			$data1["info_tache"]=$this->Tache_model->infos_tache($this->uri->segment(3));
			$this->session->set_userdata("id_tache",$this->uri->segment(3));
			$data1["liste_sous_tache"]=$this->Sous_tache_model->liste_sous_tache($this->uri->segment(3));
		    $this->load->view('client/template/header');
		    $this->load->view('client/template/head'); 
			$this->load->view('client/template/left-menu-projet');        
		    $this->load->view('client/projet/sous_tache',$data1);
			$this->load->view('client/template/footer');		
		}
		public function valider_critere_tache()
		{
			if(htmlspecialchars($this->input->post('date_debut'))!="")
			{
				$this->session->set_userdata('cri_date',htmlspecialchars($this->input->post('date_debut')));
				$this->session->set_userdata('date_search',htmlspecialchars($this->input->post('date_debut')));
			}
			if(htmlspecialchars($this->input->post('statut'))!="0")
			{
				$this->session->set_userdata('cri_statut',htmlspecialchars($this->input->post('statut')));
				$this->session->set_userdata('statut_search',htmlspecialchars($this->input->post('statut')));
			}
			if(htmlspecialchars($this->input->post('etape'))!="0")
			{
				$this->session->set_userdata('cri_etape',htmlspecialchars($this->input->post('etape')));
				$this->session->set_userdata('etape_search',htmlspecialchars($this->input->post('etape')));
			}
			redirect("Projet/tache");		
		}
		public function activite()
		{
			$this->session->set_userdata('menu',"activite");
			$data1["titre_page"]="Activités";
			if ($this->uri->segment(3)) 
			{
				$data1["modif_activite"]=$this->Activite_model->infos_activite($this->uri->segment(3));
			}
		    $this->load->view('client/template/header');
		    $this->load->view('client/template/head'); 
			$this->load->view('client/template/left-menu-projet');        
		    $this->load->view('client/projet/activite',$data1);
			$this->load->view('client/template/footer');		
		}
		public function alerte()
		{
			$this->session->set_userdata('menu',"alerte");
			$data1["titre_page"]="Alerte";
			$data1["liste_tache_hors_delais"]=$this->Tache_model->liste_tache_hors_delais_projet($this->session->userdata('id_projet'));

			$activite=$this->Activite_model->liste_activite_proche_projet($this->session->userdata('id_projet'));
			$designation_activite_proche=array();
			$date_activite_proche=array();
			$description_activite_proche=array();
			$i=0;
			foreach ($activite->result() as $row) 
			{
				$date_activite= new DateTime($row->date_debut_activite);
				$date_jour=new DateTime(date("Y-m-d"));
				$temps=date_diff($date_activite,$date_jour);
				if($temps->format('%d')>0 && ($row->periodicite_activite-$temps->format('%d')%$row->periodicite_activite)<=7)
				{
					$designation_activite_proche[$i]=$row->designation_activite;
					$date_activite_proche[$i]=date("Y-m-d",strtotime(date('Y-m-d').'+'.($row->periodicite_activite-$temps->format('%d')%$row->periodicite_activite).' days'));
					$description_activite_proche[$i]=$row->description_activite;
					$i+=1;
				}
			}
			if($activite->num_rows()>0)
			{
				$data1["designation_activite_proche"]=$designation_activite_proche;
				$data1["date_activite_proche"]=$date_activite_proche;
				$data1["description_activite_proche"]=$description_activite_proche;
			}
		    $this->load->view('client/template/header');
		    $this->load->view('client/template/head'); 
			$this->load->view('client/template/left-menu-projet');        
		    $this->load->view('client/projet/alerte',$data1);
			$this->load->view('client/template/footer');		
		}

		public function cloturer_sous_tache()
		{
			if($this->uri->segment(3)!='' && $this->uri->segment(4)!='')
			{
				$sous_tache=array(
					'date_realisation_sous_tache' =>date("Y-m-d")
				);
				$this->Sous_tache_model->modifier_sous_tache($sous_tache,$this->uri->segment(3));
				$this->actualiser_etat_tache($this->uri->segment(4));
				$this->actualiser_etat_projet();
				$this->session->set_userdata('operation','1');		
			}
			redirect("Projet/Home_projet_client/".$this->session->userdata("id_projet"));	
		}
		public function cloturer_tache()
		{
			if($this->uri->segment(3)!='')
			{
				$data=array(
					'etat_tache' =>100,
					'date_realisation_tache' => htmlspecialchars($this->input->post('date_realisation'))
				);
				$comment=array(
					'contenu_commentaire' =>htmlspecialchars($this->input->post('commentaire')),
					'id_tache' => $this->uri->segment(3),
					'date_creation_commentaire' =>date("Y-m-d H:i:s")
				);
				$id=$this->Commentaire_model->inserer_commentaire($comment);
				$nom_fichier=htmlspecialchars($this->upload_fichier());
				$fichier=array(
					'emplacement_fichier' => "assets/documents/Rapports/".$nom_fichier,
					'designation_fichier' => $nom_fichier,
					'id_commentaire' =>$id
				);
				$this->Fichier_model->inserer_fichier($fichier);
				$this->Tache_model->modifier_tache($data,$this->uri->segment(3));
				$liste_sous_tache=$this->Sous_tache_model->liste_sous_tache($this->uri->segment(3));
				foreach ($liste_sous_tache->result() as $key) 
				{
					$id_sous_tache=$key->id_sous_tache;
					$data1=array(
						'date_realisation_sous_tache' =>date("Y-m-d")
					);
					$this->Sous_tache_model->modifier_sous_tache($data1,$id_sous_tache);
				}
				$this->actualiser_etat_projet();
				$this->session->set_userdata('operation','1');	
			}	
			redirect("Projet/Home_projet_client/".$this->session->userdata("id_projet"));
		}
		public function actualiser_etat_tache($id_tache)
		{
			$nb_sous_tache=$this->Sous_tache_model->nb_sous_tache($id_tache);
			if($nb_sous_tache>0)
			{
				$nb_sous_tache_termine=$this->Sous_tache_model->nb_sous_tache_termine($id_tache);
				$tache=array(
					'etat_tache' =>(float)(($nb_sous_tache_termine*100)/$nb_sous_tache)-5
				);
				$this->Tache_model->modifier_tache($tache,$id_tache);
			}			
		}
		public function actualiser_etat_projet()
		{
			$nb_tache=$this->Tache_model->nb_tache($this->session->userdata('id_projet'));
			$nb_tache_termine=$this->Tache_model->nb_tache_termine($this->session->userdata('id_projet'));
			$projet=array(
				'etat_projet' =>(float)(($nb_tache_termine*100)/$nb_tache)
			);
			$this->Projet_model->modifier_projet($projet,$this->session->userdata('id_projet'));
		}
		function upload_fichier()
		{
			if($_FILES["document"]['name']!='')
			{
				$new_name=time().str_replace(' ', '',$_FILES["document"]['name']);
				$config['upload_path']='./assets/documents/Tache/';
				$config['allowed_types']='pdf|docx|txt';
				$config['file_name']=$new_name;
				$this->load->library('upload',$config);
				$this->upload->initialize($config);
				if(!$this->upload->do_upload('document'))
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
		

}

