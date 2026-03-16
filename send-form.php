<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input fields
    $name = htmlspecialchars(strip_tags(trim($_POST['full-name'])));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(strip_tags(trim($_POST['phone'])));
    $zip = htmlspecialchars(strip_tags(trim($_POST['zip'])));
    $notes = htmlspecialchars(strip_tags(trim($_POST['notes'])));

    // Validate required fields
    if (empty($name) || empty($email) || empty($phone) || empty($zip) || empty($notes)) {
        // You could redirect with an error message if needed
        header("Location: https://moldremovalcleaner.com/");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: https://moldremovalcleaner.com/");
        exit;
    }

    // Recipient
    $to = "Support@moldremovalcleaner.com";

    // Subject
    $subject = "New Contact Form Submission from $name";

    // Email body
    $message = "
You have received a new message from your website contact form.

Name: $name
Email: $email
Phone: $phone
Zip Code: $zip
Notes: $notes
";

    // Headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send email
    mail($to, $subject, $message, $headers);

    // Redirect after submission
    header("Location: https://moldremovalcleaner.com/");
    exit;
} else {
    // Redirect if someone tries to access PHP file directly
    header("Location: https://moldremovalcleaner.com/");
    exit;
}
?>
