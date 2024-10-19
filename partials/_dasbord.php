<?php
session_start();
include "_dbconnect.php";

$sql = "
   SELECT 
 max(a1.t_user) t_user,
 max(a1.a_user) a_user,
 max(a1.r_user) r_user,
 max(a1.p_user) p_user,
 max(a1.total_complaints) total_complaints,
 max(a1.comp_approved) comp_approved,
 max(a1.comp_reject) comp_reject,
 max(a1.comp_pending) comp_pending
FROM(
SELECT 
    COUNT(users.user_id) AS t_user,
    SUM( users.user_status = 'approved') AS a_user,
    SUM( users.user_status = 'reject') AS r_user,
    SUM( users.user_status is NUll) as p_user,
	NULL total_complaints,
    NULL AS comp_approved,
    NULL AS comp_reject,
    NULL comp_pending
FROM 
    users
	UNION 
	SELECT
	NULL t_user,
	NULL a_user,
    NULL AS r_user,
    NULL AS p_user,
    COUNT(complaints.complaint_id) AS total_complaints,
    SUM(complaints.complaints_status = 'solved') AS comp_approved,
    SUM(complaints.complaints_status = 'reject') AS comp_reject,
    SUM(complaints.complaints_status = 'pending...') AS comp_pending
FROM 
   complaints) a1
";
$result = mysqli_query($conn, $sql);

echo "<div class='w3-container w3-teal'>
                <h4>Dashboard</h4>
            </div>
            <div class='dashcss'>";

if ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='flip-card'>
            <div class='flip-card-inner'>
                <div class='flip-card-front'>
                    <img src='https://cdn.dribbble.com/users/673318/screenshots/2907588/media/13d08ca843a8d59d170f5b280735ea95.jpg' alt='Avatar' style='width:300px;height:300px;'>
                </div>
                <div class='flip-card-back'>
                    <h4>Total Users</h4>
                    <p>{$row['t_user']}</p>
                    <h4>Pending Users</h4>
                    <p>{$row['p_user']}</p>
                    <h4>Approved Users</h4>
                    <p>{$row['a_user']}</p>
                    <h4>Rejected Users</h4>
                    <p>{$row['r_user']}</p>
                </div>
            </div>
        </div>";

    echo "<div class='flip-card'>
            <div class='flip-card-inner'>
                <div class='flip-card-front'>
                    <img src='https://cdn-icons-png.flaticon.com/512/1380/1380338.png' alt='Avatar' style='width:300px;height:300px;'>
                </div>
                <div class='flip-card-back'>
                    <h4>Total Complaints</h4>
                    <p>{$row['total_complaints']}</p>
                    <h4>Resolved Complaints</h4>
                    <p>{$row['comp_approved']}</p>
                    <h4>Rejected Complaints</h4>
                    <p>{$row['comp_reject']}</p>
                    <h4>Pending Complaints</h4>
                    <p>{$row['comp_pending']}</p>
                </div>
            </div>
        </div>";
}

echo "</div>";
?>
