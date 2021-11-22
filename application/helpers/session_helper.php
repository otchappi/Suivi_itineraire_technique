<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$ctrl=&get_instance();
$ctrl->load->library('session');

if(!function_exists('set_flash_data'))
{
	function set_flash_data($data)
	{

		$ctrl=&get_instance();
		$ctrl->session->set_flashdata('flash', $data);
		//$_SESSION['flash'] = $data;
	}
}

if(!function_exists('get_flash_data'))
{
	function get_flash_data()
	{
		$ctrl=&get_instance();
		//var_dump($_SESSION);die;
		// $ctrl=&get_instance();
		//if(session_data_isset('flash')) {
		return $ctrl->session->flashdata('flash');
		//unset_session_data('flash');
		//$_SESSION['flash'] = null;
		//return $val;
		//}
	}
}
