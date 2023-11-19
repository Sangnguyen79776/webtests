<?php


session_start();

// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "itsystem";
$conn = new mysqli($servername, $username, $password, $dbname);

// Hàm xác thực người dùng
function authenticateUser($username, $password) {
  global $conn;
  $query = "SELECT * FROM acc WHERE username = '$username' AND password = '$password' ";
  $result = $conn->query($query);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['password'] = $row['password'];

    $_SESSION['role'] = $row['role'];

    return true;
  }
  return false;
}

// Kiểm tra đăng nhập
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
    $email =$_POST['email'];
  if (authenticateUser($username, $password)) {
    if($_SESSION['role']=='staff'){
        header('location:staff.php');
   }
   elseif($_SESSION['role']=='admin'){
    header('location:adminhomepage.php');
}
elseif($_SESSION['role']=='QAmanager'){
    header('location:qamanagerhomepage.php');
}
elseif($_SESSION['role']=='QAcoordinator'){
    header('location:qacoordinatorhomepage.php');
}
    exit();
  } else {
    $error = "Incorrect username or password ";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login  Form </title>
</head>
<body>
  <h2>Đăng nhập</h2>
  <?php if (isset($error)) { ?>
    <div><?php echo $error; ?></div>
  <?php } ?>
  <form method="post" action="">
    <div>
      <label for="username">Username</label>
      <input type="text" id="username" name="username" required>
    </div>
    <div>
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>
    </div>
  
    <div>
      <input type="submit" name="submit" value="Đăng nhập">
    </div>
  </form>
</body>
</html>
