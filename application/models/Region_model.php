<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Region_model extends CI_Model
	{
		
		protected $table = 'region';
		public function liste_region()
		{
			return $this->db->select('*')
			->from($this->table)
			->order_by('intitule_region', 'asc')
			->get();
		}
		public function intitule_region($id)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_region', $id)
			->get()
			->result();
		}
		public function inserer_region($data)
		{
			$this->db->insert($this->table,$data);
		}
		function modifier_region($data,$id_region)
		{
			$this->db->where("id_region",$id_region);
			$this->db->update($this->table,$data);
		}
	}