<?php


class RobtivityController extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('robtivitymodel');
		$this->load->model('usermodel');
		$this->load->model('robtivitycontentmodel');
		$this->load->model('technologymodel');
		$this->load->model('domainmodel');
		$this->load->model('levelmodel');
		$this->load->model('robtivityfilesmodel');
		$this->load->model('robtiviesauthormodel');
		$this->load->model('rankmodel');

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

	function createrobtivity()
	{
		$id_lang = $this->session->userdata['id_lang'];
		
		if ( (!isset($this->session->userdata['logged_in'])) || ($this->session->userdata['logged_in'] != true) ) {
			$data['logged_in'] = false;
			$data['warningmessage'] = $this->lang->line("error_permissions");
			$data['main_content'] = 'welcome';
			$this->load->view('template', $data);

		} else {
			$data2['logged_in'] = $this->session->userdata['logged_in'];
			$data2['function'] = $this->session->userdata['function'];
	
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
			$data2['main_content'] = 'create_robtivity';		
			$this->load->view('template', $data2);
		}
	}

	function addrobtivity()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('workname', 'workname', 'required|trim|xss_clean|htmlspecialchars');

		if (($this->form_validation->run()))
		{
			$parrentTechnology = $this->technologymodel->getParrentTechnologyById($_POST['technology']);	
			$parrentDomain = $this->domainmodel->getParrentDomainById($_POST['domain']);
			$parrentLevel = $this->levelmodel->getParrentLevelById($_POST['level']);

			$data = array(
				'workname' => $_POST['workname'],
				'id_technology' => $_POST['technology'],
				'id_technology_parrent' => $parrentTechnology['0']->id_parrent,
				'id_domain' => $_POST['domain'],
				'id_domain_parrent' => $parrentDomain['0']->id_parrent,
				'id_level' => $_POST['level'],
				'id_level_parrent' => $parrentLevel['0']->id_parrent,
			);
			$query = $this->robtivitymodel->addRobtivity($data);
			print_r($query);

			$data2 = array(
				'id_author' => $this->session->userdata['id'],
				'id_robtivity' => $query,
			);
			$query2 = $this->robtiviesauthormodel->addAuthor($data2);

			$data3 = array(
				'id_robtivity' => $query,
				'total_value' => 0,
				'total_votes' => 0,
			);
			$query3 = $this->rankmodel->addNew($data3);

		}

		if ( (!isset($this->session->userdata['logged_in'])) || ($this->session->userdata['logged_in'] != true) ) {
			$data['logged_in'] = false;
		} else {
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
		}

		redirect('/robtivityController/myrobtivies');
	}

	function myrobtivies()
	{
		if ( (!isset($this->session->userdata['logged_in'])) || ($this->session->userdata['logged_in'] != true) ) {
			$data['logged_in'] = false;
			$data['warningmessage'] = $this->lang->line("error_permissions");
			$data['main_content'] = 'welcome';
			$this->load->view('template', $data);
		} else {
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
			$robtivies = $this->robtivitymodel->getRobtiviesByAutor($this->session->userdata['id'], $this->session->userdata['id_lang']);
			$data['data'] = $robtivies;
			$data['main_content'] = 'myrobtivies';	
			$this->load->view('template', $data);
		}
	}

	function editrobtivity($id_robtivity)
	{
		
		if ( (!isset($this->session->userdata['logged_in'])) || ($this->session->userdata['logged_in'] != true) ) {
			$data['logged_in'] = false;
			$data['warningmessage'] = $this->lang->line("error_permissions");
			$data['main_content'] = 'welcome';
			$this->load->view('template', $data);

		}
		elseif ( ($this->session->userdata['function'] != 1) && ($this->robtiviesauthormodel->checkAuthor($id_robtivity, $this->session->userdata['id']) != true)) {
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
			$data['warningmessage'] = $this->lang->line("error_permissions");
			$data['main_content'] = 'welcome';
			$this->load->view('template', $data);
		} else {

			$id_lang = $this->session->userdata['id_lang'];

			$robtivity = $this->robtivitycontentmodel->getRobtivity($id_robtivity, $id_lang);

			if ($robtivity == false) {
				$data['id_robtivity'] = $id_robtivity;
				$data['id_lang'] = $id_lang;
				$data['name'] = '';
				$data['keywords'] = '';
				$data['content'] = '';
				$data['required_knowledge'] = '';
				$data['time_consumption'] = '';
				$data['enviroment'] = '';
				$data['equipment'] = '';
				$data['presentations'] = '';
				$data['papers'] = '';
				$data['teacher_description'] = '';
				$data['student_description'] = '';
				$data['sample_solution'] = '';
				$data['multimedia_artifacts'] = '';
				$data['construction_manual'] = '';
				$data['components_desc'] = '';
				$data['faq'] = '';
				$data['robtivity_resources'] = '';
				$data['general_resources'] = '';
				
				$this->robtivitycontentmodel->addRobtivity($data);
				$robtivity = $this->robtivitycontentmodel->getRobtivity($id_robtivity, $id_lang);
			}

			$robtivity['pictures_files'] = $this->robtivityfilesmodel->getFiles($id_robtivity, 'pictures');
			$robtivity['multimedia_files'] = $this->robtivityfilesmodel->getFiles($id_robtivity, 'multimedia_artifacts');
			$robtivity['presentations_files'] = $this->robtivityfilesmodel->getFiles($id_robtivity, 'presentations');
			$robtivity['papers_files'] = $this->robtivityfilesmodel->getFiles($id_robtivity, 'papers');
			$robtivity['sample_solution_files'] = $this->robtivityfilesmodel->getFiles($id_robtivity, 'sample_solution');
			$robtivity['authors'] = $this->robtiviesauthormodel->getRobtivityAuthors($id_robtivity);
			//print_r($robtivity);
			
			$data['data'] = $robtivity;
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
				
			if ($data['function'] == 1) {
				$data['main_content'] = 'make_admin_robtivity';
				$this->load->view('template', $data);
			} else {
				$data['main_content'] = 'make_robtivity';
				$this->load->view('template', $data);
			}
		}
	}

	function updaterobtivity()
	{

		$this->load->library('form_validation');

		$data['name'] = $_POST['Rname'];
		$data['content'] = $_POST['content'];
		$data['keywords'] = $_POST['keywords'];
		$data['required_knowledge'] = $_POST['required_knowledge'];
		$data['time_consumption'] = $_POST['time_consumption'];
		$data['enviroment'] = $_POST['enviroment'];
		$data['equipment'] = $_POST['equipment'];
		$data['teacher_description'] = $_POST['teacher_description'];
		$data['student_description'] = $_POST['student_description'];
		$data['sample_solution'] = $_POST['sample_solution'];
		$data['multimedia_artifacts'] = $_POST['multimedia_artifacts'];
		$data['construction_manual'] = $_POST['construction_manual'];
		$data['components_desc'] = $_POST['components_desc'];
		$data['faq'] = $_POST['faq'];
		$data['robtivity_resources'] = $_POST['robtivity_resources'];
		$data['general_resources'] = $_POST['general_resources'];
		$data['publication'] = $_POST['publication'];


		//file upload

		$pathtoDB ='./files/robtivies/' . $_POST['id']; // create a folder with unique name
		 
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

		if($this->upload->do_multi_upload("pictures")){
			$files = $this->upload->get_multi_upload_data();
			foreach ($files as $key => $value) {
				$data_pictures['id_robtivity'] = $_POST['id'];
				$data_pictures['name'] = $value['file_name'];
				$data_pictures['path'] = $value['full_path'];
				$data_pictures['link'] = str_replace("/var/www", "", $value['full_path']);
				$data_pictures['type'] = "pictures";
				$data_pictures['desc'] = "";
				$this->robtivityfilesmodel->addFile($data_pictures);
			}
		} else {
			print_r("error");
		}

		if($this->upload->do_multi_upload("files_presentations")){
			$files = $this->upload->get_multi_upload_data();
			foreach ($files as $key => $value) {
				$data_pictures['id_robtivity'] = $_POST['id'];
				$data_pictures['name'] = $value['file_name'];
				$data_pictures['path'] = $value['full_path'];
				$data_pictures['link'] = str_replace("/var/www", "", $value['full_path']);
				$data_pictures['type'] = "presentations";
				$data_pictures['desc'] = $_POST['files_presentations_description'];
				$this->robtivityfilesmodel->addFile($data_pictures);
			}
		} else {
			print_r("error");
		}

		if($this->upload->do_multi_upload("files_papers")){
			$files = $this->upload->get_multi_upload_data();
			foreach ($files as $key => $value) {
				$data_pictures['id_robtivity'] = $_POST['id'];
				$data_pictures['name'] = $value['file_name'];
				$data_pictures['path'] = $value['full_path'];
				$data_pictures['link'] = str_replace("/var/www", "", $value['full_path']);
				$data_pictures['type'] = "papers";
				$data_pictures['desc'] = $_POST['files_papers_description'];
				$this->robtivityfilesmodel->addFile($data_pictures);
			}
		} else {
			print_r("error");
		}

		if($this->upload->do_multi_upload("files_multimedia_artifacts")){
			$files = $this->upload->get_multi_upload_data();
			foreach ($files as $key => $value) {
				$data_pictures['id_robtivity'] = $_POST['id'];
				$data_pictures['name'] = $value['file_name'];
				$data_pictures['path'] = $value['full_path'];
				$data_pictures['link'] = str_replace("/var/www", "", $value['full_path']);
				$data_pictures['type'] = "multimedia_artifacts";
				$data_pictures['desc'] = $_POST['files_multimedia_artifacts_description'];
				$this->robtivityfilesmodel->addFile($data_pictures);
			}
		} else {
			print_r("error");
		}

		if($this->upload->do_multi_upload("files_sample_solution")){
			$files = $this->upload->get_multi_upload_data();
			foreach ($files as $key => $value) {
				$data_pictures['id_robtivity'] = $_POST['id'];
				$data_pictures['name'] = $value['file_name'];
				$data_pictures['path'] = $value['full_path'];
				$data_pictures['link'] = str_replace("/var/www", "", $value['full_path']);
				$data_pictures['type'] = "sample_solution";
				$data_pictures['desc'] = $_POST['files_sample_solution_description'];
				$this->robtivityfilesmodel->addFile($data_pictures);
			}
		} else {
			print_r("error");
		}


		$query = $this->robtivitycontentmodel->updateRobtivity($_POST['id'], $_POST['id_lang'], $data);
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

      	//$this->myrobtivies();
      	//$data2['main_content'] = 'myrobtivies';	
		//$robtivies = $this->robtivitymodel->getRobtiviesByAutor($this->session->userdata['id']);
		//$data2['data'] = $robtivies;
		redirect($_SERVER['HTTP_REFERER']);

		//$this->load->view('template', $data2);
	}

	function viewrobtivity($id_robtivity, $id_lang)
	{
		$robtivity = $this->robtivitycontentmodel->getRobtivity($id_robtivity, $id_lang);

		if ($robtivity == false) {
			$data['id_robtivity'] = $id_robtivity;
			$data['id_lang'] = $id_lang;
			$data['name'] = '';
			$data['content'] = '';
			$data['required_knowledge'] = '';
			$data['time_consumption'] = '';
			$data['enviroment'] = '';
			$data['equipment'] = '';
			$data['presentations'] = '';
			$data['papers'] = '';
			$data['teacher_description'] = '';
			$data['student_description'] = '';
			$data['sample_solution'] = '';
			$data['multimedia_artifacts'] = '';
			$data['construction_manual'] = '';
			$data['components_desc'] = '';
			$data['faq'] = '';
			$data['robtivity_resources'] = '';
			$data['general_resources'] = '';
			
			$this->robtivitycontentmodel->addRobtivity($data);
			$robtivity = $this->robtivitycontentmodel->getRobtivity($id_robtivity, $id_lang);
		}
		
		$robtivity['multimedia_files'] = $this->robtivityfilesmodel->getFiles($id_robtivity, 'multimedia_artifacts');
		$robtivity['presentations_files'] = $this->robtivityfilesmodel->getFiles($id_robtivity, 'presentations');
		$robtivity['papers_files'] = $this->robtivityfilesmodel->getFiles($id_robtivity, 'papers');
		$robtivity['sample_solution_files'] = $this->robtivityfilesmodel->getFiles($id_robtivity, 'sample_solution');

		$robtivity['robtivity_rank'] = $this->rankmodel->getRank($id_robtivity);
		if (isset($this->session->userdata['id'])) {
			$robtivity['user_robtivity_rank'] = $this->rankmodel->checkUserRank($this->session->userdata['id'], $id_robtivity);
		} else {
			//$robtivity['user_robtivity_rank'] = false;
		}		

		$data['data'] = $robtivity;

		if ( (!isset($this->session->userdata['logged_in'])) || ($this->session->userdata['logged_in'] != true) ) {
			$data['logged_in'] = false;
			$data['main_content'] = 'view_student_robtivity';

		} else {
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
			$data['main_content'] = 'view_robtivity';
		}

			


		$this->load->view('template', $data);
	}

	function deletefile($id)
	{
		$path = $this->robtivityfilesmodel->getFilePath($id);
		$succ = unlink($path['0']->path);
		$this->robtivityfilesmodel->deleteFile($id);
		redirect($_SERVER['HTTP_REFERER']);
	}

	function updaterank()
	{
		$this->load->library('form_validation');

		$rank = $this->rankmodel->getRank($_POST['id']);
		$check = $this->rankmodel->checkUserRank($this->session->userdata['id'], $_POST['id']);
		
		if ( $check != false ) {
						
			$data = array(
				'id' => $rank['0']->id,
				'id_robtivity' => $_POST['id'],
				'total_value' => $rank['0']->total_value + $_POST['rating'] - $check['0']->rank,
				'total_votes' => $rank['0']->total_votes,

			);
			$query = $this->rankmodel->updaterank($data);

			$data2 = array(
				'id' => $check['0']->id,
				'id_robtivity' => $_POST['id'],
				'id_user' => $this->session->userdata['id'],
				'rank' => $_POST['rating'],
			);
			$query2 = $this->rankmodel->updateUserRank($data2);

		} else {
			$data = array(
				'id' => $rank['0']->id,
				'id_robtivity' => $_POST['id'],
				'total_value' => $rank['0']->total_value + $_POST['rating'],
				'total_votes' => $rank['0']->total_votes + 1,

			);
			$query = $this->rankmodel->updaterank($data);

			$data2 = array(
				'id_robtivity' => $_POST['id'],
				'id_user' => $this->session->userdata['id'],
				'rank' => $_POST['rating'],
			);
			$query2 = $this->rankmodel->addUserRank($data2);
		}
		
		redirect($_SERVER['HTTP_REFERER']);
		
	}

	function download($id_robtivity, $id_lang)
	{
		if(!file_exists('./files/temp/')){
		    @mkdir('./files/temp/',0777,TRUE);
		}

		$robtivity = $this->robtivitycontentmodel->getRobtivity($id_robtivity, $id_lang);
		$robtivity['multimedia_files'] = $this->robtivityfilesmodel->getFiles($id_robtivity, 'multimedia_artifacts');
		$pom3 = "";
		foreach ($robtivity['multimedia_files'] as $key => $value) {
			$pom3 .= $value->name . " - " . $value->desc . "<br />";
		}
		$robtivity['presentations_files'] = $this->robtivityfilesmodel->getFiles($id_robtivity, 'presentations');
		$pom0 = "";
		foreach ($robtivity['presentations_files'] as $key => $value) {
			$pom0 .= $value->name . " - " . $value->desc . "<br />";
		}
		$robtivity['papers_files'] = $this->robtivityfilesmodel->getFiles($id_robtivity, 'papers');
		$pom1 = "";
		foreach ($robtivity['papers_files'] as $key => $value) {
			$pom1 .= $value->name . " - " . $value->desc . "<br />";
		}
		$robtivity['sample_solution_files'] = $this->robtivityfilesmodel->getFiles($id_robtivity, 'sample_solution');
		$pom2 = "";
		foreach ($robtivity['sample_solution_files'] as $key => $value) {
			$pom2 .= $value->name . " - " . $value->desc . "<br />";
		}

		require_once "dompdf/dompdf_config.inc.php";
		 
		$dompdf = new DOMPDF();

		$pdf = "<h1>" . $robtivity['0']->name . "</h1>"
				. "<h3>Content</h3>" . $robtivity['0']->content
				. "<h3>Required knowledge</h3>" . $robtivity['0']->required_knowledge
				. "<h3>Time consumption</h3>" . $robtivity['0']->time_consumption
				. "<h3>Enviroment</h3>" . $robtivity['0']->enviroment
				. "<h3>Equipment</h3>" . $robtivity['0']->equipment 
				. "<h3>Presentation</h3>" . $pom0
				. "<h3>Papers</h3>" . $pom1
				. "<h3>Teacher description</h3>" . $robtivity['0']->teacher_description 
				. "<h3>Student description</h3>" . $robtivity['0']->student_description 
				. "<h3>Sample solution</h3>" . $robtivity['0']->sample_solution . $pom2
				. "<h3>Multimedia</h3>" . $robtivity['0']->multimedia_artifacts . $pom3
				. "<h3>Construction manual</h3>" . $robtivity['0']->construction_manual 
				. "<h3>Components description</h3>" . $robtivity['0']->components_desc 
				. "<h3>FAQ</h3>" . $robtivity['0']->faq 
				. "<h3>Robtivity resources</h3>" . $robtivity['0']->robtivity_resources 
				. "<h3>General resources</h3>" . $robtivity['0']->general_resources 
				;
		 
		$dompdf->load_html($pdf);
		$dompdf->render();
		 
		//$dompdf->stream( $robtivity['0']->name . ".pdf" );
		$output = $dompdf->output();
		file_put_contents("./files/temp/" . $robtivity['0']->name . ".pdf", $output);


		$zip = new ZipArchive();
		$zip->open('./files/temp/'. $robtivity['0']->name . '.zip', ZipArchive::CREATE);

		$zip->addFile('./files/temp/' . $robtivity['0']->name . '.pdf', $robtivity['0']->name . '.pdf');

		foreach ($robtivity['multimedia_files'] as $key => $value) {
			$zip->addFile( $value->path, '/multimedia/' . $value->name);
		}

		foreach ($robtivity['presentations_files'] as $key => $value) {
			$zip->addFile( $value->path, '/presentations/' . $value->name);
		}
		foreach ($robtivity['papers_files'] as $key => $value) {
			$zip->addFile( $value->path, '/papers/' . $value->name);
		}
		foreach ($robtivity['sample_solution_files'] as $key => $value) {
			$zip->addFile( $value->path, '/sample solution/' . $value->name);
		}

		$zip->close();

		$file = './files/temp/'. $robtivity['0']->name . '.zip';

		if (file_exists($file)) {
		    header('Content-Description: File Transfer');
		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename=robtivity.zip');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize($file));
		    ob_clean();
		    flush();
		    readfile($file);
		    exit;
		}
		redirect($_SERVER['HTTP_REFERER']);

	}

	function addAuthor()
	{
		$data['id_robtivity'] = $_POST['id'];
		$pom = $this->usermodel->getByEmail($_POST['email']);
		$data['id_author'] = $pom['id'];

		if ($data['id_author'] == "") {

			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
			$robtivies = $this->robtivitymodel->getRobtiviesByAutor($this->session->userdata['id'], $this->session->userdata['id_lang']);
			$data['data'] = $robtivies;
			$data['warningmessage'] = $this->lang->line("error_wrong_email");
			$data['main_content'] = 'myrobtivies';			
		} else {
			$check = $this->robtiviesauthormodel->checkAuthor($data['id_robtivity'], $data['id_author']);
			if ($check == TRUE) {
				$data['logged_in'] = $this->session->userdata['logged_in'];
				$data['function'] = $this->session->userdata['function'];
				$robtivies = $this->robtivitymodel->getRobtiviesByAutor($this->session->userdata['id'], $this->session->userdata['id_lang']);
				$data['data'] = $robtivies;
				$data['warningmessage'] = $this->lang->line("error_already_author");
				$data['main_content'] = 'myrobtivies';
			} else {
				$query = $this->robtiviesauthormodel->addAuthor($data);

				if ($query != true) {
					$data['logged_in'] = $this->session->userdata['logged_in'];
					$data['function'] = $this->session->userdata['function'];
					$robtivies = $this->robtivitymodel->getRobtiviesByAutor($this->session->userdata['id'], $this->session->userdata['id_lang']);
					$data['data'] = $robtivies;
					$data['warningmessage'] = $this->lang->line("error_something_wrong");
					$data['main_content'] = 'myrobtivies';
				} else {
					$data['logged_in'] = $this->session->userdata['logged_in'];
					$data['function'] = $this->session->userdata['function'];
					$robtivies = $this->robtivitymodel->getRobtiviesByAutor($this->session->userdata['id'], $this->session->userdata['id_lang']);
					$data['data'] = $robtivies;
					$data['message'] = $this->lang->line("msg_add_author_succ");
					$data['main_content'] = 'myrobtivies';	
				}
			}
		}
		$this->load->view('template', $data);
	}

	function addtechnologyform()
	{
		if ( (!isset($this->session->userdata['logged_in'])) || ($this->session->userdata['logged_in'] != true) ) {
			$data['logged_in'] = false;
			$data['warningmessage'] = $this->lang->line("error_permissions");
			$data['main_content'] = 'welcome';
			$this->load->view('template', $data);
		} else {
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
			$data['main_content'] = 'add_technology';
			$pom['languages'] = $this->robtivitymodel->getLanguages();
			$pom['technology'] = $this->technologymodel->getParrentTechlology($this->session->userdata['id_lang']);
			$data['data'] = $pom;
			$this->load->view('template', $data);
		}	
	}

	function addTechnology()
	{
		$pom = $this->robtivitymodel->getLanguages();

		$this->load->library('form_validation');
		foreach ($pom as $key => $value) {
			$this->form_validation->set_rules($value->id, '', 'required|trim|xss_clean|htmlspecialchars');
		}
		
		if ($this->form_validation->run())
		{
			$data['id_parrent'] = $_POST['id_parrent'];
			$idtechnology = $this->technologymodel->addTechnology($data);

			$counter = 1;
			foreach ($pom as $key => $value) {
				$names[$counter]['id_technology'] = $idtechnology;
				$names[$counter]['id_lang'] = $value->id;
				$names[$counter]['technology_name'] = $_POST[$value->id];
				$counter = $counter + 1;
			}

			$succ = $this->technologymodel->addTechnologyNames($names);
			if ($succ != false) {
				$data2['logged_in'] = $this->session->userdata['logged_in'];
				$data2['function'] = $this->session->userdata['function'];
				$id_lang = $this->session->userdata['id_lang'];
	
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
				$data2['main_content'] = 'create_robtivity';
				$data2['message'] = $this->lang->line('msg_add_technology_succasful');	
				$this->load->view('template', $data2);
			} else {
				print_r("error");
			}
		} else {
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
			$data['main_content'] = 'add_technology';
			$pom2['languages'] = $pom;
			$pom2['technology'] = $this->technologymodel->getParrentTechlology($this->session->userdata['id_lang']);
			$data['warningmessage'] = $this->lang->line('error_wrong_data');
			$data['data'] = $pom2;
			$this->load->view('template', $data);
		}
	}

	function adddomainform()
	{
		if ( (!isset($this->session->userdata['logged_in'])) || ($this->session->userdata['logged_in'] != true) ) {
			$data['logged_in'] = false;
			$data['warningmessage'] = $this->lang->line("error_permissions");
			$data['main_content'] = 'welcome';
			$this->load->view('template', $data);
		} else {
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
			$data['main_content'] = 'add_domain';
			$pom['languages'] = $this->robtivitymodel->getLanguages();
			$pom['domain'] = $this->domainmodel->getParrentDomain($this->session->userdata['id_lang']);
			$data['data'] = $pom;
			$this->load->view('template', $data);
		}
	}

	function adddomain()
	{
		$pom = $this->robtivitymodel->getLanguages();

		$this->load->library('form_validation');
		foreach ($pom as $key => $value) {
			$this->form_validation->set_rules($value->id, '', 'required|trim|xss_clean|htmlspecialchars');
		}
		
		if ($this->form_validation->run())
		{
			$data['id_parrent'] = $_POST['id_parrent'];
			$iddomain = $this->domainmodel->addDomain($data);

			$counter = 1;
			foreach ($pom as $key => $value) {
				$names[$counter]['id_domain'] = $iddomain;
				$names[$counter]['id_lang'] = $value->id;
				$names[$counter]['domain_name'] = $_POST[$value->id];
				$counter = $counter + 1;
			}

			$succ = $this->domainmodel->addDomainNames($names);
			if ($succ != false) {
				$data2['logged_in'] = $this->session->userdata['logged_in'];
				$data2['function'] = $this->session->userdata['function'];
				$id_lang = $this->session->userdata['id_lang'];
	
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
				$data2['main_content'] = 'create_robtivity';
				$data2['message'] = $this->lang->line('msg_add_domain_succasful');	
				$this->load->view('template', $data2);
			} else {
				print_r("error");
			}
		} else {
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
			$data['main_content'] = 'add_technology';
			$pom2['languages'] = $pom;
			$pom2['domain'] = $this->domainmodel->getParrentDomain($this->session->userdata['id_lang']);
			$data['warningmessage'] = $this->lang->line('error_wrong_data');
			$data['data'] = $pom2;
			$this->load->view('template', $data);
		}
	}

	function addlevelform()
	{
		if ( (!isset($this->session->userdata['logged_in'])) || ($this->session->userdata['logged_in'] != true) ) {
			$data['logged_in'] = false;
			$data['warningmessage'] = $this->lang->line("error_permissions");
			$data['main_content'] = 'welcome';
			$this->load->view('template', $data);
		} else {
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
			$data['main_content'] = 'add_level';
			$pom['languages'] = $this->robtivitymodel->getLanguages();
			$pom['level'] = $this->levelmodel->getParrentLevel($this->session->userdata['id_lang']);
			$data['data'] = $pom;
			$this->load->view('template', $data);
		}
	}
	

	function addlevel()
	{
		$pom = $this->robtivitymodel->getLanguages();

		$this->load->library('form_validation');
		foreach ($pom as $key => $value) {
			$this->form_validation->set_rules($value->id, '', 'required|trim|xss_clean|htmlspecialchars');
		}
		
		if ($this->form_validation->run())
		{
			$data['id_parrent'] = $_POST['id_parrent'];
			$idlevel = $this->levelmodel->addLevel($data);

			$counter = 1;
			foreach ($pom as $key => $value) {
				$names[$counter]['id_level'] = $idlevel;
				$names[$counter]['id_lang'] = $value->id;
				$names[$counter]['level_name'] = $_POST[$value->id];
				$counter = $counter + 1;
			}

			$succ = $this->levelmodel->addLevelNames($names);
			if ($succ != false) {
				$data2['logged_in'] = $this->session->userdata['logged_in'];
				$data2['function'] = $this->session->userdata['function'];
				$id_lang = $this->session->userdata['id_lang'];
	
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
				$data2['main_content'] = 'create_robtivity';
				$data2['message'] = $this->lang->line('msg_add_level_succasful');	
				$this->load->view('template', $data2);
			} else {
				print_r("error");
			}
		} else {
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
			$data['main_content'] = 'add_level';
			$pom2['languages'] = $pom;
			$pom2['level'] = $this->levelmodel->getParrentLevel($this->session->userdata['id_lang']);
			$data['warningmessage'] = $this->lang->line('error_wrong_data');
			$data['data'] = $pom2;
			$this->load->view('template', $data);
		}
	}

	function deleteRobtivity($id)
	{
		$succ = $this->robtivitymodel->deleteRobtivity($id);
		$pathtoDB ='./files/robtivies/' . $id;
		system("rm -rf ".escapeshellarg($pathtoDB));
		redirect($_SERVER['HTTP_REFERER']);
	}

}