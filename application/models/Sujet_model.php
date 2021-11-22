<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Sujet_model extends CI_Model
	{
		
		var $table = "sujet";
		var $order_column=array("intitule_sujet",null,"nom_membre","date_creation_sujet",null);

		public function make_query()
		{
			$this->db->select('*');
			$this->db->from("sujet");
			$this->db->join('membre', 'membre.id_membre = sujet.id_membre');
			if(isset($_POST["search"]["value"]))
			{
				$this->db->like("intitule_sujet",$_POST["search"]["value"]);
				$this->db->or_like("nom_membre",$_POST["search"]["value"]);
			}
			if(isset($_POST["order"]))
			{
				$this->db->order_by($this->order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
			}
			else
			{
				$this->db->order_by("date_creation_sujet","DESC");
			}
		}
		public function make_datatables()
		{
			$this->make_query();
			if($_POST["length"]!=-1)
			{
				$this->db->limit($_POST["length"],$_POST["start"]);
			}
			$query=$this->db->get();
			return $query->result();
		}
		public function get_filtered_data()
		{
			$this->make_query();
			$query=$this->db->get();
			return $query->num_rows();
		}
		public function get_all_data()
		{
			$this->db->select('*');
			$this->db->from("sujet");
			$this->db->join('membre', 'membre.id_membre = sujet.id_membre');
			return $this->db->count_all_results();
		}
		public function inserer_sujet($data)
		{
			$this->db->insert($this->table,$data);
			return $this->db->insert_id();
		}
		public function supprimer_sujet($id_sujet)
		{
			$this->db->where('id_sujet',$id_sujet);
			$this->db->delete($this->table);
		}
		public function supprimer_post_sujet($id_sujet)
		{
			$this->db->where('id_sujet',$id_sujet);
			$this->db->delete("post");
		}
		public function infos_sujet($id_sujet)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_sujet',$id_sujet)
			->get();
		}







		public function infos_etablissement($id_etablissement)
		{
			$query = $this->db->query("SELECT * FROM etablissement 
				INNER JOIN arrondissement ON arrondissement.id_arrondissement = etablissement.arrondissement_id 
				INNER JOIN departement ON arrondissement.departement_id = departement.id_departement 
				INNER JOIN region ON departement.region_id = region.id_region 
				INNER JOIN compte ON etablissement.id_etablissement = compte.etablissement_id
				WHERE etablissement.id_etablissement='".$id_etablissement."'");
			return $query->result();
		}
		public function centre_examen($id_etablissement)
		{
			$centre=$this->id_centre_provisoire($id_etablissement);
			foreach ($centre->result() as $key) 
			{
				return $this->db->select('*')
				->from("centre_examen")
				->where('id_centre_examen',$key->centre_examen_id)
				->get();
			}
		}
		public function id_centre_provisoire($id_etablissement)
		{
			return $this->db->select('*')
			->from("etablissement_centre_examen")
			->where('etablissement_id',$id_etablissement)
			->get();
		}
		public function infos_etablissement_base($id_etablissement)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_etablissement',$id_etablissement)
			->get();
		}
		function modifier_etablissement($data,$id)
		{
			$this->db->where("id_etablissement",$id);
			$this->db->update($this->table,$data);
		}
		public function liste_etablissement_rattache($id_centre)
		{
			return $this->db->select('*')
			->from("etablissement_centre_examen")
			->join('etablissement', 'etablissement.id_etablissement = etablissement_centre_examen.etablissement_id')
			->where("etablissement_centre_examen.centre_examen_id",$this->session->userdata("id_centre_examen_etab"))
			->get();
		}
		
		public function inserer_etablissement_rattache($data)
		{
			$this->db->insert($this->table,$data);
			return $this->db->insert_id();
		}
		public function inserer_lier_etab_centre($data)
		{
			$this->db->insert("etablissement_centre_examen",$data);
		}
		function modifier_etablissement_rattache($data,$id)
		{
			$this->db->where("id_etablissement",$id);
			$this->db->update($this->table,$data);
		}

		/*******************************************************
				hermann
		**********************************************************/

		public function liste_centre_examen()
		{
			return $this->db->select('*')
			->from("centre_examen")
			->join('etablissement', 'etablissement.id_etablissement = centre_examen.etablissement_id')
			->distinct("centre_examen_id")
			->get();
		}
	}