<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
												////	greglak

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
	function __construct() 
	{
		parent::__construct();
		// Load session library
		$this->load->library('session');

		// Load Pagination library
		$this->load->library('pagination');
		
		// Load model used by the controller
		$this->load->model('Bookstore_Model');
	}
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
												//Login

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//on index load, will execute the login function
	public function index()
	{
		$this->login();  
	}	 

	//function loads view for adminlogin
	public function login()  
    {  
        $this->load->view('adminlogin'); 
    }  

	//function checks whether the user has been authenticated and either logs you in if session "currently_logged_in" matches it loads the index view of the admin panel
	//otherwise the user is redirected to the function invalid
    public function mainpage()  
    {  
        if ($this->session->userdata('currently_logged_in'))   
        {  
            $this->load->view('adminview');  
        } else {  
            redirect('Admin/invalid');  
        }  
    }  

	//Function displays invalid attempt to use the system, only allow users to attempt a new login
    public function invalid()  
    {  
        $this->load->view('admininvalid');  
    }  

	//With the help of the codeigniter helper and form validation library, the are rules for validating the use
    public function login_action()  
    {  
        $this->load->helper('security');  
        $this->load->library('form_validation');  
        $this->form_validation->set_rules('username', 'Username:', 'required|trim|xss_clean|callback_validation');  
        $this->form_validation->set_rules('password', 'Password:', 'required|trim');  
		
		//logical block check if validation form has been checked, and if true, allocates  it a session according to the username,
		//redirects to the main admin page
		if ($this->form_validation->run())   
        {  
            $data = array(  
                'username' => $this->input->post('username'),  
                'currently_logged_in' => 1  
                );    
				
				$this->session->set_userdata($data);  
                redirect('Admin/mainpage');  
		}
		//if the statement is false the user is redirected to the login page again
        else {  
            $this->load->view('adminlogin');  
        }  
	}  

	//function designate to talk with the database to verify user credentials
	//if the user matches it becomes true, otherwise it will display a warning message.
    public function validation()  
    {  
        if ($this->Bookstore_Model->log_in_correctly())  
        {  
            return true;  
        } else {  
            $this->form_validation->set_message('validation', 'Incorrect username/password.');  
            return false;  
        }  
	}  

	//The function usets the session that has the login information
    public function logout()  
    {  
        $this->session->unset_userdata('currently_logged_in');
        redirect('Admin/login');  
	}  


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
												//Adding category & book to database

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//This function first verify the users credentials, then grabs the input and pass it on the model to process.
	function insertintodb()
	{
		if ($this->session->userdata('currently_logged_in'))   
		{  
			$input = $this->input->post('input');
			$data['books'] = $this->Bookstore_Model->addCategory($input);
			redirect('Admin/mainpage');  
		} else {  
			redirect('Admin/invalid');  
		} 
	}

	//The function verifies credentials before allows anyone to access the view of the add category
	public function addcategory()  
    {  
		if ($this->session->userdata('currently_logged_in'))   
		{  
			$this->load->view('adminaddcategory');  
		} else {  
			redirect('Admin/invalid');  
		} 
	}
	
	//It starts with a verification, and loads the page for Book registration
	public function addbook()  
    {  
		if ($this->session->userdata('currently_logged_in'))   
		{  
			$this->load->view('adminaddbook'); 
		} else {  
			redirect('Admin/invalid');  
		} 	 
	}
	
	//Following a verification, it gathers information on the file and text type inputs,
	//then it loads the Upload library to pass the picture to the assets folder, then picture's name and other inputs are passed on to the module
	public function adminaddbook()
	{
		if ($this->session->userdata('currently_logged_in'))   
		{  
			$config['upload_path'] = 'assets/images/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = $_FILES['picture']['name'];
			//Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('picture')){
				$uploadData = $this->upload->data();
				$picture = $uploadData['file_name'];
			}else{
				$picture = '';
			}
			//Prepare array of user data
			$title = $this->input->post('title');
			$author = $this->input->post('author');
			$picture = $picture;
			$description = $this->input->post('description');
			$price = $this->input->post('price');
			$category = $this->input->post('category');
			//Pass user data to model
			$insertUserData = $this->Bookstore_Model->addBook($title, $author, $picture, $description, $price, $category);
			
			redirect('Admin/addbook');
			//Storing insertion status message.
			// if(!empty($insertUserData)){
			// 	$this->session->set_flashdata('success_msg', 'User data have been added successfully.');
			// 	redirect('Admin/addbook');
			// }else{
			// 	$this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
			// 	redirect('Admin/addbook');
			// }
		} else {  
			redirect('Admin/invalid');  
		} 	 
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
												////Admin Search

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//the admin search with pagination, first for the input from the view, then sets up the rules for pagination, and
	//it gathers information of the number of items and total number of possible rows to meet the criteria
	public function adminsearch($rowno=0)
	{
		if ($this->session->userdata('currently_logged_in'))   
		{
			// Search text
			$search_text = "";
			$search_text = $this->input->post('search');
			// Row per page
			$rowperpage = 3;
		
			// Row position
			if($rowno != 0){
			$rowno = ($rowno-1) * $rowperpage;
			}
			// All records count
			$allcount = $this->Bookstore_Model->getrecordCount($search_text);
		
			// Get records
			$users_record = $this->Bookstore_Model->getData($rowno,$rowperpage,$search_text);
			// Pagination Configuration
			$config['base_url'] = base_url().'index.php/Admin/adminsearch';
			$config['use_page_numbers'] = TRUE;
			$config['total_rows'] = $allcount;
			$config['per_page'] = $rowperpage;
		
			// Initialize
			$this->pagination->initialize($config); 
			$data['pagination'] = $this->pagination->create_links();
			$data['books'] = $users_record;
			$data['row'] = $rowno;
			$data['search'] = $search_text;
			
			// Load view
			$this->load->view('adminsearchresultsview',$data);
		} else {  
			redirect('Admin/invalid');  
		} 
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
												////Display single item

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//This function is called to retrieve a single book for the admin to check more info on it
	//It also provides statistics calculated on the module side d
	public function adminretrieveBook()
	{
		if ($this->session->userdata('currently_logged_in'))   
		{	
			$selection = $this->uri->segment(3);
			$data['book'] = $this->Bookstore_Model->displaysinglebookinfo($selection);
			$data['views'] = $this->Bookstore_Model->bookViews($selection);
			$data['times'] = $this->Bookstore_Model->timesviewed($selection);
			$this->load->view('adminbookdetails',$data);
		} else {  
			redirect('Admin/invalid');  
		}
    }
}