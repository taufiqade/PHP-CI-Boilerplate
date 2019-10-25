<?php
if ( ! defined("BASEPATH"))
{
    exit("No direct script access allowed");
}

trait base_controller {
// class Base_controller extends CI_Controller {
    private $common_data = [
		'_title'=>'',
		'_menu'=>array(),
		'_js' => array(),
		'_css' => array(),
		'_views'=>array(),
		'_views_data'=>array(),
		'_enable_head'=>true,
		'_enable_header'=>true,
		'_enable_menu'=>true,
		'_enable_footer'=>true,
    ];
	
	/**
	* Init method 
	*/
	function base_init() {
		$this->auth();
		$this->load->helper('main');
	}
    
    /**
	* Method to check if current user is logged in or not.
	*
	* @return bool True = logged in, False = not logged in
	*/
	protected function isLoggedIn() {
		return $this->whoami->logged_in;
    }
    
    /**
	* This method will check for user login status.
	* If already logged in it will return the whoami data object else redirected back to explore
	*
	* @return array The whoami data array
	*/
    public function auth() {
        // to do is check from session and set whoami
        $this->whoami = new stdClass;

        $this->whoami->user_id = null;
        $this->whoami->user_name = null;
        $this->whoami->logged_in = false;
        return false;
    }

    /**
	* Get the whoami data collected from auth that will include the common details like user profile, user_name for use in Views.
	*
	* @return array The whoami array data
	*/
	protected function getData() {
		return $this->whoami_base;
	}

    protected function checkLogin() {
		if ($this->isLoggedIn()) {
			return $this->getData();
		} else {
			redirect("/");
		}
	}
    
    public function includeJS($url_path,$name=null,$position=null) {
		$index_name = "_js";
		if(!is_null($position) || trim($position) == "bottom") {
			$index_name .= "_bottom";
		}
		if((is_string($url_path) || is_array($url_path)) && !empty($url_path)) {
			if(is_array($url_path)) {
				$this->common_data[$index_name] = array_merge($this->common_data[$index_name],$url_path);
			} else {
				if(!empty($name)) {
					$this->common_data[$index_name][$name] = $url_path;
				} else {
					$this->common_data[$index_name][] = $url_path;
				}
			}
		}
    }
    
    public function includeCSS($url_path,$name=null,$array_unshift=false) {
		if((is_string($url_path) || is_array($url_path)) && !empty($url_path)) {
			if(is_array($url_path)) {
				$this->common_data['_css'] = array_merge($this->common_data['_css'],$url_path);
			} else {
				if(!empty($name)) {
					$this->common_data['_css'][$name] = $url_path;
				} else {
					$this->common_data['_css'][] = $url_path;
				}	
			}
		}
    }

    public function globalData($arr=null) {
		$global = array(
			'whoami'=>$this->whoami,
			'og'=>(isset($this->og) && !empty($this->og) ? $this->og: new stdClass),
			'meta'=>(isset($this->meta) && !empty($this->meta) ? $this->meta: new stdClass),
		);
		if(is_object($arr)) $arr = (array)$arr;
		if(is_array($arr)) {
			$global = array_merge($global,$arr);
		}
		return $global;
	}

	public function getView($view,$data=array(),$asString = true) {
		if(is_object($data)) $data = (array)$data;
		if(is_array($data)) {
			$data = array_merge($this->common_data,$data);
		}
        $data = $this->globalData($data);
        return $this->load->view($view,$data, true);
	}
    
    public function loadView($data=null) {
        if($this->common_data['_enable_footer']) $this->common_data['_views']['footer'] = $this->getView('footer',$this->globalData());
        if($this->common_data['_enable_menu']) $this->common_data['_views']['menu'] = $this->getView('menu',$this->globalData());
        if($this->common_data['_enable_head']) $this->common_data['_views']['head'] = $this->getView('head',$this->globalData());
        if($this->common_data['_enable_header']) $this->common_data['_views']['header'] = $this->getView('header',$this->globalData());
	
		if(is_array($data)) {
			$this->common_data['_views'] = array_merge($this->common_data['_views'],$data);
		}
		$this->load->view('index',$this->common_data);		
	}






}