<?php
 class MY_Controller extends CI_Controller {
 

 	 public function __construct()
    {
        parent::__construct();
         $this->load->library('session');
        
        $this->base_url = 'http://localhost/c2mdoc';

    }

 public function mainlayout($view,$data) {
 // Page local resource 
$data['base_url'] = $this->base_url;

$this->load->view('layout/main/header.php',$data);
 $this->load->view('layout/main/left.php',$data);
  $this->load->view($view,$data);
 $this->load->view('layout/main/right.php',$data);
 $this->load->view('layout/main/footer.php',$data);
 }

  





 }
