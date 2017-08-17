<?php

class Doc_list_model extends CI_Model {



        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->load->library('session');


        }

        public function Add($data)
        {



if ($this->db->insert("doc_list", $data)){
		return true;
	}

  }


           public function Update($data)
        {



$where = array(
        'id'  => $data['id']
);

$this->db->where($where);
if ($this->db->update("doc_list", $data)){
        return true;
    }

}



      



           public function Get($data)
        {

            $perpage = $data['perpage'];

            if($data['page'] && $data['page'] != ''){
$page = $data['page'];
            }else{
          $page = '1';      
            }


            $start = ($page - 1) * $perpage;

$querynum = $this->db->query('SELECT *
    FROM doc_list 
    WHERE title LIKE "%'.$data['searchtext'].'%" OR des LIKE "%'.$data['searchtext'].'%"
    ORDER BY id DESC');


$query = $this->db->query('SELECT *
    FROM doc_list
    WHERE title LIKE "%'.$data['searchtext'].'%" OR des LIKE "%'.$data['searchtext'].'%"
    ORDER BY id DESC  LIMIT '.$start.' , '.$perpage.'  ');

$encode_data = json_encode($query->result(),JSON_UNESCAPED_UNICODE );


$num_rows = $querynum->num_rows();

$pageall = ceil($num_rows/$perpage);




$json = '{"list": '.$encode_data.',
"numall": '.$num_rows.',"perpage": '.$perpage.', "pageall": '.$pageall.'}';

return $json;

        }




        





    public function Delete($data)
        {

$query = $this->db->query('DELETE FROM doc_list  WHERE id="'.$data['id'].'"');
return true;

        }




    }