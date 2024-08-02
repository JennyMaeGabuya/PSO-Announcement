<div id="header">
  <img class="logo-large" src="../img/header_logo.png" alt="Logo" style="width: 200px; height: 80px;">
  <img class="logo-small" src="../img/header_logo.png" alt="Small Logo" style="width: 120px; height: 40px;">
</div>

<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav right">
    <li class="dropdown" id="profile-messages">
      <a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle">
        <i class="fas fa-user-circle"></i> <span class="text">Welcome Admin</span><b class="caret"></b>
      </a>
      <ul class="dropdown-menu">
        <li><a href="#"><i class="fas fa-user"></i> My Profile</a></li>
        <li class="divider"></li>
        <li><a href="change-password.php"><i class="fas fa-cog"></i> Change Password</a></li>
        <li class="divider"></li>
        <li><a href="../logout.php"><i class="fas fa-key"></i> Log Out</a></li>
      </ul>
    </li>
    <li class=""><a title="" href="../logout.php"><i class="fas fa-power-off"></i> <span class="text">Logout</span></a></li>
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

  #content #content-header {
      border: 2px solid #ddd;
      padding: 10px;
      background-color: #f5f5f5;
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