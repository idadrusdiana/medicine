<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

// $value = null; // Define the variable and set a default value

// if (isset($_POST['jenis_rental'])) {
//     // empty() is not needed since 'checkbox' won't be sent
//     // if none was selected.

//     $value = implode(' , ', $_POST['jenis_rental']);
//     $value = test_input($value);

// }

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'yoyaku.id@gmail.com';                     // SMTP username
    $mail->Password   = 'Jalanpaskal1';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('yoyaku.id@gmail.com', 'Yoyaku System');
    $mail->addAddress('sri@sumroch.id', 'Yoyaku System');     // Add a recipient
    $mail->addAddress('official@yoyaku.id');    
    $mail->addCC('sri@sumroch.id');
    $mail->addBCC('idadrusdiana01@gmail.com');

    $jenis_rental = implode(', ', $_POST['jenis_rental']);

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Email dari calon customer';
    $mail->Body    = "    
        Dari         : {$_POST['name']} <br>
        Nama Rental  : {$_POST['name_rental']} <br>
        Email        : {$_POST['email']} <br>
        No. WA       : {$_POST['phone']} <br>
        Subject      : {$_POST['subject']} <br>
        Jenis Rental : {$jenis_rental} <br>
        Jumlah Unit  : {$_POST['jumlah']} <br>
        Pertanyaan   : {$_POST['pertanyaan']} <br>
   ";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}