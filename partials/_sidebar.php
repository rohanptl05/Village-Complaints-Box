<?php

include "_header.php";
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="js/jquery-1.12.4.min.js"></script>
    <script src="jq/js1.js"></script>

    <title>dashbord</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: auto;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        #success-message {
            background: #DEF1D8;
            color: green;
            padding: 10px;
            margin: 10px;
            position: absolute;
            display: none;
            right: 15px;
            top: 85px;
            z-index: 100;


        }

        #error-message {
            background: #EFDCDD;
            color: red;
            padding: 10px;
            margin: 10px;
            position: absolute;
            display: none;
            right: 15px;
            top: 15px;
            top: 25px;
            z-index: 100;

        }

        .delete-btn {
            background: red;
            color: white;
            border: 0;
            padding: 4px 10px;
            border-radius: 3px;
            cursor: pointer;
        }

        #model {
            background: rgba(0, 0, 0, 0.7);
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 100;
            display: none;
        }

        #model-form {
            background: #fff;
            width: 40%;
            position: relative;
            top: 5%;
            left: 50%;
            transform: translateX(-50%);
            padding: 15px;
            border-radius: 4px;
            text-align: center;
        }

        #model-form h2 {
            margin: 0 0 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid black;
            text-align: center;
        }

        #model-form td {
            padding: 3px 0px;

        }


        #close-btn {
            background: red;
            color: white;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
            position: absolute;
            top: -15px;
            right: -15px;
            cursor: pointer;
        }



        body {
            display: flex;
            flex-direction: column;

        }

        .content {
            flex: 1;
        }

        .custom-sidebar {
            height: auto;
            /* Adjust this value as needed */
        }

        .flip-card {
            background-color: transparent;
            padding: 10px;
            width: 300px;
            height: 300px;
            perspective: 1000px;
            margin: 5px;
        }

        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.6s;
            transform-style: preserve-3d;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        .flip-card:hover .flip-card-inner {
            transform: rotateY(180deg);
        }

        .flip-card-front,
        .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }

        .flip-card-front {
            background-color: #bbb;
            color: black;
        }

        .flip-card-back {
            background-color: #2980b9;
            color: white;
            transform: rotateY(180deg);
            text-align: center;
        }

        #data-table {
            display: flex;
            flex-direction: column;
            /* height: 100vh; */
            min-height: 100vh;
        }

        .container-discussion {
            display: flex;
            flex-direction: column;
            height: 100vh;

        }

        /* dash bord flip derection */
        .dashcss {
            flex: auto;
            flex-direction: row;
            display: flex;
        }

        div#date-wrap {
            align-items: center;
        }

        #date-wrap {
            padding: 10px 23px;
            background-color: aquamarine;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        input#search {
            border-radius: 6px;
            width: 200px;
            border: double;
            background: #e9ecef;
        }

        input#from,
        #to {
            background: gainsboro;
            padding: 2px 5px;
        }

        .block {
            display: inline-flex;
            align-items: center;
        }

        #date-option {
            display: flex;
            padding: 0px 11px;
            gap: 20px;
        }

        button {
            padding: 2px 4px;
            margin-left: 5px;
            color: white;
            background-color: red;
            border-radius: 7px;
            box-shadow: 2px 3px lightsteelblue;
        }

        button#pdf {
            margin-left: 5px;

            background-color: red;
        }

        button.edit.btn.btn-sm.btn-primary.userView {
            margin: 4px;
        }
    </style>
</head>

<body>


    <div class="row">
        <div class="w3-light-grey w3-bar-block custom-sidebar col-3 text-center">

            <?php
            if ($_SESSION['loggedin'] == 'true' &&  $_SESSION['Role'] == 'A') {
                echo "<h3 class='w3-bar-item'>Dashboard</h3> 
                <a href='#' id='dashbord' class='w3-bar-item w3-button'>Dashbord</a>
                <a href='#' id='profile' class='w3-bar-item w3-button'>Profile</a>
                <a href='#' id='user_request' class='w3-bar-item w3-button'>Users Request</a>
                <a href='#' id='user_list' class='w3-bar-item w3-button'>Users List</a>
                <a href='#' id='user_Rejected-list' class='w3-bar-item w3-button'>Users Rejected-List</a>
                <a href='#' id='complaints' class='w3-bar-item w3-button'>Complaints</a>
                <a href='#' id='complaints_resolved' class='w3-bar-item w3-button'>Complaints-Resolved</a>
                <a href='#' id='complaints-Rejected' class='w3-bar-item w3-button'>Complaints Rejected-List</a>
                
                <a href='#' id='report2' class='w3-bar-item w3-button'>Report</a>";
            } elseif ($_SESSION['loggedin'] == 'true' &&  $_SESSION['Role'] == 'U') {
                echo "<h3 class='w3-bar-item'>Dashboard</h3>
                <a href='#' id='profile' class='w3-bar-item w3-button'>Profile</a>
                <a href='#' id='_usercomplaints' class='w3-bar-item w3-button'>Complaints Box</a>";
            }
            ?>
            <!-- <a href='#' id='report' class='w3-bar-item w3-button'>Report</a> -->

        </div>

        <!-- Page Content -->
        <div class="col-9 content" id="data-table"></div>

        <div id="model">
            <div id="model-form">
                <table cellpadding="10" width="100%"></table>
                <div id="close-btn">X</div>
            </div>
        </div>
    </div>



    <div id="error-message"></div>
    <div id="success-message"></div>

    <?php include "_footer.php"; ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- jquery ui css -->
    <script rel="stylesheet" href="project24/css/jquery-ui.min.css"></script>
    <!-- style.css -->
    <script rel="stylesheet" href="project24/css/style.css"></script>

    <script src="js/jquery-1.12.4.min.js"></script>
    <!-- jquery ui -->
    <script src="js/jquery-ui-1.12.1.min.js"></script>

    <!-- <script src="jQ/jquery.mobile-1.4.5.js"></script>
    <script src="jQ/jquery.mobile-1.4.5.min.js"></script> -->

    <script type="text/javascript">
        $(document).ready(function() {


            function loadProfile() {
                $.ajax({
                    url: "_profile.php",
                    type: "POST",
                    success: function(data) {
                        $("#data-table").html(data);
                    },
                });
            }
            loadProfile();




            $('#dashbord').on('click', function(e) {
                e.preventDefault();
                //dash bord
                function dashbord() {
                    $.ajax({
                        url: "_dasbord.php",
                        type: "POST",
                        success: function(data) {
                            $("#data-table").html(data);
                        },
                    });
                }

                dashbord();
            });




            // Profile
            $('#profile').on('click', function(e) {
                e.preventDefault();

                function loadProfile() {
                    $.ajax({
                        url: "_profile.php",
                        type: "POST",
                        success: function(data) {
                            $("#data-table").html(data);
                        },
                    });
                }
                loadProfile();

            });

            // Delegate close button event
            $("#model").on("click", "#close-btn", function() {
                $("#model").hide();
            });

            // Complaints list
            $('#complaints').on('click', function(e) {
                e.preventDefault();

                function complaiints() {
                    $.ajax({
                        url: "_complaints.php",
                        type: "POST",
                        success: function(data) {
                            $("#data-table").html(data);
                        },
                    });
                }
                complaiints();
            });

            // User list
            $('#user_list').on('click', function(e) {
                e.preventDefault();

                function userlist() {
                    $.ajax({
                        url: "_userlist.php",
                        type: "POST",
                        success: function(data) {
                            $("#data-table").html(data);
                        },
                    });
                }
                userlist();
            });

            // User request
            $('#user_request').on('click', function(e) {
                e.preventDefault();

                function userrequest() {
                    $.ajax({
                        url: "_userrequest.php",
                        type: "POST",
                        success: function(data) {
                            $("#data-table").html(data);
                        },
                    });
                }
                userrequest();
            });


            // Hide modals on clicking outside the form
            $(window).on("click", function(e) {
                if ($(e.target).is("#model")) {
                    $("#model").hide();
                }
            });
            // Load profile by default on page load


            // View complaints
            $(document).on("click", ".compaintsView", function() {
                $("#model").show();
                var uid = $(this).data("eid");


                $.ajax({
                    url: "_complaitsView.php",
                    type: "POST",
                    data: {
                        id: uid
                    },
                    success: function(data) {
                        $('#model-form table').html(data);
                    }
                });
            });
            // usercomplaintseditmodel
            $(document).on("click", ".usercomplaintseditmodel", function() {
                $("#model").show();
                var uid = $(this).data("eid");


                $.ajax({
                    url: "_complaiintseditview.php",
                    type: "POST",
                    data: {
                        id: uid
                    },
                    success: function(data) {
                        $('#model-form table').html(data);
                    }
                });
            });


            //complaints_resolved bar

            $('#complaints_resolved').on('click', function(e) {
                e.preventDefault();

                function complaints_resolved() {
                    $.ajax({
                        url: "_complaints_resolved.php",
                        type: "POST",
                        success: function(data) {
                            $("#data-table").html(data);
                        },
                    });
                }
                complaints_resolved();
            });
            // bar

            $('#complaints-Rejected').on('click', function(e) {
                e.preventDefault();

                function complaints_Rejected() {
                    $.ajax({
                        url: "_complaints-Rejected.php",
                        type: "POST",
                        success: function(data) {
                            $("#data-table").html(data);
                        },
                    });
                }
                complaints_Rejected();
            });



            //userReject prifile
            $('#user_Rejected-list').on('click', function(e) {
                e.preventDefault();

                function user_Rejected_list() {
                    $.ajax({
                        url: "_user_Rejected-list.php",
                        type: "POST",
                        success: function(data) {
                            $("#data-table").html(data);
                        },
                    });
                }
                user_Rejected_list();
            });





            // View user-detailes
            $(document).on("click", ".userView", function() {
                $("#model").show();
                var uid = $(this).data("eid");


                $.ajax({
                    url: "_userdatView.php",
                    type: "POST",
                    data: {
                        id: uid
                    },
                    success: function(data) {
                        $('#model-form table').html(data);
                    }
                });
            });
            // user-accsept req
            $(document).on("click", ".userAccept", function() {


                var uid = $(this).data("eid");
                var element = $(this);

                if(confirm("Sure this User are Accepted")){
                    
                $.ajax({
                    url: "_userAccept.php",
                    type: "POST",
                    data: {
                        id: uid
                    },
                    success: function(data) {
                        if (data == 1) {
                            $("#success-message").html("Request Accepted successfully.")
                                .slideDown();
                            $("#error-message").slideUp();

                            element.closest("tr").fadeOut();

                        } else {

                            $("#error-message").html("Failed  Accepted  data.")
                                .slideDown();
                            $("#success-message").slideUp()
                        }
                        fadeOutMessages();

                    }
                });

                }

            });
            // user-Reject req
            $(document).on("click", ".userReject", function() {
                var uid = $(this).data("eid");
                var element = $(this);

                if (confirm("Are Sure This User Rejected")) {
                    $.ajax({
                        url: "_userReject.php",
                        type: "POST",
                        data: {
                            id: uid
                        },
                        success: function(data) {
                            if (data == 1) {
                                element.closest("tr").fadeOut();
                                $("#success-message").html("Request Rejected successfully.")
                                    .slideDown();
                                $("#error-message").slideUp();

                            } else {

                                $("#error-message").html("Failed Rejected data.")
                                    .slideDown();
                                $("#success-message").slideUp();
                            }
                            fadeOutMessages();
                        }
                    });


                }

            });

            ///report bar2
            $('#report2').on('click', function(e) {
                e.preventDefault();

                function report1() {
                    $.ajax({
                        url: "_report2.php",
                        type: "POST",
                        success: function(data) {
                            $("#data-table").html(data);
                        },
                    });
                }
                report1();

            });
         





            // complaintsAccept
            $(document).on("click", ".complaintsAccept", function() {


                var uid = $(this).data("eid");
                var element = $(this);
                var ADcomment = element.closest("tr").find("#admincomments").val();

                if (uid == "" || ADcomment == "") {
                    $("#error-message").html("please fill comments").slideDown();
                    $("#success-message").slideUp();
                    fadeOutMessages();
                } else {
                    $.ajax({
                        url: "_complaintsAccept.php",
                        type: "POST",
                        data: {
                            id: uid,
                            comments: ADcomment
                        },
                        success: function(data) {
                            if (data == 1) {
                                $("#success-message").html("complaints Acsepted successfully.")
                                    .slideDown();
                                $("#error-message").slideUp();

                                element.closest("tr").fadeOut();

                            } else {

                                $("#error-message").html(" complaints not Reject")
                                    .slideDown();
                                $("#success-message").slideUp()
                            }
                            fadeOutMessages();

                        }
                    });
                }





            });


            // complaintsreject
            $(document).on("click", ".complaintsReject", function() {


                var uid = $(this).data("eid");
                var element = $(this);
                var ADcomment = element.closest("tr").find("#admincomments").val();

                if (uid == "" || ADcomment == "") {
                    $("#error-message").html("please fill comments").slideDown();
                    $("#success-message").slideUp();
                    fadeOutMessages();
                } else {
                    if (confirm("Are you sure Reject complaints")) {

                        $.ajax({
                            url: "_complaintsReject.php",
                            type: "POST",
                            data: {
                                id: uid,
                                comments: ADcomment
                            },
                            success: function(data) {
                                if (data == 1) {
                                    $("#success-message").html(" complaints Reject successfully.")
                                        .slideDown();
                                    $("#error-message").slideUp();

                                    element.closest("tr").fadeOut();

                                } else {

                                    $("#error-message").html("  complaints not Reject ")
                                        .slideDown();
                                    $("#success-message").slideUp()
                                }
                                fadeOutMessages();

                            }
                            
                        });


                    }


                }




            });








            //_usercomplaints user site
            function _usercomplaints() {
                $.ajax({
                    url: "_usercomplaints.php",
                    type: "POST",
                    success: function(data) {
                        $("#data-table").html(data);
                    },
                });
            }
            $('#_usercomplaints').on('click', function(e) {
                e.preventDefault();


                _usercomplaints();
            });


            //complaints submit id= complait-submit  class =complaitssubmit _insert_complaints_ajax.php
            $(document).on("click", "#complait-submit", function(e) {
                // console.log("oncompclick");
                e.preventDefault();
                var comptitle = $("#comptitle").val();
                var compdesc = $("#compdesc").val();
                // console.log(comptitle);
                // console.log(compdesc);
                if (comptitle == "" || compdesc == "") {
                    $("#error-message").html("All fields are required").slideDown();
                    $("#success-message").slideUp();
                } else {
                    $.ajax({
                        url: "_insert_complaints_ajax.php",
                        type: "POST",
                        data: {
                            comptitle: comptitle,
                            compdesc: compdesc
                        },
                        success: function(data) {
                            if (data == 1) {
                                $("#insertcomplaint").trigger("reset");
                                $("#success-message").html("Complaint submitted successfully.")
                                    .slideDown();
                                $("#error-message").slideUp();

                                _usercomplaints();
                                // element.closest("tr").fadeIn();
                                fadeOutMessages();

                            } else {
                                $("#error-message").html("Complaint not submitted").slideDown();
                                $("#success-message").slideUp();
                            }

                            fadeOutMessages();

                        }
                    });
                }
            });



            // user-Complaints delete 
            $(document).on("click", ".userdeletecomp", function(e) {
                var uid = $(this).data("eid");
                var element = $(this);
                // console.log(uid);
                if (confirm("Are you sure you want to delete this complaint?")) {
                    $.ajax({
                    url: "_userdeletecomp.php",
                    type: "POST",
                    data: {
                        id: uid
                    },
                    success: function(data) {
                        if (data == 1) {
                            element.closest("tr").fadeOut();
                            $("#success-message").html("Complaints deleted successfully.")
                                .slideDown();
                            $("#error-message").slideUp();
                            fadeOutMessages();

                        } else {

                            $("#error-message").html("Complaints deleted Failed ")
                                .slideDown();
                            $("#success-message").slideUp();
                        }
                        fadeOutMessages();
                    }
                });
                }
              
            });


            //massage time out function
            function fadeOutMessages() {
                setTimeout(function() {
                    $("#success-message").fadeOut();
                }, 6000);
                setTimeout(function() {
                    $("#error-message").fadeOut();
                }, 6000);
            }
            fadeOutMessages();




            //complaints update id='comupdate-submit'

            $(document).on("click", "#comupdate-submit", function(e) {
                // console.log("oncompclick");
                e.preventDefault();
                var updatetitle = $("#updatetitle").val();
                var updatedesc = $("#updatedesc").val();
                var updateid = $("#updateid").val();

                if (updatetitle == "" && updatedesc == "" && updateid == '') {
                    $("#error-message").html("All fields are required").slideDown();
                    $("#success-message").slideUp();
                } else {
                    $.ajax({
                        url: "_update_complaints_ajax.php",
                        type: "POST",
                        data: {
                            updatetitle: updatetitle,
                            updatedesc: updatedesc,
                            updateid: updateid
                        },
                        success: function(data) {
                            if (data == 1) {
                                $("#model").hide();

                                $("#success-message").html("Complaint  updated successfully.")
                                    .slideDown();
                                $("#error-message").slideUp();

                                _usercomplaints();
                                // element.closest("tr").fadeIn();
                                fadeOutMessages();

                            } else {
                                $("#error-message").html("Complaint not updated").slideDown();
                                $("#success-message").slideUp();
                            }

                            fadeOutMessages();

                        }
                    });
                }
            });



            // profileupdate data
            $(document).on("click", "#proupsubmit", function(e) {

                e.preventDefault();
                var formData = $("#updatepro").serialize(); // Serialize form data
                // console.log(formData); // Log serialized data to console

                if (provalidat()) {
                    $.ajax({
                        url: "_updateprofile_ajax.php",
                        type: "POST",
                        data: formData,
                        dataType: "json",
                        success: function(data) {
                            if (data.success) {
                                $("#success-message").html("Profile updated successfully.")
                                    .slideDown();
                                $("#error-message").slideUp();
                                fadeOutMessages();

                            } else {
                                $("#error-message").html("Failed to update profile.")
                                    .slideDown();
                                $("#success-message").slideUp();
                                fadeOutMessages();

                            }
                        },
                        error: function(xhr, status, error) {
                            console.log("AJAX Error: " + status + error);
                            $("#error-message").html("An error occurred while updating the profile.")
                                .slideDown();
                            $("#success-message").slideUp();
                            fadeOutMessages();
                        }

                    });
                }
            });



        });
    </script>
</body>

</html>