<?php
header("Access-Control-Allow-Origin: *");
// Fetching Values from URL.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = strip_tags(trim($_POST["name"]));
  $name = str_replace(array("\r","\n"),array(" "," "),$name);
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $subject = trim($_POST['subject']);
  $message = trim($_POST["message"]);
  // After sanitization Validation is performed
  if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "Oops! There was a problem with your submission. Please complete the form and try again.";
    exit;
  }
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
    http_response_code(200);
    echo "Thank you for reaching out! I will be in touch soon.";
  } else {
    echo "Sorry! An error occured and your message could not be sent. Please e-mail me the old-fashioned way.";
  };
} else {
  // Not a POST request, set a 403 (forbidden) response code.
  http_response_code(403);
  echo "There was a problem with your submission, please try again.";
}

?>
