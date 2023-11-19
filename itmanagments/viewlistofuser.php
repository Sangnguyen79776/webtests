<?php
session_start();
// If the user is not logged in redirect to the login page...

include "dbconnect.php";
$stmt = $con->prepare("SELECT fullname,email,department FROM user WHERE id = ? ");
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($fullname, $email,$department);
$stmt->fetch();
$stmt->close();
?>
<html>
    <head><meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Staff Page</title></head>
        <style>thead{
                font-weight: bold;
                text-align: center;
               }
               .header{
    font-size: 24px;
    font-weight: bold;
    background-color:rgb(87, 6, 140) ;
    margin-top: 0;
padding: 40px 40px;    width: 100%;
    color: white;
    text-align: center;
    font-family: monospace;
}
           </style>
    <body>
            <div class="header"><h1>LIST OF USERS </h1></div>

				<table width="100%" border="1" style="border-collapse:collapse;">
                <thead>
<tr>
<th ><strong>No</strong></th>
<th><strong>Fullname</strong></th>
<th><strong>Email </strong></th>


<th><strong>Department </strong></th>

<th><strong>Username </strong></th>
<th><strong>User's Email </strong></th>
<th><strong>Role</strong></th>
<th><strong>Password</strong></th>

</tr>
                </thead>
<tbody>

<?php
    $count=1;
    $test="SELECT u.fullname, u.email, u.department,a.username ,a.password,a.email,a.role
    FROM user AS u
    JOIN acc AS a ON u.id = a.id";
    $back=mysqli_query($con,$test);
    while($row = mysqli_fetch_assoc($back)) { ?>
   
        <tr><td ><?php echo $count; ?></td>
        <td ><?php echo $row["fullname"]; ?></td>
        <td ><?php echo $row["email"]; ?></td>
        
        <td ><?php echo $row["department"];?></td>
        <td ><?php echo $row["username"];?></td>
        <td ><?php echo $row["email"];?></td>
        <td ><?php echo $row["role"];?></td>
        <td ><?php echo $row["password"];?></td>
       

        </tr>
<?php $count++; } ?>

</tbody>
                </table>

			</div>
    </body>
</html>