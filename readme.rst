Intro
Boilerplate (BP) PHP-CI for personal use, this BP implements `traits`

How to use

Welcome controller

	<?php
	defined('BASEPATH')  OR  exit('No direct script access allowed');
	
	require_once('Base_controller.php');
	class  Welcome  extends  CI_Controller  {

	use  Base_controller;
	public function __construct()
	{
		parent::__construct();
		$this->base_init();
		$this->includeCSS([
			format_development_url('assets/css/bootstrap.min.css',false)
		]);
		$this->includeJS([
			format_development_url('assets/js/bootstrap.min.js',false)
		]);
	}

	public function index()
	{
		$this->common_data['_title']  =  "Homepage";
		$this->common_data['_enable_footer']  =  false;

		$ads_component =  $this->getView('components/ads', ['data'=>'testing']);
		$this->loadView([
			'body-class'=>  'welcome',
			'content'  =>  [
				$this->getView('pages/home'),
				$ads_component
			]
		]);
	}
    
ToDo:
 - [ ] Services layer
 - [ ] Scoped data into global var jquery
