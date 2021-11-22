<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Fichier_model extends CI_Model
	{
		
		protected $table = 'fichier';
		public function liste_fichier($id_commentaire)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_commentaire', $id_commentaire)
			->order_by('designation_fichier', 'asc')
			->get();
		}
		public function infos_fichier($id)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_fichier', $id)
			->get();
		}
		public function inserer_fichier($data)
		{
			$this->db->insert($this->table,$data);
		}
		function modifier_fichier($data,$id_fichier)
		{
			$this->db->where("id_fichier",$id_fichier);
			$this->db->update($this->table,$data);
		}
	}