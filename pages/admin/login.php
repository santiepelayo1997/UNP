<?php
  include "../header.php";
  session_start();
  error_reporting(0);
  include('../config.php');

if(isset($_POST['signin']))
{
    $uname=$_POST['username'];
    $password=$_POST['password'];
    $sql ="SELECT username,password,id,status FROM tbl_adminAccount WHERE username=:uname and password=:password";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':uname', $uname, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);

        if($query->rowCount() > 0)
        {
         foreach ($results as $result)
          {
            $status=$result->status;
            $_SESSION['adminSession']=$result->id;
          }
              if($status==0)
              {
                alert("Your account is Inactive. Please contact admin");
              }
              else
              {
                     $_SESSION['adminSession']=$_POST['username'];
                     echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
              } 
        }

  else
  {
    echo "<script>alert('Invalid Details');</script>";
  }

}
?>
<body class="login-page">
    <div class="login-box">
        <div class="logo">
        </div>
        <form method="POST">
        <div class="card">
              <div class="header bg-blue">
               <center> <img style="width:100px; height:100px;" src="../../images/logo.png" alt="logo"><br>
                <h4>Admin</h4>
              <h2>Login your account.</h2></center>
              </div>
            <div class="body">
              <br>
                <div class="tab-content">
                 <div role="tabpanel" class="tab-pane animated flipInX active"> 
              <form id="sign_in_student" method="POST">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control disabletype" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control disabletype" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                      <br>
                      <div class="col-xs-8">
                           <button  style="margin-left:62px;" class="btn btn-block btn-lg bg-blue waves-effect disabletype" type="submit" name="signin">SIGN IN</button>
                        </div>
                    </div>
              </form>
             </div>
             </div>
         </div>
    </div>
  </form>
</div>
<?php
  include "../footer.php";
?>
