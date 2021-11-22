<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Site_model extends CI_Model
	{
		
		protected $table = 'site_exploitation';
		public function liste_site_client($id_membre)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('proprietaire', $id_membre)
			->order_by('designation_site_exploitation', 'asc')
			->get();
		}
		public function infos_site($id)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_site_exploitation', $id)
			->join('arrondissement', 'arrondissement.id_arrondissement = site_exploitation.id_arrondissement')
			->join('departement', 'departement.id_departement = arrondissement.id_departement')
			->join('region', 'region.id_region = departement.id_region')
			->get();
		}
		public function historique_tache($critere)
		{
			$this->db->select('*');
			$this->db->from("tache");
			$this->db->join('projet', 'projet.id_projet = tache.id_projet');
			if($critere==0)
			{
				$this->db->where('date_realisation_tache<>', '0000-00-00');
			}
			if($critere==1)
			{
				$this->db->where('date_realisation_tache', '0000-00-00');
				$this->db->where('date_debut_tache<=', date('Y-m-d'));
			}			
			$this->db->where('id_site', $this->session->userdata("id_site"));
			$this->db->where('id_membre', $this->session->userdata("id_membre"));
			$this->db->order_by('intitule_tache', 'asc');
			return $this->db->get();
		}
		public function nb_projet_site()
		{
			$donnees=array(
				'id_site' => $this->session->userdata("id_site"),
				'id_membre' => $this->session->userdata("id_membre")
			);
			$this->db->select("*");
			$this->db->where($donnees);
			$this->db->from("projet");
			return $this->db->count_all_results();
		}
		public function nb_projet_hors_delais()
		{
			$donnees=array(
				'id_site' => $this->session->userdata("id_site"),
				'id_membre' => $this->session->userdata("id_membre"),
				'date_fin_projet' =>  '0000-00-00',
				'date_echeance_projet <=' =>  date('Y-m-d')
			);
			$this->db->select("*");
			$this->db->where($donnees);
			$this->db->from("projet");
			return $this->db->count_all_results();		
		}
		public function nb_projet_en_cours()
		{
			$donnees=array(
				'id_site' => $this->session->userdata("id_site"),
				'id_membre' => $this->session->userdata("id_membre"),
				'date_fin_projet' =>  '0000-00-00',
				'date_debut_projet <=' =>  date('Y-m-d'),
				'date_echeance_projet >=' =>  date('Y-m-d')
			);
			$this->db->select("*");
			$this->db->where($donnees);
			$this->db->from("projet");
			return $this->db->count_all_results();
		}
		public function nb_projet_termine()
		{
			$donnee=array(
				'id_site' => $this->session->userdata("id_site"),
				'id_membre' => $this->session->userdata("id_membre"),
				'date_fin_projet !=' =>  '0000-00-00'
			);
			$this->db->select("*");
			$this->db->where($donnee);
			$this->db->from("projet");
			return $this->db->count_all_results();
		}
		public function inserer_site($data)
		{
			$this->db->insert($this->table,$data);
			return $this->db->insert_id();
		}
		function modifier_site($data,$id_site_exploitation)
		{
			$this->db->where("id_site_exploitation",$id_site_exploitation);
			$this->db->update($this->table,$data);
		}
		public function liste_culture()
		{
			return $this->db->select('*')
			->from("projet")
			->join('culture', 'culture.id_culture = projet.id_culture')
			->where('id_site', $this->session->userdata("id_site"))
			->where('id_membre', $this->session->userdata("id_membre"))
			->where('date_debut_projet<=', date("Y-m-d"))
			->order_by('designation_culture', 'asc')
			->get();
		}
		public function infos_projet_recent()
		{
			return $this->db->select('*')
			->from("projet")
			->where('id_membre', $this->session->userdata("id_membre"))
			->where('id_site', $this->session->userdata("id_site"))
			->order_by('id_projet', 'desc')
			->limit("1")
			->get();
		}
	}