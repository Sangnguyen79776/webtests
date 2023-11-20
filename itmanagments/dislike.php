<?php
session_start();
include 'dbconnect.php';
if(isset($_POST['dislike'])){
$ideaId = $_POST['idea_id'];
$userId = $_POST['user_id'];
$likeStatus = $_POST['like_status'];

// Kiểm tra xem người dùng đã thích hoặc không thích ý tưởng này chưa
$checkQuery = "SELECT * FROM likes_dislikes WHERE idea_id = '$ideaId' AND user_id = '$userId'";
$checkResult = mysqli_query($con, $checkQuery);

if (mysqli_num_rows($checkResult) > 0) {

        if($likeStatus!='dislike'){
            echo"Error like_status !..... Please enter again....";
            mysqli_error($con);
            
        }
        else{
        // User has picked a dislike for like_status, then update like_status for idea
        $updatedata = "UPDATE likes_dislikes SET like_status = '$likeStatus' WHERE idea_id = '$ideaId' AND user_id = '$userId'";
        $resultforupdate = mysqli_query($con, $updatedata);
    
        if ($resultforupdate) {
            echo "Updated sucessfully .";
        } else {
            echo "Failed to update: " . mysqli_error($con);
        }
        $insertQuery = "INSERT INTO likes_dislikes (idea_id, user_id, like_status) VALUES ('$ideaId', '$userId', '$likeStatus')";
        $insertResult = mysqli_query($con, $insertQuery);
    
        if ($insertResult) {
            echo "Added sucessfully.";
        } else {
            echo "Failed to add : " . mysqli_error($con);
        }
        $likeQuery = "SELECT COUNT(*) AS like_count FROM likes_dislikes WHERE idea_id = $ideaId AND like_status = 'dislike'";
    $dislikeResult = mysqli_query($con, $likeQuery);
    
    if ($dislikeResult) {
        
        $row = mysqli_fetch_assoc($dislikeResult);
        $dislikeCount = $row['like_count'];
    
        echo "Number of dislike count : " . $dislikeCount;
    } else {
        echo "Error query : " . mysqli_error($con);
    }
    }
    
    }
    
      
    
    }

?>
<html>
    <head>
        <h2>Dislike Page</h2>
        
    </head>
    <body>
        <div>
        <form action="dislike.php" method="post">
        <label for="idea_id">Idead_id</label>
      <input type="number" id="idea_id" name="idea_id" required>
    </div>
    <div>
      <label for="user_id">user_id</label>
      <input type="number" id="user_id" name="user_id" required>
    </div> 
    <div>
      <label for="like_status">Like status</label>
      <input type="text" id="like_status" name="like_status" placeholder="Enter a like_status(dislike)...." required>
    </div> 
    <input type="submit" name="dislike" value="Dislike">   
        </form>
        </div>
       
    </body>
</html>
