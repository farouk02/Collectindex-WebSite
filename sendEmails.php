<?php
require_once './vendor/autoload.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
  ->setUsername("faroukious0@gmail.com")
  ->setPassword("far00ukoo2");

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

function sendVerificationEmail($userEmail, $token)
{
  global $mailer;
  $body = '<!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <title>Test mail</title>
      <style>
        .wrapper {
          padding: 20px;
          color: #444;
          font-size: 1.3em;
        }
        a {
          background: #11A9CF;
          text-decoration: none;
          padding: 8px 15px;
          border-radius: 5px;
          color: #ffffff;
        }
      </style>
    </head>

    <body>
      <div class="wrapper">
        <p>Merci de vous être inscrit sur notre application. Veuillez cliquer sur le lien ci-dessous pour vérifier votre adresse e-mail:.</p>
        <a href="http://192.168.1.100/ade/verifyToken.php?token=' . $token . '">vérifier adresse e-mail!</a>
      </div>
    </body>

    </html>';

  // Create a message
  $message = (new Swift_Message('ADE - vérifier votre adresse email'))
    ->setFrom("faroukious0@gmail.com")
    ->setTo($userEmail)
    ->setBody($body, 'text/html');

  // Send the message
  $result = $mailer->send($message);

  if ($result > 0) {
    return true;
  } else {
    return false;
  }
}
