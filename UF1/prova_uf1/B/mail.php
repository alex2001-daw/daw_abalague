<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if(isset($_POST["enviamail"])){
    if($_POST["resultat"]==11){
        $passuser=generateRandomString();
        $pass=md5($passuser);
        $user=$_POST["passreco"];

        $conn = new mysqli('localhost', 'abalague', 'abalague', 'abalague_db_proba');
        $sqlup = "UPDATE usuaris_examen SET password = '$pass' WHERE username='$user'";
        $resultat = (mysqli_query($conn, $sqlup) or die("Error". mysqli_error($conn)));

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 2;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'dawpractica2020@gmail.com';                     // SMTP username
            $mail->Password   = 'practicadaw2020';                               // SMTP password
            $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom($_POST["passreco"], 'Mailer');
            $mail->addAddress('dawpractica2020@gmail.com', 'Alex Balague');     // Add a recipient             // Name is optional
            $mail->addReplyTo('dawpractica2020@gmail.com', 'Information');


            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Has solicitat password recovery';
            $mail->Body    = '<p>La nova contrassenya es '.$passuser;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }else{
        //header("Location: http://dawjavi.insjoaquimmir.cat/abalague/UF1/prova_uf1/B/recovery.php");
        echo "";
    }
}


$passuser=generateRandomString();
$pass=md5($passuser);
$user=$_POST["passreco"];

$conn = new mysqli('localhost', 'abalague', 'abalague', 'abalague_db_proba');
$sqlup = "UPDATE usuaris_examen SET password = '$pass' WHERE username='$user'";
$resultat = (mysqli_query($conn, $sqlup) or die("Error". mysqli_error($conn)));

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'dawpractica2020@gmail.com';                     // SMTP username
    $mail->Password   = 'practicadaw2020';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom($_POST["passreco"], 'Mailer');
    $mail->addAddress('dawpractica2020@gmail.com', 'Alex Balague');     // Add a recipient             // Name is optional
    $mail->addReplyTo('dawpractica2020@gmail.com', 'Information');


    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Has solicitat password recovery';
    $mail->Body    = '<p>La nova contrassenya es '.$passuser;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>