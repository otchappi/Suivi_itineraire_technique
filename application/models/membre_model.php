<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Membre_model extends CI_Model
	{
		
		var $table = "membre";
		var $select_column=array("id_membre","nom_membre","prenom_membre","sexe_membre","telephone_membre","poste_membre","photo_membre");
		var $order_column=array(null,"nom_membre","prenom_membre","sexe_membre",null,null,null,null,null);
		public function infos_membre($id_membre)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_membre',$id_membre)
			->get();
		}





		
		public function infos_membre_nom($nom_membre)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('nom_membre',$nom_membre)
			->get();
		}
		function inserer_membre($data)
		{
			$this->db->insert($this->table,$data);
		}
		function modifier_membre($data,$id)
		{
			$this->db->where("id_membre",$id);
			$this->db->update($this->table,$data);
		}
		public function dernier_id_membre()
		{
			return $this->db->select('id_membre')
			->from($this->table)
			->get()
			->result();
		}

		public function make_query()
		{
			$this->db->select($this->select_column);
			$this->db->from($this->table);
			if(isset($_POST["search"]["value"]))
			{
				$this->db->like("nom_membre",$_POST["search"]["value"]);
				$this->db->or_like("prenom_membre",$_POST["search"]["value"]);
			}
			if(isset($_POST["order"]))
			{
				$this->db->order_by($this->order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
			}
			else
			{
				$this->db->order_by("nom_membre","ASC");
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
			$this->db->select("*");
			$this->db->from($this->table);
			return $this->db->count_all_results();
		}
		public function liste_membre()
		{
			return $this->db->select('*')
			->order_by("nom_membre","ASC")
			->from($this->table)
			->get();
			/*->result();*/
		}
		public function liste_membre_restant()
		{
			return $this->db->select('*')
			->order_by("nom_membre","ASC")
			->from($this->table)
			->get()
			->result();
		}

		public function nouveaux_membres()
		{
			return $this->db->select('*')
			->order_by("date_arrivee_membre","DESC")
			->limit(3)
			->from($this->table)
			->get();
		}
		public function nb_personne()
		{
			$this->db->select("*");
			$this->db->from($this->table);
			return $this->db->count_all_results();			
		}
		public function nb_masculin()
		{
			$this->db->select("*");
			$this->db->where("sexe_membre",1);
			$this->db->from($this->table);
			return $this->db->count_all_results();			
		}
		public function nb_feminin()
		{
			$this->db->select("*");
			$this->db->where("sexe_membre",0);
			$this->db->from($this->table);
			return $this->db->count_all_results();			
		}
	}