<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $project_name = htmlspecialchars($_POST['project_name']);
    $message = htmlspecialchars($_POST['message']);
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: sendmail.php?success=false&message=Invalid email address");
        exit();
    }
    
    // Set recipient email address
    $to = "mubinshaikh2013@gmail.com.com";
    
    // Set email subject
    $subject = "New Contact Form Submission: $project_name";
    
    // Build email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Project Name: $project_name\n\n";
    $email_content .= "Message:\n$message\n";
    
    // Build email headers
    $headers = "From: $name <$email>";
    
    // Send the email
    if (mail($to, $subject, $email_content, $headers)) {
        // Success - return to form with success message
        header('Location: sendmail.php?success=true&message=Your message has been sent successfully!');
    } else {
        // Failed - return to form with error message
        header('Location: sendmail.php?success=false&message=Oops! Something went wrong. Please try again later.');
    }
    exit();
} else {
    // Not a POST request, redirect to form
    header("Location: sendmail.php");
    exit();
}
?>