<?php
  include "../header.php";
  include "../config.php";
session_start();
error_reporting(0);


if(strlen($_SESSION['accountSession'])==0)
    {   
        header('location:../home/login.php');
    }
    else
    {
    $createby = $_SESSION['accountSession'];
     if(isset($_GET['empid']))
        {
                $id=$_GET['empid'];
                $status=0;
                $sql = "DELETE FROM tbl_accounts WHERE id=:id";
                $query = $dbh->prepare($sql);
                $query -> bindParam(':id',$id, PDO::PARAM_STR);
                $query -> execute();
                header('location:index.php');
        }
     }
   



?>
<style type="text/css">
  #banner {
  width: 100%;
  height: auto;
}
</style>
<body class="theme-blue">
    <!-- Page Loader -->

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
                        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $createby; ?></div>
                    <div class="email">SECRETARY</div>
                
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                     <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="#">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="secAddPhoto.php">
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

    
    </section>

     <section class="content">
        <div class="container-fluid">
               <div class="row clearfix">
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                         <img id="banner" src="../../images/banner.png" alt="banner">
                    </div>
                </div>
                <br>
               <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-2 bg-blue hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">folder</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Files</div>
                             <?php
                                $sql = "SELECT COUNT(*) as count from tbl_files";
                                $query = $dbh -> prepare($sql);
                                $query->execute();
                                $results=$query->fetch(PDO::FETCH_ASSOC);
                                $count = $results['count'];
                                
                                ?>          
                            <div class="number"><?php echo $count; ?></div>
                        </div>
                    </div>
                </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-2 bg-blue hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">folder</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Photos</div>
                             <?php
                                $sql = "SELECT COUNT(*) as count from tbl_pictures";
                                $query = $dbh -> prepare($sql);
                                $query->execute();
                                $results=$query->fetch(PDO::FETCH_ASSOC);
                                $count = $results['count'];
                                
                                ?>          
                            <div class="number"><?php echo $count; ?></div>
                        </div>
                    </div>
                </div>
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
      <!-- Jquery CountTo Plugin Js -->
    <script src="../../../plugins/jquery-countto/jquery.countTo.js"></script>
    <script src="../../../js/pages/widgets/infobox/infobox-3.js"></script>
    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>

    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>
</body>

</html>
