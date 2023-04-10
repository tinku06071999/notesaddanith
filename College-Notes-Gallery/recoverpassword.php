<?php include 'includes/connection.php';?>
<?php include 'includes/header.php';?>
<?php include 'includes/navbar.php';?>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['recover'])) {
  $email = mysqli_real_escape_string($conn , $_POST['email']);
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $query = "SELECT email FROM users WHERE email = '$email'";
  $run = mysqli_query($conn , $query) or die (mysqli_error($conn) );
  if (mysqli_num_rows($run) > 0) {
    function generateRandomString($length = 5) {
      return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
  }
   
  $token_tmp = generateRandomString();
  $token = md5($token_tmp);
  $url = $_SERVER['REQUEST_URI'];
  $parts = explode('/',$url);
  $dir = $_SERVER['SERVER_NAME'];
  for ($i = 0; $i < count($parts) - 1; $i++) {
   $dir .= $parts[$i] . "/";
  }
  






require 'C:\xampp\htdocs\College-Notes-Gallery\PHPMailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\College-Notes-Gallery\PHPMailer\src\Exception.php';
require 'C:\xampp\htdocs\College-Notes-Gallery\PHPMailer\src\SMTP.php';
$smtpHost = 'smtp-relay.sendinblue.com';
$smtpPort = 587;
$smtpUsername = 'tinkuv049@gmail.com';
$smtpPassword = 'AwFh49rQ7B3q6nGs';

$mail = new PHPMailer(true);

// Set mailer to use SMTP
$mail->isSMTP();
$mail->Host = $smtpHost;
$mail->Port = $smtpPort;
$mail->SMTPAuth = true;
$mail->Username = $smtpUsername;
$mail->Password = $smtpPassword;
$mail->isHTML(true);
// Set email message details
$mail->setFrom('tinkuv049@gmail.com', 'Notes Adda');
$mail->addAddress($email);
$bodyContent = '<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
  </head>
  <body>
    <p>Dear ';
    $bodyContent .=$email;
    $bodyContent .= ',</p>
    <p>We received a request to reset your password for your Notes Adda account. If you did not make this request, please ignore this email.</p>
    <p>To reset your password, please click on the link below:</p>
    <p><a href="';
    $bodyContent .= 'http://' . $dir . 'verifytoken.php?token='.$token;
    $bodyContent .=  '">Reset Password</a></p>
    <p>Thank you for using  Notes adda </p>
    <p>Best regards,</p>
    <p>The Notes adda Team</p>
  </body>
</html>
';


$mail->Subject = 'Email from Notes Adda ';
$mail->Body    = $bodyContent;

// Send the email
// $mail->send();

$query2 = "UPDATE users set token = '$token' WHERE email = '$email'";
$run = mysqli_query($conn , $query2) or die(mysqli_error($conn));
$count = mysqli_affected_rows($conn);
if($mail->send() && ($count > 0)) {
	echo "<center> <font color = 'green' >Email with recover password link has been sent </font><center> " ;
} else {

    echo  "<center> <font color = 'red' >'Message could not be sent.'</font><center> ";
    echo  "<center> <font color = 'red' >'Mailer Error: ' . $mail->ErrorInfo </font><center> ";
}
}
else {
	echo "<center> <font color = 'red' > Entered email does not match to any record </font><center> ";
}
}
else {
	echo "<center> <font color = 'red' > Invalid email type </font><center> ";
}
}



?>




 <div class="login-card">
    <h1>Recover Password</h1><br>
  <form action = "" method="POST">
    <input type="text" name="email" placeholder="Enter your Email" required="">
     <input type="submit" name="recover" class="login login-submit" value="send">
  </form>
    
  <div class="login-help">
    <a href="signup.php">Register</a> • <a href="login.php">Login</a>
  </div>
</div>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>

  
</body>
</html>
 
