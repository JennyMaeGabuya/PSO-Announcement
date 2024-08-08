<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit();
}

// Include the database connection file
include '../dbcon.php'; // Ensure the path is correct

// Base query for fetching announcements
$qry = "SELECT * FROM announcements WHERE (toWho = 'User' OR toWho = 'All') ORDER BY id DESC";

// Apply date filter if POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $qry = "SELECT * FROM announcements WHERE date BETWEEN '$start_date' AND '$end_date' ORDER BY id DESC";
}

// Execute the query
$result = mysqli_query($conn, $qry);

// Check if query execution was successful
if (!$result) {
    die("Error: " . mysqli_error($conn));
}

// Output the table rows
$cnt = 1; // Initialize the counter for the table rows
while ($row = mysqli_fetch_array($result)) {
    // Truncate the message to the first 25 characters (adjust as needed)
    $message = substr($row['message'], 0, 25);
    $message = strlen($row['message']) > 25 ? $message . "..." : $message;

    // Generate table row with "View" button and icon
    echo "<tr>
            <td style='font-weight: bold; font-size: 13px;'><div class='text-center'>" . $cnt . "</div></td>
            <td style='font-size: 13px;'><div class='text-center'>" . $row['date'] . "</div></td>
            <td style='font-size: 13px;'><div class='text-center'>" . $message . "</div></td>
            <td style='font-size: 13px;'><div class='text-center'><a href='view-announcement.php?id=" . $row['id'] . "' class='btn-view'><i class='fas fa-eye'></i></a></div></td>
          </tr>";

    $cnt++; // Increment the counter for the next row
}

mysqli_close($conn); // Close the database connection
?>
