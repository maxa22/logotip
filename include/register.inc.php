<?php 
    require('autoloader.php');

    if(isset($_POST['submit'])) {

        $username = Sanitize::sanitizeString($_POST['username']);
        $email = Sanitize::sanitizeString($_POST['email']);
        $password = Sanitize::sanitizeString($_POST['password']);
        $confirmPassword = Sanitize::sanitizeString($_POST['confirmPassword']);
        
        $validate = new Validate;
        $validate->validateUsername($username);
        $validate->validateEmail($email);
        $validate->passwordMatch($password, $confirmPassword);

        $error = Message::getError();
        
        $user = User::findByEmail($email);

        if($user) {
            Message::addError('email', 'Email already in use');
            echo json_encode(Message::getError());
            exit();
        }

        if(!$error){
            $user = new User($username, $email, $password);
            $user->save();
            $error = Message::getError();
        }
        echo json_encode($error);
        exit();
     } else {
        header('Location: ../register');
        exit();
     }
?>