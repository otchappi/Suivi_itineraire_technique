<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Site extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !='' && $this->session->userdata('id_membre') !='')
	        {
	            $this->load->model('Site_model');
	            $this->load->model('Projet_model');
	            $this->load->model('Region_model');
	            $this->load->model('Departement_model');
	            $this->load->model('Arrondissement_model');
	        }
	        else
	        {
	           	$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
	            redirect('Index/page_de_connexion');
	        }
		}
		public function Home_site_client()
		{
			if($this->uri->segment(3)!='')
			{
				$this->session->set_userdata('menu',"Presentation");
				$data2["titre_page"]="Site exploitation";
				$this->session->set_userdata("id_site",$this->uri->segment(3));
				$data2["infos_site"]=$this->Site_model->infos_site($this->session->userdata('id_site'));
		        $this->load->view('client/template/header');
		        $this->load->view('client/template/head'); 
				$this->load->view('client/template/left-menu-site');        
		        $this->load->view('client/site_exploitation/presentation',$data2);
				$this->load->view('client/template/footer');
			}
			else
			{
				redirect('Home/Home_client');
			}
		}
		public function projet_site()
		{
			$this->session->set_userdata('menu',"Projet");
			$data2["titre_page"]="Projet site";
		    $this->load->view('client/template/header');
		    $this->load->view('client/template/head'); 
			$this->load->view('client/template/left-menu-site');        
		    $this->load->view('client/site_exploitation/projet',$data2);
			$this->load->view('client/template/footer');
		}
		public function chercher_projet()
		{
			$chercher_projet=$this->Projet_model->make_datatables_cl();
			$data=array();
			foreach ($chercher_projet as $row) {
				$sub_array=array();
				$sub_array[]="<span style='font-size:1.1em; font-weight:bold;'>".$row->titre_projet."</span>";
				$sub_array[]=$row->date_creation_projet;
				$sub_array[]=$row->date_echeance_projet;
				$sub_array[]=number_format($row->budget_projet,2,',',' ');
				$sub_array[]='<div class="widget-content">
				<div class="widget-content-outer">
				<div class="widget-content-wrapper">
				<div class="widget-content-left pr-2 fsize-1">
				<div class="widget-numbers mt-0 fsize-3 text-success">'.$row->etat_projet.'%</div>
				</div>
				<div class="widget-content-right w-100">
				<div class="progress-bar-xs progress">
				<div class="progress-bar bg-success" role="progressbar" aria-valuenow="'.$row->etat_projet.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$row->etat_projet.'%;"></div>
				</div>
				</div>
				</div>
				</div>
				</div>';				
				$sub_array[]='<a type="button" name="consulter" href="'.base_url("Projet/Home_projet_client/".$row->id_projet).'" class=" btn btn-primary btn-md"><span class="fa fa-eye"></span></a>';
				$data[]=$sub_array;
			}
			$output=array(
				"draw" => intval($_POST["draw"]),
				"recordsTotal" => $this->Projet_model->get_all_data_cl(),
				"recordsFiltered" => $this->Projet_model->get_filtered_data_cl(),
				"data"  => $data
			);
			echo json_encode($output);
		}
		public function antecedant()
		{
			$this->session->set_userdata('menu',"Antecedants");
			$data2["titre_page"]="Antécédant site";
			$data2["liste_culture"]=$this->Site_model->liste_culture();
			$data2["liste_tache"]=$this->Site_model->historique_tache("0");
		    $this->load->view('client/template/header');
		    $this->load->view('client/template/head'); 
			$this->load->view('client/template/left-menu-site');        
		    $this->load->view('client/site_exploitation/antecedant',$data2);
			$this->load->view('client/template/footer');
		}
		public function historique_tache()
		{
			$this->session->set_userdata('menu',"Antecedants");
			$data2["titre_page"]="Antécédant site";
			$data2["liste_culture"]=$this->Site_model->liste_culture();
			$critere=$this->input->post('type');
			$data2["critere"]=$critere;
			$data2["liste_tache"]=$this->Site_model->historique_tache($critere);
		    $this->load->view('client/template/header');
		    $this->load->view('client/template/head'); 
			$this->load->view('client/template/left-menu-site');        
		    $this->load->view('client/site_exploitation/antecedant',$data2);
			$this->load->view('client/template/footer');
		}
		public function statistique()
		{
			$this->session->set_userdata('menu',"Statistiques");
			$data2["titre_page"]="Statistique site";
			$data2["infos_projet"]=$this->Site_model->infos_projet_recent();
			$data2["nb_pr"]=$this->Site_model->nb_projet_site();
			$data2["nb_ec"]=$this->Site_model->nb_projet_en_cours();
			$data2["nb_te"]=$this->Site_model->nb_projet_termine();
			$data2["nb_hd"]=$this->Site_model->nb_projet_hors_delais();
		    $this->load->view('client/template/header');
		    $this->load->view('client/template/head'); 
			$this->load->view('client/template/left-menu-site');        
		    $this->load->view('client/site_exploitation/statistique',$data2);
			$this->load->view('client/template/footer');
		}
		public function formulaire_ajout()
		{
			$this->session->set_userdata('menu',"site");
			$data2["titre_page"]="Ajout d'un site";
			$data2["liste_region"]=$this->Region_model->liste_region();
			$data3["liste_site"]=$this->Site_model->liste_site_client($this->session->userdata('id_membre'));
		    $this->load->view('client/template/header');
		    $this->load->view('client/template/head'); 
			$this->load->view('client/template/left-menu',$data3);        
		    $this->load->view('client/site_exploitation/ajouter_site',$data2);
			$this->load->view('client/template/footer');
		}
		public function formulaire_modification()
		{
			$this->session->set_userdata('menu',"site");
			$data2["titre_page"]="Modification d'un site";
			$data2["infos_site"]=$this->Site_model->infos_site($this->session->userdata('id_site'));
			$data2["liste_region"]=$this->Region_model->liste_region();					
			$data2["liste_departement"]=$this->Departement_model->liste_departement();
			$data2["liste_arrondissement"]=$this->Arrondissement_model->liste_arrondissement();
			$data3["liste_site"]=$this->Site_model->liste_site_client($this->session->userdata('id_membre'));
		    $this->load->view('client/template/header');
		    $this->load->view('client/template/head'); 
			$this->load->view('client/template/left-menu',$data3);        
		    $this->load->view('client/site_exploitation/modifier_site',$data2);
			$this->load->view('client/template/footer');
		}
		public function liste_departement()
		{
			if($this->input->post('id_region'))
			{
				echo $this->Departement_model->liste_departement_region($this->input->post('id_region'));
			}
		}
		public function liste_arrondissement()
		{
			if($this->input->post('id_departement'))
			{
				echo $this->Arrondissement_model->liste_arrondissement_departement($this->input->post('id_departement'));
			}
		}
		public function valider_formulaire_ajout()
		{
			$this->form_validation->set_rules("nom","nom",'required',array('required' => 'Ce champ est obligatoire'));
			$this->form_validation->set_rules("superficie","superficie",'required',array('required' => 'Ce champ est obligatoire'));
			if($this->form_validation->run() && htmlspecialchars($this->input->post('arrondissement'))!="")
			{
				if($_FILES["photos"]['name']!='')
				{
					$image=htmlspecialchars($this->upload_image());
					$data=array
					(
						'image_site' => "assets/images/site/".$image,
						'designation_site_exploitation' =>  htmlspecialchars($this->input->post('nom')),
						'superficie_site_exploitation' =>  htmlspecialchars($this->input->post('superficie')),
						"localisation_site_exploitation" => htmlspecialchars($this->input->post('localisation')),
						"id_arrondissement" => htmlspecialchars($this->input->post('arrondissement')),
						"latitude" => htmlspecialchars($this->input->post('latitude')),
						"longitude" => htmlspecialchars($this->input->post('longitude')),
						'ph_sol' =>  htmlspecialchars($this->input->post('ph')),
						'couleur_sol' =>  htmlspecialchars($this->input->post('couleur')),
						"nature_sol" => htmlspecialchars($this->input->post('nature')),
						"presence_insecte" => htmlspecialchars($this->input->post('pres_ins')),
						"commentaire" => htmlspecialchars($this->input->post('commentaire')),
						"date_creation_site" => date("Y-m-d H:i:s"),
						'proprietaire' =>  $this->session->userdata("id_membre"),
						'date_acquisition_site' =>  htmlspecialchars($this->input->post('date_acquisition'))
					);
				}
				else
				{
					$data=array
					(
						'designation_site_exploitation' =>  htmlspecialchars($this->input->post('nom')),
						'superficie_site_exploitation' =>  htmlspecialchars($this->input->post('superficie')),
						"localisation_site_exploitation" => htmlspecialchars($this->input->post('localisation')),
						"id_arrondissement" => htmlspecialchars($this->input->post('arrondissement')),
						"latitude" => htmlspecialchars($this->input->post('latitude')),
						"longitude" => htmlspecialchars($this->input->post('longitude')),
						'ph_sol' =>  htmlspecialchars($this->input->post('ph')),
						'couleur_sol' =>  htmlspecialchars($this->input->post('couleur')),
						"nature_sol" => htmlspecialchars($this->input->post('nature')),
						"presence_insecte" => htmlspecialchars($this->input->post('pres_ins')),
						"commentaire" => htmlspecialchars($this->input->post('commentaire')),
						"date_creation_site" => date("Y-m-d H:i:s"),
						'proprietaire' =>  $this->session->userdata("id_membre"),
						'date_acquisition_site' =>  htmlspecialchars($this->input->post('date_acquisition'))
					);
				}
				$id=$this->Site_model->inserer_site($data);								
				$this->session->set_userdata('operation','1');
				redirect("Site/Home_site_client/".$id);
			}
			else
			{
				if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !=''  && $this->session->userdata('id_membre') !='')
				{
					$this->session->set_userdata('menu',"site");
					$data2["titre_page"]="Ajout d'un site";
					$data2["liste_region"]=$this->Region_model->liste_region();					
					$data2["liste_departement"]=$this->Departement_model->liste_departement();
					$data2["liste_arrondissement"]=$this->Arrondissement_model->liste_arrondissement();
					$data2["id_region"]=htmlspecialchars($this->input->post('nom_region'));
					$data2["id_departement"]=htmlspecialchars($this->input->post('departement'));
					$data2["id_arrondissement"]=htmlspecialchars($this->input->post('arrondissement'));
					$data2["nature"]=htmlspecialchars($this->input->post('nature'));
					$data2["pres_ins"]=htmlspecialchars($this->input->post('pres_ins'));
					$data3["liste_site"]=$this->Site_model->liste_site_client($this->session->userdata('id_membre'));
				    $this->load->view('client/template/header');
				    $this->load->view('client/template/head'); 
					$this->load->view('client/template/left-menu',$data3);        
				    $this->load->view('client/site_exploitation/ajouter_site',$data2);
					$this->load->view('client/template/footer');
				}
				else
				{
					$this->session->set_flashdata('incorrect','Identifiez-vous svp !');
                	redirect('Index/page_de_connexion');
				}

			}
		}
		public function valider_formulaire_modif()
		{
			$this->form_validation->set_rules("nom","nom",'required',array('required' => 'Ce champ est obligatoire'));
			$this->form_validation->set_rules("superficie","superficie",'required',array('required' => 'Ce champ est obligatoire'));
			if($this->form_validation->run() && htmlspecialchars($this->input->post('arrondissement'))!="")
			{
				if($_FILES["photos"]['name']!='')
				{
					$image=htmlspecialchars($this->upload_image());
					$data=array
					(
						'image_site' => "assets/images/site/".$image,
						'designation_site_exploitation' =>  htmlspecialchars($this->input->post('nom')),
						'superficie_site_exploitation' =>  htmlspecialchars($this->input->post('superficie')),
						"localisation_site_exploitation" => htmlspecialchars($this->input->post('localisation')),
						"id_arrondissement" => htmlspecialchars($this->input->post('arrondissement')),
						"latitude" => htmlspecialchars($this->input->post('latitude')),
						"longitude" => htmlspecialchars($this->input->post('longitude')),
						'ph_sol' =>  htmlspecialchars($this->input->post('ph')),
						'couleur_sol' =>  htmlspecialchars($this->input->post('couleur')),
						"nature_sol" => htmlspecialchars($this->input->post('nature')),
						"presence_insecte" => htmlspecialchars($this->input->post('pres_ins')),
						"commentaire" => htmlspecialchars($this->input->post('commentaire')),
						'proprietaire' =>  $this->session->userdata("id_membre"),
						'date_acquisition_site' =>  htmlspecialchars($this->input->post('date_acquisition'))
					);
				}
				else
				{
					$data=array
					(
						'designation_site_exploitation' =>  htmlspecialchars($this->input->post('nom')),
						'superficie_site_exploitation' =>  htmlspecialchars($this->input->post('superficie')),
						"localisation_site_exploitation" => htmlspecialchars($this->input->post('localisation')),
						"id_arrondissement" => htmlspecialchars($this->input->post('arrondissement')),
						"latitude" => htmlspecialchars($this->input->post('latitude')),
						"longitude" => htmlspecialchars($this->input->post('longitude')),
						'ph_sol' =>  htmlspecialchars($this->input->post('ph')),
						'couleur_sol' =>  htmlspecialchars($this->input->post('couleur')),
						"nature_sol" => htmlspecialchars($this->input->post('nature')),
						"presence_insecte" => htmlspecialchars($this->input->post('pres_ins')),
						"commentaire" => htmlspecialchars($this->input->post('commentaire')),
						'proprietaire' =>  $this->session->userdata("id_membre"),
						'date_acquisition_site' =>  htmlspecialchars($this->input->post('date_acquisition'))
					);
				}
				$this->Site_model->modifier_site($data,$this->session->userdata("id_site"));								
				$this->session->set_userdata('operation','1');
				redirect("Site/Home_site_client/".$this->session->userdata("id_site"));
			}
			else
			{
				if($this->session->userdata('identifiant') !='' && $this->session->userdata('mot_de_passe') !=''  && $this->session->userdata('id_membre') !='')
				{
					$this->session->set_userdata('menu',"site");
					$data2["titre_page"]="Modification d'un site";
					$data2["liste_region"]=$this->Region_model->liste_region();					
					$data2["liste_departement"]=$this->Departement_model->liste_departement();
					$data2["liste_arrondissement"]=$this->Arrondissement_model->liste_arrondissement();
					$data2["id_region"]=htmlspecialchars($this->input->post('nom_region'));
					$data2["id_departement"]=htmlspecialchars($this->input->post('departement'));
					$data2["id_arrondissement"]=htmlspecialchars($this->input->post('arrondissement'));
					$data2["nature"]=htmlspecialchars($this->input->post('nature'));
					$data2["pres_ins"]=htmlspecialchars($this->input->post('pres_ins'));
					$data3["liste_site"]=$this->Site_model->liste_site_client($this->session->userdata('id_membre'));
				    $this->load->view('client/template/header');
				    $this->load->view('client/template/head'); 
					$this->load->view('client/template/left-menu',$data3);        
				    $this->load->view('client/site_exploitation/ajouter_site',$data2);
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
				$config['upload_path']='./assets/images/site';
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

