<?php
class Main_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function existingUsername()
	{

    $this->db->where('userName', $this->input->post('user'));
    if($this->db->count_all_results('subscriber') == 1){
      return TRUE;
    }

    return FALSE;

	}

  public function correctPassword()
  {

    $this->db->where('userName', $this->input->post('user'));
    $this->db->where('password', $this->input->post('pass'));

    if($this->db->count_all_results('subscriber') == 1){
      return TRUE;
    }

    return FALSE;
  }

	public function existingSubscriber()
	{

    $this->db->where('userName', $this->input->post('user'));
    $this->db->where('password', $this->input->post('pass'));

    if($this->db->count_all_results('subscriber') == 1){
      return TRUE;
    }

    return FALSE;

	}

  public function existingQueue()
	{

    $this->db->where('queue_name', $this->input->post('qname'));

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


  public function createQ()
  {

    $this->load->helper('url');

    if($this->existingQueue()){
      return FALSE;
    }

    $data = array(
      'queue_name' => $this->input->post('qname'),
      'seats_offered' => $this->input->post('seat'),
      'requirements' => $this->input->post('req'),
      'venue' => $this->input->post('venue'),
      'queue_description' => $this->input->post('qdesc'),
      'queue_ristriction' => $this->input->post('rest'),
      'serving_atNo' => 0,
      'total_deployNo' => 0,
      'life' => 0,
      'click' => 0
    );

    $this->db->insert('client_transaction', $data);

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

    $this->db->where('queue_name', $this->getQueue());
    $this->db->where('click', 0);
    $this->db->update('client_transaction');


    return $this->getCurrentServiceNum()+1;

	}


	public function next_id_num()
	{

   $this->db->where('queue_name', $this->getQueue());
   $this->db->where('queue_number', $this->getCurrentServiceNum()+1);

   $var = $this->db->get('queuer')->row();

   if($var){
     return $var->id_number;;
   }else{
     return "none";
   }
	}

  public function hasQueue(){

    $this->db->where('client_userName', $this->session->userdata('username'));
    $this->db->where('queue_name', 'none');
    if($this->db->count_all_results('client_info') == 0){
      return TRUE;
    }

    return FALSE;
  }

  public function getQueue($queue){

    $this->db->where('client_userName', $this->session->userdata('username'));

    return $this->db->get('client_info')->row()->queue_name;

  }

  public function getCurrentServiceNum(){

    $this->db->where('queue_name', $this->getQueue());
    // echo "<pre>";
    // print_r ($this->getQueue());
    // echo "</pre>";
    return $this->db->get('client_transaction')->row()->serving_atNo;

  }

  public function getCurrentID(){

    $this->db->where('queue_name', $this->getQueue());
    $this->db->where('queue_number', $this->getCurrentServiceNum());

    $var = $this->db->get('queuer')->row();

    if($var){
      return $var->id_number;;
    }else{
      return "none";
    }
  }

  public function getStatus($queue){

    $this->db->where('queue_name', $queue);

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

  public function setStatus($var)
	{

    $this->db->set('life', $var);

    $this->db->where('queue_name', $this->getQueue());
    $this->db->update('client_transaction');

	}

  public function closeQueue($var)
	{

    $this->db->set('life', $var);

    $this->db->where('queue_name', $this->getQueue());
    $this->db->update('client_transaction');

	}

  public function getUpdate()
	{

    $this->db->where('queue_name', $this->getQueue());

    $var = $this->db->get('client_transaction')->row();

    if($var->total_deployNo){
      return $var->total_deployNo;
    }else{
      return "none";
    }

	}

    var $table = "queuer";
    var $select_column = array("id_number", "queue_name", "queue_number");
    var $order_column = array(null, "queue_name", "queue_number");
   public function make_query()
   {
      $this->db->select($this->select_column);
      $this->db->from($this->table);
      if(isset($_POST["search"]["value"]))
      {
           $this->db->like("id_number", $_POST["search"]["value"]);
      }
      if(isset($_POST["order"]))
      {
           $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
      }
      else
      {
           $this->db->order_by('id_number', 'queue_number');
      }
   }

   public function make_datatables(){
      $this->make_query();
      if($_POST["length"] != -1)
      {
           $this->db->limit($_POST['length'], $_POST['start']);
      }
      $query = $this->db->get();
      return $query->result();
   }

   public function get_filtered_data(){
      $this->make_query();
      $query = $this->db->get();
      return $query->num_rows();
   }

   public function get_all_data()
   {
      $this->db->select("*");
      $this->db->from($this->table);
      return $this->db->count_all_results();
   }

   public function getSearchResult($match){

    if($match != ''){

      $this->db->like('queue_name', $match);

      $this->db->where('life', 1);
      $this->db->or_where('life', 2);
      return $this->db->get('client_transaction')->result();
    }

    $this->db->where('life', 1);
    $this->db->or_where('life', 2);
    return $this->db->get('client_transaction')->result();

   }

   public function getList(){

    $this->db->where('id_number', $this->getSubscriberID());
    $this->db->where('queuer_state', 'in');

    return $this->db->get('queuer')->result();

   }

   public function getSelf($queue){

    $this->db->where('id_number', $this->getSubscriberID());
    $this->db->where('queue_name', $queue);

    return $this->db->get('queuer')->row()->queue_number;

   }

   public function getSelectResult($match){

      $this->db->like('queue_name', $match);

      return $this->db->get('client_transaction')->row();

   }

  public function AlreadyInQueue($queue){

    $this->db->reset_query();

    $this->db->where('id_number', $this->getSubscriberID());
    $this->db->where('queue_name', $queue);
    $this->db->where('queuer_state', 'in');


    if($this->db->count_all_results('queuer') > 0){
      return TRUE;
    }

    return FALSE;

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

  public function IncrementedLastNumber($queue){

    $this->db->where('queue_name', $queue);
    $this->db->set('total_deployNo', 'total_deployNo+1', FALSE);
    $this->db->update('client_transaction');

    $this->db->reset_query();

    $this->db->where('queue_name', $queue);
    $var = $this->db->get('client_transaction')->row();

    return $var->total_deployNo;
  }

  public function join($queue)
 	{

    if($this->AlreadyInQueue($queue)){

      return "EXIST";
    }

    if($this->getStatus($queue) == "ONGOING"){

      $data = array(
   			 'id_number' => $this->getSubscriberID(),
         'queue_name' => $queue,
   			 'queue_number' => $this->IncrementedLastNumber($queue)+1,
         'join_type' => 'web',
   		);

      $this->db->insert('queuer', $data);

      return "ONGOING";
    }else{

      return "PAUSED";
    }

 	}

    public function leave($queue){

      if(!$this->AlreadyInQueue($queue)){
        return "NOTINQUEUE";
      }

      $this->db->where('id_number', $this->getSubscriberID());
      $this->db->where('queue_name', $queue);
      $this->db->set('queuer_state', 'out');

      $this->db->update('queuer');

      return "LEFT";
    }

}
