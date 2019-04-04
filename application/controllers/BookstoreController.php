<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
												////	greglak

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class BookstoreController extends CI_Controller 
{
	function __construct() {
		parent::__construct();
		// Load session library to track visitors
		$this->load->library('session');

		// Load Pagination library
		$this->load->library('pagination');
		
		// Load model for the main model
		$this->load->model('Bookstore_Model');
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
												////	Main Part, loads index pages + browsing by category

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//the index function runs a function call main which aims to produce the index page for users
	public function index()
	{
		$this->main();
	}

	//check all available categories on the module side and loads the main page
	public function main()
	{
		$data['categories'] = $this->Bookstore_Model->loadCategories();
        $this->load->view("usermain", $data);
	}

	//This function allows users to check the available genres/categories, and uses pagination to 
	//simply display the findings
	public function category()
	{
		$store = $this->uri->segment(3);
		$data['categories'] = $this->Bookstore_Model->loadCategories();
		$config = array();
        $config["base_url"] = base_url() . "index.php/BookstoreController/category/$store/";
        $config["total_rows"] = $this->Bookstore_Model->record_cat_count($store);
        $config["per_page"] = 3;
        $config["uri_segment"] = 4;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["results"] = $this->Bookstore_Model->fetch_bycategory($store, $config["per_page"], $page);
        $data["pagination"] = $this->pagination->create_links();
		$this->load->view('usercatview',$data);
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
												//// User Search + Pagination

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//This the function for the search, it also uses pagination with the help of segments
	public function search($rowno=0)
	{
		$data['categories'] = $this->Bookstore_Model->loadCategories();
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
		$config['base_url'] = base_url().'index.php/BookstoreController/search';
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $allcount;
		$config['per_page'] = $rowperpage;
	
		// Initialize
		$this->pagination->initialize($config); 
		$data['pagination'] = $this->pagination->create_links();
		$data['results'] = $users_record;
		$data['row'] = $rowno;
		$data['search'] = $search_text;
		
		// Load view
		$this->load->view('usersearchview',$data);
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
												////	Basket management

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//This is what captures the user's id hidden on the background, and concatenates the book id to the url
	// Then adds userid + bookId to the basket
	public function addToBasket()
	{
        $userID = $this->rememberUser();
        $bookID = $this->uri->segment(3);
        $this->Bookstore_Model->addToBasket($userID,$bookID);
        $data['items'] = $this->Bookstore_Model->retrieveBasket($userID);
        $this->load->view('userbasketview',$data);
    }
	// This check to see if visitor has been assigned a session, otherwise assigns one.
	public function rememberUser()
	{
        $remembered_user = $this->session->users;
        if(empty($remembered_user)){
            $userID = uniqid();
            $this->session->users = $userID;
        }
        return $this->session->users;
    }

	//This loads the basket view with the latest items added by using information provided by the session
	public function loadBasket()
	{
        $userID = $this->rememberUser();
        $data['items'] = $this->Bookstore_Model->retrieveBasket($userID);
        $this->load->view('userbasketview',$data);
    }

	//Function used to delete items for the basket.
	public function deletefrombasket()
	{
        $userID = $this->rememberUser();
        $bookID = $this->uri->segment(3);
        $this->Bookstore_Model->deletefrombasket($userID,$bookID);
        $this->loadBasket();
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
												////	Display single with session based stats

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Unlike the admin, this function will not only pull information on books but also to
	//a single table, so it also display a suggestion box depending on the book the user is currently checking.
	public function retrieveBook()
	{
        $userID = $this->rememberUser();
        $selection = $this->uri->segment(3);
        $this->Bookstore_Model->addBookView($userID,$selection);
        $data['books'] = $this->Bookstore_Model->displaysinglebookinfo($selection);
        $data['fivetop'] = $this->Bookstore_Model->suggestiongenerator($userID,$selection);
        $this->load->view('userbookview',$data);
	}
	
	

}