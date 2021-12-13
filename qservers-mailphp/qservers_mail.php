<?php

require_once "Mail.php"; // PEAR Mail package
require_once ('Mail/mime.php'); // PEAR Mail_Mime packge

 $name = $_POST['name']; // form field
 $email = $_POST['email']; // form field
  $id = $_POST['identifier']; // form field
 $message = $_POST['message']; // form field

 if (isset($_POST['submitForm'])){

 $from = "info@adiremarket.com"; //enter your email address
 $to = "info@adiremarket.com"; //enter the email address of the contact your sending to
 $subject = "Contact Form"; // subject of your email

$headers = array ('From' => $from,'To' => $to, 'Subject' => $subject);

$text = ''; // text versions of email.
$html = "<html><body>Name: $name <br> Email: $email <br> ID: $id <br>Message: $message <br></body></html>"; // html versions of email.

$crlf = "\n";

$mime = new Mail_mime($crlf);
$mime->setTXTBody($text);
$mime->setHTMLBody($html);

//do not ever try to call these lines in reverse order
$body = $mime->get();
$headers = $mime->headers($headers);

 $host = "localhost"; // all scripts must use localhost
 $username = "info@adiremarket.com"; //  your email address (same as webmail username)
 $password = "Eldorado2000#"; // your password (same as webmail password)


$smtp = Mail::factory('smtp', array ('host' =>$host, 'auth' => true, 'username' => $username, 'password' => $password, 'port' => '25')); 

$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
echo("<p>" . $mail->getMessage() . "</p>");
}
else {
echo("<p>Message successfully sent!</p>");
    echo "<script> alert('Thank you for contacting adiremarket, we would get back to you soon.');window.location.href='https://adiremarket.com/contact.html';</script>";
}
  }
 ?>
 

