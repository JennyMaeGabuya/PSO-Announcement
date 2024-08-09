<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit();
}

// Include the database connection file
include '../dbcon.php'; // Ensure the path is correct

// Base query to filter by 'Staff' or 'All'
$qry = "SELECT * FROM announcements WHERE (toWho = 'Staff' OR toWho = 'All')";

// Check if filtering by date range
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    if ($start_date && $end_date) {
        // Add date filter to the query
        $qry .= " AND date BETWEEN '$start_date' AND '$end_date'";
    }
}

// Order by the most recent announcements
$qry .= " ORDER BY id DESC";

$result = mysqli_query($con, $qry);

// Output the table structure
echo "<table class='table table-bordered table-hover announcement-table'>
        <thead>
            <tr>
                <th style='font-size: 13px;'><div class='text-center'>#</th>
                <th style='font-size: 13px;'><div class='text-center'>Date</th>
                <th style='font-size: 13px;'><div class='text-center'>Subject</th>
                <th style='font-size: 13px;'><div class='text-center'>Message</th>
                <th style='font-size: 13px;'><div class='text-center'>Action</th>
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
            <td style='font-weight: bold; font-size: 13px;'><div class='text-center'>" . $cnt . "</div></td>
            <td style='font-size: 13px;'><div class='text-center'>" . $row['date'] . "</div></td>
            <td style='font-size: 13px;'><div class='text-center'>" . $row['subject'] . "</div></td>
            <td style='font-size: 13px;'><div class='text-center'>" . $message . "</div></td>
            <td style='font-size: 13px;'><div class='text-center'><a href='view-announcement.php?id=" . $row['id'] . "' style='color:#0080FF;' ><i class='fas fa-eye'></i> View</a></div></td>
          </tr>";
    $cnt--; // Decrease the count for the next row
}

echo "</tbody>
      </table>";
