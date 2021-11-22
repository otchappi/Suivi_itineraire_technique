<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
			if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_membre') !='')
            {
				$this->load->model('membre_model');
				$this->load->model('Site_model');
				$this->load->model('Tache_model');
				$this->load->model('activite_model');
				$this->load->model('Message_model');
				$this->load->model('Culture_model');
				$this->load->model('Ad_model');
				$this->load->model('Statistics_model');				
            }
            else
            {
                $this->session->set_flashdata('incorrect','Identifiez-vous svp !');
                redirect('Index/page_de_connexion');
           	}

		
	}

	public function Home_client()
	{

		$this->session->set_userdata('menu',"tableau_bord");
			$data2["titre_page"]="Tableau de Bord";
			$data3["liste_site"]=$this->Site_model->liste_site_client($this->session->userdata('id_membre'));
			$data2["liste_tache_hors_delais"]=$this->Tache_model->liste_tache_hors_delais_membre($this->session->userdata('id_membre'));
			$data2["liste_new_culture"]=$this->Culture_model->liste_culture_accueil();
			$data2["liste_tache_auday"]=$this->Tache_model->liste_tache_jour_membre($this->session->userdata('id_membre'));
			$data2["liste_tache_morrow"]=$this->Tache_model->liste_tache_demain_membre($this->session->userdata('id_membre'));
			$data2["liste_new_annonce"]=$this->Ad_model->liste_annonce();
			$data2["liste_new_message"]=$this->Message_model->liste_new_message($this->session->userdata('identifiant'));
			$data2["nb_culture"]=$this->Statistics_model->nb_culture();
			$data2["nb_projet"]=$this->Statistics_model->nb_projet($this->session->userdata('id_membre'));
			$data2["nb_site"]=$this->Statistics_model->nb_site($this->session->userdata('id_membre'));
			$data2["nb_rapport"]=$this->Statistics_model->nb_rapport($this->session->userdata('id_membre'));
			$activite=$this->activite_model->liste_activite_proche($this->session->userdata('id_membre'));
			$designation_activite_proche=array();
			$date_activite_proche=array();
			$projet_activite_proche=array();
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
					$projet_activite_proche[$i]=$row->titre_projet;
					$i+=1;
				}
			}
			if($activite->num_rows()>0)
			{
				$data2["designation_activite_proche"]=$designation_activite_proche;
				$data2["date_activite_proche"]=$date_activite_proche;
				$data2["projet_activite_proche"]=$projet_activite_proche;
			}
	        $this->load->view('client/template/header');
	        $this->load->view('client/template/head'); 
			$this->load->view('client/template/left-menu',$data3);        
	        $this->load->view('client/home/home',$data2);
			$this->load->view('client/template/footer');
	}

		
}
