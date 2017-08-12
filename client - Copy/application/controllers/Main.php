<?php

  class Main extends CI_Controller{

    public function __construct(){

      parent::__construct();

      $this->load->library('session');
      $this->load->model('main_model');
      $this->load->helper('url_helper');
      // $this->load->helper('form');
      // $this->load->library('form_validation');

    }

    public function index(){

      if($this->session->userdata('username') != '' ){
        // if($this->main_model->hasQueue()){
          redirect('dashboard');
        // }else{
          // redirect('dashboard');
          // redirect('createq');
        // }
        // $this->load->view('templates/header_logout');
        // $this->load->view('home');
        // $this->load->view('templates/footer');
      }else{
        // $this->load->view('templates/header_login_signup');
        // $this->load->view('home');
        // $this->load->view('templates/footer');
        redirect('login');
      }

    }

    public function editdetail(){

      // if($this->input->post('type')=='name'){
        // echo print_r($this->input->post('content'));
      // }

      //returns the error message string


      // if($var.success){
      
      echo json_encode($this->main_model->editq($this->input->post('type'), $this->input->post('content')));
      // }else{
        // echo json_encode($var);
      // }
      // $result = array(
      //   'success' => TRUE,
      // );
      //
      // $result = array(
      //   'success' => FALSE,
      // );

      // echo json_encode($result);
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
      // }else if($this->session->userdata('username') != '' && $this->main_model->hasQueue()){
      //   redirect('dashboard');
      // }else if($this->session->userdata('username') != '' && !$this->main_model->hasQueue()){
      //   redirect('createq');
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

    public function load_status(){

      $result = array(
        'qnum' => $this->main_model->getcurrentservicenum(),
        'idnum' => $this->main_model->getcurrentid(),
        'qstatus' => $this->main_model->getstatus(),
        'totalsub' => $this->main_model->getdeployno(),
      );

      echo json_encode($result);
    }

    public function load_detail(){

      if($this->main_model->hasqueue()){

        $query_result = $this->main_model->getqueuedetails();

        $result = array(
          'display' => "true",
          'qname' => $query_result->queue_name,
          'code' => $query_result->queue_code,
          'seats' => $query_result->seats_offered,
          'desc' => $query_result->queue_description,
          'req' => $query_result->requirements,
          'venue' => $query_result->venue,
          'rest' => $query_result->queue_restriction,
        );
        // echo print_r ($query_result->queue_restriction);
      }else{

        $result = array(
          'display' => "false",
        );
      }

      echo json_encode($result);

    }

    public function createq(){

      echo json_encode($this->main_model->createq());



      // $input = $this->input->post('create_input');
      // echo print_r ($input['title']);
    }

    // public function createq(){
    //
    //   $this->load->helper('form');
    //   $this->load->library('form_validation');
    //
    //   // if($this->session->userdata('username') != '' ){
    //   //   $this->load->view('templates/header_logout');
    //   //   $this->load->view('createq');
    //   //   $this->load->view('templates/footer');
    //   // }
    //
    //   if($this->session->userdata('username') == ''){
    //     redirect('login');
    //   }else if($this->session->userdata('username') != '' && $this->main_model->hasQueue()){
    //     redirect('dashboard');
    //   }else if($this->session->userdata('username') != '' && !$this->main_model->hasQueue()){
    //     $this->load->view('templates/header_logout');
    //     $this->load->view('createq');
    //     $this->load->view('templates/footer');
    //   }
    //
    // }

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
            $this->dashboard();
        }else{

         $this->createq();
  			}
			}else{

        $this->createq();
      }
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

      $this->main_model->closequeue();

      $result = '
      <div class="panel-body detail-body">

        <h4>Queue Name</h4>
        <p id="p-qname"></p>

        <h4>Queue Code</h4>
        <p id="p-code"></p>

        <h4>Seats Offered</h4>
        <p id="p-seats"></p>

        <h4>Description</h4>
        <p id="p-desc"></p>

        <h4>Requirements</h4>
        <p id="p-req"></p>

        <h4>Venue</h4>
        <p id="p-venue"></p>

        <h4>Restriction</h4>
        <p id="p-rest"></p>

      </div>

      <div class="panel-footer detail-footer">
        <div class="btn-group btn-group-lg btn-group-justified" role="group">

          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#editModal">
              <span class="glyphicon glyphicon glyphicon-edit"></span>
              Edit
            </button>
          </div>

          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-close" >
              <span class="glyphicon glyphicon glyphicon-remove"></span>
              Close
            </button>
          </div>

        </div>
      </div>';
    }

    public function stopq(){
      $this->main_model->setStatus(3);
      echo json_encode($this->main_model->getStatus());
    }

    public function dbUpdate(){

      echo json_encode($this->main_model->getdeployno());
    }

    public function dashboard(){

      $this->load->helper('form');
      $this->load->library('form_validation');

      // if($this->session->userdata('username') == '' ){
      //   redirect('login');
      // }else if($this->session->userdata('username') != '' && $this->main_model->hasQueue()){
      //
      //   $data['qnum'] = $this->main_model->getCurrentServiceNum();
      //   $data['idnum'] = $this->main_model->getCurrentID();
      //   $data['status'] = $this->main_model->getStatus();
      //   $data['dbupdate'] = $this->main_model->getUpdate();

      $this->load->view('templates/header_logout');
      $this->load->view('modal');
      $this->load->view('client');
      $this->load->view('dashboard');
      $this->load->view('templates/footer');
      // }else if($this->session->userdata('username') != '' && !$this->main_model->hasQueue()){
      //   redirect('createq');
      // }
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

        // if ($this->main_model->existingUsername()){
        //
        //   if(!$this->main_model->correctPassword()){
        //
        //     $this->session->set_flashdata('pass_error', 'error');
        //   }
        // }else{
        //
        //   $this->session->set_flashdata('user_error', 'error');
        // }

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
