<?php
    session_start();
    if(!isset($_SESSION['id'])) {
        header('Location: ../login');
        exit();
    }
   
    if(isset($_POST['submit'])) {
        require_once('../include/autoloader.php');
        foreach($_POST as $key => $value) {
            //validating user input, searching for errors
            if(strpos($key, 'question') || strpos($key, 'optionName')) {
                Validate::validateString($key, $value);
            }
            if(strpos($key, 'optionPrice') || strpos($key, 'calculatorId')) {
                Validate::validateNumber($key, $value);
            }
            $error = Message::getError();
            if($error) {
                echo json_encode($error);
                exit();
            }
        }
        foreach($_FILES as $key => $value) {
            Validate::validateFile($key, $key);
            $optionId = explode('-', $key)[0];
            $optionId = Sanitize::sanitizeString($optionId);
            $args[$optionId]['image'] = Sanitize::sanitizeString($key);
            $error = Message::getError();
            if($error) {
                echo json_encode($error);
                exit();
            }
        }
        $calculatorId = Sanitize::sanitizeString($_POST['calculatorId']);
    //if no error was found we can write the inputs to db 
        foreach($_POST as $key => $value) {
            if(strpos($key, 'question') ) {
                $question = Sanitize::sanitizeString($value);
                $stepId = explode('-', $key)[0];
                $stepId = Sanitize::sanitizeString($stepId);
            }
            if(strpos($key, 'optionName')) {
                $optionId = explode('-', $key)[0];
                $optionId = Sanitize::sanitizeString($optionId);
                $args[$optionId]['name'] = Sanitize::sanitizeString($value);
                $args[$optionId]['stepId'] = $stepId;
                if(!strpos($key, 'new')) {
                    $args[$optionId]['id'] = $optionId;
                }
            }
            if(strpos($key, 'optionPrice')) {
                $args[$optionId]['price'] = Sanitize::sanitizeString($value);
            }
        }
        $step_args = array( 'id' => $stepId, 'name' => $question, 'calculatorId' => $calculatorId);
        $step = new Step($step_args);
        $step->save();
        foreach($args as $key => $value) {
            // check if file is new or updating
            if(!strpos($key, 'new')) {
                $oldOption = Option::findById($key);
                if(!strpos($value['image'], 'updated') && $_FILES[$args[$key]['image']]['error'] == 4 ) {
                    // if user doesen't upload image, don't update image path
                    $args[$key]['image'] = $oldOption['image'];
                } else if(!strpos($value['image'], 'updated') && $_FILES[$args[$key]['image']]['error'] == 4 ) {
                    continue;
                }
                else {
                    if($oldOption['image']) {
                        unlink('../images/' . $oldOption['image']);
                    }
                    Validate::validateFile($args[$key]['image'], $args[$key]['image']);
                }
            }
            $option = new Option($args[$key]);
            $option->save();
        }
        $error = Message::getError();
        unset($_SESSION['calculatorId']);
        echo json_encode($error);
        exit();
    } else {
        header('Location: ../calculators');
        exit();
    }
    
?>