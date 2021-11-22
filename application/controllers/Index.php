<?php

class Index extends MY_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ad_model');
		$this->load->model('Account_model');
		$this->load->model('culture_model');
		$this->load->model('testimony_model');
		$this->load->model('Statistics_model');
		$this->load->model('membre_model');
	}

	public function index()
	{
		$data["liste_annonce"]=$this->ad_model->liste_annonce();
		$data["liste_culture"]=$this->culture_model->liste_culture_accueil();
		$data["liste_temoignage"]=$this->testimony_model->liste_temoignage();
		$data["nb_culture"]=$this->Statistics_model->nb_culture();
		$data["nb_membre"]=$this->Statistics_model->nb_membre();
		$data["nb_projet"]=$this->Statistics_model->nb_projet_accueil();
		$data["nb_astuce"]=$this->Statistics_model->nb_astuce();
		$this->load->view('index',$data);
	}

	public function forum()
	{
		$this->load->view('forum/forum');
	}
	public function page_de_connexion()
	{ 
		
		$this->load->view('login/connexion');
	}
	public function mot_passe_oublie(){       
		$this->load->view('login/forgot');
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
							'identifiant' =>$identifiant,
							'mot_de_passe' =>$mot_de_passe,
							'id_membre' =>$row->id_membre,
							'nom_membre' =>$row->nom_membre,
							'prenom_membre' =>$row->prenom_membre,
							'photo_membre' =>$row->photo_membre,
					);
					$this->session->set_userdata($session_data);
					if($this->session->userdata("etat_compte")=="0")
					{
						$this->session->set_flashdata('incorrect',"Votre compte est inactif !");
						redirect('Index/page_de_connexion');
					}
					else
					{
						if($this->session->userdata("categorie_compte")=="0")
						{
							//admin
							//redirect("Home/index_accueil");
							echo "Admin";						
						}
						else
						{
							if($this->session->userdata("categorie_compte")=="1")
							{
								redirect('Home/Home_client');
								echo "client";
							}
							else
							{
								$this->session->set_flashdata('incorrect','Un problème a été trouvé lors de votre authentification !');
								redirect('Index/page_de_connexion');
							}						
						}
					}					
				}
			}	
		}
		else
		{
			$this->session->set_flashdata('incorrect','Vos informations sont incorrectes !');
			redirect('Index/page_de_connexion');
			
		}
	}
	public function reinitialiser_mdp()
	{
		$identifiant=htmlspecialchars($this->input->post('login'));
		$email=htmlspecialchars($this->input->post('email'));
		if(($email=$this->Account_model->changer_mdp($identifiant,$email))!=-1)
		{
			$new_mdp=$this->generate_password(15);
			$data=array(
				'password' =>$new_mdp
			);
			$this->Account_model->modifier_compte_login($data,$identifiant);
			$this->session->set_userdata('operation','1');
			$this->send_mail($email,$identifiant,$new_mdp);
			redirect('Index/page_de_connexion');
		}
		else
		{
			$this->session->set_flashdata('incorrect','Aucun compte ne correspond !');
			redirect('Index/mot_passe_oublie');
		}
	}
	public function deconnexion()
	{
		$this->session->unset_userdata('identifiant');
	    $this->session->unset_userdata('mot_de_passe');
	    $this->session->unset_userdata('id_membre');
	    $this->session->unset_userdata('nom_membre');
	    $this->session->unset_userdata('prenom_membre');
	    $this->session->unset_userdata('photo_membre');
	    $this->session->unset_userdata('categorie_compte');
		redirect('index');
	}
	public function send_mail($to,$login,$password)
	{
		$this->load->library('email');
		$config = array(
			'newline' => "\r\n",  
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com', 
			'smtp_port' => 465,  
              	'smtp_user' => 'brayan.tchappi@gmail.com',
              	'smtp_pass' => 'tchappi.brayan', 
              	'charset' => 'utf-8',
              	'mailtype' => 'html', 
              	'smtp_timeout'=>'60',
              	'validation' =>TRUE
              );

		$message='<br>   Bonjour,<br> Votre compte à été réinitialisé avec succès <br>Vos nouveaux identifiants sont les suivants : <br>
		Identifiant : <strong> '.$login.'</strong><br>
		Mot de passe : <strong>'.$password.'</strong>
		<br>Merci de changer votre mot de passe lors de votre prochaine connexion.
		<br>Nous restons au coeur de vos préoccupations';     
		$this->email->initialize($config);
		$this->email->from('brayan.tchappi@gmail.com');
		$this->email->to($to);
		$this->email->subject("Informations de connexion SSA");
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
	public function ecran_bloque()
	{
		$data1["infos_connecte"]=$this->membre_model->infos_membre($this->session->userdata('id_membre'));
		$this->load->view('client/home/lock_screen',$data1);
	}
	public function verrouiller_session()
	{
		$this->session->set_userdata('identifiant1',$this->session->userdata('identifiant'));
		$this->session->unset_userdata('identifiant');
		redirect('Index/ecran_bloque');
	}
	public function deverrouiller_session()
	{
		if($this->session->userdata('identifiant1') !='')
		{
			$mot_de_passe=$this->input->post('password');
			if($this->session->userdata('mot_de_passe') ==$mot_de_passe)
			{
				$this->session->set_userdata('identifiant',$this->session->userdata('identifiant1'));
				$this->session->unset_userdata('identifiant1');
				redirect($this->session->userdata('page'));
			}
			else
			{
				redirect('Index/ecran_bloque');
			}
		}
		else
		{
			$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
			redirect('Index/page_de_connexion');
		}
	}

	
}

