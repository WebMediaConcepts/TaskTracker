<?php
#region validate query and include class declarations
session_start();
if($_SESSION["LoggedIn"] == "")
{
	header("location:login.php?msg=notloggedin");
}
include "DAL/prioritytypes.php";
include "DAL/accounts.php";
include "DAL/statustypes.php";
include "DAL/tasks.php";
include "DAL/tasktypes.php";
include "DAL/projects.php";
if($_SERVER["REQUEST_METHOD"] == "GET")
{
    if(isset($_GET['msg']))
        $alertmsg = $_GET['msg'];

    //existing tasks
    if(isset($_GET['cmd']) && isset($_GET['taskid']))
    {
        if($_GET['cmd'] == "edit" && is_numeric($_GET['taskid']))
        {
            $edittask = new Tasks();
            $edittask->load($_GET['taskid']);
            $edittaskid = $edittask->getTaskID();
            $edittaskname = $edittask->getTaskName();
            $edittasktypeid = $edittask->getTaskTypeID();
            $edittaskpriorirtytypeid = $edittask->getPriorityTypeID();
            $edittaskassigneeaccountid = $edittask->getAssigneeAccountID();
            $edittaskreporteraccountid = $edittask->getReporterAccountID();
            $edittaskprojectid = $edittask->getProjectID();
            $edittaskdescription = $edittask->getDescription();
            $edittaskstatustypeid = $edittask->getStatusTypeID();
            $edittaskcreatedate = $edittask->getCreateDate();
            $edittaskclosedate = $edittask->getCloseDate();
            $edittaskreopendate = $edittask->getReopenDate();
        }
    }
}
#endregion
?>
<!DOCTYPE html>
<html lang="en">

<?php include "head.php" ?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">

<?php include "navbar.php" ?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Create Task</li>
      </ol>

      <div class="row">
	  
        <div class="col-lg-8">
            <?php if(isset($alertmsg)) { ?>
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h4> <?php  echo $alertmsg; ?> </h4>
                </div>
              <?php } ?>
                <div class="card">
                  <div class="card-header">
                      <?php if(isset($edittaskid)) { ?>
                          Edit Task ID: <?php echo $edittaskid ?>
                      <?php } else { ?>
                          Create Task
                      <?php } ?>
                     </div>
                  <div class="card-body">
                    <form id="formTask" method="post" action="PHP/_CreateTask.php" onsubmit="return doValidation()">
                        <div class="form-group">
                            <label for="TaskName">Task name</label>
                            <input id="inputTaskName" class="form-control" name="TaskName" type="text" aria-describedby="nameHelp" placeholder="Enter task name" value="<?php if(isset($edittaskname)) echo $edittaskname ?>">
                        </div>
                        <div class="form-group">
                            <div>
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label for="ddlTaskType">Task Type</label>
                                        <select id="inputTaskType" name="ddlTaskType" class="form-control">
                                            <?php
                                            if(isset($edittasktypeid))
                                            {
                                                $tt = new Tasktypes();
                                                $tt->load($edittasktypeid);
                                                echo "<option value='$edittasktypeid'>";
                                                echo $tt->getTaskType();
                                                echo "</option>";
                                            }
                                            else
                                            {
                                                echo '<option value="0">---Type---</option>';
                                            }
                                            $TaskTypesList = Tasktypes::loadall();
                                            foreach($TaskTypesList as $taskType)
                                            {
                                                if(isset($edittasktypeid) && $taskType->getTaskTypeID() == $edittasktypeid)
                                                {
                                                    //skip
                                                }
                                                else
                                                {
                                                    $tasktypeid = $taskType->getTaskTypeID();
                                                    echo "<option value='$tasktypeid'>";
                                                    echo $taskType->getTaskType();
                                                    echo "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="ddlPriorityType">Priority</label>
                                        <select id="inputPriorityType" name="ddlPriorityType" class="form-control">
                                            <?php
                                            if(isset($edittaskpriorirtytypeid))
                                            {
                                                $pt = new Prioritytypes();
                                                $pt->load($edittaskpriorirtytypeid);
                                                echo "<option value='$edittaskpriorirtytypeid'>";
                                                echo $pt->getPriorityType();
                                                echo '</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="0">---Priority---</option>';
                                            }

                                            $PriorityTypesList = Prioritytypes::loadall();
                                            foreach($PriorityTypesList as $priorityType)
                                            {
                                                if(isset($edittaskprioritytype) && $priorityType->getPriorityTypeID() == $edittaskprioritytype)
                                                {
                                                    //skip
                                                }
                                                else
                                                {
                                                    $prioritytypeid = $priorityType->getPriorityTypeID();
                                                    echo "<option value='$prioritytypeid'>";
                                                    echo $priorityType->getPriorityType();
                                                    echo '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label for="ddlAssignee">Assign To</label>
                                        <select id="inputAssigneeAccountID" name="ddlAssignee" class="form-control">
                                            <?php
                                            if(isset($edittaskassigneeaccountid))
                                            {
                                                $a = new Accounts();
                                                $a->load($edittaskassigneeaccountid);
                                                echo "<option value='$edittaskassigneeaccountid'>";
                                                echo $a->getFirstName()." ". $a->getLastName();
                                                echo '</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="0">---Assignee---</option>';
                                            }

                                            $AssigneeAccountList = Accounts::loadall();
                                            foreach($AssigneeAccountList as $assigneeAccount)
                                            {
                                                if(isset($edittaskassigneeaccountid) && $assigneeAccount->getAccountID() == $edittaskassigneeaccountid)
                                                {
                                                    //skip
                                                }
                                                else
                                                {
                                                    $accountid = $assigneeAccount->getAccountID();
                                                    echo "<option value='$accountid'>";
                                                    echo $assigneeAccount->getFirstName(). " " .$assigneeAccount->getLastName();
                                                    echo '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="ddlProjects">Project</label>
                                        <select id="inputProjectID" name="ddlProjects" class="form-control">
                                            <?php
                                            if(isset($edittaskprojectid))
                                            {
                                                $p = new Projects();
                                                $p->load($edittaskprojectid);
                                                echo "<option value='$edittaskprojectid'>";
                                                echo $p->getProjectName();
                                                echo '</option>';
                                            }
                                            else
                                            {
                                              echo '<option value="0">---Project---</option>';
                                            }

                                            $ProjectList = Projects::loadall();
                                            foreach($ProjectList as $project)
                                            {
                                                if(isset($edittaskprojectid) && $project->getProjectID() == $edittaskprojectid)
                                                {
                                                    //skip
                                                }
                                                else
                                                {
                                                    $projectid = $project->getProjectID();
                                                    echo "<option value='$projectid'>";
                                                    echo $project->getProjectName();
                                                    echo '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtDescription">Description</label>
                            <textarea id="inputDescription" name="txtDescription" class="form-control" rows="5"><?php if(isset($edittaskdescription)) echo $edittaskdescription ?></textarea>
                        </div>
                        <input type="hidden" name="edittaskid" value="<?php echo $edittaskid ?>">
                        <input type="hidden" name="edittaskreporteraccountid" value="<?php echo $edittaskreporteraccountid ?>">
                        <input type="hidden" name="edittaskstatustypeid" value="<?php echo $edittaskstatustypeid ?>">
                        <input type="hidden" name="edittaskcreatedate" value="<?php echo $edittaskcreatedate ?>">
                        <input type="hidden" name="edittaskclosedate" value="<?php echo $edittaskclosedate ?>">
                        <input type="hidden" name="edittaskreopendate" value="<?php echo $edittaskreopendate ?>">
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <?php if(isset($edittaskid)) { ?>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button class="btn btn-primary btn-block" type="submit">Save Changes</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <a class="btn btn-secondary btn-block" href="ViewTask.php?taskid=<?php echo $edittaskid ?>">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button class="btn btn-primary btn-block" type="submit">Create Task</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <a class="btn btn-secondary btn-block" href="index.php">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>

                    </form>
                  </div>
                </div>
        </div>
        <div class="col-lg-4">

          <?php include "tasks.php"; ?>
        </div>
      </div>

    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
  </div>
<?php include "footer.php"?>
<?php include "modal.php"?>
<?php include "scripts.php" ?>
<script>
    function doValidation() {
        var isValid = true;
        var taskName = $("#inputTaskName").val();
        var description = $("#inputDescription").val();
        var taskType = $("#inputTaskType").val();
        var priorityType = $("#inputPriorityType").val();
        var assigneeAccountID = $("#inputAssigneeAccountID").val();
        var projectID = $("#inputProjectID").val();
        if(taskName.length > 0)
        {
            $("#inputTaskName").addClass("is-valid");
            $("#inputTaskName").removeClass("is-invalid");
        }
        else
        {
            $("#inputTaskName").addClass("is-invalid");
            $("#inputTaskName").removeClass("is-valid");
            isValid = false;
        }


        if(taskType != 0)
        {
            $("#inputTaskType").addClass("is-valid");
            $("#inputTaskType").removeClass("is-invalid");
        }
        else
        {
            $("#inputTaskType").addClass("is-invalid");
            $("#inputTaskType").removeClass("is-valid");
            isValid = false;
        }

        if(priorityType != 0)
        {
            $("#inputPriorityType").addClass("is-valid");
            $("#inputPriorityType").removeClass("is-invalid");
        }
        else
        {
            $("#inputPriorityType").addClass("is-invalid");
            $("#inputPriorityType").removeClass("is-valid");
            isValid = false;
        }

        if(assigneeAccountID != 0)
        {
            $("#inputAssigneeAccountID").addClass("is-valid");
            $("#inputAssigneeAccountID").removeClass("is-invalid");
        }
        else
        {
            $("#inputAssigneeAccountID").addClass("is-invalid");
            $("#inputAssigneeAccountID").removeClass("is-valid");
            isValid = false;
        }

        if(projectID != 0)
        {
            $("#inputProjectID").addClass("is-valid");
            $("#inputProjectID").removeClass("is-invalid");
        }
        else
        {
            $("#inputProjectID").addClass("is-invalid");
            $("#inputProjectID").removeClass("is-valid");
            isValid = false;
        }


        if(description.length > 0)
        {
            $("#inputDescription").addClass("is-valid");
            $("#inputDescription").removeClass("is-invalid");
        }
        else
        {
            $("#inputDescription").addClass("is-invalid");
            $("#inputDescription").removeClass("is-valid");
            isValid = false;
        }
        return isValid;
    }
</script>
</body>

</html>
