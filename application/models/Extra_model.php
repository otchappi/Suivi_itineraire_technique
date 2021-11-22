<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Extra_model extends CI_Model
	{
		
		public function verify_centre_examen($id)
		{
			return  $this->db->where('etablissement_id',$id)
	                         ->count_all_results('centre_examen');
		}

		/********************

		definir un etablissement comme centre d'examen
		*********************/


		public function  definir_centre_examen($id)
		{
			return $this->db->set('etablissement_id',$id)
							 ->insert('centre_examen');
		}
	}