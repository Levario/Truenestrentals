<?php

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'info@truenestrentals.com ';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */

  $contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  if(isset($_POST['phone'])) {
    $contact->add_message( $_POST['phone'], 'Phone');
  }
  $contact->add_message( $_POST['message'], 'Message', 10);

  echo $contact->send();
?>

  // el metodo de abajo funciona sin necesidad de usar alguna libreria falta agregar <?php al inicio y cierre al final 
  /*


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "tu-correo@tudominio.com"; // Cambia esto a tu correo real
    $subject = "Mensaje desde el formulario web";

    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject_form = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // Validación básica
    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($subject_form) || empty($message)) {
        http_response_code(400);
        echo "Por favor completa correctamente el formulario.";
        exit;
    }

    $email_content = "Nombre: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Asunto: $subject_form\n\n";
    $email_content .= "Mensaje:\n$message\n";

    $headers = "From: $name <$email>";

    // Envía el correo
    if (mail($to, $subject, $email_content, $headers)) {
        http_response_code(200);
        echo "Mensaje enviado correctamente.";
    } else {
        http_response_code(500);
        echo "Hubo un problema al enviar el mensaje.";
    }
} else {
    http_response_code(403);
    echo "No tienes permiso para acceder a este recurso.";
}

  */

