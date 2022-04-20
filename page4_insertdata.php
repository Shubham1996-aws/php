<?php session_start();
 if (isset($_POST['state'])) {
     if (!empty($_SESSION['post'])){
         if (empty($_POST['address1'])
         || empty($_POST['city'])
         || empty($_POST['pin'])
         || empty($_POST['state'])){
             // Setting error for page 3.
             $_SESSION['error_page3'] = "Mandatory field(s) are missing, Please fill it again";
             header("location: page3_form.php"); // Redirecting to third page.
         } else {
             foreach ($_POST as $key => $value) {
             $_SESSION['post'][$key] = $value;
         }
         extract($_SESSION['post']); // Function to extract array.
         $connection = mysqli_connect("172.18.0.3", "admin", "admin","mysqldb");
        if($connection->connect_errno){
        echo "failed connection...!";
        exit;
        }
       #$db = mysql_select_db("mysqldb", $connection); // Storing values in database.
        $message = "";
         $query = $connection->query("insert into detail (name,email,contact,password,religion,nationality,gender,qualification,experience,address1,address2,city,pin,state) values('$name','$email','$contact','$password','$religion','$nationality','$gender','$qualification','$experience','$address1','$address2','$city','$pin','$state')");
         if ($query) {
            $message = '<p><span id="success">Form Submitted successfully..!!</span></p>';
            
         } else {
            $message =  '<p><span>Form Submission Failed..!!</span></p>';
            
         }
         unset($_SESSION['post']); // Destroying session.
         }
     } else {
     header("location: page1_form.php"); // Redirecting to first page.
     }
 } else {
 header("location: page1_form.php"); // Redirecting to first page.
 }
?>

<!DOCTYPE HTML>
<html>
 <head>
 <title>PHP Multi Page Form</title>
 <link rel="stylesheet" href="style.css" />
 </head>
 <body>
 <div class="container">
 <div class="main">
 <h2>PHP Multi Page Form</h2>
 <?php
 	echo $message;
 ?>
 </div>
 </div>
 </body>
</html>
