<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="fas fa-home"></i> Dashboard</a>
  <ul>
    <li class="<?php if ($page == 'dashboard') {
                  echo 'active';
                } ?>"><a href="index.php"><i class="fas fa-home"></i> <span>Dashboard</span></a> </li>
    <li class="<?php if ($page == 'member') {
                  echo 'submenu active';
                } else {
                  echo 'submenu';
                } ?>"> <a href="#"><i class="fas fa-users"></i> <span>Manage Offices</span></a>
      <ul>
        <li><a href="members.php"><i class="fas fa-arrow-right"></i> List of All Offices</a></li>
        <li><a href="member-entry.php"><i class="fas fa-arrow-right"></i> Create New Record</a></li>
        <li><a href="remove-member.php"><i class="fas fa-arrow-right"></i> Remove Record</a></li>
        <li><a href="edit-member.php"><i class="fas fa-arrow-right"></i> Update Record Details</a></li>
      </ul>
    </li>

    <li class="<?php if ($page == 'equipment') {
                  echo 'submenu active';
                } else {
                  echo 'submenu';
                } ?>"> <a href="#"><i class="fas fa-cogs"></i> <span>Product and Supply</span> </a>
      <ul>
        <li><a href="equipment.php"><i class="fas fa-arrow-right"></i> List of Product & Supply</a></li>
        <li><a href="equipment-entry.php"><i class="fas fa-arrow-right"></i> Add Product & Supply</a></li>
        <li><a href="remove-equipment.php"><i class="fas fa-arrow-right"></i> Remove Product & Supply</a></li>
        <li><a href="edit-equipment.php"><i class="fas fa-arrow-right"></i> Update Product & Supply Details</a></li>
      </ul>
    </li>

    <li class="<?php if ($page == 'announcement') {
                  echo 'active';
                } ?>"><a href="staff-announcement.php"><i class="fas fa-bullhorn"></i><span>Announcement</span></a></li>

    <li class="<?php if ($page == 'membersts') {
                  echo 'active';
                } ?>"><a href="member-status.php"><i class="fas fa-eye"></i> <span>Office's Status</span></a></li>

  </ul>
</div>

<style>
  div #sidebar {
    background-color: #1f262d;
  }

  body {
    background-color: #1f262d;
  }

  #header img {
    position: absolute;
    left: 10px;
    margin-bottom: 20px;
  }
</style>
<!--sidebar-menu-->