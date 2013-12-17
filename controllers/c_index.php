<?php

class index_controller extends base_controller {
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
	} 
		
	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/index/index/
	-------------------------------------------------------------------------------------------------*/
	public function index() {
		
		# Any method that loads a view will commonly start with this
		# First, set the content of the template with a view file
			$this->template->content = View::instance('v_index_index');
			
		# Now set the <title> tag
			$this->template->title = "Homepage";
	
		/*# CSS/JS includes
			
		$client_files_head = Array("css/styles.css");
	    	$this->template->client_files_head = Utils::load_client_files($client_files);
	    	
	    	$client_files_body = Array("css/styles.css");
	    	$this->template->client_files_body = Utils::load_client_files($client_files_body);  
		*/
		# Render the view
			echo $this->template;

			require_once(DOC_ROOT."/core/libraries/DB.php");
			#echo Time::now();

	} # End of method

	public function shop(){
				# Any method that loads a view will commonly start with this
		# First, set the content of the template with a view file
			$this->template->content = View::instance('v_index_shop');
			
		# Now set the <title> tag
			$this->template->title = "ChipperClipper Shopping List";
			
			echo $this->template;
	}
	
	
} # End of class
