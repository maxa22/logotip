<?php
    // - calculating the price of the options choosen by the user
    // - updating status of the step, and status of the choosen option in matching database tables and rows
    // - storing the price in a cookie and displaying it to user

    session_start();
    if(isset($_POST['submit'])) {
    // getting the prices of the selected radio inputs, calculating them and storing in price variable
    require_once('autoloader.php');
    $price = 0;
    $validate = new Validate;
    $steps = array();
    $choosenOptions = array();
    foreach($_POST as $key => $value) {
        if(strpos($key, 'answer')) {
            // validate and sanitize input
            $id = Sanitize::sanitizeString(explode('-', $value)[2]);
            $stepId = Sanitize::sanitizeString(explode('-', $value)[0]);
            $validate->validateString($key, $id);
            $validate->validateString($key, $stepId);

            $sql = "SELECT * FROM options WHERE id = ?";
            $option = DatabaseObject::findById($sql, $id);
            array_push($choosenOptions, $option);

            $sql = "SELECT * FROM step WHERE id = ?";
            $step = DatabaseObject::findById($sql, $stepId);
            array_push($steps, $step);
            $price += $option['price'];
        }
    }

    $error = Message::getError();
    if($error) {
        print_r($error);
        exit();
    }

    //updating all stepStatus fields from used steps
    foreach($steps as $stepArguments) {
        $stepArguments['stepStatus'] = '1';
        $step = new Step($stepArguments);
        $step->save();
    }
    //updating all optionStatus fields that are selected
    foreach($choosenOptions as $optionArguments) {
        $optionArguments['optionStatus'] = '1';
        $option = new Option($optionArguments);
        $option->save();
    }

    setcookie('price', $price, time() + (86400 * 30), '/');

    header('Location: ../estimate/' . $step->calculatorId);
    exit();
    } else {
        header('Location: index');
        exit();
    }
?>