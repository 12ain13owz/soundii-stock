<?php 
  include('./config/connect.php');
  $sql = "SELECT * FROM product";
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
    <a href="index.html" class="brand">
      <i class="bx bxs-speaker"></i>
      <span class="text">Speker</span>
    </a>
    <ul class="side-menu top">
      <li class="active">
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
    </ul>

    <ul class="side-menu">
      <li>
        <a href="setting.php">
          <i class="bx bx-cog"></i>
          <span class="text">ตั้งค่า</span>
        </a>
      </li>
      <li>
        <a href="login.php" class="logout">
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
      <a href="profile.html" class="profile">
        <img src="img/people.png" />
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
                <th>วันที่เพิ่ม</th>
                <th>จำนวน</th>
                <th>ราคา</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
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
                    $date = date('d/m/Y', strtotime($data["create_date"]));
                    echo "$date"; 
                  ?>
                </td>
                <td><?php echo "$data[stock]"; ?></td>
                <td><?php echo "$data[price]"; ?></td>
                <td>
                  <button class="completed">
                    <i class="bx bx-edit"></i>
                  </button>
                </td>
                <td>
                  <button class="pending">
                    <i class="bx bxs-edit-alt"></i>
                  </button>
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