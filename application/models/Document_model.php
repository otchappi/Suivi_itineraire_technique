<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Document_model extends CI_Model
	{
		
		var $table = 'document';
		public function fiche_culture($id_culture)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('categorie_document',"0")
			->where('id_culture',$id_culture)
			->get();
		}
		public function liste_document_culture($id_culture)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_culture',$id_culture)
			->get();
		}



	}