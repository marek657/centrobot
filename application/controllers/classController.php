<?php


class ClassController extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('classmodel');
		$this->load->model('classfilesmodel');


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

	function myClasses()
	{
		$classes = $this->classmodel->getClassByTeacher($this->session->userdata['id']);
		$data['data'] = $classes;

		if ( (!isset($this->session->userdata['logged_in'])) || ($this->session->userdata['logged_in'] != true) ) {
			$data['logged_in'] = false;
		} else {
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
		}

		$data['main_content'] = 'my_classes';	


		$this->load->view('template', $data);
	}

	function createclass()
	{
		$id_lang = $this->session->userdata['id_lang'];
		
		if ( (!isset($this->session->userdata['logged_in'])) || ($this->session->userdata['logged_in'] != true) ) {
			$data['logged_in'] = false;
		} else {
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
		}

		$data['main_content'] = 'create_class';		
		$this->load->view('template', $data);
	}

	function addclass()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'required|trim|xss_clean|htmlspecialchars');

		if (($this->form_validation->run()))
		{
			$data = array(
				'name' => $_POST['name'],
				'content' => $_POST['content'],
				'id_teacher' => $this->session->userdata['id'],
			);
			
			$query = $this->classmodel->addClass($data);

		}

		if ( (!isset($this->session->userdata['logged_in'])) || ($this->session->userdata['logged_in'] != true) ) {
			$data['logged_in'] = false;
		} else {
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
		}

		redirect('/classController/myClasses');
	}

	function viewclass($id_class)
	{
		$class = $this->classmodel->getClass($id_class);

		//$data['data'] = $class;

		if ( (!isset($this->session->userdata['logged_in'])) || ($this->session->userdata['logged_in'] != true) ) {
			$data['logged_in'] = false;
			$data['data'] = $class;
			$data['main_content'] = 'view_class';
		} else {
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];

			if ( $class['0']->id_teacher !=  $this->session->userdata['id']) {
				$data['data'] = $class;
				$data['main_content'] = 'view_class';
			} else {
				$files = $this->classfilesmodel->getFiles($id_class);
				
				$data2['class'] = $class;
				$data2['files'] = $files;
				
				$data['data'] = $data2;
				$data['main_content'] = 'view_teacher_class';
			}
		}

		$this->load->view('template', $data);
	}

	function sendfile()
	{
		//file upload

		$pathtoDB ='./files/classes/' . $_POST['id']; // create a folder with unique name
		 
		if(!file_exists($pathtoDB)){
		    @mkdir($pathtoDB,0777,TRUE);
		}

		//configure upload
		$config['upload_path'] = $pathtoDB;
		$config['allowed_types'] = '*';
		$config['max_size'] = '10000';
		$config['max_width'] = '0';
		$config['max_height'] = '0';

		$this->load->library('upload', $config);

		if ( $this->upload->do_upload())
		{
			$pom = $this->upload->data();
			$data['id_class'] = $_POST['id'];
			$data['name'] = $_POST['name'];
			$data['filename'] = $pom['file_name'];
			$data['path'] = $pom['full_path'];
			$data['link'] = str_replace("/var/www", "", $pom['full_path']);
			$succ = $this->classfilesmodel->addFile($data);
			if ( (!isset($this->session->userdata['logged_in'])) || ($this->session->userdata['logged_in'] != true) ) {
				$data['logged_in'] = false;
			} else {
				$data['logged_in'] = $this->session->userdata['logged_in'];
				$data['function'] = $this->session->userdata['function'];
			}
			
			if ($succ != true) {
				$class = $this->classmodel->getClass($_POST['id']);
				$data['data'] = $class;
				$data['warningmessage'] = $this->lang->line("error_something_wrong");
				$data['main_content'] = 'view_class';
			} else {
				$class = $this->classmodel->getClass($_POST['id']);
				$data['data'] = $class;
				$data['message'] = $this->lang->line("msg_file_upload_succ");
				$data['main_content'] = 'view_class';
			}
		} else {
			$class = $this->classmodel->getClass($_POST['id']);
			$data['data'] = $class;
			$data['warningmessage'] = $this->lang->line("error_something_wrong");
			$data['main_content'] = 'view_class';
		}
		$this->load->view('template', $data);

		//redirect($_SERVER['HTTP_REFERER']);
	}

	function deletefile($id)
	{
		$path = $this->classfilesmodel->getFilePath($id);
		$succ = unlink($path['0']->path);
		$this->classfilesmodel->deleteFile($id);
		redirect($_SERVER['HTTP_REFERER']);
	}

	function editclass($id_class)
	{
		if ( (!isset($this->session->userdata['logged_in'])) || ($this->session->userdata['logged_in'] != true) ) {
			$data['logged_in'] = false;
		} else {
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
		}

		$class = $this->classmodel->getClass($id_class);

		$data['data'] = $class;
		$data['main_content'] = 'edit_class';
		$this->load->view('template', $data);
	}

	function updateclass()
	{
		$this->load->library('form_validation');

		$data['name'] = $_POST['name'];
		$data['content'] = $_POST['content'];

		$query = $this->classmodel->updateClass($_POST['id'], $data);

		if ($query != true) {
			$data2['warningmessage'] = $this->lang->line("error_something_wrong");
		} else {
			$data2['message'] = $this->lang->line("msg_update_robtivity");
		}

		if ( (!isset($this->session->userdata['logged_in'])) || ($this->session->userdata['logged_in'] != true) ) {
			$data2['logged_in'] = false;
		} else {
			$data2['logged_in'] = $this->session->userdata['logged_in'];
			$data2['function'] = $this->session->userdata['function'];
		}

			
		$data2['main_content'] = 'my_classes';	
		$classes = $this->classmodel->getClassByTeacher($this->session->userdata['id']);
		$data2['data'] = $classes;


		$this->load->view('template', $data2);
	}

	function deleteClass($id)
	{
		$succ = $this->classmodel->deleteClass($id);
		$pathtoDB ='./files/classes/' . $id;
		system("rm -rf ".escapeshellarg($pathtoDB));
		redirect($_SERVER['HTTP_REFERER']);
	}

}