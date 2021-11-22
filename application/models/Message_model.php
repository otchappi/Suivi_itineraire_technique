<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Message_model extends CI_Model
	{
		
		var $table = 'message';
		public function liste_message_client($login)
		{
			$query = $this->db->query("SELECT * FROM message 
				WHERE destinataire_message='".$login."' OR emeteur_message='".$login."'");
			return $query->result();
		}
		public function supprimer_message($id_message)
		{
			$this->db->where('id_message',$id_message);
			$this->db->delete($this->table);
		}
		function inserer_message($data)
		{
			$this->db->insert($this->table,$data);
		}	
		public function liste_new_message($login)
		{
			$query = $this->db->query("SELECT * FROM message 
				WHERE etat_message='0' AND destinataire_message='".$login."'");
			return $query->result();
		}
		function marquer_lu($data,$login)
		{
			$this->db->where("destinataire_message",$login);
			$this->db->update($this->table,$data);
		}
		
	}