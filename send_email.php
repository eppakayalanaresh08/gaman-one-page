<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['nameid']);
    $phone = trim($_POST['phoneid']);
    $email = trim($_POST['emailid']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    $adminEmail = "info@gamanspineandpain.com";
    $userEmail = $email;

    $subjectToAdmin = "New Contact Form Submission: $subject";
    $messageToAdmin = "
        <h2>Contact Form Submission</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Phone:</strong> $phone</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Subject:</strong> $subject</p>
        <p><strong>Message:</strong><br>$message</p>
    ";

    $subjectToUser = "Thank you for contacting us, $name!";
    $messageToUser = "
        <h2>Hello $name,</h2>
        <p>Thank you for reaching out. We have received your message and will get back to you shortly.</p>
        <p><strong>Your Message:</strong><br>$message</p>
    ";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: no-reply@gamanspineandpain.com" . "\r\n";

    $adminMailSent = mail($adminEmail, $subjectToAdmin, $messageToAdmin, $headers);
    $userMailSent = mail($userEmail, $subjectToUser, $messageToUser, $headers);

    if ($adminMailSent && $userMailSent) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
