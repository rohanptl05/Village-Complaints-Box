<?php
session_start();
include '_dbconnect.php'; // Include database connection
$_SESSION['update'] = "";

$uid = $_SESSION['sno'];

// Fetch user details from database
$sql = "SELECT * FROM users WHERE user_id=$uid";
$result = mysqli_query($conn, $sql);
$numRows = mysqli_num_rows($result);

if ($numRows == 1) {
    $row = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Update</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/w3-css/4.1.0/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .error {
            border-color: red;
        }

        .error-msg {
            color: red;
            display: none;
        }

        .success-msg {
            color: green;
            display: none;
        }
    </style>
</head>

<body>
    <div class="w3-container w3-teal">
        <h1>Profile</h1>
    </div>

    <div class="w3-container">
        <div class="container">
            <form action="" id="updatepro" method="post" onsubmit="return provalidat()">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="upfname">First Name</label>
                        <input type="text" class="form-control my-2" id="upfname" name="upfname" value="<?php echo $row['firstname'] ?>" aria-describedby="emailHelp">
                        <span id="upfnameError" class="error-msg">Enter first name</span>
                        <input type="hidden" id="updateid" name="upid" value="<?php echo $row['user_id'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="uplname">Last Name</label>
                        <input type="text" class="form-control my-2" id="uplname" name="uplname" value="<?php echo $row['lastname'] ?>" aria-describedby="emailHelp">
                        <span id="uplnameError" class="error-msg">Fill in the last name</span>
                    </div>

                    <div class="form-group">
                        <legend>Gender</legend>
                        <label for="male">Male</label>
                        <input type="radio" name="gender" id="male" value="male" <?php echo ($row['gender'] == 'male') ? 'checked' : ''; ?>>
                        <label for="female">Female</label>
                        <input type="radio" name="gender" id="female" value="female" <?php echo ($row['gender'] == 'female') ? 'checked' : ''; ?>>
                        <label for="other">Other</label>
                        <input type="radio" name="gender" id="other" value="other" <?php echo ($row['gender'] == 'other') ? 'checked' : ''; ?>>
                        <span id="upgenderError" class="error-msg">Please select your gender</span>
                    </div>

                    <div class="form-group">
                        <label for="upemail">Email</label>
                        <input type="email" class="form-control my-2" id="upemail" name="upemail" value="<?php echo $row['email'] ?>" aria-describedby="emailHelp" disabled>
                        <span id="upemailError" class="error-msg">Fill in the email</span>
                    </div>

                    <div class="form-group">
                        <label for="updob">DOB</label>
                        <input type="date" class="form-control my-2" id="updob" name="updob" value="<?php echo $row['dob'] ?>" aria-describedby="emailHelp">
                        <span id="updobError" class="error-msg">Fill in the date of birth</span>
                    </div>

                    <div class="form-group">
                        <label for="upmbl">Mobile No:</label>
                        <input type="number" class="form-control my-2" id="upmbl" name="upmbl" value="<?php echo $row['phone'] ?>" aria-describedby="emailHelp">
                        <span id="upmobileError" class="error-msg">Please fill in the mobile number</span>
                        <span id="updatemobileErrormtc" class="error-msg">Please fill in the mobile number</span>
                    </div>

                    <div class="form-group">
                        <label for="upuname">Username</label>
                        <input type="text" class="form-control my-2" id="upuname" name="upusername" value="<?php echo $row['username'] ?>" aria-describedby="emailHelp">
                        <span id="upusernameError" class="error-msg">Please fill in the username</span>
                        <span id="upusernameMatchError" class="error-msg">Username must be between 7 to 20 characters</span>
                    </div>

                    <button type="submit" class="btn btn-primary m-1 proupsubmit" id="proupsubmit">Update</button>
                </div>
            </form>
            <div id="response-message" class="success-msg"></div>

        </div>
    </div>

    <script>
        function provalidat() {
            var flag = true;

            // First name validation
            var fn = document.getElementById("upfname").value;
            if (!fn) {
                document.getElementById("upfnameError").innerHTML = "Enter first name";
                document.getElementById("upfnameError").style.display = "block";
                flag = false;
            } else {
                document.getElementById("upfnameError").style.display = "none";
            }

            // Last name validation
            var ln = document.getElementById("uplname").value;
            if (!ln) {
                document.getElementById("uplnameError").innerHTML = "Fill in the last name";
                document.getElementById("uplnameError").style.display = "block";
                flag = false;
            } else {
                document.getElementById("uplnameError").style.display = "none";
            }

            // Gender validation
            var options = document.getElementsByName("gender");
            var selected = false;
            for (var i = 0; i < options.length; i++) {
                if (options[i].checked) {
                    selected = true;
                    break;
                }
            }
            if (!selected) {
                document.getElementById("upgenderError").innerHTML = "Please select your gender";
                document.getElementById("upgenderError").style.display = "block";
                flag = false;
            } else {
                document.getElementById("upgenderError").style.display = "none";
            }

            // Date of birth validation
            var dob = document.getElementById("updob").value;
            if (!dob) {
                document.getElementById("updobError").innerHTML = "Fill in the date of birth";
                document.getElementById("updobError").style.display = "block";
                flag = false;
            } else {
                document.getElementById("updobError").style.display = "none";
            }

            // Mobile number validation
            var mbl = document.getElementById("upmbl").value;
            var pattarn3 = /^[0-9]{10}$/;
            if (!mbl) {
                document.getElementById("upmobileError").innerHTML = "Please fill in the mobile number";
                document.getElementById("upmobileError").style.display = "block";
                flag = false;
            } else if (!pattarn3.test(mbl)) {
                document.getElementById("updatemobileErrormtc").innerHTML = "Enter mobile number with exactly 10 digits";
                document.getElementById("updatemobileErrormtc").style.display = "block";
                flag = false;
            } else {
                document.getElementById("upmobileError").style.display = "none";
                document.getElementById("updatemobileErrormtc").style.display = "none";
            }

            // Username validation
            var usname = document.getElementById("upuname").value;
            var pattarn4 = /^[a-zA-Z0-9]{7,20}$/; // Alphanumeric, 7 to 20 characters

            if (!usname) {
                document.getElementById("upusernameError").innerHTML = "Please fill in the username";
                document.getElementById("upusernameError").style.display = "block";
                document.getElementById("upusernameMatchError").style.display = "none";
                flag = false;
            } else if (!pattarn4.test(usname)) {
                document.getElementById("upusernameError").style.display = "none";
                document.getElementById("upusernameMatchError").innerHTML = "Username must be between 7 to 20 characters";
                document.getElementById("upusernameMatchError").style.display = "block";
                flag = false;
            } else {
                document.getElementById("upusernameError").style.display = "none";
                document.getElementById("upusernameMatchError").style.display = "none";
            }

            return flag;
        }
    </script>
</body>

</html>
