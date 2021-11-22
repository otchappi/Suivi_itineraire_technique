
<?php

class Localite_model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function getRegion(){
		return $this->db->select('*')
			->from('region')
			->order_by('nom_region')
			->get()->result();
	}

	public function getDepartementByRegion($id){
		return $this->db->select('*')
			->from('departement d')
			->where('d.region_id', $id)
			->order_by('d.nom_departement', 'asc')
			->get()->result();
	}

	public function getArrondissementByDep($id){
		return $this->db->select('*')
			->from('arrondissement a')
			->where('a.departement_id', $id)
			->order_by('nom_arrondissement', 'asc')
			->get()->result();
	}
	public function getCentreByArron($id){
		return $this->db->select('*')
			->from('etablissement e')
			->where('e.arrondissement_id', $id)
			->where('e.type', 1)
			->order_by('nom_etablissement', 'asc')
			->get()->result();
	}

	public function getAllDepartement(){
		return $this->db->select('*')
			->from('departement d')
			->order_by('d.nom_departement', 'asc')
			->get()->result();
	}

	public function getAllArrondissement(){
		return $this->db->select('*')
			->from('arrondissement a')
			->order_by('nom_departement', 'asc')
			->get()->result();
	}

	public function getArrondissement(){
		return $this->db->select('*')
			->from('arrondissement a')
			->join('departement d', 'a.departement_id = d.id_departement')
			->order_by('a.nom_arrondissement', 'asc')
			->get()->result();
	}
	public function getDept(){
		return $this->db->select('*')
			->from('departement d')
			->join('region r', 'd.region_id = r.id_region')
			->order_by('d.nom_departement', 'asc')
			->get()->result();
	}
}
