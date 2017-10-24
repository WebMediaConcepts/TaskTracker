<?php
session_start();
if($_SESSION["LoggedIn"] == "")
{
	header("location:login.php?msg=notloggedin");
}


include "DAL/projects.php";
include "DAL/accounts.php";
include "DAL/projectcategorytypes.php";

if($_SERVER["REQUEST_METHOD"] == "GET")
{
    if(isset($_GET['msg']))
        $alertmsg = $_GET['msg'];
    //existing accounts
    if(isset($_GET['cmd']) && isset($_GET['projectid']))
    {
        if($_GET['cmd'] == "edit" && is_numeric($_GET['projectid']))
        {

            $editproject = new Projects();
            $editproject->load($_GET['projectid']);
            $editprojectid = $editproject->getProjectId();
            $editprojectname = $editproject->getProjectName();
            $editprojectcategoryid = $editproject->getProjectCategoryID();
            $editprojectleadaccountid = $editproject->getProjectLeadAccountID();
            $editprojecturl = $editproject->getProjectURL();
            $editprojectimgurl = $editproject->getImgURL();
            $editprojectdescription = $editproject->getProjectDescription();
        }
    }
}


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
        <li class="breadcrumb-item active">Create Project</li>
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
                      <?php if(isset($editprojectname)) { ?>
                          Edit <?php echo $editprojectname ?>
                      <?php } else { ?>
                          Create Project
                      <?php } ?>
                  </div>
                  <div class="card-body">

                    <form id="formRegister" method="post" action="PHP/_CreateProject.php" onsubmit="return doValidation()">
                        <input type="hidden" name="editprojectid" value="<?php echo $editprojectid ?>">
                        <div class="form-group">
                            <label for="ProjectName">Project name</label>
                            <input id="inputProjectName" class="form-control" name="ProjectName" type="text" aria-describedby="nameHelp" placeholder="Enter project name" value="<?php if(isset($editprojectname)) echo $editprojectname ?>">
                        </div>
                        <div class="form-group">
                            <label for="ProjectImgURL">Image URL</label>
                            <input id="inputImgURL" class="form-control" name="ProjectImgURL" type="text" aria-describedby="nameHelp" placeholder="Enter project image URL" value="<?php if(isset($editprojectimgurl)) echo $editprojectimgurl ?>">
                        </div>
                        <div class="form-group">
                            <label for="ProjectURL">Project URL</label>
                            <input id="inputProjectURL" class="form-control" name="ProjectURL" type="text" aria-describedby="nameHelp" placeholder="Enter project image URL"  value="<?php if(isset($editprojecturl)) echo $editprojecturl ?>">
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="ddlProjectCategoryTypes">Project Category</label>
                                <select id="inputProjectCategoryType" name="ddlProjectCategoryTypes" class="form-control">
                                <?php

                                if(isset($editprojectcategoryid))
                                {
                                    $p = new Projectcategorytypes();
                                    $p->load($editprojectcategoryid);
                                    $projectCategoryName = $p->getProjectCategory();
                                    echo "<option value='$editprojectcategoryid'>";
                                    echo $projectCategoryName;
                                    echo '</option>';
                                }
                                else
                                {
                                    echo '<option value="0">---Project Category---</option>';
                                }

                                $ProjectCategoryList = Projectcategorytypes::loadall();
                                foreach($ProjectCategoryList as $projectCategory)
                                {
                                    if(isset($editprojectcategoryid) && $projectCategory->getProjectCategoryID() == $editprojectcategoryid)
                                    {
                                        //skip
                                    }
                                    else{
                                        $pid = $projectCategory->getProjectCategoryID();
                                        $pcname = $projectCategory->getProjectCategory();
                                        echo "<option value='$pid'>";
                                        echo $pcname;
                                        echo '</option>';
                                    }
                                }
                                ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="ddlProjectLeadAccountID">Project Lead</label>
                                <select id="inputProjectLeadAccountID" name="ddlProjectLeadAccountID" class="form-control">
                                <?php
                                if(isset($editprojectleadaccountid))
                                {
                                    $a = new Accounts();
                                    $a->load($editprojectleadaccountid);
                                    $projectleadfullname = $a->getFirstName(). " " .$a->getLastName();
                                    echo "<option value='$editprojectleadaccountid''>";
                                    echo $projectleadfullname;
                                    echo '</option>';
                                }
                                else
                                {
                                    echo '<option value="0">---Project Lead---</option>';
                                }
                                $ProjectLeadList = Accounts::loadall();
                                foreach($ProjectLeadList as $leadAccountID)
                                {
                                    if(isset($editprojectleadaccountid) && $editprojectleadaccountid == $leadAccountID->getAccountID())
                                    {
                                        //skip
                                    }
                                    else
                                    {
                                        $laid = $leadAccountID->getAccountID();
                                        $name = $leadAccountID->getFirstName(). " " .$leadAccountID->getLastName() ;
                                        echo "<option value='$laid'>";
                                        echo $name;
                                        echo '</option>';
                                    }
                                }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtDescription">Description</label>
                            <textarea id="inputDescription" name="txtDescription" class="form-control" rows="5"><?php if(isset($editprojectdescription)) echo $editprojectdescription ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <?php if(isset($editprojectname)) { ?>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button class="btn btn-primary btn-block" type="submit">Update <?php echo $editprojectname ?></button>
                                        </div>
                                        <div class="col-sm-6">
                                            <a class="btn btn-secondary btn-block" href="ViewProject.php?projectid=<?php echo $editprojectid  ?>">Cancel</a>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button class="btn btn-primary btn-block" type="submit">Create Project</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <a class="btn btn-secondary btn-block" href="index.php">Cancel</a>
                                        </div>
                                    </div>

                                <?php } ?>

                            </div>
                        </div>

                    </form>
                  </div>
                </div>
        </div>
        <div class="col-lg-4">
          <?php include "projects.php" ?>
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
        var projectName = $("#inputProjectName").val();
        var imgURL = $("#inputImgURL").val();
        var projectLink = $("#inputProjectURL").val();
        var projectCategoryType = $("#inputProjectCategoryType").val();
        var LeadAccountID = $("#inputProjectLeadAccountID").val();
        var description = $("#inputDescription").val();
        if(projectName.length > 0)
        {
            $("#inputProjectName").addClass("is-valid");
            $("#inputProjectName").removeClass("is-invalid");
        }
        else
        {
            $("#inputProjectName").addClass("is-invalid");
            $("#inputProjectName").removeClass("is-valid");
            isValid = false;
        }
        if(imgURL.length > 0)
        {
            $("#inputImgURL").addClass("is-valid");
            $("#inputImgURL").removeClass("is-invalid");
        }
        else
        {
            $("#inputImgURL").addClass("is-invalid");
            $("#inputImgURL").removeClass("is-valid");
            isValid = false;
        }
        if(projectLink.length > 0)
        {
            $("#inputProjectURL").addClass("is-valid");
            $("#inputProjectURL").removeClass("is-invalid");
        }
        else
        {
            $("#inputProjectURL").addClass("is-invalid");
            $("#inputProjectURL").removeClass("is-valid");
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

        if(projectCategoryType != 0)
        {
            $("#inputProjectCategoryType").addClass("is-valid");
            $("#inputProjectCategoryType").removeClass("is-invalid");
        }
        else
        {
            $("#inputProjectCategoryType").addClass("is-invalid");
            $("#inputProjectCategoryType").removeClass("is-valid");
            isValid = false;
        }

        if(LeadAccountID != 0)
        {
            $("#inputProjectLeadAccountID").addClass("is-valid");
            $("#inputProjectLeadAccountID").removeClass("is-invalid");
        }
        else
        {
            $("#inputProjectLeadAccountID").addClass("is-invalid");
            $("#inputProjectLeadAccountID").removeClass("is-valid");
            isValid = false;
        }

        return isValid;
    }
</script>
</body>

</html>
