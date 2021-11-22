<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Identite_model extends CI_Model
	{
		
		var $table = 'identite';
		public function liste_identite()
		{
			return $this->db->select('*')
			->from($this->table)
			->get();
		}
	}