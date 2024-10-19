<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
$showError = "false"; // Assuming this is for error handling
$showAlert = ""; // Initialize showAlert variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_dbconnect.php'; // Make sure _dbconnect.php has your database connection details

    // Sanitize and retrieve POST data
    $fname = $_POST["fmane"] ; // Use isset() or  to handle undefined key warning
    $lname = $_POST["lastname"] ;
    $gender = $_POST["gender"] ;
    $email = $_POST["Email"] ;
    $dob = $_POST["dob"] ;
    $mbl = $_POST["mbl"] ;
    $username = $_POST["username"] ;
    $pass = $_POST["signupPassword"] ;
    $cpass = $_POST["signupcPassword"] ;

   

    // Check if username already exists
    $existSql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);

    if ($numRows > 0) {
        $showError = "Username already exists";
    } else {
        if ($pass == $cpass) {
            // Hash the password
            $hash = password_hash($pass, PASSWORD_DEFAULT);

            // Insert user into database
            $sql = "INSERT INTO `users` (firstname, lastname, gender,dob, email, phone, username, password, `timestamp`) 
                    VALUES ('$fname', '$lname', '$gender',  '$dob','$email', '$mbl', '$username', '$hash', NOW())";

            $result1 = mysqli_query($conn, $sql);

            if ($result1) {
                $showAlert = true;
                
                // Redirect or show success message
                header("Location: /project24/index.php?signupsuccess=true");

                //MAILER

                try {
                    $mail = new PHPMailer(true); 

                    // Server settings
                    $mail->SMTPDebug = 1; // Set to 1 for basic debug info, 0 for production
                    $mail->isSMTP(); 
                    $mail->Host = 'smtp.gmail.com'; 
                    $mail->SMTPAuth = true; 
                    $mail->Username = 'satadiya.in@gmail.com'; 
                    $mail->Password = 'qubs nxgc rmni nyea'; 
                    $mail->SMTPSecure = 'tls'; 
                    $mail->Port = 587; 

                    // Sender and recipient
                    $mail->setFrom('satadiya.in@gmail.com', 'satadiya.in');
                    $emaill = isset($_POST["Email"]) ? $_POST["Email"] : '';
                    $mail->addAddress($emaill); 

                    // Content
                    $mail->isHTML(true); 
                    $mail->Subject = 'Registration Successful';
                    $mail->Body = "Dear $fname,<br><br>"
                            . "Welcome to the Digital Village!<br><br>"
                            . "We are pleased to inform you that your registration for the Complaints Box system has been successful.<br><br>"
                            . "This platform empowers residents to voice their concerns and contribute to the improvement of our village. Your participation is vital in helping us address issues swiftly and efficiently.<br><br>"
                            . "Please note that your account will be active after verification by our admin team, which typically takes up to 24 hours. We appreciate your patience and look forward to your active involvement.<br><br>"
                            . "Thank you for being a part of this initiative.<br><br>"
                            . "Best regards,<br>"
                            . "Satadiya Digital Village Team";


                    $mail->send();
                    echo 'Email sent successfully.';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }







                exit();
            } else {
                // Error handling if insertion fails
                $showError = "Insertion error: " . mysqli_error($conn);
            }

        } else {
            $showError = "Passwords do not match";
        }
    }
    // Redirect with error or success message
    header("Location: /project24/index.php?signupsuccess=false&error=$showError");
}
?>