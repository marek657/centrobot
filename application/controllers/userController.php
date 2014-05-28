<?php


class UserController extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('usermodel');
		if (!isset($this->session->userdata['site_lang'])) {
			$this->session->userdata['site_lang'] = "english";
			$this->session->userdata['id_lang'] = 1;
		}
		$this->lang->load('msg', $this->session->userdata['site_lang']);
		$this->lang->load('nav', $this->session->userdata['site_lang']);
		$this->lang->load('loginform', $this->session->userdata['site_lang']);
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

	function setlogin()
	{
		if ( (!isset($this->session->userdata['logged_in'])) || ($this->session->userdata['logged_in'] != true) ) {
			$data['logged_in'] = false;
			$data['main_content'] = 'login';
			$this->load->view('template', $data);
		} else {
			$data['warningmessage'] = $this->lang->line("error_logged_already");
			$data['logged_in'] = true;
			$data['function'] = $this->session->userdata['function'];
			$data['main_content'] = 'welcome';
			$this->load->view('template', $data);
		}
		
	}

	function registration()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required|trim|xss_clean|htmlspecialchars');
		$this->form_validation->set_rules('lastname', 'Lastname','required|trim|xss_clean|htmlspecialchars');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|htmlspecialchars|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean|htmlspecialchars|min_length[4]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'required|trim|xss_clean|htmlspecialchars|matches[password]');

		if (($this->form_validation->run()))
		{
			$query = $this->usermodel->getByEmail($_POST['email']);
			if ( $query == false )
			{
				$data = array(
					'name' => $_POST['name'],
					'lastname' => $_POST['lastname'],
					'email' => $_POST['email'],
					'password' => sha1($_POST['password']),
					//'function' => 3,
				 );

				$query = $this->usermodel->addUser($data);
				if ( $query == false )
				{
					$data['warningmessage'] = $this->lang->line("error_something_wrong");
					$data['logged_in'] = false;
					$data['main_content'] = 'login';
					$this->load->view('template', $data);
				} 
				else 
				{
					$data['logged_in'] = false;
					$data['message'] = $this->lang->line("msg_signup_succasful");
					$data['main_content'] = 'welcome';
					$this->load->view('template', $data);
				}
			} 
			else 
			{
				$data['warningmessage'] = $this->lang->line("error_email");
				$data['logged_in'] = false;
				$data['main_content'] = 'login';
				$this->load->view('template', $data);
			}
		}
		else
		{
			$data['warningmessage'] = $this->lang->line("error_wrong_data");
			$data['logged_in'] = false;
			$data['main_content'] = 'login';
			$this->load->view('template', $data);	
		}
	}

	function login()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'email', 'required|trim|xss_clean|htmlspecialchars');
		$this->form_validation->set_rules('password', 'password', 'required|trim|xss_clean|htmlspecialchars');

		if ($this->form_validation->run())
		{
			$query = $this->usermodel->checkPassword(sha1($_POST['password']), $_POST['email']);

			if ($query)
			{
				$query2 = $this->usermodel->checkPermission($_POST['email']);
				if ($query2 != true) {
					$data['warningmessage'] = $this->lang->line("error_login_permission");
					$data['logged_in'] = false;
					$data['main_content'] = 'login';
					$this->load->view('template', $data);
				} else {
					$data = $this->usermodel->getByEmail($_POST['email']);
					$data['logged_in'] = true;
					$data['function'] = $data['function'];
					$this->session->set_userdata($data);
					$data['main_content'] = 'welcome';
					$this->load->view('template', $data);
				}
			}
			else
			{
				$data['warningmessage'] = $this->lang->line("error_incorrect_login");
				$data['logged_in'] = false;
				$data['main_content'] = 'login';
				$this->load->view('template', $data);
			}
		} else {
			$data['warningmessage'] = $this->lang->line("error_incorrect_login");
			$data['logged_in'] = false;
			$data['main_content'] = 'login';
			$this->load->view('template', $data);
		}	
	}

	function logout()
	{
		$this->session->sess_destroy();
		$data['logged_in'] = false;
		$data['message'] = $this->lang->line("msg_logout_succasful");
		$data['main_content'] = 'welcome';
		$this->load->view('template', $data);
	}

	function changelang($lang, $id_lang)
	{
		$this->session->set_userdata('site_lang', $lang);
		$this->session->set_userdata('id_lang', $id_lang);

		redirect($_SERVER['HTTP_REFERER']);

	}
}