<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Etape_model extends CI_Model
	{
		
		protected $table = 'etape';
		public function liste_etape_culture($id_culture)
		{
			$this->db->select("*");
			$this->db->from($this->table);
			$this->db->order_by('designation_etape', 'asc');
			$this->db->join('sous_etape', 'sous_etape.id_etape = etape.id_etape');
			$this->db->where('sous_etape.id_culture',$id_culture);
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
		public function modifier_maladie($data,$id_maladie)
		{
			$this->db->where("id_maladie",$id_maladie);
			$this->db->update($this->table,$data);
		}
		
	}