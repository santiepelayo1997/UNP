<?php

include "../header.php";
session_start();
error_reporting(0);
include('../config.php');

if(strlen($_SESSION['adminSession'])==0)
    {   
        header('location:index.php');
    }
    else
    {
     if(isset($_GET['empid']))
        {
                $id=$_GET['empid'];
                $status=0;
                $sql = "DELETE FROM tbl_accounts WHERE id=:id";
                $query = $dbh->prepare($sql);
                $query -> bindParam(':id',$id, PDO::PARAM_STR);
                $query -> execute();
                header('location:adminAccount.php');
        }

        if(isset($_GET['activate']))
        {
                $id=$_GET['activate'];
                $status=1;
                $sql = "UPDATE tbl_accounts SET status=:status WHERE id=:id";
                $query = $dbh->prepare($sql);
                $query -> bindParam(':status',$status, PDO::PARAM_STR);
                $query -> bindParam(':id',$id, PDO::PARAM_STR);
                $query -> execute();
                  $btnSuccess = 3;
              
        }

          if(isset($_GET['deactivate']))
        {
                $id=$_GET['deactivate'];
                $status=0;
                $sql = "UPDATE tbl_accounts SET status=:status WHERE id=:id";
                $query = $dbh->prepare($sql);
                $query -> bindParam(':status',$status, PDO::PARAM_STR);
                $query -> bindParam(':id',$id, PDO::PARAM_STR);
                $query -> execute();
                $btnSuccess = 2;
        }

         if(isset($_POST['btnAdd']))
        {
                
                    $firstName=$_POST['firstName'];
                    $collegeName=$_POST['collegeName'];
                    $lastName=$_POST['lastName'];
                    $userName=$_POST['userName'];
                    $passWord=$_POST['passWord'];
                    $orgType=$_POST['orgType'];
                    $accountType=$_POST['accountType'];
                    $status = 1;
                   
                    $hash = password_hash($passWord, PASSWORD_DEFAULT);
                    try
                    {
                           $sql="INSERT INTO tbl_accounts (collegename,firstname,lastname,username,password,orgtype,accountType,status) VALUES(:collegeName,:firstName,:lastName,:userName,:passWord,:orgType,:accountType,:status)";

                            $query = $dbh->prepare($sql);
                            $query->bindParam(':collegeName',$collegeName,PDO::PARAM_STR);
                            $query->bindParam(':firstName',$firstName,PDO::PARAM_STR);
                            $query->bindParam(':lastName',$lastName,PDO::PARAM_STR);
                            $query->bindParam(':userName',$userName,PDO::PARAM_STR);
                            $query->bindParam(':passWord',$hash,PDO::PARAM_STR);
                            $query->bindParam(':orgType',$orgType,PDO::PARAM_STR);
                            $query->bindParam(':accountType',$accountType,PDO::PARAM_STR);
                            $query->bindParam(':status',$status,PDO::PARAM_STR);
                            $query->execute();
                            $btnSuccess = 1;
                          
                    }
                    catch(Exception $e)
                    {
                          $btnSuccess = 0;
                    }

                          
        }

          if(isset($_POST['btnUpdate']))
          {
            
                $firstName=$_POST['uFirstName'];
                $lastname=$_POST['uLastName'];
                $username=$_POST['uUserName'];
                $password=$_POST['uPassWord'];
                $UcollegeName=$_POST['UcollegeName'];
                $uorgType = $_POST['uorgType'];
                $UaccountType = $_POST['UpdateAccount'];
                $id=$_POST['varDocId'];
                $status=0;
                $hash = password_hash($password, PASSWORD_DEFAULT);
                 try
                    {
                
                  $sql = "UPDATE tbl_accounts set collegename=:UcollegeName,firstname=:firstname,lastname=:lastname,username=:username,password=:password,orgtype=:orgtype,accountType=:UaccountType WHERE id=:id";

                    $query = $dbh->prepare($sql);
                    $query -> bindParam(':id',$id, PDO::PARAM_STR);
                    $query -> bindParam(':UcollegeName',$UcollegeName, PDO::PARAM_STR);
                    $query -> bindParam(':firstname',$firstName, PDO::PARAM_STR);
                    $query -> bindParam(':lastname',$lastname, PDO::PARAM_STR);
                    $query -> bindParam(':username',$username, PDO::PARAM_STR);
                    $query -> bindParam(':password',$hash, PDO::PARAM_STR);
                    $query -> bindParam(':orgtype',$uorgType, PDO::PARAM_STR);
                    $query -> bindParam(':UaccountType',$UaccountType, PDO::PARAM_STR);
                    $query -> execute();
                     $btnSuccess = 1;

                    }
                    catch(Exception $e)
                    {
                          $btnSuccess = 0;
                    }
        }



     

     }

?>
<style type="text/css">
    td {
    white-space: nowrap;
}
</style>
<body class="theme-blue">

    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
            <img src="../../logo.png" width="51" height="51" align="left"><a class="navbar-brand" href="#">&nbsp;&nbsp;&nbsp;University of Northern Philippines</a>    
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                      <li class="pull-right"><a href="../home/login.php" class="js-right-sidebar" data-close="true"><i class="material-icons">exit_to_app</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../../images/admin.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Santie Pelayo</div>
                    <div class="email">ADMIN</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
                    <?php
                      include "adminMenu.php";
                    ?>
            <!-- #Menu -->

            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2018 - 2019 <a href="javascript:void(0);">Univeristy of Northern Philippines</a>.
                </div>
            </div>
            <!-- #Footer -->
        </aside>
    </section>

    <section class="content">

        <div class="container-fluid">
        <form method="POST" > 
            <input type="hidden" id="btnSuccess" name="btnSuccess" value="<?php echo $btnSuccess; ?>">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>
                                   Manage Accounts
                                   <i class="material-icons pull-right">account_circle</i>
                            </h2>
                        </div>
                        <div class="body">
                                <input type="hidden" name="varDocId" id="varDocId">
                            <button type="button" class="btn btn-info waves-effect" style="border-radius:20px;" data-toggle="modal" data-target="#defaultModal">Add New Account</button>&nbsp;&nbsp;
                            <br><br>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tblAccounts" >
                                    <thead>
                                        <tr>
                                            <th class="hidden">ID</th>
                                            <th>College Name</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Organizational Type</th>
                                            <th>Account Type</th>
                                            <th>Date Created</th>
                                            <th>Status</th>
                                            <th width="70%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 

                                            $sql = "SELECT * from tbl_accounts ";
                                            $query = $dbh -> prepare($sql);
                                            $query->execute();
                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt=1;
                                            if($query->rowCount() > 0)
                                            {
                                            foreach($results as $result)
                                            {               ?>  
                                        <tr>
                                                <td class="hidden"> <?php echo htmlentities($result->id);?></td>
                                                <td> <?php echo htmlentities($result->collegename);?></td>
                                                <td><?php echo htmlentities($result->firstname);?></td>
                                                <td><?php echo htmlentities($result->lastname);?></td>
                                                <td><?php echo htmlentities($result->username);?></td>
                                                <td><?php echo htmlentities($result->password);?></td>
                                                <td><?php echo htmlentities($result->orgtype);?></td>
                                                <td><?php echo htmlentities($result->accountType);?></td>
                                                <td><?php 
                                                  $date           = date('Y-m-d',strtotime($result->created_date));
                                           
                                                    echo htmlentities($date);
                                                   ?>
                                                </td>
                                                  <td><?php 
                                                        $status = $result->status;
                                                        if($status == 1)
                                                        {
                                                           echo "<span  class=\"label label-success\" style=\"font-size:12px;width:80px;;height:30px;\">Active</span>&nbsp";
                                                        }
                                                        else
                                                        {
                                                            echo "<span  class=\"label label-danger\" style=\"font-size:12px;width:80px;;height:30px;\">Inactive</span>&nbsp";
                                                        }

                                                      ?>
                                                  </td>
                                             <td>
                                                <a class="btn btn-danger waves-effect"   style="border-radius:10px;" href="adminAccount.php?empid=<?php echo htmlentities($result->id);?>"  onclick="return confirm('Do you want to delete this user?');"><i class="material-icons">delete</i></a>&nbsp;&nbsp;


                                                <button class="updateBtn btn btn-info waves-effect" type="button" data-toggle="modal" data-target="#updateModal" style="border-radius:10px;"><i class="material-icons">update</i></button>&nbsp;

                                                <?php 
                                                        $status = $result->status;
                                                        if($status == 1)
                                                        {
                                                        ?>
                                                           <a class="btn btn-danger waves-effect"   style="border-radius:10px;" href="adminAccount.php?deactivate=<?php echo htmlentities($result->id);?>"  onclick="return confirm('Do you want to Inactive this user?');"><i class="material-icons">report</i></a>
                                                     <?php }  else {     ?>
                                                         
                                                          <a class="btn btn-success waves-effect"   style="border-radius:10px;" href="adminAccount.php?activate=<?php echo htmlentities($result->id);?>"  onclick="return confirm('Do you want to Activate this user?');"><i class="material-icons">how_to_reg</i></a>

                                                     <?php   } ?>

                                               
                                            </td>
          
                                        </tr>   
                                         <?php $cnt++;
                                               } 
                                             }
                                         ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
            <!-- Default Size -->
            <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Add New Account</h4>
                        </div>
                        <div class="modal-body">
                             <div class="row clearfix">
                               <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="collegeName" id="collegeName" >
                                            <label class="form-label">College Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="firstName" id="firstName">
                                            <label class="form-label">First Name</label>
                                        </div>
                                    </div>
                                </div>
                          
                                <div class="col-sm-6">
                                      <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="lastName" id="lastName" >
                                            <label class="form-label">Last Name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                               <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="userName" id="userName">
                                            <label class="form-label">Username</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                      <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="passWord"  id="passWord" >
                                            <label class="form-label">Password</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                               <div class="row clearfix">
                                  <div class="col-sm-6">
                                     <label>Organizational Type</label>
                                    <select class="form-control show-tick" name="orgType"  id="orgType" >
                                            <option value="ACTS" selected>ACTS</option>
                                            <option value="NSO">NSO</option>
                                    </select>
                                </div>
                                  <div class="col-sm-6">
                                     <label>Account Type</label>
                                    <select class="form-control show-tick" name="accountType"  id="accountType" >
                                             <option value="Secretary" >Secretary</option>
                                             <option value="Dean">Dean</option>
                                             <option value="Adviser">Adviser</option>
                                             <option value="President">President</option>
                                    </select>
                                </div>
                              </div>

                         
                     
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-link waves-effect" id="btnAdd" name="btnAdd" value="SAVE">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>  
                    </div>
      
                </div>
            </div>
                 <!-- Update Modal  -->
            <div class="modal fade" id="updateModal" role="dialog">
                <div class="modal-dialog" role="document">
      
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Update Account</h4>
                        </div>
                        <div class="modal-body">
                             <div class="row clearfix">
                                      <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                              <label >College Name</label>
                                            <input type="text" class="form-control" name="UcollegeName" id="UcollegeName"  >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                                <label>First Name</label>
                                            <input type="text" class="form-control" name="uFirstName" id="uFirstName"  >
                                          
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                      <div class="form-group form-float">
                                        <div class="form-line">
                                         <label >Last Name</label>
                                            <input type="text" class="form-control" name="uLastName" id="uLastName"  >
                               
                                        </div>
                                    </div>
                                </div>
                            </div>
                               <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                                  <label>Username</label>
                                            <input type="text" class="form-control" name="uUserName" id="uUserName" >
                                      
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                      <div class="form-group form-float">
                                        <div class="form-line">
                                              <label >Password</label>
                                            <input type="text" class="form-control" name="uPassWord" id="uPassWord" >
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                               <div class="row clearfix">
                               <div class="col-sm-6">
                                     <label>Organizational Type</label>
                                    <select class="form-control show-tick" name="uorgType" id="uorgType" >
                                            <option value="ACTS" selected>ACTS</option>
                                            <option value="NSO">NSO</option>
                                    </select>
                                </div>
                              <div class="col-sm-6">
                                     <label>Account Type</label>
                                    <select class="form-control show-tick" name="UpdateAccount"  id="UpdateAccount" >
                                                <option value="Secretary">Secretary</option>
                                                <option value="Dean">Dean</option>
                                                <option value="Adviser">Adviser</option>
                                                <option value="President">President</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-link waves-effect" id="btnUpdate" name="btnUpdate"  value="SAVE CHANGES">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
              
                </div>
            </div>

          </form>
        </div>
    </section>
  
    <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
 <script src="../../js/sweetalert2.min.js"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>
    <script src="../../plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->

      <script type="text/javascript">
     $( document ).ready(function() {
     
            
            $('#tblAccounts tbody').on('click','.updateBtn',function(){
            var currow = $(this).closest('tr');
            var varDocId = currow.find('td:eq(0)').html();
            var UcollegeName = currow.find('td:eq(1)').html();
            var firstname = currow.find('td:eq(2)').html();
            var lastname = currow.find('td:eq(3)').html();
            var username = currow.find('td:eq(4)').html();
            var password = currow.find('td:eq(5)').html();
            var orgType = currow.find('td:eq(6)').html();
            var accountType = currow.find('td:eq(7)').html();
            $('#varDocId').val(varDocId);
            $('#UcollegeName').val(UcollegeName);
            $('#uFirstName').val(firstname);
            $('#uLastName').val(lastname);
            $('#uUserName').val(username);
            $('#uPassWord').val(password);
            $('#uorgType').val(orgType);
            $('#UpdateAccount').val(accountType);

            });

             var btn =  $.trim( $('#btnSuccess').val() )
            if (btn == 1) {
                  Swal.fire({
                  position: 'center',
                  type: 'success',
                  title: 'Successfully Saved!',
                  showConfirmButton: false,
                  timer: 1500
                })
            }
            else if (btn == 2)
            {
               Swal.fire({
                  position: 'center',
                  type: 'success',
                  title: 'Successfully Deactivated!',
                  showConfirmButton: false,
                  timer: 1500
                })
            } 
           else if (btn == 3)
            {
               Swal.fire({
                  position: 'center',
                  type: 'success',
                  title: 'Successfully Activate!',
                  showConfirmButton: false,
                  timer: 1500
                })
            } 
    });     


    </script>
</body>

</html>
