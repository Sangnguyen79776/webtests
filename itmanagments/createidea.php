<?php
    session_start();
    include 'dbconnect.php';
    if(isset($_POST['add'])){
        $title = $_POST['title'];
$explanation = $_POST['explanation'];
$category_id = $_POST['category_id'];
    $ie_id=$_POST['ie_id'];



$db_add = "INSERT INTO ideas (title, explanation, category_id,ie_id) VALUES ('$title', '$explanation', '$category_id','$ie_id')";
$kq=mysqli_query($con,$db_add);
if($kq) {
    echo "Add a new idea succesfully .";
    echo"<br>";
} else {
    echo "failed to add a new idea" . mysqli_error($con);
}

$query = "SELECT * FROM ideas WHERE category_id = '$category_id' ";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Tiêu đề: " . $row['title'] . "<br>";
        echo "Mô tả: " . $row['explanation'] . "<br>";
      
        echo "<hr>";
        
    }
} else {
    echo "Không có ý tưởng nào trong danh mục này.";
} 


    }
?>
<html>
    <head>
        <style>
        * {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
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
}

input[type=submit]:hover {
  background-color: #45a049;
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
    background-color:rgb(87, 6, 140) ;
    margin-top: 0;
padding: 40px 40px;    width: 100%;
    color: white;
    text-align: center;
    font-family: monospace;
}
</style>
    </head>
    <body>
    <div class="header"><h1>CREATE NEW IDEA</h1></div>
        <div class="container ">
            <form action='createidea.php' method="post">
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
    <div class="col-25">
                <label for="ie_id">Idea event id</label><br>
    </div>
    <div class="col-75">
                <input type="text" name="ie_id" placeholder="Idea Of Event "required><br>
    </div>
  </div>

  <div class="row">
    <div class="col-25">
                <label for="category_id">Idea cat_id</label><br>
    </div>
    <div class="col-75">
                        <input type="text" name="category_id" placeholder="Idea Of Category "required><br>

      
    </div>
  </div>
   <div class="row">
    <div class="col-25"><label for="termsandc"> Terms and condition</label></div>
    <div class="col-75"> 
<input type="radio"  value="I agreed"required>I agreed <br></div></div>
                <input type="submit" name="add" value="Add">  </div>
                <?php
                if(isset($_POST['add'])){
                    $db_query="SELECT i.title, i.explanation, i.category_id,c.name ,i.ie_id,c.description
                    FROM ideas AS i
                    JOIN categories AS c ON i.category_id = c.id";
                    $returnback=mysqli_query($con,$db_query);
                    if(mysqli_num_rows($returnback)>0){
                        while($q=mysqli_fetch_array($returnback)){
                            echo'<h4>Idea title:'.$q['title'].'</h4>';
                            echo'<h4>Idea explanation:'.$q['explanation'].'</h4>';
                            echo'<h4>Idea category_id:'.$q['category_id'].'</h4>';
                            echo'<h4>Idea event_id:'.$q['ie_id'].'</h4>';
                            echo'<h4>categories name:'.$q['name'].'</h4>';
                            echo'<h4>category description:'.$q['description'].'</h4>';
                          
                          
                    
                    }
                    }
                
                }
                
                
                ?>
            </form>
        </div>
    </body>



</html>