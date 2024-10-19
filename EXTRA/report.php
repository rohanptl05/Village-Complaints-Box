<?php

include_once "header.php";
require_once "dbconnection.php";

//query for list
$query = "SELECT 
    app.*, 
    jt.title_name, 
    per.First_name, 
    per.Last_name, 
    per_int.First_name as int_fname, 
    per_int.Last_name as int_lname
FROM 
    application app
JOIN 
    job_opportunity jo ON app.job_id = jo.job_id
JOIN 
    job_title jt ON jo.title_id = jt.title_id
JOIN 
    person per ON per.Person_id = app.person_id
LEFT JOIN 
    person per_int ON app.Interviewer_id = per_int.Person_id
ORDER BY 
    app.person_id, jt.title_name";


$stmt = $conn->query($query);
$result = $stmt->fetchall();
// echo $stmt->rowCount();
// echo "<pre>".$query; print_r($result); exit();
$num=1;


//query for filter
$query2 = "SELECT jt.title_name, jo.*
FROM job_opportunity jo, job_title jt
where jo.title_id = jt.title_id";


$stmt2 = $conn->query($query2);
$result2 = $stmt2->fetchall();
?>



<div class="min_wid">
    <div class="container-fluid mx-0 px-0">
        <div class="row mx-0 px-0">
            <div class="col-3 px-0" style="width: 20%;"><?php include_once "sidebar.php"; ?></div>
            <div class="col-9" style="width: 80%;">
                <br>
                <h2>List of Application</h2>
                <hr>
                
                <lable>Search</lable>
                <input type="text" class='search' id="live_search" autocomplete="off">
                <label class="ms-5">Position:</label>
                <select class='select-op' style="width: 200px;" id="position" name='position'>                    
                    <option value=''>Please select Position</option>
                    <?php foreach($result2 as $r2) {
                        echo "<option value='".$r2['title_name']."'>".$r2['title_name']."</option>";
                    } ?>
                                     
                </select>
                <button id="pdf" class="btn btn-primary float-end" data-pdf-id="1">PDF</button>
                
                <table id='candidate_list' class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Sr. No.</th>
                            <th scope="col">Person Id</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Position</th>
                            <th scope="col">Date of application</th>
                            <th scope="col">Status</th>


                        </tr>
                    </thead>
                    <tbody id="table_data">

                        <?php if(count($result)>0){
                        foreach ($result as $r) {  
                            $a_date = new DateTime($r['date_of_application']);
                            $apply_date = $a_date->format("d-m-Y"); 
                            ?>
                            <tr>
                                <td><?php  echo $num; $num++ ?></td>
                                <td><?php echo $r['person_id']; ?></td>
                                <td><?php echo strtoupper($r['First_name']); ?></td>
                                <td><?php echo strtoupper($r['Last_name']); ?></td>
                                <td><?php echo strtoupper($r['title_name']); ?></td>
                                <td><?php echo $apply_date;?></td>
                                <td><?php echo strtoupper($r['status']);?></td>
                                
                            </tr>

                        <?php } } else {echo "<td colspan=3><h4>No record Found.</h4></td>";} ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="approval" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Approval:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="approveApp">
                <form>
                <div class='input-text'>
                    <label for="interviewer">Interviewer</label>
                    <select class='select-op' id="interviewer" name='interviewer' required>
                        <option value=''>Please select interviewer</option>
                    </select>
                    <label for="interview_date">Interview Date</label>
                    <input type="date" id="interview_date" name="interview_date" required>
                </div>
                <button type='submit' id='submit' data-id='' class='btn1'>Submit</button>
                </form>
                
            </div>

        </div>
    </div>
</div>


<script type="text/javascript">
    //search
    $(document).ready(function(){
       
       
        $("#live_search").on("keyup", function(e)

        {
            var search_term = $(this).val().trim();
            var position = $('select[name="position"]').val().trim();
            $.ajax({
                url: 'report_man.php',
                type: 'POST',
                data: {
                    search: search_term,
                    position: position
                },
                success: function(data) {
                    $("#table_data").html(data);
                },
                
            });
        });

        
      $(document).on('click', '#pdf', function() {
        var pdf_id = $(this).data('pdf-id');
          $.ajax({
          url: 'report_pdf.php',
          type: 'POST',
          data:{pdf_id:pdf_id},
          success: function(response) {
            
            if (response.status === 'success') {
            window.open ('download/' + response.filepath,'_blank');
            }
            else {
               alert("Error" + response.message);
               alert(response.status);
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

<?php include_once "footer.php" ?>
