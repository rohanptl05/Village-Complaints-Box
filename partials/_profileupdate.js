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
    var username = document.getElementById("upusername").value;
    var pattarn4 = /^[a-zA-Z0-9]{7,20}$/;
    if (!username) {
        document.getElementById("usernameError").innerHTML = "Please fill in the username";
        document.getElementById("usernameError").style.display = "block";
        flag = false;
    } else if (!pattarn4.test(username)) {
        document.getElementById("updateusermatch").innerHTML = "Username must be between 7 to 20 characters";
        document.getElementById("updateusermatch").style.display = "block";
        flag = false;
    } else {
        document.getElementById("usernameError").style.display = "none";
        document.getElementById("updateusermatch").style.display = "none";
    }

    return flag;
}