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
                $accounttype=$_POST['accounttype'];
                $id=$_POST['varDocId'];
                $status=0;
                
                $sql = "UPDATE tbl_accounts set firstname=:firstname,lastname=:lastname,username=:username,password=:password,account_type=:accounttype WHERE id=:id";

                $query = $dbh->prepare($sql);
                $query -> bindParam(':id',$id, PDO::PARAM_STR);
                $query -> bindParam(':firstname',$firstName, PDO::PARAM_STR);
                $query -> bindParam(':lastname',$lastname, PDO::PARAM_STR);
                $query -> bindParam(':username',$username, PDO::PARAM_STR);
                $query -> bindParam(':password',$password, PDO::PARAM_STR);
                $query -> bindParam(':accounttype',$accounttype, PDO::PARAM_STR);
                $query -> execute();


}
else if ($_POST["procedure"]=="saveAccount")
{
       $firstName=$_POST['firstname'];
        $lastName=$_POST['lastname'];
        $userName=$_POST['username'];
        $passWord=$_POST['password'];
        $accountType=$_POST['accounttype'];
        $status = 1;

            $sql="INSERT INTO tbl_accounts (firstname,lastname,username,password,account_type,status) VALUES(:firstName,:lastName,:userName,:passWord,:accountType,:status)";

            $query = $dbh->prepare($sql);
            $query->bindParam(':firstName',$firstName,PDO::PARAM_STR);
            $query->bindParam(':lastName',$lastName,PDO::PARAM_STR);
            $query->bindParam(':userName',$userName,PDO::PARAM_STR);
            $query->bindParam(':passWord',$passWord,PDO::PARAM_STR);
            $query->bindParam(':accountType',$accountType,PDO::PARAM_STR);
            $query->bindParam(':status',$status,PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();
}



?>