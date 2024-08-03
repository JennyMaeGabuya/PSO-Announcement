<?php
// Check if the user's name is stored in the session
$user_name = ''; // Default user name if not found

if (isset($_SESSION['fullname'])) {
  $user_name = $_SESSION['fullname'];
} else {
  // Fetch user name from database if not set in session
  include "../dbcon.php"; // Adjust the path as necessary

  if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $qry = "SELECT fullname FROM staffs WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $qry);

    if ($result && $row = mysqli_fetch_assoc($result)) {
      $user_name = $row['fullname'];
      $_SESSION['fullname'] = $user_name; // Store in session for future use
    }

    mysqli_close($con);
  }
}
?>

<div id="header">
  <img class="logo-large" src="../img/header_logo.png" alt="Logo" style="width: 200px; height: 80px;">
  <img class="logo-small" src="../img/header_logo.png" alt="Small Logo" style="width: 120px; height: 40px;">
</div>

<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav right">
    <li class="dropdown" id="profile-messages">
      <a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle">
        <i class="fas fa-user"></i> <span class="text"> Welcome <?php echo htmlspecialchars($user_name); ?> <b class="caret"></b>
      </a>
      <ul class="dropdown-menu">
        <li><a href="#"><i class="fas fa-user"></i> My Profile</a></li>
        <li class="divider"></li>
        <li><a href="#"><i class="fas fa-lock"></i> Change Password</a></li>
        <li class="divider"></li>
        <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
      </ul>
    </li>
    <li class="">
      <a title="" href="../logout.php">
        <i class="fas fa-sign-out-alt"></i> <span class="text">Logout</span>
      </a>
    </li>
  </ul>
</div>

<style>
  #header img {
    position: absolute;
    left: 10px;
    margin-bottom: 20px;
  }

  .logo-small {
    display: none;
  }

  @media (max-width: 768px) {
    .logo-large {
      display: none;
    }

    .logo-small {
      display: block;
    }
  }
</style>