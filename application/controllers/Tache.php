<?php
	class Tache extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('Tache_model');
			$this->load->model('Projet_model');
			$this->load->model('Sous_tache_model');
		}
		public function chercher_tache_projet()
		{
			$chercher_tache=$this->Tache_model->make_datatables($this->session->userdata('id_projet'));
			$data=array();
			foreach ($chercher_tache as $row) {
				$sub_array=array();
				$sub_array[]=$row->intitule_tache;
				$sub_array[]=$row->date_debut_tache;
				$sub_array[]=$row->date_echeance_tache;
				$sub_array[]=$row->etat_tache." % ";
				$sub_array[]='<button type="button" class="btn-transition btn btn-outline-primary" data-toggle="modal" data-target="#tache'.$row->id_tache.'"><span class="fa fa-eye"></span></button>';
				$sub_array[]='<a type="button" name="gerer" href="'.base_url("Projet/sous_tache/".$row->id_tache).'" class="btn btn-outline-success btn-md"><span class="fa fa-sliders"></span></a>';
				if($row->date_realisation_tache!="0000-00-00")
				{
					$sub_array[]="/";
					$sub_array[]="/";
				}
				else
				{
					$sub_array[]='<a type="button" name="modifier" href="'.base_url("Projet/tache/".$row->id_tache).'" class="btn btn-outline-warning btn-md"><span class="fa fa-pencil"></span></a>';
					$sub_array[]='<a type="button" name="supprimer" id="'.$row->id_tache.'" class="retirer_tache btn btn-outline-danger btn-md"><span class="fa fa-trash"></span></a>';
				}
				
				$data[]=$sub_array;
			}
			$output=array(
				"draw" => intval($_POST["draw"]),
				"recordsTotal" => $this->Tache_model->get_all_data($this->session->userdata('id_projet')),
				"recordsFiltered" => $this->Tache_model->get_filtered_data($this->session->userdata('id_projet')),
				"data"  => $data
			);
			echo json_encode($output);
		}
		public function valider_formulaire()
		{
			if($this->uri->segment(3))
			{
				$id_tache_modif=$this->uri->segment(3);
			}
			$this->form_validation->set_rules("designation","designation",'required',array('required' => "Ce champ est obligatoire"));
			if($this->form_validation->run())
			{
				if($_FILES["photos"]['name']!='')
				{
					$image=htmlspecialchars($this->upload_image());
					$data=array(
						'image_tache' => "assets/images/tache/".$image,
						'id_projet'=>htmlspecialchars($this->session->userdata('id_projet')),
						'intitule_tache'=>htmlspecialchars($this->input->post('designation')),
						'designation_etape'=>htmlspecialchars($this->input->post('etape')),
						'date_debut_tache'=>htmlspecialchars($this->input->post('date_debut')),
						'date_echeance_tache'=>htmlspecialchars($this->input->post('date_echeance')),
						'description_tache'=>htmlspecialchars($this->input->post('description')),
						'etat_tache' => '0',
						'date_realisation_tache' => '0000-00-00'
					);
				}
				else
				{
					$data=array(
						'id_projet'=>htmlspecialchars($this->session->userdata('id_projet')),
						'intitule_tache'=>htmlspecialchars($this->input->post('designation')),
						'designation_etape'=>htmlspecialchars($this->input->post('etape')),
						'date_debut_tache'=>htmlspecialchars($this->input->post('date_debut')),
						'date_echeance_tache'=>htmlspecialchars($this->input->post('date_echeance')),
						'description_tache'=>htmlspecialchars($this->input->post('description')),
						'etat_tache' => '0',
						'date_realisation_tache' => '0000-00-00'
					);
				}
				if(isset($id_tache_modif))
				{
					$this->Tache_model->modifier_tache($data,$id_tache_modif);
				}
				else
				{
					$id=$this->Tache_model->inserer_tache($data);
				}
				$this->actualiser_etat_projet();
				$this->session->set_userdata('operation','1');
				redirect('Projet/tache');
			}
			else
			{
				if($this->uri->segment(3))
				{
					$data1["id_tache_modif"]=$this->uri->segment(3);
				}
				$this->session->set_userdata('menu',"tache");
				$data1["titre_page"]="Tâches";
				$data1["liste_etape"]=$this->Tache_model->liste_etape($this->session->userdata("id_projet"));
				$data1["liste_tache"]=$this->Tache_model->liste_tache_projet($this->session->userdata("id_projet"));
			    $this->load->view('client/template/header');
			    $this->load->view('client/template/head'); 
				$this->load->view('client/template/left-menu-projet');        
			    $this->load->view('client/projet/tache',$data1);
				$this->load->view('client/template/footer');
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
		public function retirer_tache()
		{
			if($this->uri->segment(3))
			{
				$liste_sous_tache=$this->Sous_tache_model->liste_sous_tache($this->uri->segment(3));
				if($liste_sous_tache->num_rows()>0)
				{
					foreach ($liste_sous_tache->result() as $row) 
					{
						$this->Sous_tache_model->supprimer_sous_tache($row->id_sous_tache);
					}					
				}
				$this->Tache_model->supprimer_tache($this->uri->segment(3));
				$this->actualiser_etat_projet();
			}
		}
		public function upload_image()
		{
			if($_FILES["photos"]['name']!='')
			{
				$new_name=time().str_replace(' ', '',$_FILES["photos"]['name']);
				$config['upload_path']='./assets/images/tache';
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
	}

