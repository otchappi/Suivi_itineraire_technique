<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Report extends MY_Controller
	{
		public function __construct()
		{
			parent::__construct();
			if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_membre') !='')
	        {
	            $this->load->model('Report_model');
	        }
	        else
	        {
	           	$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
	            redirect('Index/page_de_connexion');
	        }
			
		}

		public function valider_formulaire()
		{
			$this->form_validation->set_rules("titre_doc","titre_doc",'required|is_unique[rapport.titre_rapport]',array('required'=>'Ce champ est obligatoire','is_unique' => 'Ce titre existe'));
			if($this->form_validation->run())
			{
				$data=array(
					'titre_rapport' =>  htmlspecialchars($this->input->post('titre_doc')),
					'emplacement_rapport' => "assets/documents/Rapports/". htmlspecialchars($this->upload_fichier()),
					'date_creation_rapport' =>  date('Y-m-d H:i:s'),
					'id_projet' => $this->session->userdata('id_projet')
				);
				$this->Report_model->inserer_rapport($data);
				$this->session->set_userdata('operation','1');
				redirect("Projet/rapport");
			}
			else
			{
				redirect("Projet/rapport");

			}
		}
		function upload_fichier()
		{
			if($_FILES["document"]['name']!='')
			{
				$new_name=time().str_replace(' ', '',$_FILES["document"]['name']);
				$config['upload_path']='./assets/documents/Rapports/';
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
		public function supprimer_rapport()
		{
			if($this->uri->segment(3))
			{
				$info=$this->Report_model->infos_rapport($this->uri->segment(3));
				foreach ($info->result() as $row) 
				{
					unlink($row->emplacement_rapport);
				}
				$this->Report_model->supprimer_rapport($this->uri->segment(3));
			}
		}

}

