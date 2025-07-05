<?php

class Create extends Controller {

    public function index() {
        $this->view('create/index');
    }

        public function submit() {
            session_start();

            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($username) || empty($password) || strlen($password) < 8) {
                $_SESSION['registerError'] = "All fields are required and password must be at least 8 characters.";
                header("Location: /create");
                exit;
            }

            require_once 'app/models/User.php';
            $user = new User();
            $user->create($username, $password);

            $_SESSION['registerSuccess'] = "Successfully Registered.";
            header("Location: /login");
            exit;
        }
}