<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Maladie_model extends CI_Model
	{
		
		protected $table = 'maladie';
		public function liste_maladie_culture($id_culture)
		{
			$this->db->select("*");
			$this->db->from($this->table);
			$this->db->order_by('designation_maladie', 'asc');
			$this->db->join('maladie_culture', 'maladie_culture.id_maladie = maladie.id_maladie');
			$this->db->where('maladie_culture.id_culture',$id_culture);
			return $this->db->get();
		}






		public function intitule_maladie($id)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_maladie', $id)
			->get()
			->result();
		}
		public function inserer_maladie($data)
		{
			$this->db->insert($this->table,$data);
		}
		function modifier_maladie($data,$id_maladie)
		{
			$this->db->where("id_maladie",$id_maladie);
			$this->db->update($this->table,$data);
		}
		
	}