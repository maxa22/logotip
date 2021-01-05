<?php
    session_start();
    if(!isset($_SESSION['id'])) {
        header('Location: ../login');
        exit();
    }
 
    require_once('autoloader.php');

    if(isset($_POST['submit'])) {

        $args['name'] = $_POST['name'];
        $args['estimateText'] = $_POST['estimateText'];
        $args['heading'] = $_POST['heading'];
        $args['calculatorText'] = $_POST['calculatorText'];
        $args['button'] = $_POST['button'];
        $args['logo'] = 'logo';
        $args['backgroundColor'] = substr($_POST['backgroundColor'], 1);
        $args['color'] = substr($_POST['color'], 1);
        $args['currency'] = $_POST['currency'];
        $args['userId'] = $_SESSION['id']; 
        $validate = new Validate;

        foreach($args as $key => $value) {
            $validate->validateString($key, $args[$key]);
            $args[$key] = Sanitize::sanitizeString($value);
        }

        $validate->validateFile($args['logo'], 'logo');
        $error = Message::getError();
        if($error) {
            echo json_encode($error);
            exit();
        }
        $calculator = new Calculator($args);
        $calculator->save();
        $error = Message::getError();
        if(!$error) {
            $_SESSION['calculatorId'] = $calculator->getId();
        } 
        echo json_encode($error);
        exit();
    } else {
        header('Location: ../calculators');
        exit();
    }
?>