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

  $data = '';
  if (isset($_GET['submit'])) {
    $code = $_GET['code'];

    $sql = "SELECT * FROM product WHERE code = '$code'";
    $query = mysqli_query($connect, $sql);
    $data = mysqli_fetch_array($query);    
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
      <li class="active">
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
          <h1>ค้นหา</h1>
        </div>
      </div>

      <div class="table-data">
        <div class="todo">
          <form action="search.php" method="get">
            <div class="form-input">
              <input type="search" name="code" placeholder="Search..." />
              <button type="submit" name="submit" class="search-btn">
                <i class="bx bx-search"></i>
              </button>
            </div>
          </form>
        </div>
      </div>

      <div class="table-data">
        <div class="order">
          <table>
            <thead>
              <tr>
                <th>ชื่อสินค้า</th>
                <th>รหัส</th>
                <th>วันที่</th>
                <th>จำนวน</th>
                <th>ราคา</th>
                <th>ประวัติ</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if ($data) {
              ?>
              <tr>
                <td>
                  <?php if ($data['image_path']) {
                      echo "<img src ='$data[image_path]'/>";
                    } else {
                      echo "<img src ='./img/default/default.png' />";
                    }
                  ?>
                  <p><?php echo "$data[name]"; ?></p>
                </td>
                <td><?php echo "$data[code]"; ?></td>
                <td>
                  <?php                    
                    $date = date('d/m/Y', strtotime($data["create_date"]));
                    echo "$date"; 
                  ?>
                </td>
                <td><?php echo "$data[stock]"; ?></td>
                <td><?php echo "$data[price]"; ?></td>
                <td>
                  <?php echo "<a href='log_product.php?id=$data[id]' class='process'><i class='bx bx-history'></i></i></a>"; ?>
                </td>
                <td>
                  <?php echo "<a href='edit.php?id=$data[id]' class='completed'><i class='bx bx-edit'></i></a>"; ?>
                </td>
                <td>
                  <?php echo "<a href='delete.php?id=$data[id]' class='pending'><i class='bx bx-x'></i></a>"; ?>
                </td>
              </tr>

              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
    <!-- MAIN -->
  </section>
  <!-- CONTENT -->
</body>

</html>

<script src="./js/script.js"></script>