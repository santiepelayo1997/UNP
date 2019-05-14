<?php
  include "../header.php";
  include "../config.php";
session_start();
error_reporting(0);

if(strlen($_SESSION['accountSession'])==0)
    {   
          header('location:index.php');
    }
    else
    {
         $createby =  $_SESSION['accountSession'];
             $sql = "SELECT * FROM tbl_accounts WHERE tbl_accounts.username = '".$createby."'";
        $stmt = $dbh->prepare($sql);
        $stmt ->execute();
        $results=$stmt->fetch(PDO::FETCH_ASSOC);
        $firstname = $results['firstname'];
        $lastname = $results['lastname'];
        $fullName = $firstname." ".$lastname;
     if(isset($_GET['id']))
        {
                $id=$_GET['id'];
                $status=0;
                $sql = "DELETE FROM tbl_fees WHERE id=:id";
                $query = $dbh->prepare($sql);
                $query -> bindParam(':id',$id, PDO::PARAM_STR);
                $query -> execute();
                header('location:manageFees.php');
        }

        if(isset($_POST['btnSave'])) 

            { 
                $feeName = $_POST['feeName'];
                $amount = $_POST['amount'];
            
                $sth=$dbh->prepare("INSERT INTO tbl_fees(name,amount,createdBy)values(:feeName,:amount,:createBy) "); 
                $sth->bindParam(':feeName',$feeName); 
                $sth->bindParam(':amount',$amount); 
                $sth->bindParam(':createBy',$createby); 
                $sth->execute(); 
                 header('location:manageFees.php');

           } 

     if(isset($_POST['btnUpdate']))
        {
               $feeName = $_POST['updateFeeName'];
                $amount = $_POST['updateAmount'];
                $id = $_POST['hiddenId'];

               $sql = "UPDATE tbl_fees set name=:name,amount=:amount,updateBy=:updateBy WHERE id=:id";
                $query = $dbh->prepare($sql);
                $query -> bindParam(':id',$id);
                $query -> bindParam(':name',$feeName);
                $query -> bindParam(':amount',$amount);
                 $query -> bindParam(':updateBy',$createby);
                $query -> execute();
                header('location:manageFees.php');
               
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
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
            <img src="../../logo.png" width="51" height="51" align="left"><a class="navbar-brand" href="../../index.html">&nbsp;&nbsp;&nbsp;University of Northern Philippines</a>    
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
                     <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $fullName; ?></div>
                    <div class="email">TREASURER</div>
                      <?php include "../changeaccount.php" ?>
                  
                </div>
            </div>
            <!-- #User Info -->
             <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li>
                        <a href="index.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="manageFees.php">
                            <i class="material-icons">assignment</i>
                            <span>Manage Fees</span>
                        </a>
                    </li>
                   <li >
                        <a href="managestudent.php">
                            <i class="material-icons">people</i>
                            <span>Manage Student</span>
                        </a>
                    </li>
                     <li class="active">
                        <a href="#">
                            <i class="material-icons">assignment</i>
                            <span>Transaction Records</span>
                        </a>
                    </li>
                </ul>
            </div>
<!-- #Menu -->

            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2018 - 2019 <a href="javascript:void(0);">Univeristy of Northern Philippines</a>.
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>
                                      Manage Student
                                     <i class="material-icons pull-right">people</i>
                            </h2>
                        </div>
                        <div class="body">
                       

                                <button type="button" class="btn btn-info waves-effect" style="border-radius:20px;" data-toggle="modal" data-target="#addModal">Add New Student</button>&nbsp;&nbsp;
                             <br></br>
                            <table id="tblFees" class="table table-striped table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Section</th>
                                        <th>College Name</th>
                                        <th>Gender</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php   

                                    $sql = "SELECT * from tbl_students";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);

                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result)
                                    {   

                                        $image = $result->picture;
                                                ?>  

                                        <tr>
                                                <td> <?php echo htmlentities($result->id);?></td>
                                                <td> <?php echo htmlentities($result->firstname);?></td>
                                                <td> <?php echo htmlentities($result->lastname);?></td>
                                                <td> <?php echo htmlentities($result->section);?></td>
                                                <td> <?php echo htmlentities($result->collegename);?></td>
                                                <td> <?php echo htmlentities($result->gender);?></td>
                                                <td> 
                                                          <a   style="border-radius:10px;" class="update btn btn-info waves-effect" data-toggle="modal" data-target="#updateModal" ><i class="material-icons">note_add</i>&nbsp;Add Fee</a>
                                                </td>
                                        </tr>
                                 <?php $cnt++; } }?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    
                       <!-- Add Modal  -->
            <div class="modal fade" id="addModal" role="dialog">
                <div class="modal-dialog" role="document">
                       <form method="POST" enctype="multipart/form-data"> 
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Add New Student</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row clearfix">
                               <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="feeName" id="feeName"/>
                                            <label class="form-label">First Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="amount" id="amount"/>
                                            <label class="form-label">Last Name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          <div class="row clearfix">
                               <div class="col-sm-6">
                                     <label>Section</label>
                                    <select class="form-control show-tick" name="uorgType" id="uorgType">
                                        <option value="Mandated" selected>Mandated</option>
                                        <option value="Accredited">Accredited</option>
                                    </select>
                                </div>
                                    <div class="col-sm-6">
                                     <label>College Name</label>
                                    <select class="form-control show-tick" name="collegeName"  id="collegeName" >
                                                <option value="Treasurer" selected="">Treasurer</option>
                                                <option value="Secretary">Secretary</option>
                                                <option value="Adviser">Adviser</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                             <div class="row clearfix">
                               <div class="col-sm-6">
                                     <label>Gender</label>
                                    <select class="form-control show-tick" name="gender" id="gender">
                                        <option value="MALE">MALE</option>
                                        <option value="FEMALE">FEMALE</option>
                                    </select>
                                </div>
                           
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-link waves-effect" id="btnSave" name="btnSave" value="SAVE CHANGES">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
             <!-- Add Modal  -->
            <div class="modal fade" id="updateModal" role="dialog">
                <div class="modal-dialog" role="document">
                       <form method="POST" enctype="multipart/form-data"> 
                    <div class="modal-content">
                        <div class="modal-header">
                            <input type="hidden" name="hiddenId" id="hiddenId">
                            <h4 class="modal-title" id="defaultModalLabel">Add Fee</h4>
                        </div>
                        <div class="modal-body">
                                  <div class="row clearfix">
                               <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                              <label>Name of Student</label>
                                            <input type="text" class="form-control" name="nameOfStudent" id="nameOfStudent"/>
                                          
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                             <label >Section</label>
                                            <input type="text" class="form-control" name="section" id="section"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-link waves-effect" id="btnUpdate" name="btnUpdate" value="SAVE CHANGES">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </form>
                </div>
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
      <!-- Editable Table Plugin Js -->
    <script src="../../plugins/editable-table/mindmup-editabletable.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/tables/editable-table.js"></script>
       <script src="../../js/pages/tables/jquery-datatable.js"></script>

        <script type="text/javascript">
             $(document).ready(function(){
             $('#tblFees tbody').on('click','.update',function(){
                   var currow = $(this).closest('tr');
                    var varDocId = currow.find('td:eq(0)').text();
                    var firstname = currow.find('td:eq(1)').text();
                    var lastname = currow.find('td:eq(2)').text();
                     var section = currow.find('td:eq(3)').text();
                    $('#hiddenId').val(varDocId);
                    $('#nameOfStudent').val(firstname + "" + lastname);
                    $('#section').val(section);

            });  
        }); 
        </script>
</body>

</html>
