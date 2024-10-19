<?php
  $conn = mysqli_connect("localhost","root","","db_prectice") or die("Connection failed");



  if(isset($_POST['date1']) && isset($_POST['date2'])){
    // $min = $_POST['date1'];
    // $max = $_POST['date2'];
    $min = date('Y-m-d', strtotime($_POST['date1']));
    $max = date('Y-m-d', strtotime($_POST['date2']));

    echo $min;
    echo $max;
    $sql = "SELECT * FROM student WHERE DOB BETWEEN '{$min}' AND '{$max}'";
  }else{
    $sql = "SELECT * FROM student ORDER BY id asc";
  }

  $result = mysqli_query($conn,$sql) or die("Query Unsuccessful.");
  $output = "";

  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $dob = date('d M, Y',strtotime($row['DOB']));
      $output .= "<tr>
                    <td align='center'>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$dob}</td>
                  </tr>";
    }
    echo $output;
  }else{
    echo "<h2>No Record Found.</h2>";
  }

?>
