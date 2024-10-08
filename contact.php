<?php 
require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

var_dump(class_exists('PHPMailer\PHPMailer\PHPMailer'));

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-Width");




$data = json_decode(file_get_contents("php://input"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$fullname = htmlspecialchars($data->fullname);
	$email = htmlspecialchars($data->email);
	$message = htmlspecialchars($data->message);
     

    var_dump($message);  

    // if ($email) {
        $mail = new PHPMailer(true);
        
        try {
            //Server settings
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->Username = "johnrayglitse@gmail.com"; // 
            $mail->Password = "djquvzncvtblnoyk"; // djquvzncvtblnoyk

            //Recipients
            $mail->setFrom($email, $fullname);
            $mail->addAddress("johnrayglitse@gmail.com"); 
            $mail->addReplyTo("johnrayglitse@gmail.com");

            //Content
            $mail->Subject = $email;
            $mail->Body = $message;

            if ($mail->send()) {
                $status = "success";
                $response = "Email sent successfully.";
            } else {
                $status = "error";
                $response = "Email could not be sent.";
            }
        } catch (Exception $e) {
            $status = "error";
            $response = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $status = "error";
        $response = "Invalid email address.";
    // }
}

 ?>

 

 
