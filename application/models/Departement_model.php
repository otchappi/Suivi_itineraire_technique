<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Departement_model extends CI_Model
	{
		
		protected $table = 'departement';
		public function liste_departement()
		{
			return $this->db->select('*')
			->from($this->table)
			->order_by('intitule_departement', 'asc')
			->get();
			/*->result();*/
		}
		public function liste_departement_region($id_region)
		{
			$this->db->where('id_region', $id_region);
			$this->db->order_by('intitule_departement', 'asc');
			$query=$this->db->get($this->table);
			$output.='<option value="" selected>Cliquez pour Choisir le département</option>';
			foreach ($query->result() as $row) {
				$output.='<option value="'.$row->id_departement.'">
							'.$row->intitule_departement.'
						</option>';
			}
			if($output=='')
			{
				$output.='<option value="">Aucun département correspondant</option>';
			}
			return $output;
		}
		public function intitule_departement($id)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_departement', $id)
			->get()
			->result();
		}
		public function inserer_departement($data)
		{
			$this->db->insert($this->table,$data);
		}
		function modifier_departement($data,$id_departement)
		{
			$this->db->where("id_departement",$id_departement);
			$this->db->update($this->table,$data);
		}
	}