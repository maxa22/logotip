<?php

    require_once('database.class.php');

    class User extends DatabaseObject {

        protected static $dbTable = 'user';
        protected static $dbFields = array('name', 'email', 'password');
        protected $id;
        protected $name;
        protected $email;
        protected $password;
        
        public function __construct($name, $email, $password) {
            $this->name = $name;
            $this->email = $email;
            $this->password = password_hash($password, PASSWORD_DEFAULT);
        }


        public static function login($email, $password) {
            $user = self::findByEmail($email);
            if(!$user) {
                Message::addError('error', 'Wrong email or password');
                return;
            }
            if(!password_verify($password, $user['password'])) {
                Message::addError('error', 'Wrong email or password');
                return;
            }
            
            return $user;
        }

        public static function findByEmail($email) {
            $database = Database::instance();
            $connection = $database->connect();
            $sql = "SELECT * FROM user WHERE email = :email";

            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch();
            if($result) {
                return $result;
            }
            return;
        }

    }