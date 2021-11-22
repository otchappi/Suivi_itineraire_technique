<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Activite_model extends CI_Model
	{
		
		var $table = "activite";
		public function liste_activite_proche($id_membre)
		{
			$donnee=array(
				'projet.id_membre' => $id_membre,
			);
			$this->db->select("*");
			$this->db->join('projet', 'projet.id_projet = activite.id_projet');
			$this->db->where($donnee);
			$this->db->from($this->table);
			return $this->db->get();
		}
		public function liste_activite_proche_projet($id_projet)
		{
			$donnee=array(
				'projet.id_membre' => $this->session->userdata("id_membre"),
				'projet.id_projet' => $id_projet,
			);
			$this->db->select("*");
			$this->db->join('projet', 'projet.id_projet = activite.id_projet');
			$this->db->where($donnee);
			$this->db->from($this->table);
			return $this->db->get();
		}
		var $select_column=array("id_activite","designation_activite","description_activite","date_debut_activite","periodicite_activite");
		var $order_column=array("designation_activite",null,"date_debut_activite","periodicite_activite",null,null,null);
		public function make_query($id_projet)
		{
			$this->db->select($this->select_column);
			$this->db->from($this->table);
			$this->db->where("id_projet",$id_projet);
			if(isset($_POST["search"]["value"]))
			{
				$this->db->like("designation_activite",$_POST["search"]["value"]);				
				$this->db->or_like("date_debut_activite",$_POST["search"]["value"]);
			}
			if(isset($_POST["order"]))
			{
				$this->db->order_by($this->order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
			}
			else
			{
				$this->db->order_by("date_debut_activite","ASC");
			}
		}
		public function make_datatables($id_projet)
		{
			$this->make_query($id_projet);
			$this->db->where("id_projet",$id_projet);
			if($_POST["length"]!=-1)
			{
				$this->db->limit($_POST["length"],$_POST["start"]);
			}
			$query=$this->db->get();
			return $query->result();
		}
		public function get_filtered_data($id_projet)
		{
			$this->make_query($id_projet);
			$this->db->where("id_projet",$id_projet);
			$query=$this->db->get();
			return $query->num_rows();
		}
		public function get_all_data($id_projet)
		{
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where("id_projet",$id_projet);
			return $this->db->count_all_results();
		}
		public function retirer_activite($id)
		{
			$this->db->where("id_activite",$id);
			$this->db->delete($this->table);
		}
		public function modifier_activite($data,$id)
		{
			$this->db->where("id_activite",$id);
			$this->db->update($this->table,$data);
		}
		public function infos_activite($id_activite)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_activite',$id_activite)
			->get();
		}









		
		
		public function liste_activite($id_projet)
		{
			return $this->db->select('*')
			->from($this->table)
			->where("id_projet",$id_projet)
			->get();
		}
		function inserer_activite($data)
		{
			$this->db->insert($this->table,$data);
		}
		
		
		
		
	}