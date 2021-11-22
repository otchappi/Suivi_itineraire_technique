<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Projet_model extends CI_Model
	{
		
		var $table = "projet";
		var $order_column=array("titre_projet","date_creation_projet","date_echeance_projet","budget_projet",null,null);

		public function make_query_cl()
		{
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where("id_site",$this->session->userdata("id_site"));
			$this->db->where("id_membre",$this->session->userdata("id_membre"));
			if(isset($_POST["search"]["value"]))
			{
				$this->db->like("titre_projet",$_POST["search"]["value"]);
			}
			if(isset($_POST["order"]))
			{
				$this->db->order_by($this->order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
			}
			else
			{
				$this->db->order_by("date_creation_projet","DESC");
			}
		}
		public function make_datatables_cl()
		{
			$this->make_query_cl();
			$this->db->where("id_site",$this->session->userdata("id_site"));
			$this->db->where("id_membre",$this->session->userdata("id_membre"));
			if($_POST["length"]!=-1)
			{
				$this->db->limit($_POST["length"],$_POST["start"]);
			}
			$query=$this->db->get();
			return $query->result();
		}
		public function get_filtered_data_cl()
		{
			$this->make_query_cl();
			$this->db->where("id_site",$this->session->userdata("id_site"));
			$this->db->where("id_membre",$this->session->userdata("id_membre"));
			$query=$this->db->get();
			return $query->num_rows();
		}
		public function get_all_data_cl()
		{
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where("id_site",$this->session->userdata("id_site"));
			$this->db->where("id_membre",$this->session->userdata("id_membre"));
			return $this->db->count_all_results();
		}
		public function liste_projet_client($id_membre)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_membre', $id_membre)
			->order_by('date_creation_projet', 'desc')
			->get();
		}
		public function infos_projet($id_projet)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_projet',$id_projet)
			->get();
		}
		function modifier_projet($data,$id_projet)
		{
			$this->db->where("id_projet",$id_projet);
			$this->db->update($this->table,$data);
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
		

	}