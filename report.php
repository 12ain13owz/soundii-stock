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
      
  if ($role == 0) {
    include("./function/notification.php");
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
      <li class="active">
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
          <h1>รายงาน</h1>
        </div>
      </div>

      <div class="table-data">
        <div class="order">
          <form action="export.php" method="post">
            <div class="radio-box">
              <input type="radio" name="select" id="option1" value="0" checked>
              <input type="radio" name="select" id="option2" value="1">
              <input type="radio" name="select" id="option3" value="2">

              <label for="option1" class="option-1">
                <div class="dot"></div>
                <div class="text">วันที่เพิ่ม</div>
              </label>
              <label for="option2" class="option-2">
                <div class="dot"></div>
                <div class="text">วันที่แก้ไข</div>
              </label>
              <label for="option3" class="option-3">
                <div class="dot"></div>
                <div class="text">ตัดสต็อก</div>
              </label>
            </div>

            <div class="form-inline">
              <div class="form">
                <input type="date" id="from" name="from" class="valid" required />
                <label for="from">จาก</label>
              </div>
              <div class="form">
                <input type="date" id="to" name="to" class="valid" required />
                <label for="to">ถึง</label>
              </div>
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

<script>
const from = document.querySelector('#from');
const to = document.querySelector('#to');

const date = new Date();
const d = date.getDate() - 7;
const m = date.getMonth();
const y = date.getFullYear();
const start = new Date(y, m, d);
const end = this.removeTime(date);

from_mm = ("0" + (start.getMonth() + 1)).slice(-2)
to_mm = ("0" + (end.getMonth() + 1)).slice(-2)

from_dd = ("0" + start.getDate()).slice(-2);
to_dd = ("0" + end.getDate()).slice(-2)

from.value = start.getFullYear() + "-" + from_mm + "-" + from_dd
to.value = end.getFullYear() + "-" + to_mm + "-" + to_dd

function removeTime(date) {
  return new Date(date.getFullYear(), date.getMonth(), date.getDate());
}
</script>