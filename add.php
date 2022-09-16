<?php 
  include("./config/connect.php");
               
  if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $code = $_POST['code'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];
    $detail = $_POST['detail'];
    $file = $_FILES['upload'];
    $image_path = "";
    
    if (file_exists($file['tmp_name']) ||  is_uploaded_file($file['tmp_name'])) {
      $path = "./img/";
      $fileName = $file['name'];
      $tmpName = $file['tmp_name'];
      copy($tmpName, $path.$fileName);
      $image_path = $path.$fileName;
    }

    $sql = "INSERT INTO product (code, name, stock, price, detail, image_path)
            VALUES ('$code', '$name', '$stock', '$price', '$detail', '$image_path');";
    $query = mysqli_query($connect, $sql);
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
      <li class="active">
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
          <h1>เพิ่มสินค้า</h1>
        </div>
      </div>

      <div class="table-data">
        <div class="order">
          <form id="add" action="add.php" method="post" enctype="multipart/form-data">
            <div class="form">
              <input type="file" id="upload" name="upload" accept="image/*" />
            </div>
            <div class="form-inline">
              <div class="form">
                <input type="text" id="name" name="name" />
                <label for="name">ชื่อสินค้า</label>
              </div>
              <div class="form">
                <input type="text" id="code" name="code" />
                <label for="code">รหัส</label>
              </div>
            </div>

            <div class="form-inline">
              <div class="form">
                <input type="number" id="stock" name="stock" />
                <label for="stock">จำนวน</label>
              </div>
              <div class="form">
                <input type="number" step=".01" id="price" name="price" />
                <label for="price">ราคา</label>
              </div>
            </div>

            <div class="form">
              <textarea id="detail" name="detail" cols="30" rows="10"></textarea>
              <label for="detail">รายละเอียด</label>
            </div>

            <button type="submit" name="submit" class="btn-submit">Submit</button>
          </form>
        </div>
      </div>

      <?php 
        if (isset($_POST['submit'])) {          
      ?>

      <div class="table-data">
        <div class="order">
          <?php             
            if ($query) {
              echo "<span class='message-success'>เพิ่มข้อมูลสำเร็จ</span>";
            } else {
              echo "<span class='message-error'>เพิ่มข้อมูลสำเร็จ</span>";
            }             
          ?>
        </div>
      </div>

      <?php } ?>

    </main>
    <!-- MAIN -->
  </section>
  <!-- CONTENT -->
</body>

</html>

<script src="./js/script.js"></script>
<script src="./js/form.js"></script>