<?php
class users_controller extends base_controller {

        /*-------------------------------------------------------------------------------------------------
        
        -------------------------------------------------------------------------------------------------*/
    public function __construct() {
    
            # Make sure the base controller construct gets called
                parent::__construct();
    } 


        /*-------------------------------------------------------------------------------------------------
        Display a form so users can sign up        
        -------------------------------------------------------------------------------------------------*/
    public function signup() {
       
       # Set up the view
       $this->template->content = View::instance('v_users_signup');
       
       # Render the view
       echo $this->template;
       
    }
    
    
    /*-------------------------------------------------------------------------------------------------
    Process the sign up form
    -------------------------------------------------------------------------------------------------*/
    public function p_signup() {
                        
            # Mark the time
            $_POST['created']  = Time::now();
            $_POST['modified'] = Time::now();
            
            # Hash password
            $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
            
            # Create a hashed token
            $_POST['token']    = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
            
            # Insert the new user    
            DB::instance(DB_NAME)->insert_row('users', $_POST);
            
            # For now, just confirm they've signed up - 
            # You should eventually make a proper View for this
            //echo 'You\'re signed up';
            
            # Send them to the login page
            Router::redirect('/users/login');
            
    }


        /*-------------------------------------------------------------------------------------------------
        Display a form so users can login
        -------------------------------------------------------------------------------------------------*/
    public function login() {
    
            $this->template->content = View::instance('v_users_login');  
            $this->template->title   = "Login";

            echo $this->template;   
       
    }
    
    
    /*-------------------------------------------------------------------------------------------------
    Process the login form
    -------------------------------------------------------------------------------------------------*/
    public function p_login() {
                      
        # Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        # Hash submitted password so we can compare it against one in the db
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        # Search the db for this email and password
        # Retrieve the token if it's available
        $q = "SELECT token 
            FROM users 
            WHERE email = '".$_POST['email']."' 
            AND password = '".$_POST['password']."'";

        $token = DB::instance(DB_NAME)->select_field($q);

        # If we didn't find a matching token in the database, it means login failed
        if(!$token) {

            # Send them back to the login page
            Router::redirect("/users/login/");
            


        # But if we did, login succeeded! 
        } else {

            /* 
            Store this token in a cookie using setcookie()
            Important Note: *Nothing* else can echo to the page before setcookie is called
            Not even one single white space.
            param 1 = name of the cookie
            param 2 = the value of the cookie
            param 3 = when to expire
            param 4 = the path of the cooke (a single forward slash sets it for the entire domain)
            */
            setcookie("token", $token, strtotime('+1 year'), '/');

            # Send them to the main page - or whever you want them to go
            Router::redirect("/index.php");

    }
           
    }


        /*-------------------------------------------------------------------------------------------------
        No view needed here, they just goto /users/logout, it logs them out and sends them
        back to the homepage.        
        -------------------------------------------------------------------------------------------------*/
    public function logout() {
       
        # Generate and save a new token for next login
        $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

        # Create the data array we'll use with the update method
        # In this case, we're only updating one field, so our array only has one entry
        $data = Array("token" => $new_token);

        # Do the update
        DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

        # Delete their token cookie by setting it to a date in the past - effectively logging them out
        setcookie("token", "", strtotime('-1 year'), '/');

        # Send them back to the main index.
        Router::redirect("/index.php");
       
    }

        /*-------------------------------------------------------------------------------------------------
        
        -------------------------------------------------------------------------------------------------*/
    public function profile() {
                
        # If user is blank, they're not logged in; redirect them to the login page
        if(!$this->user) {
            Router::redirect('/users/login');
        }

        # If they weren't redirected away, continue:

        # Setup view
        $this->template->content = View::instance('v_users_profile');
        $this->template->title   = "Profile of ".$this->user->first_name;

        # Render template
        echo $this->template;
    }

    public function error(){
               # Set up the view
       $this->template->content = View::instance('v_users_error');
       
       # Render the view
       echo $this->template;
    }

} # end of the class
