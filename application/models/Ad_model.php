<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Ad_model extends CI_Model
	{
		
		var $table = 'annonce';
		var $select_column=array("id_annonce","titre_annonce","contenu_annonce","etat_annonce","date_creation_annonce");
		//var $order_column=array(null,"titre_annonce","contenu_annonce","etat","date_creation_annonce",null,null,null);
		public function liste_annonce()
		{
			return $this->db->select('*')
			->from($this->table)
			->where("date_debut_annonce<=",date('Y-m-d'))
			->where("date_fin_annonce>=",date('Y-m-d'))
			->order_by('date_creation_annonce', 'desc')
			->limit(8)
			->get();
			/*->result();*/
		}
		/*function inserer_annonce($data)
		{
			$this->db->insert($this->table,$data);
		}
		function modifier_annonce($data,$id)
		{
			$this->db->where("id_annonce",$id);
			$this->db->update($this->table,$data);
		}
		public function supprimer_annonce($id)
		{
			$this->db->where("id_annonce",$id);
			$this->db->delete($this->table);
		}
		public function infos_annonce($id_annonce)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_annonce',$id_annonce)
			->get();
		}
		public function make_query()
		{
			$this->db->select($this->select_column);
			$this->db->from($this->table);
			if(isset($_POST["search"]["value"]))
			{
				$this->db->like("titre_annonce",$_POST["search"]["value"]);
				$this->db->or_like("contenu_annonce",$_POST["search"]["value"]);
				$this->db->or_like("date_creation_annonce",$_POST["search"]["value"]);
			}
			if(isset($_POST["order"]))
			{
				$this->db->order_by($this->order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
			}
			else
			{
				$this->db->order_by("date_creation_annonce","DESC");
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
		}*/
	}