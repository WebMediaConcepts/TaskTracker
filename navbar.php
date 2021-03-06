<?php
$accountid = $_SESSION["AccountID"];
$roleid = $_SESSION["RoleID"];
include "DAL/rolestopermissions.php";


?>
<!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">
		<i class="fa fa-cloud"></i> TaskTracker
		<!--<img src="tasktrackerlogo.png" style="height: 50px;">-->
	</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Update Account Information">
              <a class="nav-link" href="ViewAccount.php?accountid=<?php echo $accountid ?>">
                  <i class="fa fa-fw fa-user"></i>
                  <span class="nav-link-text">My Account</span>
              </a>
          </li>
          <?php
          $PermissionsList = Rolestopermissions::loadbyroleid($roleid);
          foreach($PermissionsList as $permission)
          {
              if($permission->getPermissionID() == 5){  //Can Search tasks
            ?>
                  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Create Project">
                      <a class="nav-link" href="SearchTasks.php">
                          <i class="fa fa-fw fa-search"></i>
                          <span class="nav-link-text">Search Tasks</span>
                      </a>
                  </li>
          <?php
              }
              if($permission->getPermissionID() == 1){
            ?>
                  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Create Task">
                      <a class="nav-link" href="CreateTask.php">
                          <i class="fa fa-fw fa-plus-square-o"></i>
                          <span class="nav-link-text">Create Task</span>
                      </a>
                  </li>
          <?php
              }
              if($permission->getPermissionID() == 3){
                  ?>
                  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Create Project">
                      <a class="nav-link" href="CreateProject.php">
                          <i class="fa fa-fw fa-pencil-square-o"></i>
                          <span class="nav-link-text">Create Project</span>
                      </a>
                  </li>
          <?php
              }
              if($permission->getPermissionID() == 3){
                  ?>
                  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Create Project">
                      <a class="nav-link" href="CreateRole.php">
                          <i class="fa fa-fw fa-user-plus"></i>
                          <span class="nav-link-text">Create Role</span>
                      </a>
                  </li>
          <?php
              }
          }
          ?>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i>
            <span class="d-lg-none">Messages
              <span class="badge badge-pill badge-primary">12 New</span>
            </span>
            <span class="indicator text-primary d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Messages:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>David Miller</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>Jane Smith</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>John Doe</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all messages</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts
              <span class="badge badge-pill badge-warning">6 New</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">New Alerts:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-danger">
                <strong>
                  <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all alerts</a>
          </div>
        </li>
        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 mr-lg-2" method="post" action="SearchTasks.php">
            <div class="input-group">
                <!--<div class="input-group-btn">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tasks
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" id="aTasks">Tasks</a>
                        <a class="dropdown-item" id="aAccounts"">Accounts</a>
                    </div>
                </div>-->
              <input class="form-control" name="searchBox" type="text" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button" type="submit">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>