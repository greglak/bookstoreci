<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
												////	greglak

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class Bookstore_Model extends CI_Model 
{
    //function loads database for easier commnunication
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Function counts all books at the books table for pagination calculation
    public function record_count() 
    {
        return $this->db->count_all('books');
    }

    //Function checks how many items we have in a category
    public function record_cat_count($store) 
    {
        $this->db->where('category', $store);
        return $this->db->from('books')->count_all_results();
    }

    //This function fetches all book, to calculate the beginning and ending of the pagination
    public function fetch_allbooks($limit, $start) 
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get('books');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    //This function will fetch findings by category
    public function fetch_bycategory($store, $limit, $start) 
    {
        $this->db->limit($limit, $start);
        $this->db->where('category', $store); 
        $query = $this->db->get('books'); 
        return $query->result_array();
    }
    
    //This function helps load info on the left side category navigation
    public function loadCategories() 
    {
        $this->db->select('category');
        $this->db->distinct();
        $query = $this->db->get('books');
        return $query->result();
    }
    
    //this verifies the submitted credentials with the ones from the database
    public function log_in_correctly() 
    {  
        $this->db->where('username', $this->input->post('username'));  
        $this->db->where('password', $this->input->post('password'));  
        $query = $this->db->get('user_login');  

        if ($query->num_rows() == 1)  
        {  
            return true;  
        } else {  
            return false;  
        }  
    }
    
    //This functions adds a new category to the book_categories table
    public function addCategory($newcategory) 
    {
        $query="insert into book_categories values('','$newcategory')";
        $this->db->query($query);
    }

    //This function adds a new book to the books table
    public function addBook($title, $author, $picture, $description, $price, $category)
    {
        $query="insert into books values('', '$title', '$author', '$picture', '$description', '$price', '$category')";
        $this->db->query($query);  
    }

    // Fetch records from the books table to check whether there are any titles or authors under the same name.
    public function getData($rowno,$rowperpage,$search="") {
        $this->db->select('*');
        $this->db->from('books');
        if($search != '')
        {
            $this->db->like('title', $search);
            $this->db->or_like('author', $search);
        }
        $this->db->limit($rowperpage, $rowno); 
        $query = $this->db->get();
        return $query->result_array();
    }

    // Select total records of findings for pagination
    public function getrecordCount($search = '') 
    {
        $this->db->select('count(*) as allcount');
        $this->db->from('books');
        if($search != ''){
        $this->db->like('title', $search);
        $this->db->or_like('author', $search);
        }
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['allcount'];
    }

    //Function allocates a userid and bookid to the userbasket
    public function addToBasket($userID, $bookID)
    {
        $data = array(
            'userid' => $userID,
            'bookId' => $bookID);
        $this->db->insert('user_basket', $data);
    }

    //Function will check credentials and check to see if there's anything in basket
    public function retrieveBasket($userID)
    {
        $this->db->select('bookId');
        $this->db->where('userid', $userID);
        $query = $this->db->get('user_basket');
        $result = $query->result();
        if($query->num_rows() == 0){
            return false;
        }
        $books=array();
        foreach($result as $bookID){
            array_push($books,"$bookID->bookId");
        }
        $this->db->select('*');
        $this->db->where_in('bookId',$books);
        $query = $this->db->get('books');
        $data = $query->result();
        return $data;
    }

    //Function deletes items from the basket
    public function deletefrombasket($userID,$bookID)
    {
        $this->db->where('userid',$userID);
        $this->db->where('bookId',$bookID);
        $this->db->delete('user_basket');
    }

    //This function increments the number of view per book
    public function addBookView($userID,$bookID)
    {
        $data = array(
            'userid' => $userID,
            'bookId' => $bookID);
        $this->db->insert('book_views', $data);
    }

    //used to retrieve information on a single book according to its bookid
    public function displaysinglebookinfo($bookID)
    {
        $this->db->where('bookId',$bookID);
        $result_set = $this->db->get('books');
        return $result_set->result();
    }

    //This is the suggestion generator with consists of nested queries
    public function suggestiongenerator($userID,$bookID)
    {
        $result_set = $this->db->query("SELECT bookId, picture FROM books WHERE bookId IN (SELECT bookId from book_views WHERE userid IN(SELECT userId FROM book_views WHERE bookId=$bookID AND userid <> '$userID') GROUP BY bookId ORDER BY COUNT(*) DESC) AND bookId <> '$bookID' LIMIT 5;");
        return $result_set->result();
    }

    //The function to allow admin to search book according to title and author
    public function adminsearch($post)
    {
        $this->db->select('*');
        $this->db->like('title', $post);
        $this->db->or_like('author', $post);
        $query = $this->db->get('books'); 
        return $query->result_array();
    }

    //This will calculate the number of view of a specifc bookId
    public function bookViews($bookID)
    {
        $this->db->where('bookId', $bookID);
        $query = $this->db->count_all_results('book_views');
        return $query;
    }

    //Extra feature to display info on dates, when the books were accessed.
    public function timesviewed($bookID)
    {
        $this->db->select('viewed_at');
        $this->db->where('bookId', $bookID);
        $query = $this->db->get('book_views');
        return $query->result_array();
    }
}
