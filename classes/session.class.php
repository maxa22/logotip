<?php

    class Session {
        public function __construct($id) {
            session_start();
            $_SESSION['id'] = $id;
        }
        public function addSession($name) {
            $_SESSION[$name] = $name;
        }
        static function unset() {
            session_unset();
            unset($_SESSION['id']);
        }
    }
?>