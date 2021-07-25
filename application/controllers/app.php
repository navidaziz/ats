<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class App extends Public_Controller{
    
    /**
     * constructor method
     */
    public function __construct(){
        
        
        
        parent::__construct();
        
		
		
    }
    //---------------------------------------------------------------
    
    
    /**
     * Default action to be called
     */ 
    public function index(){
        $this->db->query('INSERT INTO `app_url_request`( `data`) VALUES (\'request\')');
        redirect('https://play.google.com/store/apps/details?id=pk.com.chitral.ats.ats');
       
    }
    
    
}        
