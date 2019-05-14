<?php
header('Content-Type: text/plain');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: 1 Jan 2000 00:00:00 GMT");     

ini_set('memory_limit', '2048M');                                                       //JB-2016/08/31 include to fix fatal error allocate memory
ini_set('max_execution_time', 600);                                                     //PH-2017/03/03 include to fix fatal error execution time
include('../config.php');

if($_POST["procedure"]=="UpdateAccounts")
{
                $firstName=$_POST['firstname'];
                $lastname=$_POST['lastname'];
                $username=$_POST['username'];
                $password=$_POST['password'];
                $UcollegeName=$_POST['UcollegeName'];
                $uorgType = $_POST['uorgType'];
                $UaccountType = $_POST['UaccountType'];
                $id=$_POST['varDocId'];
                $status=0;
                
                $sql = "UPDATE tbl_accounts set collegename=:UcollegeName,firstname=:firstname,lastname=:lastname,username=:username,password=:password,orgtype=:orgtype,accountType=:UaccountType WHERE id=:id";

                $query = $dbh->prepare($sql);
                $query -> bindParam(':id',$id, PDO::PARAM_STR);
                $query -> bindParam(':UcollegeName',$UcollegeName, PDO::PARAM_STR);
                $query -> bindParam(':firstname',$firstName, PDO::PARAM_STR);
                $query -> bindParam(':lastname',$lastname, PDO::PARAM_STR);
                $query -> bindParam(':username',$username, PDO::PARAM_STR);
                $query -> bindParam(':password',$password, PDO::PARAM_STR);
                $query -> bindParam(':orgtype',$uorgType, PDO::PARAM_STR);
                $query -> bindParam(':UaccountType',$UaccountType, PDO::PARAM_STR);
                $query -> execute();

                header('Location: adminAccount.php');


}
else if ($_POST["procedure"]=="saveAccount")
{
            $firstName=$_POST['firstname'];
            $collegeName=$_POST['collegeName'];
            $lastName=$_POST['lastname'];
            $userName=$_POST['username'];
            $passWord=$_POST['password'];
            $orgType=$_POST['orgType'];
            $accountType=$_POST['accountType'];
            $status = 1;

            $sql="INSERT INTO tbl_accounts (collegename,firstname,lastname,username,password,orgtype,accountType,status) VALUES(:collegeName,:firstName,:lastName,:userName,:passWord,:orgType,:accountType,:status)";

            $query = $dbh->prepare($sql);
              $query->bindParam(':collegeName',$collegeName,PDO::PARAM_STR);
            $query->bindParam(':firstName',$firstName,PDO::PARAM_STR);
            $query->bindParam(':lastName',$lastName,PDO::PARAM_STR);
            $query->bindParam(':userName',$userName,PDO::PARAM_STR);
            $query->bindParam(':passWord',$passWord,PDO::PARAM_STR);
            $query->bindParam(':orgType',$orgType,PDO::PARAM_STR);
            $query->bindParam(':accountType',$accountType,PDO::PARAM_STR);
            $query->bindParam(':status',$status,PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();
}
else if ($_POST["procedure"]=="savePhoto")
{
            $name=$_POST['picName'];
            $image = addslashes(file_get_contents(@$_FILES['image']['tmp_name']));
            $image_name = addslashes(@$_FILES['image']['name']);
            $image_size = getimagesize(@$_FILES['image']['tmp_name']);

            move_uploaded_file(@$_FILES["image"]["tmp_name"], "../uploads" . @$_FILES["image"]["name"]);
            $location = "../uploads" . @$_FILES["image"]["name"];

            $sql="INSERT INTO tbl_pictures (name,picture) VALUES(:name,:profile)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':profile', $location, PDO::PARAM_LOB);
            $query->bindParam(':name',$name,PDO::PARAM_STR);
            $query->execute();
           
}

else if ($_POST["procedure"]=="retrieveAccounts")
{

            $sql = "SELECT * from tbl_accounts ";
            $query = $dbh -> prepare($sql);
            $query->execute();
            $query->bindParam(':profile', $location, PDO::PARAM_LOB);
            $query->bindParam(':name',$name,PDO::PARAM_STR);
            $query->execute();
           
}
else if ($_POST["procedure"]=="retrievePhoto")
{
    $sql =" SELECT * FROM tbl_pictures";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $rs = $query->fetchAll();
    $data = array();
    $number_filter_row= $query->rowCount();
    foreach($rs as $result)
    {   
         $image_date =  $result['picture'];
         $sub_array["picName"]          =  $result['name'];
         $sub_array["image"]           =  "<img src=\"data:image/png;base64, ".base64_encode( stripslashes($result['picture'])) ."  ?>\" />";

         $sub_array["createdDate"]      =  $result['created_date'];

          $sub_array["button"]            = "<button type=\"button\" class=\"btn btn-danger\" id=\"activeBtn\" data-toggle=\"modal\" data-target=\"#approveModal\" style=\"font-size:12px;height:30px;border-radius:30px;\">DELETE</button>";

      $data[]=$sub_array;       
    }       
    $output = array(
        "recordsTotal"  =>  $number_filter_row,
        "recordsFiltered" => $number_filter_row,
        "data"    => $data
    );  
    echo json_encode($output);
}


?>