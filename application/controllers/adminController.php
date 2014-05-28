<?php


class AdminController extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('usermodel');
		$this->load->model('robtivitymodel');
		$this->load->model('robtiviesauthormodel');
		$this->load->model('domainmodel');
		$this->load->model('levelmodel');
		$this->load->model('technologymodel');


		if (!isset($this->session->userdata['site_lang'])) {
			$this->session->userdata['site_lang'] = "english";
			$this->session->userdata['id_lang'] = 1;
		}
		$this->lang->load('msg', $this->session->userdata['site_lang']);
		$this->lang->load('nav', $this->session->userdata['site_lang']);
		$this->lang->load('robtivies', $this->session->userdata['site_lang']);
		$this->lang->load('loginform', $this->session->userdata['site_lang']);

		if (!isset($this->session->userdata['function']) || ($this->session->userdata['function'] != 1) ) {
			if (isset($this->session->userdata['logged_in'])) {
				$data['logged_in'] = $this->session->userdata['logged_in'];
				$data['function'] = $this->session->userdata['function'];
			} else {
				$data['logged_in'] = false;
			}
			$data['warningmessage'] = $this->lang->line("error_permissions");
			$data['main_content'] = 'welcome';
			$this->load->view('template', $data);
		}
	}

	function index()
	{		

		$data['logged_in'] = $this->session->userdata['logged_in'];
		$data['function'] = $this->session->userdata['function'];
		$data['main_content'] = 'welcome';
		$this->load->view('template', $data);
		
	}

	function getNotApprovedUsers()
	{
		$data['data'] = $this->usermodel->getWaitingUsers();
		$data['logged_in'] = $this->session->userdata['logged_in'];
		$data['function'] = $this->session->userdata['function'];
		$data['main_content'] = 'approve_users';
		$this->load->view('template', $data);
	}

	function approveRegistration($id_user)
	{
		$user = $this->usermodel->getUser($id_user);
		$data = array(
			'function' => 2,
			'name' => $user['0']->name,
			'lastname' => $user['0']->lastname,
			'email' => $user['0']->email,
			'password' => $user['0']->password,
			);
		$succ = $this->usermodel->updateUser($id_user, $data);
		
		if ($succ == true) {
			$data['data'] = $this->usermodel->getWaitingUsers();
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
			$data['message'] = $this->lang->line("msg_registration_approved");
			$data['main_content'] = 'approve_users';
			$this->load->view('template', $data);
		} else {
			$data['data'] = $this->usermodel->getWaitingUsers();
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
			$data['warningmessage'] = $this->lang->line("error_something_wrong");
			$data['main_content'] = 'approve_users';
			$this->load->view('template', $data);
		}
	}

	function disapproveRegistration($id_user)
	{
		$succ = $this->usermodel->deleteUser($id_user);
		
		if ($succ == true) {
			$data['data'] = $this->usermodel->getWaitingUsers();
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
			$data['message'] = $this->lang->line("msg_registration_disapproved");
			$data['main_content'] = 'approve_users';
			$this->load->view('template', $data);
		} else {
			$data['data'] = $this->usermodel->getWaitingUsers();
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
			$data['warningmessage'] = $this->lang->line("error_something_wrong");
			$data['main_content'] = 'approve_users';
			$this->load->view('template', $data);
		}
	}

	function getRobtivies()
	{
		$data['data'] = $this->robtivitymodel->getRobtivies($this->session->userdata['id_lang']);
		$data['logged_in'] = $this->session->userdata['logged_in'];
		$data['function'] = $this->session->userdata['function'];
		$data['main_content'] = 'all_robtivies';
		$this->load->view('template', $data);
	}

	function removeAuthor($id_robtivity, $id_author)
	{
		$author = $this->robtiviesauthormodel->deleteAuthor($id_robtivity, $id_author);
		redirect($_SERVER['HTTP_REFERER']);
	}

	function getUsers()
	{
		$data['data'] = $this->usermodel->getUsers();
		$data['logged_in'] = $this->session->userdata['logged_in'];
		$data['function'] = $this->session->userdata['function'];
		$data['main_content'] = 'all_users';
		$this->load->view('template', $data);
	}

	function promoteUser($id_user)
	{
		$user = $this->usermodel->getUser($id_user);
		$data = array(
			'function' => 1,
			'name' => $user['0']->name,
			'lastname' => $user['0']->lastname,
			'email' => $user['0']->email,
			'password' => $user['0']->password,
			);
		$succ = $this->usermodel->updateUser($id_user, $data);
		
		if ($succ == true) {
			$data['data'] = $this->usermodel->getUsers();
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
			$data['message'] = $this->lang->line("msg_promote_succ");
			$data['main_content'] = 'all_users';
			$this->load->view('template', $data);
		} else {
			$data['data'] = $this->usermodel->getUsers();
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
			$data['warningmessage'] = $this->lang->line("error_something_wrong");
			$data['main_content'] = 'all_users';
			$this->load->view('template', $data);
		}
	}

	function removeUser($id_user)
	{
		$succ = $this->usermodel->deleteUser($id_user);
		
		if ($succ == true) {
			$data['data'] = $this->usermodel->getUsers();
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
			$data['message'] = $this->lang->line("msg_registration_disapproved");
			$data['main_content'] = 'all_users';
			$this->load->view('template', $data);
		} else {
			$data['data'] = $this->usermodel->getUsers();
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
			$data['warningmessage'] = $this->lang->line("error_something_wrong");
			$data['main_content'] = 'all_users';
			$this->load->view('template', $data);
		}
	}

	function getDomains()
	{
		$data['data'] = $this->domainmodel->getDomains();
		$data['logged_in'] = $this->session->userdata['logged_in'];
		$data['function'] = $this->session->userdata['function'];
		$data['main_content'] = 'edit_domains';
		$this->load->view('template', $data);
	}

	function updateDomain($id_domain, $id_lang)
	{
		$data = array(
			'id_domain' => $id_domain,
			'id_lang' => $id_lang,
			'domain_name' => $_POST['domain_name'],
		 );

		$succ = $this->domainmodel->updateDomain($id_domain, $id_lang, $data);
		redirect($_SERVER['HTTP_REFERER']);
	}

	function getTechnologys()
	{
		$data['data'] = $this->technologymodel->getTechnologys();
		$data['logged_in'] = $this->session->userdata['logged_in'];
		$data['function'] = $this->session->userdata['function'];
		$data['main_content'] = 'edit_technology';
		$this->load->view('template', $data);
	}

	function updateTechnology($id_technology, $id_lang)
	{
		$data = array(
			'id_technology' => $id_technology,
			'id_lang' => $id_lang,
			'technology_name' => $_POST['technology_name'],
		 );

		$succ = $this->technologymodel->updateTechnology($id_technology, $id_lang, $data);
		redirect($_SERVER['HTTP_REFERER']);
	}

	function getLevels()
	{
		$data['data'] = $this->levelmodel->getLevels();
		$data['logged_in'] = $this->session->userdata['logged_in'];
		$data['function'] = $this->session->userdata['function'];
		$data['main_content'] = 'edit_levels';
		$this->load->view('template', $data);
	}

	function updateLevel($id_level, $id_lang)
	{
		$data = array(
			'id_level' => $id_level,
			'id_lang' => $id_lang,
			'level_name' => $_POST['level_name'],
		 );

		$succ = $this->levelmodel->updateLevel($id_level, $id_lang, $data);
		redirect($_SERVER['HTTP_REFERER']);
	}

}