<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('location:../index.php');
  exit();
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  include 'dbcon.php';

  $qry = "UPDATE members SET reminder = '1' WHERE user_id = $id";
  $result = mysqli_query($con, $qry);

  if ($result) {
    echo json_encode(['success' => true]);
  } else {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => mysqli_error($con)]);
  }

  mysqli_close($con);
}
?>
