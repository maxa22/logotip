<?php 

    class Validate {

        private $fileUploadError = array(
            UPLOAD_ERR_INI_SIZE		=> "The uploaded file exceeds the upload_max_filesize directive in php.ini",
            UPLOAD_ERR_FORM_SIZE    => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
            UPLOAD_ERR_PARTIAL      => "The uploaded file was only partially uploaded.",
            UPLOAD_ERR_NO_FILE      => "No file was uploaded.",               
            UPLOAD_ERR_NO_TMP_DIR   => "Missing a temporary folder.",
            UPLOAD_ERR_CANT_WRITE   => "Failed to write file to disk.",
            UPLOAD_ERR_EXTENSION    => "A PHP extension stopped the file upload.");

                /**
         * if string is empty add error message
         * if string does not match the pattern add error message
         * allowed alfanumeric characters, spaces and / . -
         *
         * @param [string] $key
         * @param [string] $string
         * @return void
         */
        public static function validateString($key, $string) {
            if(empty($string)) {
                Message::addError($key, 'Field can\'t be empty');
                return;
            }
            if(!preg_match('/^[a-zA-Z\p{L}0-9\-\/\s,\._\'\?]*$/u', $string)) {
                Message::addError($key, 'Field can only contain alfanumeric characters');
                return;
            }
        }
        public static function validateUsername($string) {
            if(empty($string)) {
                Message::addError('username', 'Username can\'t be empty');
                return;
            }
            if(!preg_match('/^[a-zA-Z0-9\p{L}\s]*$/u', $string)) {
                Message::addError('username', 'Field can only contain alfanumeric characters');
                return;
            }
        }

        public static function validateEmail($email) {
            if(empty($email)) {
                Message::addError('email', 'Email can\'t be empty');
                return;
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                Message::addError('email', 'Provide valid email');
                return;
            }
        }

        public static function passwordMatch($password, $confirm) {
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
    
            if(!$uppercase || !$lowercase || !$number || strlen($password) < 6) {
                Message::addError('password', 'Password must be at least 8 characters long, must contain one uppercase, one lowercase letter and one number');
                return;
            }
            if(empty($password)) {
                Message::addError('password', 'Field can\'t be empty');
                return;
            }
            if($password !== $confirm) {
                Message::addError('password', 'Passwords must match');
                return;
            }
        }

        public static function validateNumber($key, $number){
            if(!is_numeric($number)) {
                Message::addError($key, 'Please provide valid price');
                return;
            }
        }

        public static function validateFile($key, $k){
            if($_FILES[$k]['error'] == 4) {
                return;
            }
            $allowed = array('jpg', 'jpeg', 'png');
            $extension = pathinfo($_FILES[$k]["name"], PATHINFO_EXTENSION);
            $extension = strtolower($extension);
            if(!in_array($extension, $allowed) && !empty($extension)) {
                Message::addError($key, 'Sorry, only JPG, JPEG, PNG files are allowed.');
                return;
            } 
            if($_FILES[$k]['error'] != 4 && $_FILES[$k]['error'] != 0) {
                Message::addError($key, Message::fileUploadError[ $_FILES[$k]['error']]);
                return;
            }
            if (($_FILES[$k]["size"] > 2000000)) {
                Message::addError($key, "Image size exceeds 2MB");
                return;
            }
        }
    } // end of class
?>