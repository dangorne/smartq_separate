<?php

  class Main extends CI_Controller{

    public function __construct(){

      parent::__construct();

      $this->load->library('session');
      $this->load->model('main_model');
      $this->load->helper('url_helper');

    }

    public function index(){

      if($this->session->userdata('username') != '' ){
        if($this->main_model->hasQueue()){
          redirect('controlq');
        }else{
          redirect('createq');
        }
      }else{
        redirect('login');
      }

    }

    public function joinselected(){

      $result = array('res' => $this->main_model->join($this->input->post('selected')));
      echo json_encode($result);
    }

    public function leave(){

      $result = array('res' => $this->main_model->leave($this->input->post('selected')));
      echo json_encode($result);
    }

    public function listselected(){

      $var = $this->input->post('selected');

      $search_result = $this->main_model->getSelectResult($this->input->post('selected'));

      $result = array(
        'queue_name' => $search_result->queue_name,
        'status' => "ONGOING",
        'serving_atNo' => $search_result->serving_atNo,
        'total_deployNo' => $search_result->total_deployNo,
        'self' => $this->main_model->getSelf($var),
        'queue_description' => $search_result->queue_description,
        'queue_restriction' => $search_result->queue_restriction,
        'requirements' => $search_result->requirements,
        'venue' => $search_result->venue,
      );

      echo json_encode($result);

    }

    public function fetchsearch(){

      $var = $this->input->post('selected');

      if($var == ''){
        $search_result = $this->main_model->getSearchResult($this->input->post('search'), TRUE);
      }else{
        $search_result = $this->main_model->getSearchResult();
      }

      foreach ($search_result as $row)
      {
        echo '<tr>';
        echo '<td>'.$row->queue_name.'</td>';
        echo '<td>'.$row->serving_atNo.'</td>';
        echo '<td>'.$row->total_deployNo.'</td>';
        echo '<td>'.$row->seats_offered.'</td>';
        echo '<td>'.$row->queue_description.'</td>';
        echo '<td>'.$row->queue_restriction.'</td>';
        echo '<td>'.$row->requirements.'</td>';
        echo '<td>'.$row->venue.'</td>';
        echo '</tr>';
      }

    }

    public function fetchlist(){

      $search_result = $this->main_model->getList();

      foreach ($search_result as $row)
      {

        echo '<div class="list-group-item list-selected">';
        echo '<span class="list-qname"><strong>'.$row->queue_name.'</strong></span>';
        echo '<span class="badge badge-total">'.$row->queue_number.'</span>';
        echo '</div>';
      }

    }

    public function logout(){

      // if($this->session->userdata('username') != '' && $this->main_model->isLoggedIn()){
      if($this->session->userdata('username') != ''){

        //logout user by setting fieldname to false
        // $this->main_model->isLoggedIn();

        // $this->main_model->logoutUser();
        // //unset user and type
        unset($_SESSION['username']);
      }

      //go back to home page with no session
      redirect(base_url(). '');

    }

    public function login(){

      $this->load->helper('form');
      $this->load->library('form_validation');
      // echo "<pre>";
      // print_r ($this->session->all_userdata());
      // echo "</pre>";
      if($this->session->userdata('username') == '' ){
        $this->load->view('templates/header_login_signup');
        $this->load->view('login');
        $this->load->view('templates/footer');
      }else if($this->session->userdata('username') != '' && $this->main_model->hasQueue()){
        redirect('controlq');
      }else if($this->session->userdata('username') != '' && !$this->main_model->hasQueue()){
        redirect('createq');
      }

    }

    public function signup_subscriber(){

      $this->load->helper('form');
      $this->load->library('form_validation');

      $this->load->view('templates/header_login_signup');
      $this->load->view('signup_subscriber');
      $this->load->view('templates/footer');

    }

    public function signup(){

      $this->load->helper('form');
      $this->load->library('form_validation');

      if($this->session->userdata('username') == '' ){
        $this->load->view('templates/header_login_signup');
        $this->load->view('signup');
        $this->load->view('templates/footer');
      }

    }

    public function createq(){

      $this->load->helper('form');
      $this->load->library('form_validation');

      // if($this->session->userdata('username') != '' ){
      //   $this->load->view('templates/header_logout');
      //   $this->load->view('createq');
      //   $this->load->view('templates/footer');
      // }

      if($this->session->userdata('username') == ''){
        redirect('login');
      }else if($this->session->userdata('username') != '' && $this->main_model->hasQueue()){
        redirect('controlq');
      }else if($this->session->userdata('username') != '' && !$this->main_model->hasQueue()){
        $this->load->view('templates/header_logout');
        $this->load->view('createq');
        $this->load->view('templates/footer');
      }

    }

    public function createq_submit(){

      $this->load->helper('form');
      $this->load->library('form_validation');

		  $this->form_validation->set_rules('qname', 'Qname', 'required');
		  $this->form_validation->set_rules('seat', 'Seat', 'required');
      $this->form_validation->set_rules('qdesc', 'Qdesc', 'required');
      $this->form_validation->set_rules('req', 'Req', 'required');
      $this->form_validation->set_rules('venue', 'Venue', 'required');

      if ($this->form_validation->run()){

        if(!$this->main_model->existingQueue()){

            $this->main_model->createQ();

    				redirect(base_url(). '');

            // $this->createq();
            $this->controlq();
        }else{

         $this->createq();
  			}
			}else{

        $this->createq();
      }
    }

    public function fetch_user(){

     $fetch_data = $this->main_model->make_datatables();
     $data = array();
     foreach($fetch_data as $row)
     {
        $sub_array = array();
        // $sub_array[] = '<img src="'.base_url().'upload/'.$row->image.'" class="img-thumbnail" width="50" height="35" />';
        $sub_array[] = $row->id_number;
        $sub_array[] = $row->queue_name;
        $sub_array[] = $row->queue_number;
        // $sub_array[] = '<button type="button" name="update" id="'.$row->id.'" class="btn btn-warning btn-xs">Update</button>';
        // $sub_array[] = '<button type="button" name="delete" id="'.$row->id.'" class="btn btn-danger btn-xs">Delete</button>';
        $data[] = $sub_array;
     }
     $output = array(
          "draw"                    =>     intval($_POST["draw"]),
          "recordsTotal"          =>      $this->main_model->get_all_data(),
          "recordsFiltered"     =>     $this->main_model->get_filtered_data(),
          "data"                    =>     $data
     );
     echo json_encode($output);
    }

    public function pauseq(){
      $this->main_model->setStatus(2);
      echo json_encode($this->main_model->getStatus());
    }

    public function resumeq(){
      $this->main_model->setStatus(1);
      echo json_encode($this->main_model->getStatus());
    }

    public function closeq(){
      $this->main_model->closeQueue();
      redirect('createq');
    }

    public function stopq(){
      $this->main_model->setStatus(3);
      echo json_encode($this->main_model->getStatus());
    }

    public function dbUpdate(){

      echo json_encode($this->main_model->getUpdate());
    }

    public function controlq(){

      $this->load->helper('form');
      $this->load->library('form_validation');

      if($this->session->userdata('username') == '' ){
        redirect('login');
      }else if($this->session->userdata('username') != '' && $this->main_model->hasQueue()){

        $data['qnum'] = $this->main_model->getCurrentServiceNum();
        $data['idnum'] = $this->main_model->getCurrentID();
        $data['status'] = $this->main_model->getStatus();
        $data['dbupdate'] = $this->main_model->getUpdate();

        $this->load->view('templates/header_logout');
        $this->load->view('controlq', $data);
        $this->load->view('templates/footer');
      }else if($this->session->userdata('username') != '' && !$this->main_model->hasQueue()){
        redirect('createq');
      }
    }

    public function edit(){

      $this->load->helper('form');
      $this->load->library('form_validation');

      if($this->session->userdata('username') != '' ){
        $this->load->view('templates/header_logout');
        $this->load->view('templates/unavailable');
        $this->load->view('templates/footer');
      }
    }

    public function edit_validated(){


    }

    public function editsubscriber_validated(){


    }

    public function nextqueuer(){
      // echo "<pre>";
      // print_r ($this->session->all_userdata());
      // echo "</pre>";
      // echo "<pre>";
      // print_r ($this->main_model->serve_next());
      // echo "</pre>";

      echo json_encode(array('servicenum' => $this->main_model->next_service_num(), 'idnum' => $this->main_model->next_id_num()));

    }

    // public function login_validated(){
    //
    //   $this->load->helper('form');
    //   $this->load->library('form_validation');
    //
    //   $this->form_validation->set_rules('user', 'Username',
    //             array(
    //               array('existingusername',  array($this->main_model, 'existingUsername'))
    //             ),
    //               array('existingusername' => 'Username does not exist.')
    //   );
    //
    //   $this->form_validation->set_rules('pass', 'Password',
    //             array(
    //               array('correctpassword',  array($this->main_model, 'correctPassword'))
    //             ),
    //               array('correctpassword' => 'Incorrect password.')
    //   );
    //
		//   if ($this->form_validation->run('syntax')){
    //
    //     if ($this->form_validation->run()){
    //
    //       $userdata = array(
    //        'username' => $this->input->post('user')
    //       );
    //       $this->session->set_userdata($userdata);
    //
    //         redirect(base_url(). '');
    //       }else{
    //         $this->session->set_flashdata('error', 'error');
    //         $this->login();
    //      }
  	// 	}else{
    //
    //     $this->session->set_flashdata('error', 'error');
    //     $this->login();
  	// 	}
    // }
////////////////////////////////////////////////////////////////////////////////////////////////////

  public function dashboard(){

    $this->load->helper('form');
    $this->load->library('form_validation');

    if($this->session->userdata('username') != '' ){
      $this->load->view('templates/header_logout');
      $this->load->view('subscriber');
      $this->load->view('dashboard');
      $this->load->view('templates/footer');
    }

  }

    public function login_validated(){

      $this->load->helper('form');
      $this->load->library('form_validation');

		  if ($this->form_validation->run('syntax')){

        if ($this->main_model->existingUsername()){

          unset($_SESSION['user_error']);
          if($this->main_model->correctPassword()){

              $userdata = array(
               'username' => $this->input->post('user')
              );
              $this->session->set_userdata($userdata);

              // redirect(base_url(). '');
              // if($this->main_model->hasQueue()){
                redirect('dashboard');
              // }else{
              //   redirect('createq');
              // }
          }else{

            $this->session->set_flashdata('pass_error', 'error');
            $this->login();
          }
       }else{

          $this->session->set_flashdata('user_error', 'error');
          $this->login();
       }
  	 }else{

        $this->session->set_flashdata('syntax_error', 'error');
        $this->login();
  	 }
   }
////////////////////////////////////////////////////////////////////////////////////////////////////
    public function signup_validated(){

      $this->load->helper('form');
			$this->load->library('form_validation');

      //all form validation except the checkbox
      $this->form_validation->set_rules('id', ' ID', 'required');
			$this->form_validation->set_rules('user', 'User', 'required');
			$this->form_validation->set_rules('pass', 'Pass', 'required');
      $this->form_validation->set_rules('office', 'Office', 'required');
      // $this->form_validation->set_rules('qname', 'Queue', 'required');
      $this->form_validation->set_rules('permcode', 'Permission Code', 'required');

      //check if user is unregistered
      //login the user if success
			if ($this->form_validation->run()){

        //check if  does not exists
        if(!$this->main_model->existingClient()){

          //register user
          if($this->main_model->register()){
            //set user session with username
            //the actual login
            $userdata = array(
              'username' => $this->input->post('user')
            );
            $this->session->set_userdata($userdata);

            //after login redirect to homepage
    				redirect(base_url(). '');
          }else{

            $this->signup();

          }
        }else{

         //go back to same page and
         //alert user that username already exists
         //only username must be checked for existingClient
         //no need for password
         $this->signup();

  			}
			}else{

        //user or pass is invalid
        // redirect(base_url(). 'login');
        $this->signup();
      }
    }

  }

?>
