<?php
session_start();
include 'dbconnect.php';
$stmt = $con->prepare("SELECT title,explanation,category_id ,ie_id FROM ideas WHERE id = ? ");
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($title, $explanation,$category_id,$ie_id);
$stmt->fetch();
$stmt->close();

?>
<html>
    <head>
       
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Staff Page</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <style>
            .w3-bar {
                color: rgb(255, 255, 255);
                font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif
            }
             .top-nav-index {
 background-color:rgb(87, 6, 140) ;        color: rgb(255, 255, 255);
        font-size: 18px;
        padding: 15px 15px;
        font-weight: bold;
        font-family:'Times New Roman', Times, serif
            }
            .searchidea{
                font-size: 14px;
                text-align: center;
            }
            .well-sm{
                background-color:rgb(153, 204, 255)
;
                color: black;           }
                .idea{
                    padding: 10px;
                }
               thead{
                font-weight: bold;
                text-align: center;
               }
        </style>

    </head>
<body>
   
    <div>
        <div class=top-nav-index >
<a href="ideamanagementhomepage.php">Back To Idea HomePage</a>            
            
          
          
        </div>
    </div>

<div class='idea'>

    <form action="viewallofidea.php" method="post"class='searchidea' >
    <label for="searchidea"><span class="glyphicon glyphicon-search"></span></label>
    <input type="text" name="hastags" placeholder="hastags">
    <input type="submit" name="search" value="Search">
    </form>
    <?php
    if(isset($_POST['search'])){
        $hastags=$_REQUEST['hastags'];
 
        $checkQ = "SELECT * FROM ideas WHERE hastags LIKE '%#%'";
    $backto = $con->query($checkQ);

    // Hiển thị kết quả
    if ($backto->num_rows > 0) {
        while($a = $backto->fetch_assoc()) {
            echo"You have selected the hastags is $hastags for searching<br>";
            echo"<h2>Here is your finding idea</h2>";
            echo "<h4>Idea Name:".$a["title"] . "</h4>";
         
            echo "<h4>Idea explanation:".$a["explanation"] . "</h4>";
          
            echo "<h4>Idea hastags:".$a["hastags"] . "</h4>";
        
          
          
        }
    } else {
        echo "Không có kết quả phù hợp.";
    }

       
    }
 
    
    
    ?>
      <div class="well well-sm">List Of Ideas:</div>

</div> <table class="table table-hover">
    <thead>
      <tr>
       <th>No</th> 
       <th>Idea Title</th>
        <th>Idea Explanation</th>
        <th>Idea Of Category</th>
        <th>Idea Of Event</th>

      </tr>
    </thead>
    <tbody>
<?php
$count=1;
$sel_query="SELECT * FROM ideas  ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
<tr><td ><?php echo $count; ?></td>
<td ><?php echo $row["title"]; ?></td>
<td ><?php echo $row["explanation"]; ?></td>

<td ><?php echo $row["category_id"];?></td>
<td ><?php echo $row["ie_id"];?></td>
<td >
<a href="editidea.php?id=<?php echo $row["id"]; ?>">Edit</a>
</td>
<td >
<a href="deleteidea.php?id=<?php echo $row["id"]; ?>">Delete</a>
</td>
<td >
<a href="cmtidea.php?id=<?php echo $row["id"]; ?>">Write a comment for idea </a>
</td>
<td>
    <a href="like.php?id=<?php echo $row["id"]; ?>">Like  </a></td>
    <td>
    <a href="dislike.php?id==<?php echo $row["id"]; ?>">Dislike  </a>
</td>

</tr>
<?php $count++; } ?>
</tbody>
  </table>
				

			</div>
</body>
</html>
</div>