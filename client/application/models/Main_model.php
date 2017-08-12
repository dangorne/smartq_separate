<?php
class Main_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function existingUsername()
	{

    $this->db->where('client_userName', $this->input->post('user'));
    if($this->db->count_all_results('client_info') == 1){
      return TRUE;
    }

    return FALSE;

	}

  public function correctPassword()
  {

    $this->db->where('client_userName', $this->input->post('user'));
    $this->db->where('client_password', $this->input->post('pass'));

    if($this->db->count_all_results('client_info') == 1){
      return TRUE;
    }

    return FALSE;
  }

  public function getList(){

  //  $this->db->where('id_number', $this->getSubscriberID());
  //  $this->db->where('queuer_state', 'in');

   return $this->db->get('client_transaction')->result();

  }

  public function getSubscriberID(){

    $this->db->reset_query();
    $this->db->where('userName', $this->session->userdata('username'));

    $var = $this->db->get('subscriber')->row();

    if($var){
      return $var->id_number;
    }else{
      return "none";
    }
  }

  public function editq($type, $content){

    if($type=="name"){

      $qname = $this->getqueuename();

      $this->db->where('queue_name', $qname);
      $this->db->set('queue_name', $content);
      $this->db->update('client_transaction');

      $this->db->reset_query();

      // echo print_r($qname);

      $this->db->where('queue_name', $qname);
      $this->db->set('queue_name', $content);
      $this->db->update('client_info');
    }

    $result = array(
      'success' => TRUE,
      'error' => "Wrong Input"
    );

    return $result;
  }

	public function existingClient()
	{

    $this->db->where('client_userName', $this->input->post('user'));
    $this->db->where('client_password', $this->input->post('pass'));

    if($this->db->count_all_results('client_info') == 1){
      return TRUE;
    }

    return FALSE;

	}

  public function existingQueue()
	{

    $this->db->where('queue_name', $this->input->post('input')['name']);
    $this->db->where('queue_name', $this->input->post('input')['code']);

    if($this->db->count_all_results('client_transaction') == 1){

      return TRUE;

    }

    return FALSE;

	}

	public function register()
	{
		$this->load->helper('url');

    if($this->existingClient()){
      return FALSE;
    }

    $this->db->where('code', $this->input->post('permcode'));

    if($this->db->count_all_results('permission_code') == 0){
      return FALSE;
    }

    $this->db->reset_query();

		$data = array(
      'client_id' => $this->input->post('clientid'),
			'client_userName' => $this->input->post('user'),
			'client_password' => $this->input->post('pass'),
      'office' => $this->input->post('office'),
		);

		$this->db->insert('client_info', $data);

    return TRUE;
	}


  public function createq()
  {

    $this->load->helper('url');

    if($this->existingQueue()){
      return FALSE;
    }

    $data = array(
      'queue_name' => $this->input->post('input')['name'],
      'queue_code' => $this->input->post('input')['code'],
      'seats_offered' => $this->input->post('input')['seat'],
      'requirements' => $this->input->post('input')['req'],
      'venue' => $this->input->post('input')['venue'],
      'queue_description' => $this->input->post('input')['desc'],
      'queue_restriction' => $this->input->post('input')['rest'],
      'serving_atNo' => 0,
      'total_deployNo' => 0,
      'life' => 1,
      'click' => 0
    );

    $this->db->insert('client_transaction', $data);

    $this->db->set('queue_name', $this->input->post('input')['name']);
    $this->db->where('client_userName', $this->session->userdata['username']);
    $this->db->update('client_info');

    return TRUE;
  }

  public function logInUser(){

    $this->db->set('loggedin', 'TRUE');
    $this->db->where('client_userName', $this->input->post('user'));
    $this->db->update('client_info');

  }

  public function logoutUser(){

    $this->db->set('loggedin', 'FALSE');
    $this->db->where('client_userName', $this->session->userdata('username'));
    $this->db->update('client_info');

  }

  public function isLoggedIn(){

    $this->db->where('client_userName', $this->session->userdata('username'));
    $this->db->where('loggedin', 'TRUE');

    if($this->db->count_all_results('client_info') == 1){

      return TRUE;

    }

    return FALSE;
  }

	public function next_service_num()
	{

    $this->db->set('click', 1);

    $this->db->where('queue_name', $this->getqueuename());
    $this->db->where('click', 0);
    $this->db->update('client_transaction');

    return $this->getCurrentServiceNum()+1;

	}


	public function next_id_num()
	{

   $this->db->where('queue_name', $this->getqueuename());
   $this->db->where('queue_number', $this->getCurrentServiceNum()+1);

   $var = $this->db->get('queuer')->row();

   if($var){
     return $var->id_number;;
   }else{
     return "none";
   }
	}

  public function hasqueue(){

    $this->db->where('client_userName', $this->session->userdata('username'));
    $this->db->where('queue_name', 'none');//is code NULL

    if($this->db->count_all_results('client_info') == 0){
      return TRUE;
    }

    return FALSE;
  }

  // public function getqueuestatus(){
  //
  //   $result = array(
  //     'qnum' => $this->getcurrentservicenum(),
  //     'idnum' => $this->getcurrentid(),
  //     'qstatus' => $this->getstatus(),
  //     'totalsub' => $this->getdeployno(),
  //   );
  //
  //   return $result;
  // }

  public function getqueuedetails(){

    $this->db->where('queue_name', $this->getqueuename());

    return $this->db->get('client_transaction')->row();
  }

  public function getqueuename(){

    $this->db->where('client_userName', $this->session->userdata('username'));

    // echo print_r ($this->session->userdata('username'));
    return $this->db->get('client_info')->row()->queue_name;

  }

  // public function hasQueue(){
  //
  //   $this->db->where('client_userName', $this->session->userdata('username'));
  //   $this->db->where('queue_name');
  //   if($this->db->count_all_results('client_info') == 0){
  //     return TRUE;
  //   }
  //
  //   return FALSE;
  // }

  public function getQueue(){

    $this->db->where('client_userName', $this->session->userdata('username'));

    return $this->db->get('client_info')->row()->queue_name;

  }

  public function getcurrentservicenum(){

    $this->db->where('queue_name', $this->getqueuename());

    return $this->db->get('client_transaction')->row()->serving_atNo;

  }

  public function getcurrentid(){

    $this->db->where('queue_name', $this->getqueuename());
    $this->db->where('queue_number', $this->getcurrentservicenum());

    $var = $this->db->get('queuer')->row();

    if($var){
      return $var->id_number;;
    }else{
      return "none";
    }
  }

  public function getstatus(){

    $this->db->where('queue_name', $this->getqueuename());

    $var = $this->db->get('client_transaction')->row();

    if($var->life == 1){
      return 'ONGOING';
    }else if ($var->life == 2){
      return 'PAUSED';
    }else if ($var->life == 3){
      return 'CLOSED';
    }else{
      return 'UNIDENTIFIED';
    }
  }

  public function setstatus($var)
	{

    $this->db->set('life', $var);

    $this->db->where('queue_name', $this->getqueuename());
    $this->db->update('client_transaction');

	}

  public function closequeue()
	{

    $this->db->set('serving_atNo', 0);
    $this->db->set('total_deployNo', 0);
    $this->db->set('life', 3);
    $this->db->set('click', 0);

    $this->db->where('queue_name', $this->getqueuename());

    $this->db->update('client_transaction');

	}

  public function getdeployno()
	{

    $this->db->where('queue_name', $this->getqueuename());

    $var = $this->db->get('client_transaction')->row();

    if($var->total_deployNo){
      return $var->total_deployNo;
    }else{
      return "none";
    }

	}

}
