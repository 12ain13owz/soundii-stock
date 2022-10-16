<?php 
  include("./config/connect.php");
  include('./function/notify.php');
  session_start();

  $id = $_SESSION['id'];
  if (!$id) {
    header( "location: login.php" );
    exit(0);
  } else {  
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];    
  }

  if (isset($_POST['submit'])) {
    $old_pass = $_POST['old_password'];
    $new_pass = $_POST['new_password'];
    $con_pass = $_POST['confirm_password'];
    $message = "";
    $status = false;

    $sql = "SELECT * FROM account WHERE id = $id AND password = $old_pass";
    $query = mysqli_query($connect, $sql);
    $row = mysqli_num_rows($query);

    if ($row == 0) {
      $message = "รหัสผ่านเก่าไม่ถูกต้อง";
    } else if ($new_pass != $con_pass) {
      $message = "รหัสผ่านใหม่ไม่ตรงกัน";
    } else {
      $sql = "UPDATE account SET password = '$new_pass' WHERE id = $id";
      $query = mysqli_query($connect, $sql);     
      $message = "เปลี่ยนรหัสผ่านสำเร็จ";
      $status = true; 
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
      <li>
        <a href="report.php">
          <i class='bx bx-file-blank'></i>
          <span class="text">รายงาน</span>
        </a>
      </li>
      <li>
        <a href="stock.php" style="position: relative;">
          <i class='bx bx-notification'></i>
          <span class="text">ใกล้หมด</span>
          <?php 
            if ($stock11 > 0) {
              echo "<span class='notify'>$stock11</span>";
            }           
          ?>
        </a>
      </li>
    </ul>

    <ul class="side-menu">
      <li>

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
          <h1>เปลี่ยนรหัสผ่าน</h1>
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
            } else {
              echo "<span class='message-success'>$message</span>";   
            }
          ?>
        </div>
      </div>

      <?php } ?>

      <div class="table-data">
        <div class="order">
          <form action="profile.php?id=<?php echo $id; ?>" method="post">
            <div class="form">
              <input type="password" id="old_password" name="old_password" required autofocus />
              <label for="old_password">รหัสเก่า</label>
            </div>

            <div class="form">
              <input type="password" id="new_password" name="new_password" required />
              <label for="new_password">รหัสใหม่</label>
            </div>

            <div class="form">
              <input type="password" id="confirm_password" name="confirm_password" required />
              <label for="confirm_password">คอนเฟิร์ม รหัสใหม่</label>
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