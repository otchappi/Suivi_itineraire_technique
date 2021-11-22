<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Lutte_model extends CI_Model
	{
		
		protected $table = 'methode_lutte';
		public function liste_lutte_maladie($id_maladie)
		{
			$this->db->select("*");
			$this->db->from($this->table);
			$this->db->where('id_maladie',$id_maladie);
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