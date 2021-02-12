<?php 
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    // Load Composer's autoloader
    require '../vendor/autoload.php';
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        // if(!isset($_POST['submit'])) {
        //   header('Location: ../examples');
        //   exit();
        // }
        require_once('autoloader.php');
        $email = $_POST['email'];
        Validate::validateEmail($email);
        $fullname = Sanitize::sanitizeString($_POST['fullname']);
        Validate::validateString('fullname', $fullname);
        $text = Sanitize::sanitizeString($_POST['text']);
        Validate::validateString('text', $text);
        $error = Message::getError();
        if($error) {
            echo json_encode($error);
            exit();
        }
        $mail->CharSet = 'UTF-8';
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   // Enable verbose debug output
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hello@labmail.me';
        $mail->Password = 'Email.22122020.Managment.101!';
        $mail->SMTPSecure = 'tls';                                         
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->From = 'hello@labmail.me';
        $mail->FromName = $fullname;
        $mail->addAddress('mldnmksmvc@gmail.com');                  // Add a recipient
        $mail->addReplyTo($email, $fullname);

        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = 'Logotip calculator contact';
        $mail->Body    = $text;
        $mail->AltBody = $text;


        $mail->send();
        echo json_encode('');
        exit();
    } catch (Exception $e) {
        echo json_encode(array('error', "Message could not be sent. Mailer Error " . $mail->ErrorInfo));
        exit();
    }
