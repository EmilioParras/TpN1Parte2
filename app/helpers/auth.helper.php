<?php

class AuthHelper {

    // Verifica que el user este logeado, si no lo redirige al login. 

    public function checkLogged() {
        session_start();
        if (!isset($_SESSION['IS_LOGGED'])) {
            header ("Location : " . LOGIN);
            die();
        }
    }
}