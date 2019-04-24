<?php

if(!isset($_POST['submit']))
{
	echo "error; you need to submit the form!";
}
$name = $_POST['name'];
$surname = $_POST['surname'];
$visitor_email = $_POST['email'];
$phone = $_POST['phone'];
$date = $_POST['date'];
$person_amount = $_POST['person_amount'];
$special_occasion = $_POST['special_occasion'];
$separate_room = $_POST['separate_room'];
$hall = $_POST['hall'];
$message = $_POST['message'];


if(empty($name)||empty($surname)||empty($visitor_email)||empty($phone)||empty($date)||empty($person_amount)||empty($hall))
{
    echo "Please, fill the form";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}

$email_from = 'ost.tuz@gmail.com';
$email_subject = "New Reservation";
$email_body = "Information about reservation: \n Name: $name \n Surname: $surname \n E-mail: $visitor_email \n Phone: $phone \n Date: $date \n Amount of people: $person_amount \n Special occasion: $special_occasion\n Separate room: $separate_room \n Hall: $hall \n Message: $message";

$to = "ost.tuz@gmail.com";
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";

mail($to,$email_subject,$email_body,$headers);

header('Location: index.html');


function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}

?>
