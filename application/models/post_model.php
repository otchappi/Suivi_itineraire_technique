<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Post_model extends CI_Model
	{
		
		var $table = 'post';
		public function nb_post_sujet($id_sujet)
		{
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where("id_sujet",$id_sujet);
			return $this->db->count_all_results();
		}
		function inserer_post($data)
		{
			$this->db->insert($this->table,$data);
		}
		public function supprimer_post($id_post)
		{
			$this->db->where('id_post',$id_post);
			$this->db->delete($this->table);
		}
		public function liste_post($id_sujet)
		{
			return $this->db->select('*')
			->from($this->table)
			->join('membre', 'membre.id_membre = post.id_membre')
			->where('id_sujet',$id_sujet)
			->order_by("date_creation_post","DESC")
			->get();
		}









		public function liste_rapport_etablissement($id,$id_centre)
		{
			$query = $this->db->query("SELECT * FROM rapport INNER JOIN etablissement ON rapport.etablissement_id = etablissement.id_etablissement WHERE (rapport.etablissement_id='".$id."' OR rapport.etablissement_id='".$id_centre."'   OR rapport.etablissement_id='1') AND rapport.session_id='".$this->session->userdata('id_session')."' AND rapport.examen_id='".$this->session->userdata('id_examen')."'");
			return $query->result();
		}
		public function liste_rapport_centre($id_centre)
		{
			$query = $this->db->query("SELECT * FROM rapport INNER JOIN etablissement ON rapport.etablissement_id=etablissement.id_etablissement WHERE (rapport.etablissement_id IN(SELECT etablissement_centre_examen.etablissement_id FROM etablissement_centre_examen WHERE etablissement_centre_examen.centre_examen_id='".$id_centre."') OR rapport.etablissement_id='".$this->session->userdata('id_etablissement')."'  OR rapport.etablissement_id='1' )  AND rapport.session_id='".$this->session->userdata('id_session')."' AND rapport.examen_id='".$this->session->userdata('id_examen')."'");
			return $query->result();
		}
		function inserer_rapport($data)
		{
			$this->db->insert($this->table,$data);
		}
		function modifier_rapport($data,$id)
		{
			$this->db->where("id_rapport",$id);
			$this->db->update($this->table,$data);
		}
		public function infos_rapport($id_rapport)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_rapport',$id_rapport)
			->get();
		}
		public function nb_rapports()
		{
			$this->db->select("*");
			$this->db->from($this->table);
			return $this->db->count_all_results();			
		}
		public function supprimer_rapport($id_rapport)
		{
			$this->db->where('id_rapport',$id_rapport);
			$this->db->delete($this->table);
		}
		public function getReport(){
		    return $this->db->select('*')
		      ->from('rapport r')
		      ->join('etablissement e', 'e.id_etablissement = r.etablissement_id', 'left')
		      ->order_by('id_rapport', 'desc')
		      ->get()->result();
		}
	}