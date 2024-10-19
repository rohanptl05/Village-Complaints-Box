<?php
$showError = false; // Initialize error flag

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_dbconnect.php'; // Include database connection

    // Sanitize and validate user inputs
    $username = mysqli_real_escape_string($conn, $_POST['loginusername']);
    $pass = mysqli_real_escape_string($conn, $_POST['loginPass']);

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $numRows = $result->num_rows;

    if ($numRows == 1) {
        $row = $result->fetch_assoc();
        // Verify password
        if ($row['user_status'] == 'approved') {
            if (password_verify($pass, $row['password'])) {



            session_start(); // Start session

            // Store session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['sno'] = intval($row['user_id']);
            $_SESSION['Role'] = $row['Role'];
            $_SESSION['username'] = $username;

            // Redirect based on user role
            // if ($row['Role'] == "A") {
            header("Location: /project24/partials/_sidebar.php");
            // } else {
            // header("Location: /project24/partials/_userdashbord.php");
            // }
            exit(); // Ensure script stops execution after redirection
            }else{
                $showErrorpass = true;
            }


        } else {
            $showErrorusrapp = true; // Set error flag
        }
    } else {
        $showError = true; // Set error flag
    }
    $stmt->close();
    $conn->close();
}

// Display error message if login fails
if ($showError) {
    echo "<script>
        alert('Invalid credentials. Please try again');
        window.location.href = '/project24';
    </script>";
}
if ($showErrorpass) {
    echo "<script>
        alert('Your Password is not match please try again');
        window.location.href = '/project24';
    </script>";
}
if ($showErrorusrapp) {
    echo "<script>
        alert('Your Username NOT Aproved by Admin.');
        window.location.href = '/project24';
    </script>";
}
?>