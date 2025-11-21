<?php
include 'config.php'; // include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $phone = htmlspecialchars(trim($_POST['tel']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Prepare and bind SQL insert statement
    $stmt = $conn->prepare("INSERT INTO services_contact (name, email, subject, phone, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $subject, $phone, $message);

    // Execute and check result
    if ($stmt->execute()) {
        echo "<script>alert('Message sent successfully!'); window.location='contact.php';</script>";
    } else {
        echo "<script>alert('Error: Unable to send message. Please try again.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
