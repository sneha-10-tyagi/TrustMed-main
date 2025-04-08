<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    // Establish a connection to the MySQL database
    $conn = mysqli_connect('localhost', 'root', '', 'test1') or die("Connection failed: " . mysqli_connect_error());

    // Check if all fields are set
    if (isset($_POST['name']) && isset($_POST['age']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['subject']) && isset($_POST['message']) && isset($_POST['prescription']) && isset($_POST['medicines']) && isset($_POST['gender'])) {

        // Sanitize user input
        $name = mysqli_real_escape_string($conn, trim($_POST['name']));
        $age = mysqli_real_escape_string($conn, trim($_POST['age']));
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));
        $subject = mysqli_real_escape_string($conn, trim($_POST['subject']));
        $message = mysqli_real_escape_string($conn, trim($_POST['message']));
        $prescription = mysqli_real_escape_string($conn, trim($_POST['prescription']));
        $medicines = mysqli_real_escape_string($conn, trim($_POST['medicines']));
        $gender = mysqli_real_escape_string($conn, trim($_POST['gender']));

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Invalid email format';
            exit();
        }

        // Check if required fields are empty
        if (empty($name) || empty($age) || empty($email) || empty($message) || empty($prescription) || empty($medicines) || empty($gender)) {
            echo 'One or more required fields are empty';
            exit();
        }

        // Compose the email message with the new fields
        $email_message = "
        Name: " . $name . "
        Age: " . $age . "
        Gender: " . $gender . "
        Email: " . $email . "
        Phone: " . $phone . "
        Subject: " . $subject . "
        Message: " . $message . "
        Prescription: " . $prescription . "
        Medicines Advised: " . $medicines . "
        ";

        // Send the email
        if (mail("trustmed@gmail.com", "New Message", $email_message)) {
            // Redirect on success
            header("Location: ../mail-success.html");
        } else {
            echo 'Error in sending email';
        }
    } else {
        echo 'One or more fields are empty';
    }
}
?>



// <?php
// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

//     // Establishing a connection to the MySQL database
//     $conn = mysqli_connect('localhost', 'root', '', 'test1') or die("Connection failed: " . mysqli_connect_error());

//     // Check if all fields are set
//     if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['subject']) && isset($_POST['message'])) {

//         // Sanitize user input
//         $name = mysqli_real_escape_string($conn, trim($_POST['name']));
//         $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
//         $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));
//         $subject = mysqli_real_escape_string($conn, trim($_POST['subject']));
//         $message = mysqli_real_escape_string($conn, trim($_POST['message']));

//         // Validate email format
//         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//             echo 'Invalid email format';
//             exit();
//         }

//         // Check if required fields are empty
//         if (empty($name) || empty($email) || empty($message)) {
//             echo 'One or more required fields are empty';
//             exit();
//         }

//         // Compose the email message
//         $email_message = "
//         Name: " . $name . "
//         Email: " . $email . "
//         Phone: " . $phone . "
//         Subject: " . $subject . "
//         Message: " . $message . "
//         ";

//         // Send the email
//         if (mail("name@youremail.com", "New Message", $email_message)) {
//             // Redirect on success
//             header("location: ../mail-success.html");
//         } else {
//             echo 'Error in sending email';
//         }
//     } else {
//         echo 'One or more fields are empty';
//     }
// }
// ?>
