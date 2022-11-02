<?php
require_once './app/models/user.model.php';
require_once './app/views/user.view.php';

    class AuthController {

        private $model; 
        private $userView;
        private $authview;
        private $email; 

        public function __construct() {
            $this->model = new UserModel();
            $this->userView = new UserView();
            session_start(); 
            $this->setEmail();
        }

        public function setEmail() {
            if (isset ($_SESSION['EMAIL_USER'])){
                $this->email = $_SESSION['EMAIL_USER'];
            } 
        }

        public function showFormLogin()  {
            $this->userView->showFormLogin($this->email);
        }

        public function validateUser() {
                // tomo los datos del form
                $email = $_POST['logEmail'];
                $password = $_POST['logPassword'];

                $user = $this->model->getUserByEmail($email);

                // verifico que el usuario exista y que los datos coincidan
                if ($user && password_verify($password, $user->password)) {
                
                    session_start();
                    $_SESSION['EMAIL_USER'] = $user->email;
                 
                header("Location: " . INICIO );  
            } else {
                $this->userView->showFormLogin($this->email, "El usuario o la contraseña son incorrectos");
            }
        }

        public function logout() {
            session_start();
            session_destroy();
            header ("Location: " . BASE_URL);
        }

}
