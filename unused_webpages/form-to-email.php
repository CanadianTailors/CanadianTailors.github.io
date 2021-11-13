<?php
if(!isset($_POST['submit']))
{
    // This page should not be access directly. Need to submit the form.
    echo "error; you need to submit the form!";
}
$name = $_POST['name'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];

// Validate first
if(empty($name) || empty($visitor_email))
{
  echo "Name and email are mandatory!";
  exit;
}

$email_from = "mivanov@live.ca"; //<==== Put your email address here
$email_subject = "New Form Submission"
$email_body = "You have received a new message from the user $name.\n".
    "email address: $visitor_email\n".
    "Here is the message:\n $message".

$to = "mivanov@live.ca"; //<==== Put your email address here
$headers = "From: $email_from \r\n";

// Check if email is injected (prevent email injection in 'headers')
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

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}

// Send the email!
mail($to, $email_subject, $email_body, $headers);

// Done!
?>
