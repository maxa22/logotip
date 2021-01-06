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

        public function validateString($key, $string) {
            if(empty($string)) {
                Message::addError($key, 'Field can\'t be empty');
                return;
            }
            if(!preg_match('/^[a-zA-Z0-9\?\s]*$/', $string)) {
                Message::addError($key, 'Field can only contain alfanumeric characters');
                return;
            }
        }
        public function validateUsername($string) {
            if(empty($string)) {
                Message::addError('username', 'Username can\'t be empty');
                return;
            }
            if(!preg_match('/^[a-zA-Z0-9\s]*$/', $string)) {
                Message::addError('username', 'Field can only contain alfanumeric characters');
                return;
            }
        }

        public function validateEmail($email) {
            if(empty($email)) {
                Message::addError('email', 'Email can\'t be empty');
                return;
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                Message::addError('email', 'Provide valid email');
                return;
            }
        }
        public function passwordMatch($pass, $confirm) {
            if(empty($pass)) {
                Message::addError('password', 'Password can\'t be empty');
                return;
            }
            if($pass !== $confirm) {
                Message::addError('password', 'Passwords must match');
                return;
            }
        }

        public function validateNumber($key, $number){
            if(!is_numeric($number)) {
                Message::addError($key, 'Please provide valid price');
                return;
            }
        }

        public function validateFile($key, $k){
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