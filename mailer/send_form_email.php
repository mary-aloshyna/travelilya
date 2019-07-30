<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require 'vendor/autoload.php';

  // Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['letter'])) {
  $email_to = 'malakhova.liliya.1999@gmail.com';
  $password = 'flexamerica';
  $email_subject = 'TraveLilya New request';

  $sender_name = $_POST['name'];
  $sender_email = $_POST['email'];
  $letter = $_POST['letter'];

  $email_message = '<html>
    <body>
      <p><b>Имя:</b> '.$sender_name.'</p>
      <p><b>Почта:</b> '.$sender_email.'</p>
      <p><b>Запрос:</b> '.$letter.'</p>
    </body>
  </html>';

  try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = $email_to;                     // SMTP username
    $mail->Password   = $password;                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($sender_email, $sender_name);
    $mail->addAddress($email_to);     // Add a recipient
    $mail->addReplyTo($sender_email, $sender_name);

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $email_subject;
    $mail->Body    = $email_message;

    $mail->send();
    
    // echo "<script type='text/javascript'>alert('Your mail was successfully sent');</script>";
    echo 'Message has been sent';
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}
?>