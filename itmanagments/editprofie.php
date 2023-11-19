<?php
session_start();

include 'dbconnect.php';


$id=$_REQUEST['id'];
$query = "SELECT * from acc where id='".$id." '"; 
$status = mysqli_query($con, $query) or die ( mysqli_connect_error());
$row = mysqli_fetch_assoc($status);
?>
<html>
    <head>
        <title>Profile</title><meta name='viewport' content='width=device-width, initial-scale=1'>
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        
        <style>
           .dropbtn {
 background-color:rgb(87, 6, 140) ;  
  color: #ffffff;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
  
display: inline-block;}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 190px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: rgb(87, 6, 140) ;  
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  font-weight: bold;
}
.nav-bar{
    background-color: rgb(87, 6, 140) ;  
}

.dropdown-content a:hover {background-color:#f5e7fe
; }

.dropdown:hover .dropdown-content {
  display: block;
}


.dropdown:hover .dropbtn {
 background-color:rgb(87, 6, 140) ;  
}
label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

input[type=password], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

input[type=submit] {
  background-color: red;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
  font-weight: bold;
}

input[type=submit]:hover {
  background-color: red;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
  padding: 5px 5px;
}

.col-35 {
  float: left;
  width: 35%;
  margin-top: 6px;
  padding:5px 5px;}
  

/* Clear floats after the columns */
.row::after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 350px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 350px) {
  .col-25, .col-35, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
h3{
    font-weight: bold;
    margin:auto;
}     
        </style>
    </head>
    <?php
    $kq="";
    if(isset($_POST['new']) && $_POST['new']==1)
       {
       $id=$_REQUEST['id'];
    $username=$_REQUEST['username'];
    $password=$_REQUEST['password'];
    $email=$_REQUEST['email'];
        
         
    $check="SELECT *FROM acc where username='$username' OR email='$email' OR password='$password'" ;
    $v_c=mysqli_query($con,$check);
    $notify= mysqli_fetch_assoc($v_c);
        if($notify){
            if($notify['username']===$username){
                echo'<p>The username has already exist, you cannot use this username more!...<br>Please enter again<br></p>';
              $error="Failed to update the user account information";
              echo $error;
             
           
            }
            if($notify['email']===$email){
                echo"the email you have edited is $email have already existed so you cannot use this email anymore....<br>Please enter again<br>";
                echo"Failed to update the user information   (email)" ;
            }
        }else{
            $password=md5($password);
    $update="UPDATE acc set
    username='".$username."', password='".$password."',email='".$email."' where id='".$id."'";
    
    
    mysqli_query($con, $update) or die(mysqli_connect_error());
$info = "User Account Updated Successfully. </br></br>
<a href='adminprofile.php'>Details of Updated Profile  </a>";
echo '<p style="color:#FF0000;">'.$info.'</p>';}
}else {
    
    
    
    
    ?>
       <body >
        <div class="nav-bar">
          <div class="dropdown">
                <button class="dropbtn"> BACK TO </button>  <div class="dropdown-content">
                     <a href="adminhomepage.php" >ADMIN</a>
                    <a href="staff.php" >STAFF</a>
                     <a href="qacoordinatorhomepage.php" >QAC</a>
                      <a href="qamanagerhomepage.php" >QAM</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">IDEA</button>
                <div class="dropdown-content">
                     <a href="viewallofidea.php" >IDEAS</a>
                    <a href="ideamanagementhomepage.php" >IDEA HOME</a>
                </div>
            </div>
         <div class="dropdown">
             <button class="dropbtn">UPLOAD</button>
                <div class="dropdown-content">
                    <a href="postideawithpdffile.php" ><i class="fa-solid fa-paperclip"></i>FILE PDF</a>
                </div>
            </div>
            <div class="dropdown">
             <button class="dropbtn">PORTFOLIO</button>
                <div class="dropdown-content">
                    <a href="editstaffacc.php" >PROFILE</a>
                    <a href="logout.php" >LOG OUT</a>
                </div>
            </div>

        </div>
    <div class="from-group">
        <div class="container ">
    <div >
        <form action="editprofile.php" method="post"> <h3><i class="fa fa-id-card" style="font-size:26px;padding:10px 10px;color:rgb(87, 6, 140)"></i>EDIT USER PROFILE
</h3>
            <input type="hidden" name="new" value="1"/>
   <div class="row">
    <div class="col-25"><label for="username">Username </label></div>
        <div class="col-35">
        <input name="id" type="hidden" value="<?php echo $row['user_id'];?>" />
        <p><input type="text" name="username" placeholder="Enter Name" required value="<?php echo $row['username'];?>" /></p></div></div>  <div class="row">
    <div class="col-25">
        <label for="password">Password </label></div>
        <div class="col-35">
        <p><input type="password" name="password"  placeholder="Enter Password here......" 
required value="<?php echo $row['password'];?>" /></p></div></div>
<div class="row"><div class="col-25">
<label for="email">Email </label></div>
<div class="col-35">
<p><input type="text" name="email " placeholder="Enter user account email:" required value="<?php echo $row['email'];?>" /></p>
</div></div>

<p><input name="submit" type="submit" value="Update" /></p> 
          
        </form>
        <?php } ?>
        </div>
        </div>
    </body>
</html>