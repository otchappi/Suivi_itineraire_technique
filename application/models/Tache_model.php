<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Tache_model extends CI_Model
	{
		
		var $table = "tache";
		public function liste_tache_membre($id_membre)
		{
			return $this->db->select('*')
			->order_by("date_debut_tache","ASC")
			->join('projet', 'projet.id_projet = tache.id_projet')
			->where('projet.id_membre',$id_membre)
			->from($this->table)
			->get();
		}
		public function liste_tache_projet($id_projet)
		{
			return $this->db->select('*')
			->order_by("date_debut_tache","ASC")
			->join('projet', 'projet.id_projet = tache.id_projet')
			->where('projet.id_projet',$id_projet)
			->where('projet.id_membre',$this->session->userdata("id_membre"))
			->from($this->table)
			->get();
		}
		public function liste_etape($id_projet)
		{
			return $this->db->select('designation_etape')
			->order_by("designation_etape","ASC")
			->distinct()
			->join('projet', 'projet.id_projet = tache.id_projet')
			->where('projet.id_projet',$id_projet)
			->where('projet.id_membre',$this->session->userdata("id_membre"))
			->from($this->table)
			->get();
		}
		public function liste_tache_hors_delais_membre($id_membre)
		{
			$donnee=array(
				'projet.id_membre' => $id_membre,
				'date_echeance_tache <=' =>  date('Y-m-d'),
				'date_realisation_tache =' =>  '0000-00-00'
			);
			$this->db->select("*");
			$this->db->join('projet', 'projet.id_projet = tache.id_projet');
			$this->db->where($donnee);
			$this->db->from($this->table);
			return $this->db->get();
		}
		public function liste_tache_hors_delais_projet($id_projet)
		{
			$donnee=array(
				'projet.id_membre' => $this->session->userdata("id_membre"),
				'projet.id_projet' => $id_projet,
				'date_echeance_tache <=' =>  date('Y-m-d'),
				'date_realisation_tache =' =>  '0000-00-00'
			);
			$this->db->select("*");
			$this->db->join('projet', 'projet.id_projet = tache.id_projet');
			$this->db->where($donnee);
			$this->db->from($this->table);
			return $this->db->get();
		}
		public function liste_tache_jour_membre($id_membre)
		{
			return $this->db->select('*')
			->order_by("date_debut_tache","ASC")
			->join('projet', 'projet.id_projet = tache.id_projet')
			->where('projet.id_membre',$id_membre)
			->where('date_debut_tache <=',date("Y-m-d"))
			->where('date_echeance_tache >=',date("Y-m-d"))
			->from($this->table)
			->get();
		}
		public function liste_tache_demain_membre($id_membre)
		{
			return $this->db->select('*')
			->order_by("date_debut_tache","ASC")
			->join('projet', 'projet.id_projet = tache.id_projet')
			->where('projet.id_membre',$id_membre)
			->where('date_debut_tache',date('Y-m-d',strtotime(date('Y-m-d').'+1 days')))
			->from($this->table)
			->get();
		}
		public function liste_tache_en_cours_projet($id_projet)
		{
			return $this->db->select('*')
			->order_by("date_debut_tache","ASC")
			->join('projet', 'projet.id_projet = tache.id_projet')
			->where('projet.id_membre',$this->session->userdata("id_membre"))
			->where('projet.id_projet',$id_projet)
			->where('date_debut_tache <=',date("Y-m-d"))
			->where('date_realisation_tache', '0000-00-00')
			->from($this->table)
			->get();
		}
		public function infos_tache($id_tache)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_tache',$id_tache)
			->get();
		}
		public function liste_tache_proche_projet($id_projet)
		{
			return $this->db->select('*')
			->order_by("date_debut_tache","ASC")
			->join('projet', 'projet.id_projet = tache.id_projet')
			->where('projet.id_projet',$id_projet)
			->where('projet.id_membre',$this->session->userdata("id_membre"))
			->where('date_debut_tache >',date("Y-m-d"))
			->where('date_debut_tache <=',date('Y-m-d',strtotime(date('Y-m-d').'+7 days')))
			->from($this->table)
			->get();
		}
		public function nb_tache_termine($id_projet)
		{
			$donnee=array(
				'id_projet' => $id_projet,
				'date_realisation_tache !=' =>  '0000-00-00'
			);
			$this->db->select("*");
			$this->db->where($donnee);
			$this->db->from($this->table);
			return $this->db->count_all_results();
		}
		public function nb_tache($id_projet)
		{
			$this->db->select("*");
			$this->db->where("id_projet",$id_projet);
			$this->db->from($this->table);
			return $this->db->count_all_results();			
		}
		public function modifier_tache($data,$id)
		{
			$this->db->where("id_tache",$id);
			$this->db->update($this->table,$data);
		}
		function inserer_tache($data)
		{
			$this->db->insert($this->table,$data);
			return $this->db->insert_id();
		}
		var $order_column=array("intitule_tache","date_debut_tache","date_echeance_tache","etat_tache",null,null,null,null);
		
		public function make_query($id_projet)
		{
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('id_projet',$id_projet);
			if($this->session->userdata("cri_date")!="")
			{
				$this->db->where('date_debut_tache',$this->session->userdata("cri_date"));
			}
			if($this->session->userdata("cri_etape")!="")
			{
				$this->db->where('designation_etape',$this->session->userdata("cri_etape"));
			}
			if($this->session->userdata("cri_statut")!="")
			{
				if($this->session->userdata("cri_statut")=="1")
				{
					$this->db->where('date_realisation_tache !=','0000-00-00');
				}
				if($this->session->userdata("cri_statut")=="2")
				{
					$this->db->where('date_debut_tache <=',date("Y-m-d"));
					$this->db->where('date_realisation_tache', '0000-00-00');
				}
				if($this->session->userdata("cri_statut")=="3")
				{
					$this->db->where('date_debut_tache >',date("Y-m-d"));
					$this->db->where('date_realisation_tache', '0000-00-00');
				}
			}
			if(isset($_POST["search"]["value"]))
			{
				$this->db->like("intitule_tache",$_POST["search"]["value"]);
			}
			if(isset($_POST["order"]))
			{
				$this->db->order_by($this->order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
			}
			else
			{
				$this->db->order_by("date_debut_tache","DESC");
			}
		}
		public function make_datatables($id_projet)
		{
			$this->make_query($id_projet);
			$this->db->where('id_projet',$id_projet);
			if($this->session->userdata("cri_date")!="")
			{
				$this->db->where('date_debut_tache',$this->session->userdata("cri_date"));
			}
			if($this->session->userdata("cri_etape")!="")
			{
				$this->db->where('designation_etape',$this->session->userdata("cri_etape"));
			}
			if($this->session->userdata("cri_statut")!="")
			{
				if($this->session->userdata("cri_statut")=="1")
				{
					$this->db->where('date_realisation_tache !=','0000-00-00');
				}
				if($this->session->userdata("cri_statut")=="2")
				{
					$this->db->where('date_debut_tache <=',date("Y-m-d"));
					$this->db->where('date_realisation_tache', '0000-00-00');
				}
				if($this->session->userdata("cri_statut")=="3")
				{
					$this->db->where('date_debut_tache >',date("Y-m-d"));
					$this->db->where('date_realisation_tache', '0000-00-00');
				}
			}
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
			$this->db->where('id_projet',$id_projet);
			if($this->session->userdata("cri_date")!="")
			{
				$this->db->where('date_debut_tache',$this->session->userdata("cri_date"));
			}
			if($this->session->userdata("cri_etape")!="")
			{
				$this->db->where('designation_etape',$this->session->userdata("cri_etape"));
			}
			if($this->session->userdata("cri_statut")!="")
			{
				if($this->session->userdata("cri_statut")=="1")
				{
					$this->db->where('date_realisation_tache !=','0000-00-00');
				}
				if($this->session->userdata("cri_statut")=="2")
				{
					$this->db->where('date_debut_tache <=',date("Y-m-d"));
					$this->db->where('date_realisation_tache', '0000-00-00');
				}
				if($this->session->userdata("cri_statut")=="3")
				{
					$this->db->where('date_debut_tache >',date("Y-m-d"));
					$this->db->where('date_realisation_tache', '0000-00-00');
				}
			}
			$query=$this->db->get();
			return $query->num_rows();
		}
		public function get_all_data($id_projet)
		{
			$this->db->select("*");
			$this->db->from($this->table);
			$this->db->where('id_projet',$id_projet);
			if($this->session->userdata("cri_date")!="")
			{
				$this->db->where('date_debut_tache',$this->session->userdata("cri_date"));
				$this->session->unset_userdata("cri_date");
			}
			if($this->session->userdata("cri_etape")!="")
			{
				$this->db->where('designation_etape',$this->session->userdata("cri_etape"));
				$this->session->unset_userdata("cri_etape");
			}
			if($this->session->userdata("cri_statut")!="")
			{
				if($this->session->userdata("cri_statut")=="1")
				{
					$this->db->where('date_realisation_tache !=','0000-00-00');
				}
				if($this->session->userdata("cri_statut")=="2")
				{
					$this->db->where('date_debut_tache <=',date("Y-m-d"));
					$this->db->where('date_realisation_tache', '0000-00-00');
				}
				if($this->session->userdata("cri_statut")=="3")
				{
					$this->db->where('date_debut_tache >',date("Y-m-d"));
					$this->db->where('date_realisation_tache', '0000-00-00');
				}
				$this->session->unset_userdata("cri_statut");
			}
			return $this->db->count_all_results();
		}
		public function supprimer_tache($id_tache)
		{
			$this->db->where("id_tache",$id_tache);
			$this->db->delete($this->table);
		}















		
		
		
		public function make_query_membre($id_projet,$id_membre)
		{
			$this->db->select($this->select_column);
			$this->db->from($this->table);
			$this->db->where('id_membre',$id_membre);
			$this->db->where('id_projet',$id_projet);
			if(isset($_POST["search"]["value"]))
			{
				$this->db->like("intitule_tache",$_POST["search"]["value"]);
				$this->db->or_like("budget_tache",$_POST["search"]["value"]);
			}
			if(isset($_POST["order"]))
			{
				$this->db->order_by($this->order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
			}
			else
			{
				$this->db->order_by("date_debut_tache","DESC");
			}
		}
		public function make_datatables_membre($id_projet,$id_membre)
		{
			$this->make_query_membre($id_projet,$id_membre);
			$this->db->where('id_membre',$id_membre);
			$this->db->where('id_projet',$id_projet);
			if($_POST["length"]!=-1)
			{
				$this->db->limit($_POST["length"],$_POST["start"]);
			}
			$query=$this->db->get();
			return $query->result();
		}
		public function get_filtered_data_membre($id_projet,$id_membre)
		{
			$this->make_query_membre($id_projet,$id_membre);
			$this->db->where('id_membre',$id_membre);
			$this->db->where('id_projet',$id_projet);
			$query=$this->db->get();
			return $query->num_rows();
		}
		public function get_all_data_membre($id_projet,$id_membre)
		{
			$this->db->select("*");
			$this->db->from($this->table);
			$this->db->where('id_membre',$id_membre);
			$this->db->where('id_projet',$id_projet);
			return $this->db->count_all_results();
		}

		public function liste_tache($id_projet)
		{
			return $this->db->select('*')
			->order_by("date_debut_tache","ASC")
			->where('id_projet',$id_projet)
			->from($this->table)
			->get();
		}
		public function liste_date_fin_tache($id_projet)
		{
			return $this->db->select('date_echeance_tache')
			->order_by("date_echeance_tache","ASC")
			->where('id_projet',$id_projet)
			->from($this->table)
			->get();
		}
		
		public function liste_tache_membre_projet($id_membre,$id_projet)
		{
			return $this->db->select('*')
			->order_by("date_debut_tache","ASC")
			->where('id_projet',$id_projet)
			->where('id_membre',$id_membre)
			->from($this->table)
			->get();
		}
		
		public function nb_tache_en_cours($id_projet)
		{
			$donnees=array(
				'id_projet' => $id_projet,
				'date_debut_tache <=' =>  date('Y-m-d'),
				'date_realisation_tache =' =>  '0000-00-00'
			);
			$this->db->select("*");
			$this->db->where($donnees);
			$this->db->from($this->table);
			return $this->db->count_all_results();
		}
		public function nb_tache_a_venir($id_projet)
		{
			$donnees=array(
				'id_projet' => $id_projet,
				'date_debut_tache >=' =>  date('Y-m-d'),
				'date_realisation_tache =' =>  '0000-00-00'
			);
			$this->db->select("*");
			$this->db->where($donnees);
			$this->db->from($this->table);
			return $this->db->count_all_results();
		}
		
		public function nb_tache_hors_delais($id_projet)
		{
			$donnee=array(
				'id_projet' => $id_projet,
				'date_echeance_tache <=' =>  date('Y-m-d'),
				'date_realisation_tache =' =>  '0000-00-00'
			);
			$this->db->select("*");
			$this->db->where($donnee);
			$this->db->from($this->table);
			return $this->db->count_all_results();
		}
		public function liste_tache_hors_delais($id_projet)
		{
			$donnee=array(
				'id_projet' => $id_projet,
				'date_debut_tache >=' =>  date('Y-m-d'),
				'date_debut_tache <=' =>  date('Y-m-d',strtotime(date('Y-m-d').'+7 days')),
				'date_realisation_tache =' =>  '0000-00-00'
			);
			$this->db->select("*");
			$this->db->where($donnee);
			$this->db->from($this->table);
			return $this->db->get();
		}

		public function nouvelles_taches()
		{
			return $this->db->select('*')
			->order_by("date_realisation_tache","DESC")
			->where('date_realisation_tache!=','0000-00-00')
			->limit(5)
			->from($this->table)
			->get();
		}
		
	}