<!DOCTYPE html>
<html lang="en">
<head>
  <title>Report</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <?php
  session_start();
  include "_dbconnect.php";

  $sql = "SELECT * FROM users, complaints WHERE complaints.user_id = users.user_id ORDER BY complaints_date ASC";
  $result = mysqli_query($conn, $sql);
  ?>

  <div style="width: 100%; margin: 0 auto; padding: 20px;">
    <h1 style="text-align: center;">Report</h1>
    <div style="overflow-x: auto;">
      <table style="width: 100%; border-collapse: collapse;" border="1">
        <thead>
          <tr style="background-color: #f2f2f2;">
            <th style="padding: 8px; text-align: center;">S.No</th>
            <th style="padding: 8px; text-align: center;">User ID</th>
            <th style="padding: 8px; text-align: center;">First Name</th>
            <th style="padding: 8px; text-align: center;">Username</th>
            <th style="padding: 8px; text-align: center;">Complaint Title</th>
            <th style="padding: 8px; text-align: center;">Complaint Description</th>
            <th style="padding: 8px; text-align: center;">Complaint Date</th>
            <th style="padding: 8px; text-align: center;">Complaint Status</th>
          </tr>
        </thead>
        <tbody>
          <?php  
          $sno = 0;
          while ($row = mysqli_fetch_assoc($result)) {
              $sno++; 
          ?>
          <tr>
            <td style="padding: 8px; text-align: center;"><?= $sno ?></td>
            <td style="padding: 8px; text-align: center;"><?= $row['user_id'] ?></td>
            <td style="padding: 8px; text-align: center;"><?= $row['firstname'] ?></td>
            <td style="padding: 8px;"><?= $row['username'] ?></td>
            <td style="padding: 8px; text-align: center;"><?= $row['complaint_title'] ?></td>
            <td style="padding: 8px;"><?= $row['complaints_desc'] ?></td>
            <td style="padding: 8px; text-align: center;"><?= date('d-m-Y h:i:sa', strtotime($row['complaints_date'])) ?></td>
            <td style="padding: 8px;"><?= $row['complaints_status'] ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
