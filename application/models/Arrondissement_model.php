<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Arrondissement_model extends CI_Model
	{
		
		protected $table = 'arrondissement';
		public function liste_arrondissement()
		{
			return $this->db->select('*')
			->from($this->table)
			->order_by('intitule_arrondissement', 'asc')
			->get();
			/*->result();*/
		}
		public function intitule_arrondissement($id)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_arrondissement', $id)
			->get()
			->result();
		}
		public function inserer_arrondissement($data)
		{
			$this->db->insert($this->table,$data);
		}
		function modifier_arrondissement($data,$id_arrondissement)
		{
			$this->db->where("id_arrondissement",$id_arrondissement);
			$this->db->update($this->table,$data);
		}
		public function liste_arrondissement_departement($id_departement)
		{
			$this->db->where('id_departement', $id_departement);
			$this->db->order_by('intitule_arrondissement', 'asc');
			$query=$this->db->get($this->table);
			$output.="<option value='' selected>Cliquez pour Choisir l'arrondissement</option>";
			foreach ($query->result() as $row) {
				$output.='<option value="'.$row->id_arrondissement.'">
							'.$row->intitule_arrondissement.'
						</option>';
			}
			if($output=='')
			{
				$output.='<option value="">Aucun arrondissement correspondant</option>';
			}
			return $output;
		}
	}