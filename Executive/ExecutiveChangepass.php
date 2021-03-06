<?php
define('TITLE', 'Change Password');
include('../dbconnect.php');
include('../headerfooter/header.php'); 
session_start();
 if(isset($_SESSION['is_Executivelogin'])){
  $ExecutiveEmail = $_SESSION['ExecutiveEmail'];
 } else {
  echo "<script> location.href='ExecutiveLogin.php'; </script>";
 }
 $ExecutiveEmail = $_SESSION['ExecutiveEmail'];
 if(isset($_REQUEST['passupdate'])){
  if(($_REQUEST['ExecutivePassword'] == "")){
   // msg displayed if required field missing
   $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
    $sql = "SELECT * FROM executivelogin_tb WHERE e_email='$ExecutiveEmail'";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
     $ExecutivePassword = $_REQUEST['ExecutivePassword'];
     $sql = "UPDATE executivelogin_tb SET e_pass = '$ExecutivePassword' WHERE e_email = '$ExecutiveEmail'";
      if($conn->query($sql) == TRUE){
       // below msg display on form submit success
       $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
      } else {
       // below msg display on form submit failed
       $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
      }
    }
   }
}
?>
<p class="mt-5 text-center" style="font-size: 20px;"><span>Change Password</span>
</p>
<div class="container-fluid mb-5">
    <div class="row justify-content-center custom-margin">
        <div class="col-sm-6 col-md-4">
            <form class="mt-1 mx-5">
                <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control" id="inputEmail" value=" <?php echo $ExecutiveEmail ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="inputnewpassword">New Password</label>
                    <input type="text" class="form-control" id="inputnewpassword" placeholder="New Password"
                        name="ExecutivePassword">
                </div>
                <button type="submit" class="btn btn-danger mr-4 mt-4" name="passupdate">Update</button>
                <button type="reset" class="btn btn-secondary mt-4">Reset</button>
                <?php if(isset($passmsg)) {echo $passmsg; } ?>
            </form>
            <div class="text-center"><a class="btn btn-info mt-3 shadow-sm font-weight-bold" href="ExecutiveDashboard.php">Back
                    to Dashboard</a></div>
        </div>
    </div>
</div>
</div>
</div>