<?php
include 'dbconnect.php';

?>
<html>

<head>
    <style>
        body {
            font-size: 20px;
            margin-left: 3%;
        }

        h2 {
            text-align: center;
            margin-top: 3%;
        }

        img {
            position: absolute;
            left: 0px;
            top: 0px;
            z-index: -1;
            border-radius: 50%;
            width: 100%;
            opacity: 0.7;
        }
    </style>
</head>

<body>
    <div>
        <h2>Comment Idea Page </h2>
        <img src="picture4.png">
        <form action=cmtidea.php method="post">
            <p>What have you thought about the quality of our features and blogs?</p>
            <textarea name="feedback_info" rows="8" cols="40"></textarea>
            <label for="mode">Anoymous:</label>
            <select name="mode">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
            <input type="submit" name="submit" value="Submit">
          
            <?php
            $error = array();
            if (isset($_REQUEST['submit'])) {
                if($mode=='No'){
                $count = 1;
                $txt_ = mysqli_real_escape_string($con, $_POST['feedback_info']);
                if (empty($txt_)) {
                    array_push($error, "feedback_info  is required");
                }
                if (count($error) != 0) {
                    print_r($error);
                    echo '<br>';
                    echo '<div style="color:red;text-transform:uppercase;background-color:orange;text-align:center;"><b>Something went wrong!.....Failed to submit a comment </b></div>';
                } else {
                    $ins_query = "INSERT INTO comment(feedback_info) VALUES('$txt_')";
                    mysqli_query($con, $ins_query) or die(mysqli_connect_error());
                    echo '<div style="color:olive;text-transform:uppercase;background-color:orange;text-align:center;"><b>Give a comment successfully </b></div>';


                }
            }else{
                $ins_query = "INSERT INTO comment(feedback_info,acc_id) VALUES('$txt_','$acc_id')";

                mysqli_query($con, $ins_query) or die(mysqli_connect_error());
                
            }
            }
  

            ?>
        </form>
    </div>
</body>

</html>
