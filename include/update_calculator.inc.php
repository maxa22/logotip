<?php
    session_start();
    if(!isset($_SESSION['id'])) {
        header('Location: ../login');
        exit();
    }
 
    require_once('autoloader.php');

    if(isset($_POST['submit'])) {
       
        foreach($_POST as $key => $value) {
            if(strpos($key, 'calculatorName')) {
                Validate::validateString($key, $value);
                $args['id'] = explode('-', $key)[0];
                $args['name'] = Sanitize::sanitizeString($value);
                break;
            }
        }
        $args['estimateText'] = $_POST['estimateText'];
        $args['heading'] = $_POST['heading'];
        $args['calculatorText'] = $_POST['calculatorText'];
        $args['button'] = $_POST['button'];
        $args['backgroundColor'] = substr($_POST['backgroundColor'], 1);
        $args['color'] = substr($_POST['color'], 1);
        $args['currency'] = $_POST['currency'];
        $args['userId'] = $_SESSION['id']; 
                
        foreach($args as $key => $value) {
            if(strpos(!$key, 'calculatorName')) {
                Validate::validateString($key, $args[$key]);
                $args[$key] = Sanitize::sanitizeString($value);
            }
        }

        $args['contactForm'] = $_POST['contactForm'];
        $args['includeContactForm'] = $_POST['includeContactForm'] ?? '0';
        if(!empty($args['contactForm'])) {
            Validate::validateString('contactForm', $args['contactForm']);
            $args['contactForm'] = Sanitize::sanitizeString($args['contactForm']);
        }
        if(!empty($args['includeContactForm'])) {
            Validate::validateString('includeContactForm', $args['includeContactForm']);
            $args['includeContactForm'] = Sanitize::sanitizeString($args['includeContactForm']);
        }

        $error = Message::getError();
        if($error) {
            echo json_encode($error);
            exit();
        } 
        // get old logo if user doesn't upload new logo
        $calculatorToBeupdated = Calculator::findById($args['id']);
        $args['logo'] = isset($_FILES['logo']) ? 'logo' : 'logo-updated';
        if(isset($_FILES['logo']) && $_FILES[$args['logo']]['error'] == 4 ) {
            // if user doesen't upload image, don't update image path
            $args['logo'] = $calculatorToBeupdated['logo'];
        } else {
            if($calculatorToBeupdated['logo']) {
                unlink('../images/' . $calculatorToBeupdated['logo']);
            }
            Validate::validateFile($args['logo'], $args['logo']);
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