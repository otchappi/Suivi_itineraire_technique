<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Annonces extends MY_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Settings_model', 'settings');
		$this->zone = 'obc/annonce';
	}

	public function saveInfoflash(){

		if($this->input->method()=='post'){
			$this->form_validation->set_error_delimiters('<p class="form_erreur text-danger small"><b>', '</b><p>');
			$this->form_validation->set_rules('titre', 'titre', 'trim|required|encode_php_tags|is_unique[annonce.titre_annonce]');
			$this->form_validation->set_rules('message', 'meassage', 'trim|required|encode_php_tags');
			$this->form_validation->set_rules('d_fin' , 'Date de fin' , 'callback_date_f_check');
			if($this->form_validation->run()){
				$dd=($this->input->post("d_debut") && $this->input->post("h_debut"))? $this->input->post("d_debut").' '.$this->input->post("h_debut") : date('Y-m-d H:i:m');
				$date_heure_debut = new DateTime($dd);
				$df=($this->input->post("d_fin") && $this->input->post("h_fin"))? $this->input->post("d_fin").' '.$this->input->post("h_fin") : date('Y-m-d H:i:m');
				$date_heure_fin = new DateTime($df);

				$infosFlash = array(
					'titre_annonce' => $this->input->post('titre'),
					'contenu_annonce' => $this->input->post('message'),
					'date_creation_annonce' => moment()->addHours(1)->format('Y-m-d H:i:s'),
					'date_debut'=>date_format($date_heure_debut, 'Y-m-d H:i:s'),
					'date_fin' => date_format($date_heure_fin, 'Y-m-d H:i:s'),
					'etat_annonce' => 1
				);
//				var_dump($infosFlash);die;
				$idAnnonce = $this->settings->saveTable($infosFlash, 'annonce');
				if($idAnnonce > 0){
					set_flash_data(array('success', 'L\'annonce a été enregistré avec success'));
					redirect('Annonces/listInfoflash');
				}else{
					set_flash_data(array('error', 'Echec d\'enregistrement de l\'annonce '));
					redirect('Annonces/saveInfoflash');
				}
			}
		}
		$this->data['breadcrumb'] = array(
			'Accueil' => base_url(),
			'Annonce' => '#',
			'Enregistrer une annonce'=>'#'
		);
		$this->render('Enregistrement d\'une annonce à publier', 'save-infoFlash');
	}
	public function listInfoflash(){
		$this->data['annonces'] = $annonces = $this->settings->selectTableCritere('*', 'annonce', array(), 'id_annonce', 'DESC');
		$this->data['breadcrumb'] = array(
			'Accueil' => base_url(),
			'Paramètres' => "#",
			'Annonce' => '#',
			'Liste des annonces'=>'#'
		);
		$this->render('Liste des annonces', 'list-infoFlash');
	}
	public function annuler_annonce($id){
		if(!empty($id)){
			$data = array(
				'date_annulation' => moment()->addHours('1')->format('Y-m-d H-i-s'),
				'etat_annonce' => 0
			);
			$this->settings->updateTableCriterion($data, "annonce", array("id_annonce" => $id));
			redirect('Annonces/listInfoflash');
		}
	}
	public function reprogrammer_annonce($id){
		if(!empty($id)){
			$a = $this->settings->selectTableCritere('*', 'annonce', array('id_annonce'=>$id));
			$this->data['annonce'] = $a[0];
			if($this->input->method()=='post'){
				$this->form_validation->set_error_delimiters('<p class="form_erreur text-danger small"><b>', '</b><p>');
				$this->form_validation->set_rules('titre', 'titre', 'trim|required|encode_php_tags');
				$this->form_validation->set_rules('message', 'meassage', 'trim|required|encode_php_tags');
				$this->form_validation->set_rules('d_fin' , 'Date de fin' , 'callback_date_f_check');
				if($this->form_validation->run()){
					$dd=$this->input->post('d_debut')." ".$this->input->post('h_debut');
					$date_heure_debut = new DateTime($dd);
					$df=$this->input->post('d_fin')." ".$this->input->post('h_fin');
					$date_heure_fin = new DateTime($df);
					$infosFlash = array(
						'titre_annonce' => $this->input->post('titre'),
						'contenu_annonce' => $this->input->post('message'),
						"date_debut"=>trim($dd)!='0000-00-00 00:00:00'?date_format($date_heure_debut, 'Y-m-d H:i:s'):moment($a[0]->date_debut)->format('Y-m-d H:i:s'),
						"date_fin"=>trim($df)!='0000-00-00 00:00:00'?date_format($date_heure_fin, 'Y-m-d H:i:s'):moment($a[0]->date_fin)->format('Y-m-d H:i:s'),
						'etat_annonce' => 1
					);
					$x = $this->settings->updateTableCriterion($infosFlash, 'annonce', array('id_annonce' => $a[0]->id_annonce));
					if($x)
					{
						set_flash_data(array("success", 'L\'annonce ayant pour titre '.$a[0]->titre_annonce.' a bien été reprogrammé '));
						return redirect('Annonces/listInfoflash');
					}else{
						set_flash_data(array("error", 'Echec de la reprogrammation sur L\'annonce '.$a[0]->titre_annonce.''));
						return redirect('Annonces/reprogrammer_annonce/'.$a[0]->id_annonce);
					}
				}
			}
			$this->data['breadcrumb'] = array(
				'Accueil' => base_url(),
				'Paramètres' => "#",
				'Annonces' => '#',
				'Reprogrammer une annonce'=>'#'
			);
			$this->render('Reprogrammation d\'une annonce ', 'edit-annonce');
		}

	}
	public function date_d_check($str){

		$date_entiere = $str.' '.$this->input->post('h_debut');
		if ($str == NULL){
			$this->form_validation->set_message( 'date_d_check', 'La date ne peut pas être vide!!' );
			return FALSE;
		}
		elseif (date_create($str)->format("Y-m-d") <  moment()->addHours(1)->format('Y-m-d') ){
			$this->form_validation->set_message( 'date_d_check',  'Entrer une date de début future' );
			return FALSE;
		}
		elseif (date_create($str)->format("Y-m-d") ==  moment()->addHours(1)->format('Y-m-d') ){
			if ( date_create($date_entiere)->format("H:i") <  moment()->addHours(1)->format('H:i') ){
				$this->form_validation->set_message( 'date_d_check',  'Entrer une heure de début supérieure à '.moment()->addHours(1)->format('H:i') );
				return FALSE;
			}
			else{
				return TRUE;
			}
		}
		else{
			return TRUE;
		}
	}
	public function date_f_check($str){

		$date_entiere = $str.' '.$this->input->post('h_fin');
		$d_debut = $this->input->post('d_debut');
		$h_debut = $this->input->post('h_debut');
		if ($str == NULL){
			$this->form_validation->set_message( 'date_f_check', 'La date ne peut pas être vide!!' );
			return FALSE;
		}
		elseif ( $this->date_d_check($d_debut) == FALSE ){
			$this->form_validation->set_message( 'date_f_check',  'Verifier la date de début' );
			return FALSE;
		}
		elseif ( $this->date_d_check($d_debut) == TRUE and date_create($str)->format("Y-m-d") <  date_create($d_debut)->format("Y-m-d") ){
			$this->form_validation->set_message( 'date_f_check',  'La date de fin doit être supérieure la date de début' );
			return FALSE;
		}
		elseif ( $this->date_d_check($d_debut) == TRUE and date_create($str)->format("Y-m-d") ==  date_create($d_debut)->format("Y-m-d") ){
			if ( date_create($date_entiere)->format("H:i") <=  date_create($d_debut.' '.$h_debut)->format('H:i') ){
				$this->form_validation->set_message( 'date_f_check',  'Entrer une heure de fin supérieure à l\'heure de début: '.date_create($d_debut.' '.$h_debut)->format('H:i') );
				return FALSE;
			}
			return TRUE;
		}else
			return TRUE;
	}
}
