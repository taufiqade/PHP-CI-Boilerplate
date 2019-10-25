<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('Base_controller.php');
class Welcome extends CI_Controller {
	use Base_controller;
	
	public function __construct()
	{
		parent::__construct();
		$this->base_init();

		$this->includeCSS(array(
			format_development_url('assets/css/bootstrap.min.css',false)
		));
		$this->includeJS(array(
			format_development_url('assets/js/bootstrap.min.js',false)
		));
	}
	
	public function index()
	{
		$this->common_data['_title'] = "Homepage";
		$this->common_data['_enable_footer'] = false;
		
		$this->loadView([
			'body-class'=> 'welcome',
			'content' => [
				$this->getView('pages/home'),
			]
		]);
	}
}
