<?php
	class Activite extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('Activite_model');
		}
		function chercher_activite_projet()
		{
			$chercher_activite=$this->Activite_model->make_datatables($this->session->userdata('id_projet'));
			$data=array();
			foreach ($chercher_activite as $row) {
				$sub_array=array();
				$sub_array[]=$row->designation_activite;
				$sub_array[]=$row->description_activite;
				$sub_array[]=$row->date_debut_activite;
				$sub_array[]=$row->periodicite_activite;

				$date_activite= new DateTime($row->date_debut_activite);
				$date_jour=new DateTime(date("Y-m-d"));
				$temps=date_diff($date_activite,$date_jour);					
				$date_activite_proche=date("Y-m-d",strtotime(date('Y-m-d').'+'.($row->periodicite_activite-$temps->format('%d')%$row->periodicite_activite).' days'));
				$sub_array[]="<span class='text-success font-weight-bold'>".$date_activite_proche."</span>";

				$sub_array[]='<a type="button" name="modifier" href="'.base_url("Projet/activite/".$row->id_activite).'" class="btn btn-warning btn-md text-white"><span class="fa fa-pencil"></span></a>';
				$sub_array[]='<a type="button" name="supprimer" id="'.$row->id_activite.'" class="retirer_activite btn btn-danger btn-md text-white"><span class="fa fa-trash"></span></a>';
				$data[]=$sub_array;
			}
			$output=array(
				"draw" => intval($_POST["draw"]),
				"recordsTotal" => $this->Activite_model->get_all_data($this->session->userdata('id_projet')),
				"recordsFiltered" => $this->Activite_model->get_filtered_data($this->session->userdata('id_projet')),
				"data"  => $data
			);
			echo json_encode($output);
		}
		public function valider_formulaire()
		{
			if($this->uri->segment(3))
			{
				$id_activite_modif=$this->uri->segment(3);
			}
			$this->form_validation->set_rules("designation","designation",'required',array('required' => "Ce champ est obligatoire"));
			$this->form_validation->set_rules("periodicite","periodicite",'is_natural',array('is_natural' => "Veuillez entrer un entier"));
			if($this->form_validation->run())
			{
				$data=array(
					'id_projet'=>htmlspecialchars($this->session->userdata('id_projet')),
					'designation_activite'=>htmlspecialchars($this->input->post('designation')),
					'date_debut_activite'=>htmlspecialchars($this->input->post('date_debut')),
					'periodicite_activite'=>htmlspecialchars($this->input->post('periodicite')),
					'description_activite'=>htmlspecialchars($this->input->post('description'))
				);
				if(isset($id_activite_modif))
				{
					$this->Activite_model->modifier_activite($data,$id_activite_modif);
				}
				else
				{
					$this->Activite_model->inserer_activite($data);
				}
				$this->session->set_userdata('operation','1');
				redirect('Projet/activite');
			}
			else
			{
				if($this->uri->segment(3))
				{
					$data1["id_activite_modif"]=$this->uri->segment(3);
				}
				$this->session->set_userdata('menu',"activite");
				$data1["titre_page"]="Activités";
			    $this->load->view('client/template/header');
			    $this->load->view('client/template/head'); 
				$this->load->view('client/template/left-menu-projet');        
			    $this->load->view('client/projet/activite',$data1);
				$this->load->view('client/template/footer');
			}
		}
		public function retirer_activite()
		{
			if($this->uri->segment(3))
			{
				$this->Activite_model->retirer_activite($this->uri->segment(3));
			}
		}
	}

