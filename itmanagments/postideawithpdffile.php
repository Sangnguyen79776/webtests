
<html>
    <head> <meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   
       <meta name='viewport' content='width=device-width, initial-scale=1'>
 <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <style>
            input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
 input[type=number], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
 input[type=file], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 10%;
  background-color: rgb(230, 0, 0);
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}


input[type=submit]:hover {
  background-color: rgb(230, 0, 0);
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: rgb(87, 6, 140) ;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #ffffff;
}
div {
  border-radius: 5px;
  background-color: rgb(245, 231, 254);
  padding: 20px;
}
h2{font-weight: bold;}</style>
    </head>
    <body>
 <ul>
            <li><a href="staff.php"><i class="glyphicon glyphicon-user" style="color:white;"></i>
</a></li>

         <li><a href="ideamanagementhomepage.php">IDEA HOME</a></li>

  <li><a href="filterideabycategory.php">IDEA OF CATEGORY</a></li>
  <li><a href="filterideabyevent.php">IDEA OF EVENT</a></li>
  <li><a href="createidea.php">NEW IDEA</a></li>
  <li><a href="viewallofidea.php">IDEAS</a></li>
  <li><a href="postideawithpdffile.php">FILE</a></li>

 
</ul>
        <div>
            <h2>UPLOAD PDF FILE OF IDEA</h2>
        <form action="postideawithpdffile.php" method="post" enctype="multipart/form-data">
  <label for="title">Idea Title:</label>
    <input type="text" name="title" id="title" required>

    <label for="explanation">Explanation:</label>
    <input type="text" id="explanation" name="explanation" placeholder="" required>

    <label for="category_id">Idea Of Category:</label>
     <input type="number" name="category_id" id="category_id" required>
   <label for="file">Upload PDF File:<i class='glyphicon glyphicon-paperclip' style='font-size:16px;color:red'></i>
</label>
    <input type="file" name="file" id="file">
       <label for="termsandc"> Terms & Conditions:</label><input type="radio"  value="I agreed"required>I Agreed <br>
    <input type="submit" value="Submit" name="post">
  
    <?php
        session_start();
        include 'dbconnect.php';
        if(isset($_REQUEST['post'])){
        $title = $_POST['title'];
        $explanation = $_POST['explanation'];
        $category_id= $_POST['category_id'];
       
       
        $targetDir = 'uploads/';
        $targetFile = $targetDir . basename($_FILES['file']['name']);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }
    
    // Set the appropriate permissions for file uploads
    chmod($targetDir, 0755);
// Check if the file is a PDF
        if ($fileType !== 'pdf') {
        echo "Only PDF files are allowed.";
        $uploadOk = 0;
    }

// Move the uploaded file
        if ($uploadOk) {
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
        // Store the idea information in the database
        $filePath = $targetFile;
        $filePath = $con->real_escape_string($filePath);
        // Write a database insert query and execute it
        // ...
        $db_add = "INSERT INTO ideas (title, explanation, category_id,file_path) VALUES ('$title', '$explanation', '$category_id','$filePath')";
        $kq=mysqli_query($con,$db_add);
        echo "Idea submitted successfully.";
       
        } else {
        echo "Error uploading the file.";
        }
    }
    }
    ?>
</form>
        </div>
    </body>
</html>
