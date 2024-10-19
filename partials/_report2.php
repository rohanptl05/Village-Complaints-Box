<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Complaints Report</title>
  <link rel="stylesheet" href="css/jquery-ui.min.css">
  <style>
    #pdfgeneret {
      padding: 2px 4px;
      margin-left: 5px;
      color: white;
      background-color: red;
    }
    .element {
    margin: 10px 2px;
}
  </style>
</head>

<body>
  <!-- jquery -->
  <script src="js/jquery-1.12.4.min.js"></script>
  <!-- jquery ui -->
  <script src="js/jquery-ui-1.12.1.min.js"></script>

  <div class="w3-container w3-teal inline-container">
    <h1>Report</h1>
  </div>

  <div id="date-wrap">
    <div>
      <label for="search"><b>Search:</b></label>
      <input type="search" id="reportsearch">
    </div>
    <div class="block">
      <div>
      <label for="search"><b>Status :</b></label>
        <select id="statusFilter">
          
          <option value="">--select--</option>
          <option value="pending...">Pending</option>
          <option value="Solved">Solved</option>
          <option value="reject">Reject</option>
        </select>
      </div>
      <div id="date-wrap">
        <label for="from"><b>From</b></label>
        <input type="date" id="from" class="element" autocomplete="off">
        <label for="to"><b>to</b></label>
        <input type="date" id="to"  class="element" autocomplete="off">
        <button id="pdf" class="btn btn-primary float-end" data-pdf-id="1">PDF</button>
      </div>
    </div>
  </div>

  <div class="w3-container">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">User ID</th>
          <th scope="col">First Name</th>
          <th scope="col">Username</th>
          <th scope="col">Complaint Title</th>
          <th scope="col">Complaint Description</th>
          <th scope="col">Complaint Date</th>
          <th scope="col">Complaint Status</th>
          <th scope="col">Admin-Comments</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody id="date-data-show"></tbody>
    </table>
  </div>

  <script>
    $(document).ready(function() {

      function fetchComplaints() {
        var search = $("#reportsearch").val().toLowerCase();
        var status = $("#statusFilter").val();
        var date1 = $("#from").val();
        var date2 = $("#to").val();

        $.ajax({
          url: "_search2_ajax.php",
          type: "POST",
          data: {
            search: search,
            date1: date1,
            date2: date2,
            status: status
          },
          success: function(data) {
            $("#date-data-show").html(data);
          }
        });
       
      }
      fetchComplaints();
      function validateDateRange() {
        var fromDate = $("#from").val();
        var toDate = $("#to").val();

        if (fromDate && toDate && fromDate > toDate) {
          alert("The 'From' date cannot be later than the 'To' date.");
          $("#from").val(""); // Clear the invalid date
        }
      }

      $("#from, #to").on("change", function() {
        validateDateRange();
        fetchComplaints();
      });

      $("#reportsearch").on("keyup", function() {
        fetchComplaints();
      });

      $("#statusFilter").on("change", function() {
        fetchComplaints();
      });
      fetchComplaints();

      $(document).on('click', '#pdf', function() {
    var pdf_id = $(this).data('pdf-id');
    var search = $("#reportsearch").val().toLowerCase();
    var status = $("#statusFilter").val();
    var date1 = $("#from").val();
    var date2 = $("#to").val();

    $.ajax({
        url: '_report_pdf.php',
        type: 'POST',
        data: {
            pdf_id: pdf_id,
            search: search,
            date1: date1,
            date2: date2,
            status: status
        },
        success: function(response) {
            var res = JSON.parse(response);
            if (res.status === 'success') {
                window.open('' + res.filepath, '_blank');
            } else {
                alert("Error: " + res.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: " + status + " - " + error);
            alert("Error: " + xhr.responseText);
        }
    });
});



    });
  </script>
</body>

</html>
