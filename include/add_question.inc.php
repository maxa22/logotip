<?php
    session_start();
    if(!isset($_SESSION['id'])) {
        header('Location: ../login');
    }
    if(isset($_POST['submit'])) {
        require_once('../include/autoloader.php');
        $i = 1;
        while(isset($_POST[$i . 'question'])) {
            $validate = new Validate;
            //validating user input, searching for errors
            $validate->validateString($i . 'question', $_POST[$i . 'question']);
            $error = Message::getError();
            if(!$error) {
                $j = 1;
                while(isset($_POST[$i . 'optionName' . $j])) {
                    $validate->validateString($i . 'optionName' . $j, $_POST[$i . 'optionName' . $j]);
                    $validate->validateNumber($i . 'optionPrice' . $j, $_POST[$i . 'optionPrice' . $j]);
                    $validate->validateFile($i . 'optionImage' . $j, $i . 'optionImage' . $j);
                    $error = Message::getError();
                    if($error) {
                        echo json_encode($error);
                        exit();
                    }
                    $j++;
                }
            $i++;
            } else {
                echo json_encode($error);
                exit();
            }
        }
    //if no error was found we can write the inputs to db 
        $i = 1;
        while(isset($_POST[$i . 'question'])) {

            $calculator_args['name'] = Sanitize::sanitizeString($_POST[$i . 'question']);
            $calculator_args['calculatorId'] = $_SESSION['calculatorId'];
            $step = new Step($calculator_args);
            $step->save();
            $id = $step->getId();
            $error = Message::getError();
            if(!$error) {
                $j = 1;
                while(isset($_POST[$i . 'optionName' . $j])) {
                    $args['name'] = Sanitize::sanitizeString($_POST[$i . 'optionName' . $j]);
                    $args['price'] = Sanitize::sanitizeString($_POST[$i . 'optionPrice' . $j]);
                    $args['image'] = $i . 'optionImage' . $j;
                    $args['stepId'] = $id;
                    $option = new Option($args);
                    $option->save();
                    $error = Message::getError();
                    if($error) {
                        echo json_encode($error);
                        exit();
                    }
                    $j++;
                }
            } else {
                echo json_encode($error);
                exit();
            }
            ++$i;
        }
        unset($_SESSION['calculatorId']);
        echo json_encode($error);
        exit();
    } else {
        header('Location: ../calculators');
        exit();
    }
    
?>