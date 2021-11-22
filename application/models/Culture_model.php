<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Culture_model extends CI_Model
	{
		
		var $table = "culture";

		public function liste_culture_accueil()
		{
			return $this->db->select('*')
			->order_by("id_culture","DESC")
			->from($this->table)
			->limit(5)
			->get();
		}
		public function nb_culture()
		{
			$this->db->select("*");
			$this->db->from($this->table);
			return $this->db->count_all_results();			
		}
		public function liste_culture()
		{
			return $this->db->select('*')
			->order_by("id_culture","DESC")
			->from($this->table)
			->get();
		}
		public function liste_culture_recherche($designation,$id_region,$id_categorie)
		{
			$this->db->select("*");
			$this->db->from($this->table);
			if($designation!="")
			{
				$this->db->like('designation_culture',$designation);
			}
			if($id_categorie!=0)
			{
				$this->db->where('id_categorie',$id_categorie);
			}
			if($id_region!=0)
			{
				$this->db->join('region_culture', 'region_culture.id_culture = culture.id_culture');
				$this->db->where('region_culture.id_region',$id_region);
			}
			return $this->db->get();
		}
		public function details_culture($id_culture)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_culture',$id_culture)
			->get();
		}












		var $select_column=array("id_procede","id_culture","designation_procede","periodicite_procede","cout_procede","duree_procede");
		var $order_column=array("designation_procede","periodicite_procede","cout_procede","duree_procede",null,null);
		
		public function infos_procede($id_procede)
		{
			return $this->db->select('*')
			->from($this->table1)
			->where('id_procede',$id_procede)
			->get();
		}
		public function infos_dependre($id_esclave)
		{
			return $this->db->select('*')
			->from($this->table2)
			->where('id_esclave',$id_esclave)
			->get();
		}
		public function liste_esclave($id_maitre)
		{
			return $this->db->select('*')
			->from($this->table2)
			->where('id_maitre',$id_maitre)
			->get();
		}
		function inserer_culture($data)
		{
			$this->db->insert($this->table,$data);
			return $this->db->insert_id();
		}
		function modifier_culture($data,$id)
		{
			$this->db->where("id_culture",$id);
			$this->db->update($this->table,$data);
		}
		public function supprimer_culture($id)
		{
			$this->db->where("id_culture",$id);
			$this->db->delete($this->table);
		}
		function inserer_procede($data)
		{
			$this->db->insert($this->table1,$data);
			return $this->db->insert_id();
		}
		function modifier_procede($data,$id)
		{
			$this->db->where("id_procede",$id);
			$this->db->update($this->table1,$data);
		}
		public function supprimer_procede($id)
		{
			$this->db->where("id_procede",$id);
			$this->db->delete($this->table1);
		}
		function modifier_dependre($data,$id)
		{
			$this->db->where("id_esclave",$id);
			$this->db->update($this->table2,$data);
		}
		function inserer_dependre($data)
		{
			$this->db->insert($this->table2,$data);
		}
		public function supprimer_dependre($id)
		{
			$this->db->where("id_esclave",$id);
			$this->db->delete($this->table2);
		}
		public function dernier_id_culture()
		{
			return $this->db->select('id_culture')
			->from($this->table)
			->get()
			->result();
		}
		
		public function liste_procede()
		{
			return $this->db->select('*')
			->order_by("periodicite_procede","ASC")
			->from($this->table1)
			->get();
		}
		public function liste_dependre()
		{
			return $this->db->select('*')
			->from($this->table2)
			->get();
		}
		public function liste_dependre_culture($id_culture)
		{
			return $this->db->select('*')
			->where('id_culture',$id_culture)
			->from($this->table2)
			->get();
		}
		public function liste_procede_culture($id_culture)
		{
			return $this->db->select('*')
			->order_by("periodicite_procede","ASC")
			->where('id_culture',$id_culture)
			->from($this->table1)
			->get();
		}
		public function liste_culture_projet($id_projet)
		{
			$query = $this->db->query("SELECT * FROM culture INNER JOIN lier ON culture.id_culture = lier.id_culture WHERE lier.id_projet='".$id_projet."'");
			return $query->result();
		}
		public function liste_culture_pas_projet($id_projet)
		{
			$this->db->select('*');
			$this->db->from($this->table);
			$data=$this->liste_culture_projet($id_projet);
			$donnee=array();
			$i=0;
			foreach ($data as $key) {
				$donnee[$i]=$key->id_culture;
				$i++;
			}
			$this->db->where_not_in('id_culture', $donnee);
			$query = $this->db->get();
			return $query->result();
		}
		public function make_query($id_culture)
		{
			$this->db->select($this->select_column);
			$this->db->from($this->table1);
			$this->db->where('id_culture',$id_culture);
			if(isset($_POST["search"]["value"]))
			{
				$this->db->like("designation_procede",$_POST["search"]["value"]);
				$this->db->or_like("periodicite_procede",$_POST["search"]["value"]);
			}
			if(isset($_POST["order"]))
			{
				$this->db->order_by($this->order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
			}
			else
			{
				$this->db->order_by("designation_procede","ASC");
			}
		}
		public function make_datatables($id_culture)
		{
			$this->make_query($id_culture);
			$this->db->where('id_culture',$id_culture);
			if($_POST["length"]!=-1)
			{
				$this->db->limit($_POST["length"],$_POST["start"]);
			}
			$query=$this->db->get();
			return $query->result();
		}
		public function get_filtered_data($id_culture)
		{
			$this->make_query($id_culture);
			$this->db->where('id_culture',$id_culture);
			$query=$this->db->get();
			return $query->num_rows();
		}
		public function get_all_data($id_culture)
		{
			$this->db->select("*");
			$this->db->where('id_culture',$id_culture);
			$this->db->from($this->table1);
			return $this->db->count_all_results();
		}
		public function nb_procedes()
		{
			$this->db->select("*");
			$this->db->from($this->table);
			return $this->db->count_all_results();			
		}

		public function make_query2($id_culture)
		{
			$this->db->select($this->select_column);
			$this->db->from($this->table1);
			$this->db->where('id_culture',$id_culture);
			$this->db->where('periodicite_procede<>',"");
			if(isset($_POST["search"]["value"]))
			{
				$this->db->like("designation_procede",$_POST["search"]["value"]);
				$this->db->or_like("periodicite_procede",$_POST["search"]["value"]);
			}
			if(isset($_POST["order"]))
			{
				$this->db->order_by($this->order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
			}
			else
			{
				$this->db->order_by("designation_procede","ASC");
			}
		}
		public function make_datatables2($id_culture)
		{
			$this->make_query2($id_culture);
			$this->db->where('id_culture',$id_culture);
			$this->db->where('periodicite_procede<>',"");
			if($_POST["length"]!=-1)
			{
				$this->db->limit($_POST["length"],$_POST["start"]);
			}
			$query=$this->db->get();
			return $query->result();
		}
		public function get_filtered_data2($id_culture)
		{
			$this->make_query2($id_culture);
			$this->db->where('id_culture',$id_culture);
			$this->db->where('periodicite_procede<>',"");
			$query=$this->db->get();
			return $query->num_rows();
		}
		public function get_all_data2($id_culture)
		{
			$this->db->select("*");
			$this->db->where('id_culture',$id_culture);
			$this->db->where('periodicite_procede<>',"");
			$this->db->from($this->table1);
			return $this->db->count_all_results();
		}

		public function make_query3($id_culture)
		{
			$this->db->select($this->select_column);
			$this->db->from($this->table1);
			$this->db->where('id_culture',$id_culture);
			$this->db->where('duree_procede<>',"");
			if(isset($_POST["search"]["value"]))
			{
				$this->db->like("designation_procede",$_POST["search"]["value"]);
				$this->db->or_like("duree_procede",$_POST["search"]["value"]);
			}
			if(isset($_POST["order"]))
			{
				$this->db->order_by($this->order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
			}
			else
			{
				$this->db->order_by("designation_procede","ASC");
			}
		}
		public function make_datatables3($id_culture)
		{
			$this->make_query3($id_culture);
			$this->db->where('id_culture',$id_culture);
			$this->db->where('duree_procede<>',"");
			if($_POST["length"]!=-1)
			{
				$this->db->limit($_POST["length"],$_POST["start"]);
			}
			$query=$this->db->get();
			return $query->result();
		}
		public function get_filtered_data3($id_culture)
		{
			$this->make_query3($id_culture);
			$this->db->where('id_culture',$id_culture);
			$this->db->where('duree_procede<>',"");
			$query=$this->db->get();
			return $query->num_rows();
		}
		public function get_all_data3($id_culture)
		{
			$this->db->select("*");
			$this->db->where('id_culture',$id_culture);
			$this->db->where('duree_procede<>',"");
			$this->db->from($this->table1);
			return $this->db->count_all_results();
		}
		
	}