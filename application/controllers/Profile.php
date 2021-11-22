<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Profile extends MY_Controller
	{
		public function __construct()
		{
			parent::__construct();
			if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_membre') !='')
            {
                
				$this->load->model('Account_model');
				$this->load->model('membre_model');
				$this->load->model('Site_model');
				$this->load->model('Projet_model');
				$this->load->model('Tache_model');
            }
            else
            {
                $this->session->set_flashdata('incorrect','Identifiez-vous svp !');
                redirect('Index/page_de_connexion');
            }
			
		}
		public function index()
		{
			$this->session->set_userdata('menu',"profil");
			$data1["titre_page"]="Profil";
			$data1["infos_connecte"]=$this->membre_model->infos_membre($this->session->userdata('id_membre'));
			$data1["infos_projet"]=$this->Projet_model->liste_projet_client($this->session->userdata('id_membre'));
			$data3["liste_site"]=$this->Site_model->liste_site_client($this->session->userdata('id_membre'));
		    $this->load->view('client/template/header');
		    $this->load->view('client/template/head'); 
			$this->load->view('client/template/left-menu',$data3);        
		    $this->load->view('client/profile/profile',$data1);
			$this->load->view('client/template/footer');		
		}
		public function agenda()
		{
			$this->session->set_userdata('menu',"Agenda");
			$data1["titre_page"]="Agenda";
			$data1["liste_tache"]=$this->Tache_model->liste_tache_membre($this->session->userdata('id_membre'));
			$data3["liste_site"]=$this->Site_model->liste_site_client($this->session->userdata('id_membre'));
		    $this->load->view('client/template/header');
		    $this->load->view('client/template/head'); 
			$this->load->view('client/template/left-menu',$data3);        
		    $this->load->view('client/profile/agenda',$data1);
			$this->load->view('client/template/footer');		
		}
		public function modifier_securite()
		{
			$this->form_validation->set_rules("identifiant","Identifiant",'required',array('required' => "L'identifiant est obligatoire"));
			if($this->form_validation->run())
			{
				if(htmlspecialchars($this->input->post('amdp'))!=$this->session->userdata('mot_de_passe'))
				{
					$this->session->set_userdata('echec_1','1');
				}
				else
				{
					if(htmlspecialchars($this->input->post('nmdp'))!=htmlspecialchars($this->input->post('cmdp')))
					{
						$this->session->set_userdata('echec_2','1');
					}
					else
					{
						$this->Account_model->supprimer_compte($this->session->userdata('identifiant'),$this->session->userdata('mot_de_passe'),$this->session->userdata('id_membre'));
						$data1=array(
							'login' => htmlspecialchars($this->input->post('identifiant')),
							'password' => htmlspecialchars($this->input->post('nmdp')),
							'id_membre' => $this->session->userdata('id_membre'),
							'etat' =>"1",
							'categorie' => $this->session->userdata("categorie_compte")
						);
						$this->Account_model->ajouter_compte($data1);
						$this->session->set_userdata('identifiant',htmlspecialchars($this->input->post('identifiant')));
						$this->session->set_userdata('mot_de_passe',htmlspecialchars($this->input->post('nmdp')));
						$this->session->set_userdata('operation','1');
					}
				}
				redirect('Profile');
			}
			else
			{
				$this->session->set_userdata('echec_3','1');
				redirect('Profile');
			}			
		}
		public function modifier_profil()
		{
			$data1["infos_connecte"]=$this->membre_model->infos_membre($this->session->userdata('id_membre'));
			$data1["titre_page"]="Profil";
			$data3["liste_site"]=$this->Site_model->liste_site_client($this->session->userdata('id_membre'));
		    $this->load->view('client/template/header');
		    $this->load->view('client/template/head'); 
			$this->load->view('client/template/left-menu',$data3);        
		    $this->load->view('client/profile/edit_profile',$data1);
			$this->load->view('client/template/footer');			
		}
		public function valider_formulaire()
		{
			if($this->uri->segment(3))
			{
				if($this->uri->segment(3)!=$this->session->userdata("id_membre"))
				{
					$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
                	redirect('Index/page_de_connexion');
				}
				else
				{
					$id_membre_modif=$this->uri->segment(3);
				}				
			}
			$this->form_validation->set_rules("email","email",'required|valid_email',array('required' => 'Ce champ est obligatoire',"valid_email" => "Cette adresse email est invalide"));
			if($this->form_validation->run())
			{
				if($_FILES["photos"]['name']!='')
				{
					$image=htmlspecialchars($this->upload_image());
					$data=array
					(
						'photo_membre' => "assets/images/avatars/".$image,
						'nom_membre' =>  htmlspecialchars($this->input->post('nom')),
						'prenom_membre' =>  htmlspecialchars($this->input->post('prenom')),
						"date_naiss_membre" => htmlspecialchars($this->input->post('date_naiss')),
						"lieu_naiss_membre" => htmlspecialchars($this->input->post('lieu_naiss')),
						"sexe_membre" => htmlspecialchars($this->input->post('sexe')),
						"nationalite_membre" => htmlspecialchars($this->input->post('nationalite')),
						'email_membre' =>  htmlspecialchars($this->input->post('email')),
						'telephone_membre' =>  htmlspecialchars($this->input->post('telephone')),
						'domicile_membre' =>  htmlspecialchars($this->input->post('domicile'))
					);
					$this->session->set_userdata("photo_membre","assets/images/avatars/".$image);
				}
				else
				{
					$data=array
					(
						'nom_membre' =>  htmlspecialchars($this->input->post('nom')),
						'prenom_membre' =>  htmlspecialchars($this->input->post('prenom')),
						"date_naiss_membre" => htmlspecialchars($this->input->post('date_naiss')),
						"lieu_naiss_membre" => htmlspecialchars($this->input->post('lieu_naiss')),
						"sexe_membre" => htmlspecialchars($this->input->post('sexe')),
						"nationalite_membre" => htmlspecialchars($this->input->post('nationalite')),
						'email_membre' =>  htmlspecialchars($this->input->post('email')),
						'telephone_membre' =>  htmlspecialchars($this->input->post('telephone')),
						'domicile_membre' =>  htmlspecialchars($this->input->post('domicile'))
					);
				}
				$this->session->set_userdata("nom_membre",htmlspecialchars($this->input->post('nom')));
				$this->session->set_userdata("prenom_membre",htmlspecialchars($this->input->post('prenom')));
				$this->membre_model->modifier_membre($data,$id_membre_modif);								
				$this->session->set_userdata('modification','1');
				redirect('Profile');
			}
			else
			{
				if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !=''  && $this->session->userdata('id_membre') !='')
				{
					$data1["infos_connecte"]=$this->membre_model->infos_membre($this->session->userdata('id_membre'));
					$data1["titre_page"]="Profil";
					$data1["id_membre_modif"]=$this->uri->segment(3);
					$data3["liste_site"]=$this->Site_model->liste_site_client($this->session->userdata('id_membre'));
				    $this->load->view('client/template/header');
				    $this->load->view('client/template/head'); 
					$this->load->view('client/template/left-menu',$data3);        
				    $this->load->view('client/profile/edit_profile',$data1);
					$this->load->view('client/template/footer');
				}
				else
				{
					$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
                	redirect('Index/page_de_connexion');
				}

			}
		}
		function upload_image()
		{
			if($_FILES["photos"]['name']!='')
			{
				$new_name=time().str_replace(' ', '',$_FILES["photos"]['name']);
				$config['upload_path']='./assets/images/avatars';
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













		
		
		public function sauvegarder_epreuve()
		{
			if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_etablissement') !='')
			{
			    $liste_epreuve=$this->Epreuve_facultative_model->liste_epreuve();
			    $this->Epreuve_facultative_model->supprimer_epreuve_centre($this->session->userdata('id_etablissement'));
			    foreach ($liste_epreuve->result() as $row)
		        {
					if($this->input->post('epreuve'.$row->id_epreuve_facultative)!='')
					{
		           		$data=array(
		           			"centre_examen_id" => $this->session->userdata('id_etablissement'),
		           			"epreuve_facultative_id"=>$row->id_epreuve_facultative
		           		);
		           		$this->Epreuve_facultative_model->inserer_epreuve_centre($data);
		           		$this->session->set_userdata('operation','1');
					}
		        }
			    redirect('Profile');
			}
			else
			{
				$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
				redirect('Index/page_de_connexion');
			}
		}
	}

