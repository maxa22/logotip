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

        foreach($args as $key => $value) {
            Validate::validateString($key, $args[$key]);
            $args[$key] = Sanitize::sanitizeString($value);
        }
        $args['contactForm'] = $_POST['contactForm'];
        $args['includeContactForm'] = $_POST['includeContactForm'] ?? '0';
        if($args['contactForm']) {
            Validate::validateString('contactForm', $args['contactForm']);
            $args['contactForm'] = Sanitize::sanitizeString($args['contactForm']);
        }
        if($args['includeContactForm']) {
            Validate::validateString('includeContactForm', $args['includeContactForm']);
            $args['includeContactForm'] = Sanitize::sanitizeString($args['includeContactForm']);
        }

        Validate::validateFile($args['logo'], 'logo');
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