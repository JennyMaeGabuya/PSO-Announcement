<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul style="background-color: #4E4E4E;">
    <li class="<?php if($page=='dashboard'){ echo 'active'; }?>"><a href="index.php"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li class="<?php if($page=='member'){ echo 'submenu active'; } else { echo 'submenu';}?>"> <a href="#"><i class="icon icon-group"></i> <span>Manage Offices</span></a>
      <ul>
        <li><a href="members.php">List of All Offices</a></li>
        <li><a href="member-entry.php">Create New Record</a></li>
        <li><a href="remove-member.php">Remove Record</a></li>
        <li><a href="edit-member.php">Update Record Details</a></li>
      </ul>
    </li>

    <li class="<?php if($page=='equipment'){ echo 'submenu active'; } else { echo 'submenu';}?>"> <a href="#"><i class="icon icon-cogs"></i> <span>Product and Supply</span> </a>
      <ul>
        <li><a href="staff-announcement.php">Announcements</a></li>
        <li><a href="equipment.php">List of Product & Supply</a></li>
        <li><a href="equipment-entry.php">Add Product & Supply</a></li>
        <li><a href="remove-equipment.php">Remove Product & Supply</a></li>
        <li><a href="edit-equipment.php">Update Product & Supply Details</a></li>
      </ul>
    </li>
    <li class="<?php if($page=='membersts'){ echo 'active'; }?>"><a href="member-status.php"><i class="icon icon-eye-open"></i> <span>Office's Status</span></a></li>

  </ul>
</div>
<!--sidebar-menu-->