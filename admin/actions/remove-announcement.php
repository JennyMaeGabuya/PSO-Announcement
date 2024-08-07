<?php

session_start();
// The isset function to check if username is already logged in and stored in the session
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    include '../dbcon.php';

    $qry = "DELETE FROM announcements WHERE id = $id";
    $result = mysqli_query($con, $qry);

    if ($result) {
        // Redirect back with a success parameter
        header('Location: ../manage-announcement.php?success=true');
    } else {
        // Redirect back with an error parameter
        header('Location: ../manage-announcement.php?success=false');
    }
}
