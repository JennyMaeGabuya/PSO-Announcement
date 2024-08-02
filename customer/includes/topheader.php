<div id="header">
  <img class="logo-large" src="../img/header_logo.png" alt="Logo" style="width: 200px; height: 80px;">
  <img class="logo-small" src="../img/header_logo.png" alt="Small Logo" style="width: 135px; height: 55px;">
</div>

<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav right">
    <li class="dropdown" id="profile-messages"><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i> <span class="text">Welcome @officeName</span><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="../pages/my-report.php"><i class="icon-file"></i> My Report</a></li>
        <li class="divider"></li>
        <li><a href="to-do.php"><i class="icon-user"></i> My Profile</a></li>
        <li class="divider "></li>
        <li><a href="../logout.php"><i class="icon-key"></i> Log Out</a></li>
      </ul>
    </li>

    <li class=""><a title="" href="../logout.php"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
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
</style>a