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



     }

?>
<body class="theme-blue">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
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
                    <li class="pull-right"><a href="login.php" class="js-right-sidebar" data-close="true"><i class="material-icons">exit_to_app</i></a></li>
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
                     <!-- Basic Examples -->
                      <form method="POST"> 
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
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tblAccounts">
                                    <thead>
                                        <tr>
                                            <th>*</th>
                                             <th>ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Account Type</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
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
                                            <td> <?php echo htmlentities($cnt);?></td>
                                            <td> <?php echo htmlentities($result->id);?></td>
                                            <td><?php echo htmlentities($result->firstname);?></td>
                                            <td><?php echo htmlentities($result->lastname);?></td>
                                            <td><?php echo htmlentities($result->username);?></td>
                                           <td><?php echo htmlentities($result->password);?></td>
                                            <td><?php echo htmlentities($result->account_type);?></td>
                                            <td><?php echo htmlentities($result->created_date);?></td>
                                             <td>
                                                <a class="btn btn-danger waves-effect"   style="border-radius:10px;" href="adminAccount.php?empid=<?php echo htmlentities($result->id);?>"  onclick="return confirm('Do you want to delete this user?');"><i class="material-icons">delete</i></a>&nbsp;&nbsp;<button class="updateBtn btn btn-info waves-effect" type="button" data-toggle="modal" data-target="#updateModal" style="border-radius:10px;"><i class="material-icons">update</i></button></td>
          
                                        </tr>   
                                         <?php $cnt++;} }?>
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
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="firstName" id="firstName"/>
                                            <label class="form-label">First Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                      <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="lastName" id="lastName"/>
                                            <label class="form-label">Last Name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                               <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="userName" id="userName"/>
                                            <label class="form-label">Username</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                      <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="passWord"  id="passWord" />
                                            <label class="form-label">Password</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                               <div class="row clearfix">
                                  <div class="col-sm-6">
                                     <label>Account Type</label>
                                    <select class="form-control show-tick" name="accountType"  id="accountType" >
                                          <option value="ADVISER">ADVISER</option>
                                        <option value="OFFICER">OFFICER</option>
                                        <option value="ADMIN">ADMIN</option>
                                    </select>

                                </div>
                           
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-link waves-effect" id="btnAdd" name="btnAdd" value="SAVE">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
      
                </div>
            </div>
                 <!-- Update Modal  -->
            <div class="modal fade" id="updateModal" role="dialog">
                <div class="modal-dialog" role="document">
                     <form method="POST"> 
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Update Account</h4>
                        </div>
                        <div class="modal-body">
                             <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                                <label>First Name</label>
                                            <input type="text" class="form-control" name="uFirstName" id="uFirstName"/>
                                          
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                      <div class="form-group form-float">
                                        <div class="form-line">
                                                         <label >Last Name</label>
                                            <input type="text" class="form-control" name="uLastName" id="uLastName"/>
                               
                                        </div>
                                    </div>
                                </div>
                            </div>
                               <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                                  <label>Username</label>
                                            <input type="text" class="form-control" name="uUserName" id="uUserName"/>
                                      
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                      <div class="form-group form-float">
                                        <div class="form-line">
                                              <label >Password</label>
                                            <input type="text" class="form-control" name="uPassWord" id="uPassWord"/>
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                               <div class="row clearfix">
                                  <div class="col-sm-6">
                                     <label>Account Type</label>
                                    <select class="form-control show-tick" name="uAccountType" id="uAccountType">
                                        <option value="ADMIN">ADMIN</option>
                                        <option value="ADVISER">ADVISER</option>
                                        <option value="1">OFFICER</option>
                                    </select>
                                </div>
                           
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-link waves-effect" id="btnUpdate" name="btnUpdate" value="Save Changes">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </form>
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

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>
    <script src="../../plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>
      <script type="text/javascript">
     $( document ).ready(function() {
            
            $('#tblAccounts tbody').on('click','.updateBtn',function(){
            var currow = $(this).closest('tr');
            var varDocId = currow.find('td:eq(1)').text();
            var firstname = currow.find('td:eq(2)').text();
            var lastname = currow.find('td:eq(3)').html();
            var username = currow.find('td:eq(4)').html();
            var password = currow.find('td:eq(5)').html();
            var accounttype = currow.find('td:eq(6)').html();
            $('#varDocId').val(varDocId);
            $('#uFirstName').val(firstname);
            $('#uLastName').val(lastname);
            $('#uUserName').val(username);
            $('#uPassWord').val(password);
            $("select#uAccountType").val(accounttype);
       
            });     

             $('#btnUpdate').on('click',function(){
                    if (confirm("Do you want to update this account?")) {
                        processDocument("update");    
                    }            
            });     

            $('#btnAdd').on('click',function(){
               
                var varDocId      =   $('#varDocId').val();
                var firstname     =   $('#firstName').val();
                var lastname      =   $('#lastName').val();
                var username      =   $('#userName').val();
                var password      =   $('#passWord').val();
                var accounttype      =   $('#accountType').val();

                if (firstname == "")
                {   
                    alert("First Name is Empty!");
                }
                else if(lastname == "")
                {
                    alert("Last Name is Empty!");
                }
                else if(username == "")
                {
                     alert("Username is Empty!");
                }
                 else if(password == "")
                {
                     alert("Password is Empty!");
                }
                else
                {


                    if (confirm("Do you want to save this account?")) {
                        saveDocument("save");    
                    }   
                }         
            });     

            function processDocument(action){

                var varDocId      =   $('#varDocId').val();
                var firstname     =   $('#uFirstName').val();
                var lastname      =   $('#uLastName').val();
                var username      =   $('#uUserName').val();
                var password      =   $('#uPassWord').val();
                var status        =   1;
                var accounttype   =   $("#uAccountType option:selected").val();
                
                $.ajax({
                    type: "POST",       
                    url: "getData.php",
                    data:   {
                            procedure:"UpdateAccounts",
                            varDocId:varDocId,
                            firstname:firstname,
                            lastname:lastname, 
                            username:username,
                            password:password,
                            accounttype:accounttype,
                            status:status
                            } ,
                          dataType: "json"
                });
                     location.reload();
            }

            function saveDocument(action){

                var firstname     =   $('#firstName').val();
                var lastname      =   $('#lastName').val();
                var username      =   $('#userName').val();
                var password      =   $('#passWord').val();
                var accounttype      =   $('#accountType').val();
                var status      =   1;
                var accounttype   =   $("#uAccountType option:selected").val();
                
                $.ajax({
                    type: "POST",       
                    url: "getData.php",
                    data:   {
                            procedure:"saveAccount",
                            firstname:firstname,
                            lastname:lastname, 
                            username:username,
                            password:password,
                            accounttype:accounttype,
                            status:status
                            } ,
                          dataType: "json"
                });

                location.reload(); 
              
            }

      


    });     


    </script>
</body>

</html>
