<?php
// Email yako ya kupokea messages
$to = "mbuhombe@gmail.com";

// Angalia kama request ni POST
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Safisha data kutoka fomu
    $name = htmlspecialchars(strip_tags(trim($_POST['name'])));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(strip_tags(trim($_POST['subject'])));
    $message = htmlspecialchars(strip_tags(trim($_POST['message'])));

    // Validate fields
    if(empty($name) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "Tafadhali jaza fomu yote kwa sahihi.";
        exit;
    }

    // Body ya email
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Subject: $subject\n";
    $email_content .= "Message:\n$message\n";

    // Email headers
    $headers = "From: $name <$email>";

    // Tuma email
    if(mail($to, $subject, $email_content, $headers)){
        echo "Message imetumwa kwa mafanikio. Asante!";
    } else {
        echo "Tatizo limejitokeza, jaribu tena.";
    }

} else {
    echo "Hii form haiwezi kufikiwa kwa njia hii.";
}
?>
