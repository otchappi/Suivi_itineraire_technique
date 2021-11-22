<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Sous_tache_model extends CI_Model
	{
		
		var $table = 'sous_tache';
		public function liste_sous_tache($id_tache)
		{
			return $this->db->select('*')
			->where('id_tache',$id_tache)
			->from($this->table)
			->order_by('date_debut_sous_tache', 'desc')
			->get();
		}
		public function nb_sous_tache_termine($id_tache)
		{
			$donnee=array(
				'id_tache' => $id_tache,
				'date_realisation_sous_tache !=' =>  '0000-00-00'
			);
			$this->db->select("*");
			$this->db->where($donnee);
			$this->db->from($this->table);
			return $this->db->count_all_results();
		}
		public function nb_sous_tache($id_tache)
		{
			$this->db->select("*");
			$this->db->where("id_tache",$id_tache);
			$this->db->from($this->table);
			return $this->db->count_all_results();			
		}
		public function modifier_sous_tache($data,$id)
		{
			$this->db->where("id_sous_tache",$id);
			$this->db->update($this->table,$data);
		}
		public function supprimer_sous_tache($id_sous_tache)
		{
			$this->db->where('id_sous_tache',$id_sous_tache);
			$this->db->delete($this->table);
		}
		public function infos_sous_tache($id_sous_tache)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_sous_tache',$id_sous_tache)
			->get();
		}
		public function inserer_sous_tache($data)
		{
			$this->db->insert($this->table,$data);
		}
		var $order_column=array("designation_sous_tache","date_debut_sous_tache","date_echeance_sous_tache","date_realisation_sous_tache",null,null,null);
		public function make_query($id_tache)
		{
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where("id_tache",$id_tache);
			if(isset($_POST["search"]["value"]))
			{
				$this->db->like("designation_sous_tache",$_POST["search"]["value"]);
			}
			if(isset($_POST["order"]))
			{
				$this->db->order_by($this->order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
			}
			else
			{
				$this->db->order_by("date_debut_sous_tache","ASC");
			}
		}
		public function make_datatables($id_tache)
		{
			$this->make_query($id_tache);
			$this->db->where("id_tache",$id_tache);
			if($_POST["length"]!=-1)
			{
				$this->db->limit($_POST["length"],$_POST["start"]);
			}
			$query=$this->db->get();
			return $query->result();
		}
		public function get_filtered_data($id_tache)
		{
			$this->make_query($id_tache);
			$this->db->where("id_tache",$id_tache);
			$query=$this->db->get();
			return $query->num_rows();
		}
		public function get_all_data($id_tache)
		{
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where("id_tache",$id_tache);
			return $this->db->count_all_results();
		}
		
	}