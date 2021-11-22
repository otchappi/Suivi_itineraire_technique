<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Account_model extends CI_Model
	{
		var $table = 'compte';
		var $select_column=array("id_compte","login","password","date_creation_compte","etat_compte","type_compte","etablissement_id","candidat_id");
		var $order_column=array(null,"login","password","date_creation_compte",null,null,"etablissement_id","candidat_id");
		public function authentifier($identifiant,$mot_de_passe)
		{
			$this->db->where('login',$identifiant);
			$this->db->where('password',$mot_de_passe);
			$query=$this->db->get($this->table);
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row) 
				{
					$this->session->set_userdata("categorie_compte",$row->categorie);
					$this->session->set_userdata("etat_compte",$row->etat);
					return $row->id_membre;
				}
			}
			else
			{
				return -1;
			}
		}
		public function infos_connecte($id)
		{
			return $this->db->select('*')
			->from("membre")
			->where('id_membre',$id)
			->get();
		}
		public function changer_mdp($identifiant,$email)
		{
			$this->db->where('login',$identifiant);
			$query=$this->db->get('compte');
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row) 
				{
					$email=$this->obtenir_email($email,"membre","email_membre");
					if($email!=-1)
					{
						foreach ($email as $row) 
						{
							return $row->email_membre;
						}
					}
					else
						return -1;					
				}
			}
			else
			{
				return -1;
			}
		}
		public function obtenir_email($email,$table,$champ)
		{
			$this->db->where($champ,$email);
			$query=$this->db->get($table);
			if($query->num_rows()>0)
			{
				return $query->result();
			}
			else
			{
				return -1;
			}
		}
		function modifier_compte_login($data,$login)
		{
			$this->db->where("login",$login);
			$this->db->update($this->table,$data);
		}		
		public function ajouter_compte($data)
		{
			$this->db->insert($this->table,$data);
		}		
		public function supprimer_compte($login,$mot_de_passe,$id_membre)
		{
			$this->db->where("id_membre",$id_membre);
			$this->db->where("login",$login);
			$this->db->where("password",$mot_de_passe);
			$this->db->delete($this->table);
		}
		public function infos_admin()
		{
			return $this->db->select('*')
			->from($this->table)
			->where('categorie',"0")
			->get();
		}



















		function modifier_compte($data,$id_membre)
		{
			$this->db->where("id_membre",$id_membre);
			$this->db->update($this->table,$data);
		}
		
		public function type_etablissement($etablissement_id)
		{
			$this->db->where('etablissement_id',$etablissement_id);
			$query=$this->db->get('etablissement_centre_examen');
			if($query->num_rows()>0)
			{
				return 2;
			}
			$this->db->where('etablissement_id',$etablissement_id);
			$query1=$this->db->get('centre_examen');
			if($query1->num_rows()>0)
			{
				return 1;
			}
			return 0;
		}
		public function id_center($etablissement_id)
		{
			$this->db->where('etablissement_id',$etablissement_id);
			$this->db->select("id_centre_examen");
			$query1=$this->db->get('centre_examen');
			if($query1->num_rows()>0)
			{
				foreach ($query1->result() as $key) 
				{
					return $key->id_centre_examen;
				}
			}
		}
		
		/*public function make_query()
		{
			$this->db->select($this->select_column);
			$this->db->from($this->table);
			if(isset($_POST["search"]["value"]))
			{
				$this->db->like("login",$_POST["search"]["value"]);
			}
			if(isset($_POST["order"]))
			{
				$this->db->order_by($this->order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
			}
			else
			{
				$this->db->order_by("categorie_compte","ASC");
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