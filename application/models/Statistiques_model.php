<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistiques_model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
	}

	public function nbCandidatureTotal($idCentre, $session, $idExamen, $serie, $typeCandidat)
	{
		$this->db->select('*')
		->from('dossier as d')
		->join('candidat_etablissement as ca_e', 'ca_e.candidat_id = d.candidat_id')
		->join('candidat ca', 'ca.id_candidat = ca_e.candidat_id')
		->join('etablissement e', 'ca_e.etablissement_id = e.id_etablissement')
		->join('centre_examen ce', 'e.id_etablissement = ce.etablissement_id')
		->join('arrondissement a', 'a.id_arrondissement = e.arrondissement_id')
		->join('departement de', 'de.id_departement = a.departement_id')
		->join('region r', 'r.id_region = de.region_id')
		->where('d.session_id', $session)
		->where('d.examen_id', $idExamen);
		if(!empty($idCentre) && $idCentre != -1){
			$this->db->where('ce.etablissement_id', $idCentre); //l'etablissement se trouvant dans la table centre_examen
		}
		if(!empty($typeCandidat) && $typeCandidat != -1){
			$this->db->where('ca.type_candidat_id', $typeCandidat);
		}
		if(!empty($serie) && $serie != -1){
			$this->db->where('d.serie_id', $serie);
		}
		return  $this->db->count_all_results();
	}
	public function nbCandidatureValid($idCentre, $session, $idExamen, $serie, $typeCandidat){
		$this->db->select('*')
			->from('dossier as d')
			->join('candidat_etablissement as ca_e', 'ca_e.candidat_id = d.candidat_id')
			->join('candidat ca', 'ca.id_candidat = ca_e.candidat_id')
			->join('etablissement e', 'ca_e.etablissement_id = e.id_etablissement')
			->join('centre_examen ce', 'e.id_etablissement = ce.etablissement_id')
			->join('arrondissement a', 'a.id_arrondissement = e.arrondissement_id')
			->join('departement de', 'de.id_departement = a.departement_id')
			->join('region r', 'r.id_region = de.region_id')
			->where('d.session_id', $session)
			->where('d.examen_id', $idExamen)
			->where_in('d.statut_dossier', array('1', '4'));
		if(!empty($idCentre) && $idCentre != -1){
			$this->db->where('ce.etablissement_id', $idCentre); //l'etablissement se trouvant dans la table centre_examen
		}
		if(!empty($typeCandidat) && $typeCandidat != -1){
			$this->db->where('ca.type_candidat_id', $typeCandidat);
		}
		if(!empty($serie) && $serie != -1){
			$this->db->where('d.serie_id', $serie);
		}
		return  $this->db->count_all_results();
	}
	public function nbCandidatureRefuse($idCentre, $session, $idExamen, $serie, $typeCandidat){
		$this->db->select('*')
			->from('dossier as d')
			->join('candidat_etablissement as ca_e', 'ca_e.candidat_id = d.candidat_id')
			->join('candidat ca', 'ca.id_candidat = ca_e.candidat_id')
			->join('etablissement e', 'ca_e.etablissement_id = e.id_etablissement')
			->join('centre_examen ce', 'e.id_etablissement = ce.etablissement_id')
			->join('arrondissement a', 'a.id_arrondissement = e.arrondissement_id')
			->join('departement de', 'de.id_departement = a.departement_id')
			->join('region r', 'r.id_region = de.region_id')
			->where('d.session_id', $session)
			->where('d.examen_id', $idExamen)
			->where('d.statut_dossier', 3);
		if(!empty($idCentre) && $idCentre != -1){
			$this->db->where('ce.etablissement_id', $idCentre); //l'etablissement se trouvant dans la table centre_examen
		}
		if(!empty($typeCandidat) && $typeCandidat != -1){
			$this->db->where('ca.type_candidat_id', $typeCandidat);
		}
		if(!empty($serie) && $serie != -1){
			$this->db->where('d.serie_id', $serie);
		}
		return  $this->db->count_all_results();
	}
	public function nbCandidatureIncomplete($idCentre, $session, $idExamen, $serie, $typeCandidat){
		$this->db->select('*')
			->from('dossier as d')
			->join('candidat_etablissement as ca_e', 'ca_e.candidat_id = d.candidat_id')
			->join('candidat ca', 'ca.id_candidat = ca_e.candidat_id')
			->join('etablissement e', 'ca_e.etablissement_id = e.id_etablissement')
			->join('centre_examen ce', 'e.id_etablissement = ce.etablissement_id')
			->join('arrondissement a', 'a.id_arrondissement = e.arrondissement_id')
			->join('departement de', 'de.id_departement = a.departement_id')
			->join('region r', 'r.id_region = de.region_id')
			->where('d.session_id', $session)
			->where('d.examen_id', $idExamen)
			->where('d.statut_dossier', 2);
		if(!empty($idCentre) && $idCentre != -1){
			$this->db->where('ce.etablissement_id', $idCentre); //l'etablissement se trouvant dans la table centre_examen
		}
		if(!empty($typeCandidat) && $typeCandidat != -1){
			$this->db->where('ca.type_candidat_id', $typeCandidat);
		}
		if(!empty($serie) && $serie != -1){
			$this->db->where('d.serie_id', $serie);
		}
		return  $this->db->count_all_results();
	}

	public function nbCandidatApte($idCentre, $session, $idExamen, $serie, $typeCandidat){
		$this->db->select('*')
			->from('dossier as d')
			->join('candidat_etablissement as ca_e', 'ca_e.candidat_id = d.candidat_id')
			->join('candidat ca', 'ca.id_candidat = ca_e.candidat_id')
			->join('etablissement e', 'ca_e.etablissement_id = e.id_etablissement')
			->join('centre_examen ce', 'e.id_etablissement = ce.etablissement_id')
			->join('arrondissement a', 'a.id_arrondissement = e.arrondissement_id')
			->join('departement de', 'de.id_departement = a.departement_id')
			->join('region r', 'r.id_region = de.region_id')
			->where('d.session_id', $session)
			->where('d.examen_id', $idExamen)
			->where('d.aptitude', 1);
		if(!empty($idCentre) && $idCentre != -1){
			$this->db->where('ce.etablissement_id', $idCentre); //l'etablissement se trouvant dans la table centre_examen
		}
		if(!empty($typeCandidat) && $typeCandidat != -1){
			$this->db->where('ca.type_candidat_id', $typeCandidat);
		}
		if(!empty($serie) && $serie != -1){
			$this->db->where('d.serie_id', $serie);
		}
		return  $this->db->count_all_results();
	}
	public function nbCandidatInapte($idCentre, $session, $idExamen, $serie, $typeCandidat){
		$this->db->select('*')
			->from('dossier as d')
			->join('candidat_etablissement as ca_e', 'ca_e.candidat_id = d.candidat_id')
			->join('candidat ca', 'ca.id_candidat = ca_e.candidat_id')
			->join('etablissement e', 'ca_e.etablissement_id = e.id_etablissement')
			->join('centre_examen ce', 'e.id_etablissement = ce.etablissement_id')
			->join('arrondissement a', 'a.id_arrondissement = e.arrondissement_id')
			->join('departement de', 'de.id_departement = a.departement_id')
			->join('region r', 'r.id_region = de.region_id')
			->where('d.session_id', $session)
			->where('d.examen_id', $idExamen)
			->where('d.aptitude', 0);
		if(!empty($idCentre) && $idCentre != -1){
			$this->db->where('ce.etablissement_id', $idCentre); //l'etablissement se trouvant dans la table centre_examen
		}
		if(!empty($typeCandidat) && $typeCandidat != -1){
			$this->db->where('ca.type_candidat_id', $typeCandidat);
		}
		if(!empty($serie) && $serie != -1){
			$this->db->where('d.serie_id', $serie);
		}
		return  $this->db->count_all_results();
	}

	public function nbCandidatRegulier($idCentre, $session, $idExamen, $serie, $typeCandidat){
		$this->db->select('*')
			->from('dossier as d')
			->join('candidat_etablissement as ca_e', 'ca_e.candidat_id = d.candidat_id')
			->join('candidat ca', 'ca.id_candidat = ca_e.candidat_id')
			->join('etablissement e', 'ca_e.etablissement_id = e.id_etablissement')
			->join('centre_examen ce', 'e.id_etablissement = ce.etablissement_id')
			->join('arrondissement a', 'a.id_arrondissement = e.arrondissement_id')
			->join('departement de', 'de.id_departement = a.departement_id')
			->join('region r', 'r.id_region = de.region_id')
			->where('d.session_id', $session)
			->where('d.examen_id', $idExamen)
			->where('ca.type_candidat_id', 1);
		if(!empty($idCentre) && $idCentre != -1){
			$this->db->where('ce.etablissement_id', $idCentre); //l'etablissement se trouvant dans la table centre_examen
		}
		if(!empty($typeCandidat) && $typeCandidat != -1){
			$this->db->where('ca.type_candidat_id', $typeCandidat);
		}
		if(!empty($serie) && $serie != -1){
			$this->db->where('d.serie_id', $serie);
		}
		return  $this->db->count_all_results();
	}
	public function nbCandidatLibre($idCentre, $session, $idExamen, $serie, $typeCandidat){
		$this->db->select('*')
			->from('dossier as d')
			->join('candidat_etablissement as ca_e', 'ca_e.candidat_id = d.candidat_id')
			->join('candidat ca', 'ca.id_candidat = ca_e.candidat_id')
			->join('etablissement e', 'ca_e.etablissement_id = e.id_etablissement')
			->join('centre_examen ce', 'e.id_etablissement = ce.etablissement_id')
			->join('arrondissement a', 'a.id_arrondissement = e.arrondissement_id')
			->join('departement de', 'de.id_departement = a.departement_id')
			->join('region r', 'r.id_region = de.region_id')
			->where('d.session_id', $session)
			->where('d.examen_id', $idExamen)
			->where('ca.type_candidat_id', 2);
		if(!empty($idCentre) && $idCentre != -1){
			$this->db->where('ce.etablissement_id', $idCentre); //l'etablissement se trouvant dans la table centre_examen
		}
		if(!empty($typeCandidat) && $typeCandidat != -1){
			$this->db->where('ca.type_candidat_id', $typeCandidat);
		}
		if(!empty($serie) && $serie != -1){
			$this->db->where('d.serie_id', $serie);
		}
		return  $this->db->count_all_results();
	}

}
