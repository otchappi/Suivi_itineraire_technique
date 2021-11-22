<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Testimony_model extends CI_Model
	{
		var $table = 'temoignage';
		public function liste_temoignage()
		{
			return $this->db->select('*')
			->from($this->table)
			->join('membre', 'membre.id_membre = temoignage.id_membre')
			->get();
		}
		
	}