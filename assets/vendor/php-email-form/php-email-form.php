<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input values
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // Check if required fields are empty
    if (empty($name) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Please fill in all fields correctly.";
        exit;
    }

    // Email settings
    $recipient = "growingisti@yahoo.com"; // Your email address
    $headers = "From: $name <$email>";
    $email_subject = "New contact form message from $name";
    $email_body = "Name: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Subject: $subject\n\n";
    $email_body .= "Message:\n$message\n";

    // Send the email
    if (mail($recipient, $email_subject, $email_body, $headers)) {
        http_response_code(200);
        echo "Thank you! Your message has been sent.";
    } else {
        http_response_code(500);
        echo "There was a problem with sending your message. Please try again later.";
    }
} else {
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
