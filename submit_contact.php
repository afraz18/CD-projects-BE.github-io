<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname    = $_POST['fullname'];
    $phone       = $_POST['phone'];
    $email       = $_POST['email'];
    $partyname   = $_POST['partyname'];
    $location    = $_POST['location'];
    $projectname = $_POST['projectname'];
    $budget      = $_POST['budget'];
    $timeline    = $_POST['timeline'];
    $message     = $_POST['message'];

    $sql = "INSERT INTO contact_form 
            (fullname, phone, email, partyname, location, projectname, budget, timeline, message) 
            VALUES 
            ('$fullname', '$phone', '$email', '$partyname', '$location', '$projectname', '$budget', '$timeline', '$message')";

    if (mysqli_query($conn, $sql)) {
        echo "<h2>Form submitted successfully!</h2>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
