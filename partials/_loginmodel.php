<!-- Login Modal -->
 <style>
    .red{
        color: red;
    }
 </style>


<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login Satadiya.in</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="partials/_handleLogin.php" onsubmit="return loginvalidate()" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user">Username</label>
                        <input type="text" class="form-control" id="user" name="loginusername">
                        <span class="red" id="loginusernameError"></span>
                        <span class="red" id="loginusernameErrormatch"></span>
                    </div>
                    <div class="form-group">
                        <label for="loginPass">Password</label>
                        <input type="password" class="form-control" id="loginPass" name="loginPass">
                        <span class="red" id="loginpasswordError"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Log In</button>
                </div>
            </form>

        </div>
    </div>
</div>


<script >
    function loginvalidate() {
  var flag = true;

  // Clear previous error messages
 
  document.getElementById("loginpasswordError").innerHTML = "";

  

   // Username Validation
   var username = document.getElementById("user").value;
   var pattern4 = /^[a-zA-Z0-9]{7,20}$/;
 
   if (!username) {
     document.getElementById("loginusernameError").innerHTML = "Please fill in the username";
     flag = false;
   } else if (!pattern4.test(username)) {
     document.getElementById("loginusernameErrormatch").innerHTML = "Fill the username with a minimum of 7 to a maximum of 20 characters";
     flag = false;
   } else {
     document.getElementById("loginusernameError").innerHTML = ""; // Clear error message
     document.getElementById("loginusernameErrormatch").innerHTML = ""; // Clear error message
   }

  // Password validation
  var password = document.getElementById("loginPass").value;
  var pattern5 = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@.#$!%*?&])[A-Za-z\d@.#$!^%*?&]{8,}$/;

  if (!password) {
      document.getElementById("loginpasswordError").innerHTML = "Please fill in the password";
      flag = false;
  } else if (!pattern5.test(password)) {
      document.getElementById("loginpasswordError").innerHTML = "<br>Password must be at least 8 characters long and include a mix of uppercase, lowercase, numbers, and symbols.";
      flag = false;
  }

  return flag;
}
</script>


<!-- Include Bootstrap and jQuery libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/5hb7ie2G5qkdfBQcpi7N7lw4D+1e91ZafAnA/w" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybII2Bx3HrS0wUpOVIcGQmKRC4lxP0vvnjX4IqfAib1mo4M2y" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.2.0/js/bootstrap.min.js" integrity="sha384-C64C7ktw35E3YFE0D4u/1A6eLO2JOjw1h52SWOZztsInG8/ir9p4AAseBx5U1Z3G" crossorigin="anonymous"></script>

