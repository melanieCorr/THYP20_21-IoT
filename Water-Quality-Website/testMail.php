<?php
   ini_set('SMTP','smtp.bouygtel.fr');
  $dest = "marouajellal1996@gmail.com";
  $sujet = "Email de test";
  $corp = "Salut ceci est un email de test envoyer par un script PHP";
  $headers  = 'MIME-Version: 1.0' . "\n";
    $headers .= 'X-Mailer: PHP/' . phpversion() . "\n";
  $headers .= "From: marouajellal788@gmail.com";
  if (mail($dest, $sujet, $corp, $headers)) {
    echo "Email envoyé avec succès à $dest ...";
  } else {
    echo "Échec de l'envoi de l'email...";
  }
?>