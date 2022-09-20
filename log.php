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
  
  $sql = "SELECT * FROM log INNER JOIN product ON log.id_product = product.id ORDER BY log.datetime DESC ";
  $query = mysqli_query($connect, $sql);
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
      <li class="active">
        <a href="log.php">
          <i class='bx bx-spreadsheet'></i>
          <span class="text">ประวัติ</span>
        </a>
      </li>
    </ul>

    <ul class="side-menu">
      <li>
        <a href="setting.php">
          <i class="bx bx-cog"></i>
          <span class="text">ตั้งค่า</span>
        </a>
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
      <a href="#" class="notification">
        <i class="bx bxs-bell"></i>
        <span class="num">8</span>
      </a>
      <a href="profile.php" class="profile">
        <?php echo $username; ?>
      </a>
    </nav>
    <!-- NAVBAR -->

    <!-- MAIN -->
    <main>
      <div class="head-title">
        <div class="left">
          <h1>หน้าแรก</h1>
        </div>
      </div>

      <div class="table-data">
        <div class="order">
          <div class="head">
            <h3>สินค้าทั้งหมด</h3>
          </div>
          <table>
            <thead>
              <tr>
                <th>ชื่อสินค้า</th>
                <th>รหัส</th>
                <th>วันที่ตัด</th>
                <th>จำนวน</th>
                <th>รายละเอียด</th>
              </tr>
            </thead>
            <tbody>
              <?php
                while ($data = mysqli_fetch_array($query)) {                
              ?>

              <tr>
                <td>
                  <?php echo "<img src = '$data[image_path]'/>"; ?>
                  <p><?php echo "$data[name]"; ?></p>
                </td>
                <td><?php echo "$data[code]"; ?></td>
                <td>
                  <?php                    
                    $date = date('d/m/Y', strtotime($data["datetime"]));
                    echo "$date"; 
                  ?>
                </td>
                <td>
                  <?php 
                    if ($data['status'] == 0) {
                      echo "<span class='text-blue'>$data[amount]</span>";
                    } else if ($data['status'] == 1) {
                      echo "<span class='text-red'>-$data[amount]</span>";
                    }
                  ?>
                </td>
                <td><?php echo "$data[specs]"; ?></td>
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

  <div class="popup-box">
    <i class='bx bx-info-circle'></i>
    <h1 id="popup-name">ชื่อ</h1>
    <label>ต้องการลบใช่ไหม?</label>
    <div class="popup-btn">
      <a href="#" class="btn-cancel">ยกเลิก</a>
      <a href="#" class="btn-ok">ตกลง</a>
    </div>
  </div>
</body>


</html>

<script src="./js/script.js"></script>
<script src="./js/popup.js"></script>