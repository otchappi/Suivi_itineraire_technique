<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Report_model extends CI_Model
	{
		
		var $table = 'rapport';
		function inserer_rapport($data)
		{
			$this->db->insert($this->table,$data);
		}
		function modifier_rapport($data,$id)
		{
			$this->db->where("id_rapport",$id);
			$this->db->update($this->table,$data);
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
		public function liste_rapport_projet()
		{
		    return $this->db->select('*')
		      ->from($this->table)
		      ->where('id_projet',$this->session->userdata("id_projet"))
		      ->order_by('titre_rapport', 'asc')
		      ->get()
		      ->result();
		}
		public function infos_rapport($id_rapport)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_rapport', $id_rapport)
			->get();
		}
	}