<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doc extends MY_Controller {


 public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('doc_list_model');

  
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		

$data['title'] = 'C2M Doc โปรแกรมจัดเก็บไฟล์และเอกสาร';
		$this->mainlayout('doc_list',$data);
}





 function Add()
    {
 
if(!isset($_POST['title']) || $_POST['title']==''){
exit();
}  
if(isset($_FILES["file"]["name"]) && $_FILES["file"]["name"] != ''){

$target_dir = "uploads/";

$target_file = $target_dir . basename($_FILES["file"]["name"]);

$type = pathinfo($target_file,PATHINFO_EXTENSION);

    $upload = move_uploaded_file($_FILES["file"]["tmp_name"],'upload/'.time().md5($_FILES["file"]["name"]).'.'.$type);

    $data['file'] = 'upload/'.time().md5($_FILES["file"]["name"]).'.'.$type;

}else{
$data['product_image'] = '';
}


$data['title'] =  $_POST['title'];
$data['des'] = $_POST['des'];
$data['size'] = $_FILES["file"]["size"];
$data['type'] = $type;


		$success = $this->doc_list_model->Add($data);
      
}



 function Update()
    {

$data['id'] =  $_POST['id'];
$data['title'] =  $_POST['title'];
$data['des'] =  $_POST['des'];

		$success = $this->doc_list_model->Update($data);
      
}



    function Get()
    {


$data = json_decode(file_get_contents("php://input"),true);
if(!isset($data)){
exit();
}
echo  $this->doc_list_model->Get($data);

}





	






    function Delete()
    {
 
$data = json_decode(file_get_contents("php://input"),true);
if(!isset($data)){
exit();
}

unlink($data['file']);
$success = $this->doc_list_model->Delete($data);
      if($success){
      	return true;
      }else{
      	return false;
      }

}





	}

