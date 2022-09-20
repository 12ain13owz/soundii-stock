<?php 
  include("./config/connect.php");
  session_start();	
  $rows = 2;
               
  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];        
    
    $sql = "SELECT * FROM account WHERE account.username = '$username' AND account.password = '$password'";
    $query = mysqli_query($connect, $sql);
    $data = mysqli_fetch_array($query);
    $rows = mysqli_num_rows($query);

    if ($rows == 1) {
      $_SESSION['id'] = $data['id'];
      $_SESSION['username'] = $data['username'];
      $_SESSION['role'] = $data['role'];
  
      header( "location: index.php" );
      exit(0);
    } else {
      $rows = 0;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PJ168</title>
  <!-- Boxicons -->
  <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
  <!-- My CSS -->
  <link rel="stylesheet" href="./css/style.css" />
</head>

<body>
  <div class="login-form">
    <form action="login.php" method="POST">
      <div class="form">
        <h2 class="title">เข้าสู่ระบบ</h2>
        <div class="form">
          <input type="text" id="username" name="username" required>
          <label for="username">Username</label>
        </div>
        <div class="form">
          <input type="password" id="password" name="password" required>
          <label for="password">Password</label>
        </div>
        <button type="submit" name="submit" class="btn-submit">Submit</button>
      </div>
    </form>
    <?php 
      if ($rows == 0) {                                     
        echo "<div class='message'>
          <span class='message-error'>Username หรือ Password ผิด</span>
        </div>";     
      }
    ?>
  </div>
</body>

</html>
<script src="./js/form.js"></script>
<script>
setTheme()

function setTheme() {
  let theme = localStorage.getItem("theme");
  if (!theme) {
    theme = "white";
    localStorage.setItem("theme", "white");
  }

  if (theme == "dark") document.body.classList.add(theme);
  else document.body.classList.remove("dark");

}
</script>