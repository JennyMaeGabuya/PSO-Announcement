<?php
session_start();
// the isset function to check username is already logged in and stored in the session
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit();
}

include "dbcon.php";

$qry = "SELECT * FROM announcements ORDER BY id DESC"; // Fetch data in descending order of id

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $qry = "SELECT * FROM announcements WHERE date BETWEEN '$start_date' AND '$end_date' ORDER BY id DESC";
}

$result = mysqli_query($conn, $qry);

echo "<table class='table table-bordered table-hover announcement-table'>
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>";

$totalRows = mysqli_num_rows($result); // Get the total number of rows
$cnt = $totalRows; // Start with the total number of rows

while ($row = mysqli_fetch_array($result)) {
    // Truncate the message to the first 15 words
    $message = implode(' ', array_slice(explode(' ', $row['message']), 0, 15));
    $message = strlen($row['message']) > 15 ? $message . "..." : $message;

    echo "<tr>
            <td style='font-weight: bold;'><div class='text-center'>" . $cnt . "</div></td>
            <td><div class='text-center'>" . $row['date'] . "</div></td>
            <td><div class='text-center'>" . $message . "</div></td>
            <td><div class='text-center'><a href='view-announcement.php?id=" . $row['id'] . "' style='color:#0080FF;' ><i class='fas fa-eye'></i> View</a></div></td>
          </tr>";
    $cnt--; // Decrease the count for the next row
}

echo "</tbody>
      </table>";
?>
