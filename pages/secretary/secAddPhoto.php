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
     if(isset($_GET['idpic']))
        {
                $id=$_GET['idpic'];
                $status=0;
                $sql = "DELETE FROM tbl_pictures WHERE id=:id";
                $query = $dbh->prepare($sql);
                $query -> bindParam(':id',$id, PDO::PARAM_STR);
                $query -> execute();
                header('location:secAddPhoto.php');
        }

        if(isset($_POST['btnSave'])) 

            { 
                $picName = $_POST['picName'];
                $folder ="../uploads/"; 
                $image = $_FILES['image']['name']; 
                $path = $folder . $image ; 
                $target_file=$folder.basename($_FILES["image"]["name"]);
                $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
                $allowed=array('jpeg','png' ,'jpg'); $filename=$_FILES['image']['name']; 
                $ext=pathinfo($filename, PATHINFO_EXTENSION); if(!in_array($ext,$allowed) ) 

            { 
                echo '<script language="javascript">';
                echo 'alert("Sorry, only JPG, JPEG, PNG & GIF  files are allowed.")';
                echo '</script>';
            }
            else
            { 
                move_uploaded_file( $_FILES['image'] ['tmp_name'], $path); 
                $sth=$dbh->prepare("insert into tbl_pictures(name,picture,createdBy)values(:name,:image,:createBy) "); 
                $sth->bindParam(':image',$image); 
                $sth->bindParam(':name',$image); 
                $sth->bindParam(':createBy',$createby); 
                $sth->execute(); 
            } 

        } 

     if(isset($_POST['btnUpdate']))
        {
                 $id=$_POST['hiddenId'];
                  $folder ="../uploads/"; 
                $image = $_FILES['updateImage']['name']; 
                $path = $folder . $image ; 
                $target_file=$folder.basename($_FILES["updateImage"]["name"]);
                $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
                $allowed=array('jpeg','png' ,'jpg'); $filename=$_FILES['updateImage']['name']; 
                $ext=pathinfo($filename, PATHINFO_EXTENSION); if(!in_array($ext,$allowed) ) 

            { 
                echo '<script language="javascript">';
                echo 'alert("Sorry, only JPG, JPEG, PNG & GIF  files are allowed.")';
                echo '</script>';
            }
            else
            { 
                 unlink($target_file);
                move_uploaded_file( $_FILES['updateImage'] ['tmp_name'], $path); 
               $sql = "UPDATE tbl_pictures set picture=:picture,name=:name,updateBy=:updateBy WHERE id=:id";
                $query = $dbh->prepare($sql);
                $query -> bindParam(':id',$id);
                $query -> bindParam(':picture',$image);
                $query -> bindParam(':name',$image);
                 $query -> bindParam(':updateBy',$createby);
                $query -> execute();
                header('location:secAddPhoto.php');
            } 
                
       
               
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
                    <li class="active">
                        <a href="#">
                            <i class="material-icons">add_photo_alternate</i>
                            <span>Manage Gallery</span>
                        </a>
                    </li>
                        <li>
                        <a href="managefile.php">
                            <i class="material-icons">description</i>
                            <span>Manage Files</span>
                        </a>
                    </li>
                       <li>
                        <a href="manageAnnouncement.php">
                            <i class="material-icons">announcement</i>
                            <span>Manage Announcement</span>
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
                                      Manage Gallery
                                     <i class="material-icons pull-right">insert_photo</i>
                            </h2>
                        </div>
                        <div class="body">
                       

                                <button type="button" class="btn btn-info waves-effect" style="border-radius:20px;" data-toggle="modal" data-target="#addModal">Add New Photo</button>&nbsp;&nbsp;
                             <br></br>
                            <table id="tblPhoto" class="table table-striped table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th class="hidden">Id</th>
                                        <th>Name</th>
                                        <th>Picture</th>
                                        <th>Date Created</th>
                                        <th>Created By</th>
                                        <th>Update By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php   

                                    $sql = "SELECT * from tbl_pictures";
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
                                            <td class="hidden"> <?php echo htmlentities($result->id);?></td>
                                             <td> <?php echo htmlentities($result->name);?></td>
                                             <td><img src="../uploads/<?php echo $image; ?>" width="60" height="60"></td>
                                               <td> <?php echo htmlentities($result->created_date);?></td>
                                                  <td> <?php echo htmlentities($result->createdBy);?></td>
                                                     <td> <?php echo htmlentities($result->updateBy);?></td>
                                                <td>  <a class="btn btn-danger waves-effect"   style="border-radius:10px;" href="secAddPhoto.php?idpic=<?php echo htmlentities($result->id);?>"  onclick="return confirm('Do you want to delete this photo?');"><i class="material-icons">delete</i></a>
                                                            &nbsp; &nbsp;
                                                          <a   style="border-radius:10px;" class="update btn btn-info waves-effect" data-toggle="modal" data-target="#updateModal" ><i class="material-icons">update</i></a>
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
                            <h4 class="modal-title" id="defaultModalLabel">Add Photo</h4>
                        </div>
                        <div class="modal-body">
                             <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                                <label>File Path</label>
                                              <input type="file" name="image" class="form-control"  id="image" accept="*/image">
                                    </div>
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
               <!-- Update Modal  -->
            <div class="modal fade" id="updateModal" role="dialog">
                <div class="modal-dialog" role="document">
                       <form method="POST" enctype="multipart/form-data"> 
                        <input type="hidden" name="hiddenId" id="hiddenId">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Update Photo</h4>
                        </div>
                        <div class="modal-body">
                             <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                                <label>File Path</label>
                                              <input type="file" name="updateImage" class="form-control"  id="updateImage" accept="*/image">
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
             $('#tblPhoto tbody').on('click','.update',function(){
                   var currow = $(this).closest('tr');
                  var varDocId = currow.find('td:eq(0)').text();
                  $('#hiddenId').val(varDocId);

            });  
        }); 
        </script>
</body>

</html>
