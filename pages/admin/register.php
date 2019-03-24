<?php
  include "../header.php";
?>
<body class="signup-page">
    <div class="login-box">
      <div class="row clearfix">
        <div class="card">
              <div class="header bg-blue">
                <h2>Create your account.</h2></center>
              </div>
            <div class="body">
              <br>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane animated fadeIn active"> 
                        <form method="POST">
                          <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" />
                                            <label class="form-label">First Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                      <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" />
                                            <label class="form-label">Middle Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                      <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" />
                                            <label class="form-label">Last Name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" />
                                            <label class="form-label">Contact #</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                      <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" />
                                            <label class="form-label">Address</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                               <div class="row clearfix">
                                 <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" />
                                            <label class="form-label">Username</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                      <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" />
                                            <label class="form-label">Password</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                      <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" />
                                            <label class="form-label">Retype Password</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <div class="row">
                      <br>
                      <div class="col-xs-4">
                           <button  style="margin-left: 500px;border-radius:20px;" class="btn btn-block btn-lg bg-blue waves-effect disabletype" type="submit" name="login_student">SIGN UP</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="login.php">Have already account?</a>
                        </div>
                    </div>
              </form>
             </div>
             </div>
            </div>
         </div>
       </div>
    </div>   
</div>
<?php
  include "../footer.php";
?>
