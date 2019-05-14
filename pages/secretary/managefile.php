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
        if(isset($_GET['fileId']))
        {
                $id=$_GET['fileId'];

                $sql = "SELECT * FROM tbl_files WHERE id=:id";
                $select_stmt= $dbh->prepare($sql); 
                $select_stmt->bindParam(':id',$id);
                $select_stmt->execute();
                $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
                unlink("../uploads/5cbaefe9022f35.32853668.png");
        
                $sql = "DELETE FROM tbl_files WHERE id=:id";
                $query = $dbh->prepare($sql);   
                $query -> bindParam(':id',$id, PDO::PARAM_STR);
                $query -> execute();
                header('location:managefile.php');
        }

        if(isset($_POST['btnUpdate']))
        {
                $id=$_POST['hiddenId'];
           
                $file = $_FILES['updateFile'];
                $fileName = $_FILES['updateFile']['name'];
                $fileTmpName = $_FILES['updateFile']['tmp_name'];
                $fileSize = $_FILES['updateFile']['size'];
                $fileError = $_FILES['updateFile']['error'];
                $fileType = $_FILES['updateFile']['type'];

                $fileExt =explode('.',$fileName);
                $fileActualExt = strtolower(end($fileExt));
                $allowed = array('jpg','jpeg','docx','png','pdf','txt','xslx');

                if(in_array($fileActualExt, $allowed)){
                    if($fileError === 0) 
                    {
                       $fileNameNew = uniqid('',true).".".$fileActualExt;
                       $fileDestination = '../uploads/'.$fileNameNew;
                       unlink($fileDestination); //unlink function remove previous file
                       move_uploaded_file($fileTmpName, "../upload/" .$fileNameNew); //move upload file temperory directory to your upload folder 
                    }
                    else
                    {
                        echo "There's was an error uploading you file!";
                    }
                }
                else
                {
                    echo 'You cannot upload file in this type!';
                }

                $sql = "UPDATE  tbl_files set file=:file,name=:name,updateBy=:updateBy WHERE id=:id";
                $query = $dbh->prepare($sql);   
                $query -> bindParam(':id',$id);
                $query -> bindParam(':file',$fileName); 
                $query -> bindParam(':name',$fileName); 
                $query -> bindParam(':updateBy',$fullName); 
                $query -> execute();
                header('location:managefile.php');
        }

        if(isset($_POST['btnSave'])) 

            { 
                $fileTypeDropDown = $_POST['fileType'];
                $others = $_POST['others'];
                $file = $_FILES['myFile'];
                $fileName = $_FILES['myFile']['name'];
                $fileTmpName = $_FILES['myFile']['tmp_name'];
                $fileSize = $_FILES['myFile']['size'];
                $fileError = $_FILES['myFile']['error'];
                $fileType = $_FILES['myFile']['type'];

                $fileExt =explode('.',$fileName);
                $fileActualExt = strtolower(end($fileExt));
                $allowed = array('jpg','jpeg','docx','png','pdf','txt','xslx');

                if(in_array($fileActualExt, $allowed)){
                    if($fileError === 0) 
                    {
                       $fileNameNew = uniqid('',true).".".$fileActualExt;
                       $fileDestination = '../uploads/'.$fileNameNew;
                       move_uploaded_file($fileTmpName, $fileDestination);
                    }
                    else
                    {
                        echo "There's was an error uploading you file!";
                    }
                }
                else
                {
                    echo 'You cannot upload file in this type!';
                }
              
                $sth=$dbh->prepare("INSERT INTO tbl_files(name,type,file,fileType,created_by)values(:name,:type,:data,:fileType,:createdby) "); 
                $sth->bindParam(':name',$fileName); 
                $sth->bindParam(':type',$fileType); 
                $sth->bindParam(':data',$fileName); 
                $sth->bindParam(':createdby',$fullName); 
                $sth->bindParam(':fileType',$fileTypeDropDown); 
                $sth->bindParam(':fileType',$others); 
                $sth->execute(); 
             } 
     }
?>
<style type="text/css">
    td {
    white-space: nowrap;
}
</style>
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
    <div class="overlay"></div>
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
                    <div class="email">SECRETARY</div>
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
                    <li >
                        <a href="secAddPhoto.php">
                            <i class="material-icons">add_photo_alternate</i>
                            <span>Manage Gallery</span>
                        </a>
                    </li>
                        <li class="active">
                        <a href="managefile.php">
                            <i class="material-icons">description</i>
                            <span>Manage Files</span>
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
                                      Manage Files
                                     <i class="material-icons pull-right">description</i>
                            </h2>
                        </div>
                        <div class="body">
                       

                                <button type="button" class="btn btn-info waves-effect" style="border-radius:20px;" data-toggle="modal" data-target="#addModal">Upload File</button>&nbsp;&nbsp;
                             <br></br>
                                 <div class="table-responsive">
                            <table id="tblFiles" class="table table-striped table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th class="hidden">Id</th>
                                        <th>File Name</th>
                                        <th>File Type</th>
                                        <th>Date Created</th>
                                        <th>Created By</th>
                                        <th>Updated By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php   
                                        $query=$dbh->prepare("SELECT * from tbl_files");
                                        $query->execute();
                                        while($row =  $query->fetch())
                                    {   
                                       ?>  
                                        <tr>
                                                <td class="hidden"> <?php echo htmlentities($row['id']);?></td>
                                                <td> <?php echo htmlentities($row['name']);?></td>
                                                    <td> <?php echo htmlentities($row['fileType']);?></td>
                                                <td> <?php echo htmlentities($row['created_date']);?></td>
                                                <td> <?php echo htmlentities($row['created_by']);?></td>
                                                <td> <?php echo htmlentities($row['updateBy']);?></td>
                                                <td> <?php  echo "<a class='btn btn-info waves-effect'  style='border-radius:15px;'href='download.php?file=".$row['file']."'>Download</a> ";?>

                                                <a   style="border-radius:15px;" class="update btn btn-info waves-effect" data-toggle="modal" data-target="#updateModal" >Update</a>

                                                <a class="btn btn-danger waves-effect"   style="border-radius:15px;" href="managefile.php?fileId=<?php echo htmlentities($row['id']);?>"  onclick="return confirm('Do you want to delete this file?');">Delete</a></td>                                           
                                        </tr>
                                 <?php  }?>
                                </tbody>
                            </table>
                          </div>

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
                            <h4 class="modal-title" id="defaultModalLabel">Upload File</h4>
                        </div>
                        <div class="modal-body">
                             <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                      <label>File Path</label>
                                      <input type="file" name="myFile" class="form-control"  id="image" accept="*/image">
                                    </div>
                                </div>
                                         <div class="col-sm-6">
                                     <label>File Type</label>
                                    <select class="form-control show-tick" name="fileType"  id="fileType" >
                                             <option value="Operational Plan" >Operational Plan</option>
                                             <option value="Action Plan">Action Plan</option>
                                             <option value="Receipt">Receipt</option>
                                             <option value="Attendance">Attendance</option>
                                             <option value="Communication Letter">Communication Letter</option>
                                             <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                               <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float" style="display: none;" id="others">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="others"  id="others" >
                                            <label class="form-label">Others</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-link waves-effect" id="btnSave" name="btnSave" value="SAVE">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>

                   <!-- Update Modal  -->
            <div class="modal fade" id="updateModal" role="dialog">
                <div class="modal-dialog" role="document">
              <form method="POST" enctype="multipart/form-data"> 
                <input type="hidden" name="hiddenId" id="hiddenId">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Update File</h4>
                        </div>
                        <div class="modal-body">
                             <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                                <label>File Path</label>
                                              <input type="file" name="updateFile" class="form-control"  id="updateFile" accept="*/image">
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
        </div>

          </form>
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
             $('#tblFiles tbody').on('click','.update',function(){
                   var currow = $(this).closest('tr');
                  var varDocId = currow.find('td:eq(0)').text();
                  $('#hiddenId').val(varDocId);

            });  
               $('#fileType').on('change',function(){
                //var optionValue = $(this).val();
                //var optionText = $('#dropdownList option[value="'+optionValue+'"]').text();
                var optionText = $("#fileType option:selected").text();
                if(optionText == "Others")
                {
                    $("#others").css("display", "");
                }
                else
                {
                    $("#others").css("display", "none");
                }
            });

        }); 
       </script>
 

        
</body>

</html>
