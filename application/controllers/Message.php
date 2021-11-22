<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Message extends MY_Controller
	{
		public function __construct()
		{
			parent::__construct();
			if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_membre') !='')
            {
                $this->load->model('membre_model');
                $this->load->model('Account_model');
				$this->load->model('Message_model');
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
			$this->session->set_userdata('menu',"Messagerie");
			$data1["infos_admin"]=$this->Account_model->infos_admin();
			$data1["liste_message"]=$this->Message_model->liste_message_client($this->session->userdata('identifiant'));
			$data1["titre_page"]="Messagerie";
			$data3["liste_site"]=$this->Site_model->liste_site_client($this->session->userdata('id_membre'));
			$data=array(
					'etat_message' =>"1"
			);
			$this->Message_model->marquer_lu($data,$this->session->userdata('identifiant'));
			$this->load->view('client/template/header');
			$this->load->view('client/template/head'); 
			$this->load->view('client/template/left-menu',$data3);        
			$this->load->view('client/message/client_chat',$data1);
			$this->load->view('client/template/footer');
		}
		public function envoyer_message()
		{
			$this->form_validation->set_rules("contenu","contenu",'required',array('required' => 'Saisissez le message'));
			if($this->form_validation->run())
			{
				$data=array(
					'objet_message' =>  htmlspecialchars($this->input->post('objet')),
					'contenu_message' => htmlspecialchars($this->input->post('contenu')),
					'date_creation_message' =>  date('Y-m-d H:i:s'),
					'etat_message' =>"0",
					'emeteur_message' => $this->session->userdata('identifiant'),
					'destinataire_message' => $this->session->userdata('admin')
				);
				$this->session->unset_userdata('admin');
				$this->Message_model->inserer_message($data);
				$this->session->set_userdata('operation','1');
				redirect(base_url("Message/index_client"));

			}
			else
			{
				redirect(base_url("Message/index_client"));				
			}
		}
















		public function messagerie_centre()
		{
			if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_etablissement') !='')
			{
				$this->session->set_userdata('menu',"Messagerie");
				$liste_etablissement=$this->Establishment_model->liste_etablissement_rattache($this->session->userdata("id_etablissement"));
				
				if($this->uri->segment(3))
				{
					$data1["infos_first_etab"]=$this->Establishment_model->infos_etablissement_base($this->uri->segment(3));
					$data1["liste_message"]=$this->Message_model->liste_message($this->session->userdata('id_etablissement'),$this->uri->segment(3));
					//$data1["liste_message"]=$this->Message_model->liste_message_etablissement($this->uri->segment(3),$this->session->userdata('id_etablissement'));
				}	
				else
				{
					$stop=0;
					$id=0;
					foreach ($liste_etablissement->result() as $key) 
					{
					   	if($stop==0)
					   	{
					   		$data1["infos_first_etab"]=$this->Establishment_model->infos_etablissement_base($key->id_etablissement);
					   		$id=$key->id_etablissement;
					   		$stop++;
					   		break;
					   	}				   	
					}
					$data1["liste_message"]=$this->Message_model->liste_message($this->session->userdata('id_etablissement'),$id);
					//$data1["liste_message"]=$this->Message_model->liste_message_etablissement($id,$this->session->userdata('id_etablissement'));
				}			
				$data1["liste_etablissement"]=$liste_etablissement;
				$data1["intitule_session"]=$this->Session_model->intitule_session($this->session->userdata('id_session'));
				$data1["intitule_examen"]=$this->Exam_model->intitule_examen($this->session->userdata('id_examen'));
				$data3["liste_session"]=$this->Session_model->liste_session();
				$data3["liste_examen"]=$this->Exam_model->liste_examen();
				$header=array('titre'=>'Messagerie');
		        $this->load->view('establishment/template/header',$header);
		        $this->load->view('establishment/template/head'); 
				$this->load->view('establishment/template/left-menu');        
		        $this->load->view('establishment/message/exam_center_chat',$data1);
				$this->load->view('establishment/template/footer',$data3);
			}
			else
			{
				$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
				redirect('Index/page_de_connexion');
			}
		}
		public function supprimer_message()
		{
			if($this->uri->segment(3))
			{
				$this->Message_model->supprimer_message($this->uri->segment(3));
			}
		}
		/*************************************************************************
					Hermann
		****************************************************************************/

		public function obc_message_conversation()
		{
			$etab=htmlspecialchars($this->input->post('desti'));
			redirect(base_url("Message/obc_message/".$etab));
		}
		public function obc_message()
		{
			if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_etablissement') !='')
			{
				$this->session->set_userdata('menu',"obc_Message");
				$liste_centre=$this->Establishment_model->liste_centre_examen();
				
				if($this->uri->segment(3))
				{
					$data1["infos_first_etab"]=$this->Establishment_model->infos_etablissement_base($this->uri->segment(3));
					$data1["liste_message"]=$this->Message_model->liste_message_etablissement($this->uri->segment(3),$this->session->userdata('id_etablissement'));
				}	
				else
				{
					$stop=0;
					$id=0;
					foreach ($liste_centre->result() as $key) 
					{
					   	if($stop==0)
					   	{
					   		$data1["infos_first_etab"]=$this->Establishment_model->infos_etablissement_base($key->id_etablissement);
					   		$id=$key->id_etablissement;
					   		$stop++;
					   		break;
					   	}				   	
					}
					$data1["liste_message"]=$this->Message_model->liste_message_etablissement($id,$this->session->userdata('id_etablissement'));
				}			
				$data1["liste_etablissement"]=$liste_centre;
				$data1["intitule_session"]=$this->Session_model->intitule_session($this->session->userdata('id_session'));
				$data1["intitule_examen"]=$this->Exam_model->intitule_examen($this->session->userdata('id_examen'));
				$data3["liste_session"]=$this->Session_model->liste_session();
				$data3["liste_examen"]=$this->Exam_model->liste_examen();
				$header=array('titre'=>'Messagerie');
		        $this->load->view('obc/template/header',$header);
		        $this->load->view('obc/template/head'); 
				$this->load->view('obc/template/left-menu');        
		        $this->load->view('obc/message/obc_Message',$data1);
				$this->load->view('obc/template/footer',$data3);
			}
			else
			{
				$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
				redirect('Index/page_de_connexion');
			}
		}
		public function nouveau_message()
		{
			if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_etablissement') !='')
			{
				$this->session->set_userdata('menu',"New_Message");
				$liste_centre=$this->Establishment_model->liste_centre_examen();
							
				$data1["liste_etablissement"]=$liste_centre;
				$data1["intitule_session"]=$this->Session_model->intitule_session($this->session->userdata('id_session'));
				$data1["intitule_examen"]=$this->Exam_model->intitule_examen($this->session->userdata('id_examen'));
				$data3["liste_session"]=$this->Session_model->liste_session();
				$data3["liste_examen"]=$this->Exam_model->liste_examen();
				$header=array('titre'=>'Messagerie');
		        $this->load->view('obc/template/header',$header);
		        $this->load->view('obc/template/head'); 
				$this->load->view('obc/template/left-menu');
		        $this->load->view('obc/message/new_message',$data1);
				$this->load->view('obc/template/footer',$data3);
			}
			else
			{
				$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
				redirect('Index/page_de_connexion');
			}
		}

		public function envoyer_message_obc()
		{
			if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_etablissement') !='')
			{
				$this->form_validation->set_rules("contenu","contenu",'required',array('required' => 'Saisissez le message'));
				if($this->form_validation->run())
				{
					$etab=0;
					if($this->session->userdata("recepteur")!="")
					{
						$etab=$this->session->userdata('recepteur');
						$data=array(
							'objet_message' =>  htmlspecialchars($this->input->post('objet')),
							'contenu_message' => htmlspecialchars($this->input->post('contenu')),
							'date_creation_message' =>  date('Y-m-d H:i:s'),
							'expediteur_id' => $this->session->userdata('id_etablissement'),
							'recepteur_id' => $this->session->userdata('recepteur')
						);
						$this->session->unset_userdata("recepteur");
						$this->session->unset_userdata('id_centre_examen');
						$this->Message_model->inserer_message($data);
						$this->session->set_userdata('operation','1');
						redirect(base_url("Message/obc_message/".$etab));
					}
					else
					{
						redirect(base_url("Message/obc_message"));	
					}
				}
				else
				{
					redirect(base_url("Message/obc_message"));					
				}
			}
			else
			{
				$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
				redirect('Index/page_de_connexion');
			}
		}
		public function envoyer_nouveau_message()
		{
			if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_etablissement') !='')
			{
				$this->form_validation->set_rules("contenu","contenu",'required',array('required' => 'Saisissez le message'));
				if($this->form_validation->run())
				{
					$tab=array();
					$tab=$this->input->post('desti');
					for ($i=0; $i <count($tab) ; $i++) 
					{ 
					 	$data=array(
							'objet_message' =>  htmlspecialchars($this->input->post('objet')),
							'contenu_message' => htmlspecialchars($this->input->post('contenu')),
							'date_creation_message' =>  date('Y-m-d H:i:s'),
							'expediteur_id' => "1",
							'recepteur_id' => $tab[$i]
						);
						$this->Message_model->inserer_message($data);
						$this->session->set_userdata('operation','1');
						redirect(base_url("Message/nouveau_message"));
					}
				}
				else
				{
					redirect(base_url("Message/nouveau_message"));					
				}
			}
			else
			{
				$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
				redirect('Index/page_de_connexion');
			}
		}

	}

