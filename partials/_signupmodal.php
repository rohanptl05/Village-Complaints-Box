<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Signup for an Satadiya Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <style>
            .red {
              color: red;
            }
          </style>




        </button>
      </div>
      <form action="partials/_handleSignup.php" id="singup"  onsubmit="return validate()" method="post">
        <div class="modal-body ">
          <div class="form-group">
            <label for="fname">First Name</label>
            <input type="text" class="form-control my-2" id="fname" name="fmane" aria-describedby="emailHelp">
            <span class="red" id="fnameError"></span>
          </div>

          <div class="form-group">
            <label for="lname">Last Name</label>
            <input type="text" class="form-control my-2" id="lname" name="lastname" aria-describedby="emailHelp">
            <span class="red" id="lnameerror"></span>
          </div>

          <div class="form-group">
            <legend>Gender</legend>
            <label for="male"> Male : </label>
            <input type="radio" name="gender" id="male" value="male" />

            <label for="female"> Female : </label>
            <input type="radio" name="gender" id="female" value="female" />

            <label for="other"> Other : </label>
            <input type="radio" name="gender" id="other" value="other" />
            <span class="red" id="genderError"></span>
          </div>

          <div class="form-group">
            <label for="Email">Email</label>
            <input type="email" class="form-control my-2" id="Email" name="Email" aria-describedby="emailHelp">
            <span class="red" id="EmailError"></span>
          </div>

          <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="date" class="form-control my-2" id="dob" name="dob" aria-describedby="emailHelp">
            <span class="red" id="dobError"></span>
          </div>

          <div class="form-group">
            <label for="mbl">Mobile No:</label>
            <input type="number" class="form-control my-2" id="mbl" name="mbl" aria-describedby="emailHelp">
            <span class="red" id="mblError"></span>
            <span class="red" id="mblmacth"></span>
          </div>

          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control my-2" id="username" name="username"  aria-describedby="emailHelp">
            <span class="red" id="usernameError"></span>
            <span class="red" id="usernameErrormatch"></span>
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control my-2" id="password" name="signupPassword" aria-describedby="emailHelp">
            <span class="red" id="passwordError"></span>
          </div>
          <div class="form-group">
            <label for="cpassword">Confirm Password</label>
            <input type="password" class="form-control my-2" id="cpassword" name="signupcPassword" aria-describedby="emailHelp">
            <span class="red" id="passwordErrormatch"></span>
          </div>

          <button type="submit" class="btn btn-primary">Signup</button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </form>
      
    </div>
  </div>
</div>
<script >
  function validate() {
  var flag = true;

  // First Name Validation
  var fn = document.getElementById("fname").value;
  if (!fn) {
    document.getElementById("fnameError").innerHTML = "Enter first name";
    flag = false;
  } else {
    document.getElementById("fnameError").innerHTML = ""; // Clear error message
  }

  // Last Name Validation
  var ln = document.getElementById("lname").value;
  if (!ln) {
    document.getElementById("lnameerror").innerHTML = "Fill the Last Name";
    flag = false;
  } else {
    document.getElementById("lnameerror").innerHTML = ""; // Clear error message
  }

  // Gender Validation
  var options = document.getElementsByName("gender");
  var selected = false;

  for (var i = 0; i < options.length; i++) {
    if (options[i].checked) {
      selected = true;
      break;
    }
  }

  if (!selected) {
    document.getElementById("genderError").innerHTML = "Please Select Your Gender";
    flag = false;
  } else {
    document.getElementById("genderError").innerHTML = ""; // Clear error message
  }

  // Date of Birth Validation
  var dob = document.getElementById("dob").value;
  if (!dob) {
    document.getElementById("dobError").innerHTML = "Fill the birth of date";
    flag = false;
  } else {
    document.getElementById("dobError").innerHTML = ""; // Clear error message
  }

  // Email Validation
  var email = document.getElementById("Email").value;
  if (!email) {
    document.getElementById("EmailError").innerHTML = "Fill the Email";
    flag = false;
  } else {
    document.getElementById("EmailError").innerHTML = ""; // Clear error message
  }

  // Mobile Number Validation
  var mbl = document.getElementById("mbl").value;
  var pattern3 = /^[0-9]{10}$/;

  if (!mbl) {
    document.getElementById("mblError").innerHTML = "Please fill in the Mobile number";
    flag = false;
  } else if (!pattern3.test(mbl)) {
    document.getElementById("mblmacth").innerHTML = "Enter Mobile number with exactly 10 digits";
    flag = false;
  } else {
    document.getElementById("mblError").innerHTML = ""; // Clear error message
    document.getElementById("mblmacth").innerHTML = ""; // Clear error message
  }

  // Username Validation
  var username = document.getElementById("username").value;
  var pattern4 = /^[a-zA-Z0-9]{7,20}$/;

  if (!username) {
    document.getElementById("usernameError").innerHTML = "Please fill in the username";
    flag = false;
  } else if (!pattern4.test(username)) {
    document.getElementById("usernameErrormatch").innerHTML = "Fill the username with a minimum of 7 to a maximum of 20 characters";
    flag = false;
  } else {
    document.getElementById("usernameError").innerHTML = ""; // Clear error message
    document.getElementById("usernameErrormatch").innerHTML = ""; // Clear error message
  }

  // Password Validation
  var password = document.getElementById("password").value;
  var pattern5 = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@.#$!%*?&])[A-Za-z\d@.#$!^%*?&]{8,}$/;

  if (!password) {
    document.getElementById("passwordError").innerHTML = "Please fill in the password";
    flag = false;
  } else if (!pattern5.test(password)) {
    document.getElementById("passwordError").innerHTML = "Fill the password with a minimum of 8 characters, including symbols and numbers";
    flag = false;
  } else {
    document.getElementById("passwordError").innerHTML = ""; // Clear error message
  }

  // Confirm Password Validation
  var cpassword = document.getElementById("cpassword").value;
  if (!cpassword) {
    document.getElementById("passwordErrormatch").innerHTML = "Please fill in the confirm password";
    flag = false;
  } else if (password !== cpassword) {
    document.getElementById("passwordErrormatch").innerHTML = "Passwords do not match";
    flag = false;
  } else {
    document.getElementById("passwordErrormatch").innerHTML = ""; // Clear error message
  }

  return flag;
}

// function userCheck(){
//   var user_name = document.getElementById("username").value.trim();
//   $.ajax({
//     url:"_user_check-ajax.php",
//     type:"POST",
//     data:{
//       user_name:user_name
//     },
//     success:function(data){
//      if(data == 0){
//       document.getElementById("usernameError").innerHTML = "Username is Already Exist";
//       document.getElementById("singup").onsubmit = function(){
//         return false;
//       };
//      }
//      else{
//       document.getElementById("usernameError").innerHTML = "";
//       document.getElementById("singup").onsubmit = null;
// }
//     }
    
//   });
// }

</script>
