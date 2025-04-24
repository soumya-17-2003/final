<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require 'src/Exception.php';
    require 'src/PHPMailer.php';
    require 'src/SMTP.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
        $receiverEmail = $_POST['email'];

        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'mohantysoumya950@gmail.com'; // Your email
            $mail->Password = 'owoo wrlc wezd wyoh'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
            $mail->Port = 587; // TCP port to connect to

            // Recipients
            $mail->setFrom('mohantysoumya950@gmail.com', 'CS');
            $mail->addAddress($receiverEmail); // Add a recipient
            $mail->addReplyTo('mohantysoumya950@gmail.com', 'CID');
            $mail->addCC("susmitamohanty2000@gmail.com");
            $mail->addBCC('soumyaranjan23@lpu.in');

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Hello!';
            $mail->Body = 'Hi, This is the link to upload your video resume
            https://drive.google.com/drive/folders/1mn7ewaGJNIampndayVzEuzY749hApHct
            ';
            $mail->AltBody = 'Hi, sorry the link could not be send .Kindly open it again';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    ?>