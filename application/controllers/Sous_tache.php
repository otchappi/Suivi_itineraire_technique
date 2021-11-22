<?php
	class Sous_tache extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('Sous_tache_model');
			$this->load->model('Tache_model');
			$this->load->model('Projet_model');
		}
		public function cloturer_sous_tache()
		{
			if($this->uri->segment(3)!='' && $this->uri->segment(4)!='')
			{
				$sous_tache=array(
					'date_realisation_sous_tache' =>htmlspecialchars($this->input->post('date_realisation'))
				);
				$this->Sous_tache_model->modifier_sous_tache($sous_tache,$this->uri->segment(3));
				$this->actualiser_etat_tache($this->uri->segment(4));
				$this->actualiser_etat_projet();
				$this->session->set_userdata('operation','1');		
			}
			redirect("Projet/sous_tache/".$this->uri->segment(4));	
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
		function chercher_sous_tache_projet()
		{
			$chercher_sous_tache=$this->Sous_tache_model->make_datatables($this->uri->segment(3));
			$data=array();
			foreach ($chercher_sous_tache as $row) {
				$sub_array=array();
				$sub_array[]=$row->designation_sous_tache;
				$sub_array[]=$row->date_debut_sous_tache;
				$sub_array[]=$row->date_echeance_sous_tache;
				if($row->date_realisation_sous_tache!="0000-00-00")
				{
					$sub_array[]=$row->date_realisation_sous_tache;
					$sub_array[]="/";
					$sub_array[]="/";
					$sub_array[]="/";
				}
				else
				{
					$sub_array[]="Pas terminée";
					$sub_array[]='<button type="button" class="btn-transition btn btn-outline-primary" data-toggle="modal" data-target="#cloture'.$row->id_sous_tache.'"><span class="fa fa-check-square-o"></span></button>';
					$sub_array[]='<a type="button" name="modifier" href="'.base_url("Projet/sous_tache/".$this->uri->segment(3)."/".$row->id_sous_tache).'" class="btn btn-outline-warning btn-md"><span class="fa fa-pencil"></span></a>';
					$sub_array[]='<a type="button" name="supprimer" id="'.$row->id_sous_tache.'" class="retirer_sous_tache btn btn-outline-danger btn-md"><span class="fa fa-trash"></span></a>';
				}		
				$data[]=$sub_array;
			}
			$output=array(
				"draw" => intval($_POST["draw"]),
				"recordsTotal" => $this->Sous_tache_model->get_all_data($this->uri->segment(3)),
				"recordsFiltered" => $this->Sous_tache_model->get_filtered_data($this->uri->segment(3)),
				"data"  => $data
			);
			echo json_encode($output);
		}
		public function valider_formulaire()
		{
			if($this->uri->segment(3))
			{
				$id_sous_tache_modif=$this->uri->segment(3);
			}
			$this->form_validation->set_rules("designation","designation",'required',array('required' => "Ce champ est obligatoire"));
			if($this->form_validation->run())
			{
				$data=array(
					'id_tache'=>$this->session->userdata("id_tache"),
					'designation_sous_tache'=>htmlspecialchars($this->input->post('designation')),
					'date_debut_sous_tache'=>htmlspecialchars($this->input->post('date_debut')),
					'date_echeance_sous_tache'=>htmlspecialchars($this->input->post('date_echeance'))
				);
				if(isset($id_sous_tache_modif))
				{
					$this->Sous_tache_model->modifier_sous_tache($data,$id_sous_tache_modif);
				}
				else
				{
					$this->Sous_tache_model->inserer_sous_tache($data);
				}
				$this->actualiser_etat_tache($this->session->userdata("id_tache"));
				$this->session->set_userdata('operation','1');
				redirect('Projet/sous_tache/'.$this->session->userdata("id_tache"));
			}
			else
			{
				if($this->uri->segment(3))
				{
					$data1["id_sous_tache_modif"]=$this->uri->segment(3);
				}
				$this->session->set_userdata('menu',"tache");
				$data1["titre_page"]="Sous-tâche";
				$data1["info_tache"]=$this->Tache_model->infos_tache($this->uri->segment(3));
				$data1["liste_sous_tache"]=$this->Sous_tache_model->liste_sous_tache($this->uri->segment(3));
			    $this->load->view('client/template/header');
			    $this->load->view('client/template/head'); 
				$this->load->view('client/template/left-menu-projet');        
			    $this->load->view('client/projet/sous_tache',$data1);
				$this->load->view('client/template/footer');
			}
		}
		public function retirer_sous_tache()
		{
			if($this->uri->segment(3))
			{
				$this->Sous_tache_model->supprimer_sous_tache($this->uri->segment(3));
				$this->actualiser_etat_tache($this->session->userdata("id_tache"));
			}
		}
	}

