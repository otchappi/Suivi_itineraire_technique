<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Notification_model extends CI_Model
	{
		
		protected $table = 'notification';
		public function liste_toute_notification()
		{
			return $this->db->select('*')
			->from("type_notification")
			->order_by('description_notification', 'asc')
			->get();
		}
		public function liste_notification_dossier($id_dossier)
		{
			return $this->db->select('*')
			->from($this->table)
			->join('type_notification', 'notification.type_notification_id = type_notification.id_type_notification')
			->where('dossier_id', $id_dossier)
			->order_by('description_notification', 'asc')
			->get();
		}
		public function liste_id_notification_dossier($id_dossier)
		{
			return $this->db->select('id_type_notification')
			->from($this->table)
			->join('type_notification', 'notification.type_notification_id = type_notification.id_type_notification')
			->where('dossier_id', $id_dossier)
			->get()
			->result();
		}
		public function renvoyer_notification($data,$id_dossier)
		{
			$this->db->where("id_dossier",$id_dossier);
			$this->db->update($this->table,$data);
		}
		public function envoyer_notification($data)
		{
			$this->db->insert($this->table,$data);
		}



		public function intitule_session($id)
		{
			return $this->db->select('*')
			->from($this->table)
			->where('id_session', $id)
			->get()
			->result();
		}
		public function inserer_session($data)
		{
			$this->db->insert($this->table,$data);
		}
		function modifier_session($data,$id_session)
		{
			$this->db->where("id_session",$id_session);
			$this->db->update($this->table,$data);
		}
		public function derniere_session()
		{
			return $this->db->select('*')
			->from($this->table)
			->order_by("id_session",'desc')
			->limit("1")
			->get()
			->result();
		}
	}