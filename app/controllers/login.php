<?php

class Login extends Controller {

    public function index() {		
	    $this->view('login/index');
    }
    
	public function verify() {
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];

			$user = $this->model('User');
			$result = $user->authenticate($username, $password);

			if ($result) {
					$_SESSION['user_id'] = $result['id']; 
					header("Location: /home");
					exit;
			} else {
					echo "Invalid login";  
			}
	}


}
