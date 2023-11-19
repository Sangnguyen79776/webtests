<?php
    session_start();
    include 'dbconnect.php';

    $connect = "mysql:host=$DATABASE_HOST;dbname=$DATABASE_NAME;charset=utf8mb4";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
     
    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';
    $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug=3;
            $mail->isSMTP(); // Set mailer to use SMTP
            // Other necessary configuration settings for the SMTP server
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->Username = 'bomberlauna@gmail.com';
            $mail->Password = 'tpky ndzb lgoy qqae'; 
            $mail->setFrom('bomberlauna@gmail.com', 'Notification');
            $mail->addAddress('bomberlauna@gmail.com', 'QA Coordinator');
            
            $mail->isHTML(true);
            $mail->Subject = 'New Idea Submission';
            $mail->Body = "A new idea has been submitted for review. Here is the idea information:title: $title 
            <br>idea explantion:$explanation<br>idea category: $category_id<br>idea event id: $ie_id";
           
            $mail->send();
            echo 'Email has been sent successfully';
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    try {
        $pdo = new PDO($connect, $DATABASE_USER, $DATABASE_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    $sql = "SELECT DISTINCT category_id,name FROM ideas INNER JOIN categories on ideas.category_id=categories.id ";
    $result = $con->query($sql);
    $categories = array();
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row['category_id'].$row['name'];
       
      
    }
    
}

// Handle form submission to filter ideas based on category
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['category_id'])) {
    $selectedCategory = $_POST['category_id'];
  
    $sql = "SELECT * FROM ideas WHERE category_id = '$selectedCategory'  ";
    $result = $con->query($sql);
    $filteredIdeas = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $filteredIdeas[] = $row;
        }
    }
}
$sql = "SELECT DISTINCT ie_id,ename FROM ideas INNER JOIN  ideasevent on ideas.ie_id=ideasevent.id";
$result = $con->query($sql);
$event = array();
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
    $event[] = $row['ie_id'].$row['ename'];
}
}

// Handle form submission to filter ideas based on event
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ie_id'])) {
$selectedEvent = $_POST['ie_id'];
$sql = "SELECT * FROM ideas WHERE ie_id = '$selectedEvent'";
$result = $con->query($sql);
$filteredIdeas = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $filteredIdeas[] = $row;
    }
}
}
    if(isset($_POST['add'])){
        $title = $_POST['title'];
    $explanation = $_POST['explanation'];
    $category_id = $_POST['category_id'];
    $ie_id=$_POST['ie_id'];
   

    // Assuming the idea has been successfully inserted into the database and reviewed_status is false
 
        

$db_add = "INSERT INTO ideas (title, explanation, category_id,ie_id) VALUES ('$title', '$explanation', '$category_id','$ie_id')";

$kq=mysqli_query($con,$db_add);
if($kq) {
    echo "Add a new idea succesfully .";
    echo"<br>";
} else {
    echo "failed to add a new idea" . mysqli_error($con);
}


    }


?>

<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    * {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 2px solid #f5e7fe;
  border-radius: 4px;
  resize: vertical;border-style: outset;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right; 
  width: 80px;
  height: 60px;
  background: #45a049;
  transition: width 2s;
}

input[type=submit]:hover {
  background-color:red; 
  width: 100px;
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

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
  padding:5px 5px;
}
.col-10{
    float: right;
    font-weight: bold;
}

/* Clear floats after the columns */
.row::after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
.header{
    font-size: 24px;
    font-weight: bold;
    background-color:#f5e7fe;
padding: 40px 40px;    width: 60%;
    color: rgb(87, 6, 140) ;
    text-align: center;
    font-family: monospace;
    margin: auto;
}        .top-nav-index {
    background-color:rgb(87, 6, 140) ;
        color: rgb(255, 255, 255);
        font-size: 20px;
        padding: 10px 10px;
        font-weight: bold;
        height: 50px;  
 
}


    
</style>
    </head>
    <body>
    <div class="top-nav-index"><i class="fa fa-toggle-left" style="padding: 5px 5px;"></i><a href="ideamanagementhomepage.php" style="color:#ffffff;">IDEA HOMEPAGE

 </a>
</div>
<br>    <div class="header"><h1>CREATE NEW IDEA</h1></div>
    <br>
    <div class="container">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="row">
    <div class="col-25">
                <label for="title">Idea Title</label><br>
    </div>
    <div class="col-75">
                <input type="text" name="title" placeholder="Idea Title "required>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
                <label for="explanation">Idea explanation</label><br>
    </div>
    <div class="col-75">
                <input type="text" name="explanation" placeholder="Idea Explanation "required><br>
    </div>
  </div>
  <div class="row">
   <div class="col-75">
                <label for="category_id">Select a Category:</label>
        <select id="category" name="category_id" required>
            <?php
    
            foreach ($categories as $category) {
                
                
                echo "<option value='".$category."'>".$category."</option>";
           
               
                
            }

            ?>
        </select><br></div>
        <div class="col-25">
        <label for="Event">Select a Event:</label>
        <select id="ievent" name="ie_id" required>
            <?php
    
            foreach ($event as $ievent) {
                
                
                echo "<option value='".$ievent."'>".$ievent."</option>";
           
               
                
            }

            ?>
        </select>  </div>
 
        </div>
                <div class="row">
                    <label for="termsandc"> Terms and Condition</label></div>
                    <div class="col-75"> 
                <input type="radio"  value="I agreed"required>I Agreed <br></div></div>
            <div class="row">
            <div class="col-10">  <input type="submit" name="add" value="Add"> </div> </div>
                </div>
                </div>
                <?php
                if(isset($_POST['add'])){
                    $db_query="SELECT i.title, i.explanation, i.category_id,c.name ,i.ie_id,c.description
                    FROM ideas AS i
                    JOIN categories AS c ON i.category_id = c.id";
                    $returnback=mysqli_query($con,$db_query);
                    if(mysqli_num_rows($returnback)>0){
                        while($q=mysqli_fetch_array($returnback)){
                            echo"<div style='border-bottom:1px solid black;padding:10px 10px;'>";
                            echo'<h4>Idea title:'.$q['title'].'</h4>';
                            echo'<h4>Idea explanation:'.$q['explanation'].'</h4>';
                            echo'<h4>Idea category_id:'.$q['category_id'].'</h4>';
                            echo'<h4>Idea event_id:'.$q['ie_id'].'</h4>';
                            echo'<h4>categories name:'.$q['name'].'</h4>';
                            echo'<h4>category description:'.$q['description'].'</h4>';  
                            echo"</div>";
                    }
                    }            
                }        
                ?>
                
            </form>
        </div>
    </body>



</html>
