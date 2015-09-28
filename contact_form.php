<?php
// header("Access-Control-Allow-Origin: *");
// Fetching Values from URL.
if (isset($_POST["submit"])) {
  $name = strip_tags(trim($_POST["name"]));
  $name = str_replace(array("\r","\n"),array(" "," "),$name);
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $subject = trim($_POST['subject']);
  $message = trim($_POST["message"]);
  $human = intval($_POST['human']);

  // Check if name has been entered
  if (!$_POST['name']) {
      $errName = 'Please enter your name';
  }

  // Check if email has been entered and is valid
  if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $errEmail = 'Please enter a valid email address';
  }

  // Check if subject has been entered
  if (!$_POST['message']) {
      $errSubject = 'Please enter your message';
  }

  //Check if message has been entered
  if (!$_POST['message']) {
      $errMessage = 'Please enter your message';
  }
  //Check if simple anti-bot test is correct
  if ($human !== 5) {
      $errHuman = 'Your anti-spam is incorrect';
  }
  if (!$errName && !$errEmail && !$errSubject && !$errMessage && !$errHuman) {
    // To send HTML mail, the Content-type header must be set.
    $jeremy = "jeremy.koulish@gmail.com";
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From:' . $email. "\r\n"; // Sender's Email
    $headers .= 'Cc:' . $email. "\r\n"; // Carbon copy to Sender
    $template = '<div style="padding:50px; color:white;">Hello ' . $name . ',<br/>'
    . '<br/>Thank you for contacting me.<br/><br/>'
    . 'Name:' . $name . '<br/>'
    . 'Email:' . $email . '<br/>'
    . 'Subject:' . $subject . '<br/>'
    . 'Message:' . $message . '<br/><br/>'
    . 'This is a confirmation that I have received your message.'
    . '<br/>'
    . 'I will contact You as soon as possible.</div>';
    $sendmessage = "<div style=\"background-color:#7E7E7E; color:white;\">" . $template . "</div>";
    // Message lines should not exceed 70 characters (PHP rule), so wrap it.
    $sendmessage = wordwrap($sendmessage, 70);
    // Send mail by PHP Mail Function.

    if (mail($jeremy, $subject, $sendmessage, $headers)) {
      $result = '<div class="alert alert-success">Thank you for reaching out! I will be in touch soon."</div>';
    } else {
      $result='<div class="alert alert-danger">Sorry! An error occured and your message could not be sent. Please e-mail me the old-fashioned way.</div>';
    };
  }
}

?>
