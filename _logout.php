<?php
session_start();
echo "Logging you out. Please wait...";
echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> Logging you out. Please wait...
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>';

session_destroy();
header("Location: /project24/")
?>