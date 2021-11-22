<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Categorie_model extends CI_Model
	{
		
		protected $table = 'categorie';
		public function liste_categorie()
		{
			return $this->db->select('*')
			->from($this->table)
			->order_by('designation_categorie', 'asc')
			->get();
		}
		public function intitule_categorie($id)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_categorie', $id)
			->get()
			->result();
		}
		public function inserer_categorie($data)
		{
			$this->db->insert($this->table,$data);
		}
		function modifier_categorie($data,$id_categorie)
		{
			$this->db->where("id_categorie",$id_categorie);
			$this->db->update($this->table,$data);
		}
		
	}