<?php 
  include('./config/connect.php');
  session_start();	

  $id = $_SESSION['id'];
  if (!$id) {
    header( "location: login.php" );
    exit(0);
  } else {  
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];    
  }

  $id = $_GET['id'];
  if (!$id) {
    header( "location: setting.php" );
    exit(0);
  }

  $sql = "SELECT * FROM account WHERE account.id = '$id'";
  $query = mysqli_query($connect, $sql);
  $data = mysqli_fetch_array($query);

  if (isset($_POST['submit'])) {    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $select = $_POST['select'];

    $sql = "SELECT * FROM account WHERE account.id = $id";
    $query = mysqli_query($connect, $sql);
    $data = mysqli_fetch_array($query);

    if ($password == '') {
      $password = $data['password'];
    }

    if ($username == $data['username']) {
      $sql = "UPDATE account SET password='$password', role=$select
              WHERE account.id = '$id'";
      $query = mysqli_query($connect, $sql);          
      header( "location: setting.php" );
      exit(0);
    } else {
      $sql = "SELECT * FROM account WHERE account.username = '$username';";
      $query = mysqli_query($connect, $sql);
      $rows = mysqli_num_rows($query);
      $status = false;
      $message = "Username ซ้ำ!";

      if ($rows < 1) {
        $sql = "UPDATE account SET username='$username',password='$password', role=$select
                WHERE account.id = '$id'";
        $query = mysqli_query($connect, $sql);          
        header( "location: setting.php" );
        exit(0);
      }
    }    
  }

  if ($role == 0) {
    include('./function/notification.php');
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Boxicons -->
  <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
  <!-- My CSS -->
  <link rel="stylesheet" href="./css/style.css" />
  <title>PJ168</title>
</head>

<body>
  <!-- SIDEBAR -->
  <section id="sidebar">
    <a href="index.php" class="brand">
      <i class="bx bxs-speaker"></i>
      <span class="text">Speker</span>
    </a>
    <ul class="side-menu top">
      <li>
        <a href="index.php">
          <i class="bx bxs-dashboard"></i>
          <span class="text">หน้าแรก</span>
        </a>
      </li>
      <li>
        <a href="search.php">
          <i class="bx bx-search"></i>
          <span class="text">ค้นหา</span>
        </a>
      </li>
      <li>
        <a href="add.php">
          <i class="bx bx-plus-circle"></i>
          <span class="text">เพิ่มสินค้า</span>
        </a>
      </li>
      <li>
        <a href="log.php">
          <i class='bx bx-spreadsheet'></i>
          <span class="text">ประวัติ</span>
        </a>
      </li>
    </ul>

    <ul class="side-menu">
      <li class="active">

        <?php if ($role == 0) { ?>
        <a href="setting.php">
          <i class="bx bx-cog"></i>
          <span class="text">ตั้งค่า</span>
        </a>
        <?php } ?>

      </li>
      <li>
        <a href="logout.php" class="logout">
          <i class="bx bx-log-out"></i>
          <span class="text">ออกจากระบบ</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- SIDEBAR -->

  <!-- CONTENT -->
  <section id="content">
    <!-- NAVBAR -->
    <nav>
      <div class="menu">
        <i class="bx bx-menu"></i>
      </div>
      <input type="checkbox" id="switch-mode" hidden />
      <label for="switch-mode" class="switch-mode"></label>

      <?php 
        if ($role == 0) {        
      ?>
      <a href="notification.php" class="notification">
        <i class="bx bxs-bell"></i>
        <?php 
         if ($amount > 0) {
          echo "<span class='num'>$amount</span>";
         }
        ?>
      </a>
      <?php } ?>

      <a href="profile.php" class="profile">
        <?php echo $username; ?>
      </a>
    </nav>
    <!-- NAVBAR -->

    <!-- MAIN -->
    <main>
      <div class="head-title">
        <div class="left">
          <h1>แก้ไขข้อมูลพนักงาน</h1>
        </div>
      </div>

      <?php 
        if (isset($_POST['submit'])) {                      
      ?>

      <div class="table-data">
        <div class="order">
          <?php             
            if ($status == false) {
              echo "<span class='message-error'>$message</span>";   
            }
          ?>
        </div>
      </div>

      <?php } ?>

      <div class="table-data">
        <div class="order">
          <form action="edit_setting.php?id=<?php echo $data['id']; ?>" method="post">
            <div class="radio-box">
              <input type="radio" name="select" id="option1" value="0" <?php 
                if ($data['role'] == 0) {
                  echo "checked";
                }
              ?>>
              <input type="radio" name="select" id="option2" value="1" <?php 
                if ($data['role'] == 1) {
                  echo "checked";
                }
              ?>>

              <label for="option1" class="option-1">
                <div class="dot"></div>
                <div class="text">แอดมิน</div>
              </label>
              <label for="option2" class="option-2">
                <div class="dot"></div>
                <div class="text">พนักงาน</div>
              </label>
            </div>

            <div class="form">
              <input type="text" id="username" name="username" value="<?php echo $data['username'] ;?>" <?php 
                  { echo "class='valid'"; }
                ?> required />
              <label for="username">Username</label>
            </div>

            <div class="form">
              <input type="password" id="password" name="password" />
              <label for="password">Password</label>
            </div>

            <button type="submit" name="submit" class="btn-submit">Submit</button>
          </form>
        </div>
      </div>
    </main>
    <!-- MAIN -->
  </section>
  <!-- CONTENT -->
</body>


</html>

<script src="./js/script.js"></script>
<script src="./js/form.js"></script>