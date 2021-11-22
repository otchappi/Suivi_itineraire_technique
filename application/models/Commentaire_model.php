<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Commentaire_model extends CI_Model
	{
		
		protected $table = 'commentaire';
		public function liste_commentaire($id_tache)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_tache', $id_tache)
			->order_by('date_creation_commentaire', 'asc')
			->get();
		}
		public function infos_commentaire($id_commentaire)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_commentaire', $id_commentaire)
			->get();
		}
		public function inserer_commentaire($data)
		{
			$this->db->insert($this->table,$data);
			return $this->db->insert_id();
		}
		function modifier_commentaire($data,$id_commentaire)
		{
			$this->db->where("id_commentaire",$id_commentaire);
			$this->db->update($this->table,$data);
		}
	}