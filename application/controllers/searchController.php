<?php


class SearchController extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('robtivitymodel');
		$this->load->model('robtivitycontentmodel');
		$this->load->model('technologymodel');
		$this->load->model('domainmodel');
		$this->load->model('levelmodel');

		if (!isset($this->session->userdata['site_lang'])) {
			$this->session->userdata['site_lang'] = "english";
			$this->session->userdata['id_lang'] = 1;
		}
		$this->lang->load('msg', $this->session->userdata['site_lang']);
		$this->lang->load('nav', $this->session->userdata['site_lang']);
		$this->lang->load('robtivies', $this->session->userdata['site_lang']);

	}

	function index()
	{
		if ( (!isset($this->session->userdata['logged_in'])) || ($this->session->userdata['logged_in'] != true) ) {
			$data['logged_in'] = false;
		} else {
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
		}

		$data['main_content'] = 'welcome';		
		$this->load->view('template', $data);
		
	}

	function getSearch()
	{
		$id_lang = $this->session->userdata['id_lang'];
		
		if ( (!isset($this->session->userdata['logged_in'])) || ($this->session->userdata['logged_in'] != true) ) {
			$data2['logged_in'] = false;
		} else {
			$data2['logged_in'] = $this->session->userdata['logged_in'];
			$data2['function'] = $this->session->userdata['function'];
		}

		//-----------------Technology-----------------
		$data['parrentTechnology'] = $this->technologymodel->getParrentTechlology($id_lang);
		$data['technology'] = $this->technologymodel->getTechnology($id_lang);

		//-----------------Domain-----------------
		$data['parrentDomain'] = $this->domainmodel->getParrentDomain($id_lang);
		$data['domain'] = $this->domainmodel->getDomain($id_lang);

		//-----------------Level-----------------
		$data['parrentLevel'] = $this->levelmodel->getParrentLevel($id_lang);
		$data['level'] = $this->levelmodel->getLevel($id_lang);
		
		$data2['data'] = $data;
		$data2['main_content'] = 'search';		
		$this->load->view('template', $data2);
	}

	function search()
	{
		$id_lang = $this->session->userdata['id_lang'];
		$this->load->library('form_validation');

			$pom = array(
				'keywords' => $_POST['keywords'],
				'id_lang' => $this->session->userdata['id_lang'],
			);

			if (isset($_POST['technology'])) {
				$pom['id_technology'] = $_POST['technology'];
			}

			if (isset($_POST['domain'])) {
				$pom['id_domain'] = $_POST['domain'];
			}

			if (isset($_POST['level'])) {
				$pom['id_level'] = $_POST['technology'];
			}

		$query = $this->robtivitymodel->searchRobtivies($pom);

		$data['results'] = $query;


		if ( (!isset($this->session->userdata['logged_in'])) || ($this->session->userdata['logged_in'] != true) ) {
			$data2['logged_in'] = false;
		} else {
			$data2['logged_in'] = $this->session->userdata['logged_in'];
			$data2['function'] = $this->session->userdata['function'];
		}

		//-----------------Technology-----------------
		$data['parrentTechnology'] = $this->technologymodel->getParrentTechlology($id_lang);
		$data['technology'] = $this->technologymodel->getTechnology($id_lang);

		//-----------------Domain-----------------
		$data['parrentDomain'] = $this->domainmodel->getParrentDomain($id_lang);
		$data['domain'] = $this->domainmodel->getDomain($id_lang);

		//-----------------Level-----------------
		$data['parrentLevel'] = $this->levelmodel->getParrentLevel($id_lang);
		$data['level'] = $this->levelmodel->getLevel($id_lang);

		
		$data2['data'] = $data;
		$data2['main_content'] = 'search_result';		
		$this->load->view('template', $data2);

		//print_r($data2);
		//redirect('/robtivityController/myrobtivies');
	}

}