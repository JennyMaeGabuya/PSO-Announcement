<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('location:../index.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $toWho = $_POST["target_audience"];
  $subject = $_POST["subject"];
  $message = $_POST["message"];
  $date = $_POST["date"];

  include 'dbcon.php';

  if (!$con) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed.']);
    exit();
  }

  date_default_timezone_set('Asia/Manila');
  $currentDateTime = date("Y-m-d H:i:s");

  $stmt = $con->prepare("INSERT INTO announcements (toWho, subject, message, date) VALUES (?, ?, ?, ?)");
  if ($stmt === false) {
    echo json_encode(['status' => 'error', 'message' => 'Prepare statement failed: ' . $con->error]);
    exit();
  }

  $stmt->bind_param("ssss", $toWho, $subject, $message, $currentDateTime);

  if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Execution failed: ' . $stmt->error]);
  }

  $stmt->close();
  $con->close();
}
