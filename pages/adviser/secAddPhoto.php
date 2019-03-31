<?php
  include "../header.php";
  include "../config.php";



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
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">exit_to_app</i></a></li>
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
                    <div class="email">SECRETARY</div>
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
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li>
                        <a href="home.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="adminAccount.php">
                            <i class="material-icons">add_photo_alternate</i>
                            <span>Manage Gallery</span>
                        </a>
                    </li>
                        <li>
                        <a href="#">
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
                                      Manage Gallery
                                     <i class="material-icons pull-right">description</i>
                            </h2>
                        </div>
                        <div class="body">
                                <button type="button" class="btn btn-info waves-effect" style="border-radius:20px;" data-toggle="modal" data-target="#addModal">Add New Photo</button>&nbsp;&nbsp;
                             <br></br>
                            <table id="tblPhoto" class="table table-striped table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Picture</th>
                                        <th>Date Created</th>
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
                                            <td> <?php echo htmlentities($result->id);?></td>
                                             <td> <?php echo htmlentities($result->name);?></td>
                                              <td><?php  
                                         if ($result->picture == NULL) 
                                         {      
                                  
                                                 echo '<img src="../../images/nophoto.png" height="35" width="35" class="circle" alt="">';
                                         }
                                         else
                                         {
                                               echo '<img src="data:image/jpeg;base64,' . base64_encode($image) . '"/>'; 
                                         }
                                     

                                        ?></td>
                                               <td> <?php echo htmlentities($result->created_date);?></td>
                                                <td> <?php echo 
                                                "<button type=\"button\" class=\"btn btn-danger\" id=\"activeBtn\" data-toggle=\"modal\" data-target=\"#approveModal\" style=\"font-size:12px;height:30px;border-radius:30px;\">DELETE</button>";
                                                ?></td>
                                        </tr>
                                 <?php $cnt++; } }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                  <!-- Update Modal  -->
            <div class="modal fade" id="addModal" role="dialog">
                <div class="modal-dialog" role="document">
                     <form method="POST"> 
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Add Photo</h4>
                        </div>
                        <div class="modal-body">
                             <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                                <label>File Path</label>
                                              <input type="file" name="image" class="form-control"  id="image" accept="*/image">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                      <div class="form-group form-float">
                                        <div class="form-line">
                                                         <label >Name</label>
                                            <input type="text" class="form-control" name="picName" id="picName"/>
                               
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-link waves-effect" id="btnSave" name="btnSave" value="SAVE CHANGES">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </form>
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
           $( document ).ready(function() {


             $('#btnSave').on('click',function(){
                    if (confirm("Do you want to update this photo?")) {
                        saveDocument("save");    
                    }            
            });    

            function getData(){

                        var currentTable  = $('#tblPhoto').DataTable();  
                        currentTable.destroy();
                        currentTable=$('#tblPhoto').DataTable({
                            
                            ajax:{
                                url: "../admin/getData.php",
                                type:"POST",                        
                                data:{procedure:"retrievePhoto"}
                            },                      
                            columns :  [
                                { data : "picName" },
                                { data : "image" },
                                { data : "createdDate" },
                                { data : "button" }
                            ]
                        });                     
            
            }

            function saveDocument(action){

                var picName       =   $('#picName').val();
                var image          =    $('#image').val();

         
                
                $.ajax({
                    type: "POST",       
                    url: "../admin/getData.php",
                    data:   {
                            procedure:"savePhoto",
                            picName:picName,
                            image:image
                            } ,
                          dataType: "json"
                });

                location.reload(); 
              
            }
             });

    </script>
</body>

</html>
