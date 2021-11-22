<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Astuce_model extends CI_Model
	{
		
		protected $table = 'astuce';
		public function liste_astuces_recherche($id_culture)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_culture', $id_culture)
			->order_by('titre_astuce', 'asc')
			->get();
		}
















		public function intitule_astuce($id)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_astuce', $id)
			->get()
			->result();
		}
		public function inserer_astuce($data)
		{
			$this->db->insert($this->table,$data);
		}
		function modifier_astuce($data,$id_astuce)
		{
			$this->db->where("id_astuce",$id_astuce);
			$this->db->update($this->table,$data);
		}
		public function derniere_astuce()
		{
			return $this->db->select('*')
			->from($this->table)
			->order_by("id_astuce",'desc')
			->limit("1")
			->get()
			->result();
		}
	}