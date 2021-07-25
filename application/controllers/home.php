<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Home extends Public_Controller{
    
    /**
     * constructor method
     */
    public function __construct(){
		parent::__construct();
		}
	

    public function index(){
		echo '<div style="text-align:center; width:100%; padding-top: 50px;">
		<div  >
		<img style=" padding:10px; background-color:#8DC63F;" src="http://ats.chitral.com.pk/assets/uploads/system_global_settings/6ad01e5091f8647ece1be42617eae3a9.png" width="200" />
		</div>
		<h1>Welcome! we are working on ATS Chitral Website.</h1> 
		<h3>if you are admin click  Admin to login. thanks.</h3>
		<a href="http://ats.chitral.com.pk/admin/users/login" > <h1 style="margin-top:10px"> Admin </h1> </a>
		</div>';
    }
  
    
}        
