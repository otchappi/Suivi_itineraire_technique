<?php

class MY_Controller extends CI_Controller
{
	/**
	 *
	 * @var array
	 */
	protected $data;
	

	protected function render($titre,$view=null, $leftMenu=true){

		$this->load->view('obc/template/header', array('titre'=>$titre));
		if ($leftMenu){
			$this->load->view('obc/template/left-menu');
		}

		$this->load->view($this->zone.'/'.$view, $this->data);
		$this->load->view('obc/template/footer',array());
	}
}
