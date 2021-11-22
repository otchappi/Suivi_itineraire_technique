<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Statistics_model extends CI_Model
	{
		public function nb_membre()
		{
			$this->db->select("*");
			$this->db->from("membre");
			return $this->db->count_all_results();			
		}
		public function nb_culture()
		{
			$this->db->select("*");
			$this->db->from("culture");
			return $this->db->count_all_results();			
		}
		public function nb_projet_accueil()
		{
			$this->db->select("*");
			$this->db->from("projet");
			return $this->db->count_all_results();			
		}
		public function nb_astuce()
		{
			$this->db->select("*");
			$this->db->from("astuce");
			return $this->db->count_all_results();			
		}
		public function nb_projet($id_membre)
		{
			$this->db->select("*");
			$this->db->from("projet");
			$this->db->where('id_membre',$id_membre);
			return $this->db->count_all_results();			
		}
		public function nb_site($id_membre)
		{
			$this->db->select("*");
			$this->db->from("site_exploitation");
			$this->db->where('proprietaire',$id_membre);
			return $this->db->count_all_results();			
		}
		public function nb_rapport($id_membre)
		{
			$this->db->select("*");
			$this->db->from("rapport");
			$this->db->join('projet', 'projet.id_projet = rapport.id_projet');
			$this->db->where('projet.id_membre',$id_membre);
			return $this->db->count_all_results();			
		}
	}