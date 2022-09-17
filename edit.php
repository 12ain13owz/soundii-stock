<?php 
  include("./config/connect.php");

  if (isset($_POST['submit'])) {    
    $id = $_GET['id'];
    $name = $_POST['name'];
    $code = $_POST['code'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];
    $detail = $_POST['detail'];
    $file = $_FILES['upload'];
    $image_path = $_POST['image_path'];;
    
    if (file_exists($file['tmp_name']) ||  is_uploaded_file($file['tmp_name'])) {
      $path = "./img/";
      $fileName = $file['name'];
      $tmpName = $file['tmp_name'];
      @unlink($path.$fileName);
      copy($tmpName, $path.$fileName);
      $image_path = $path.$fileName;
    }

    $sql = "UPDATE product SET name='$name', code='$code', stock='$stock', price='$price', detail='$detail', image_path='$image_path'
            WHERE id = '$id'";
    $query = mysqli_query($connect, $sql);

    header( "location: index.php" );
    exit(0);
  }
               
  $id = $_GET['id'];
  if (!$id) {
    header( "location: index.php" );
    exit(0);
  }

  $sql = "SELECT * FROM product WHERE product.id = '$id'";
  $query = mysqli_query($connect, $sql);
  $data = mysqli_fetch_array($query);
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
      <a href="profile.php" class="profile">
        <img src="img/people.png" />
      </a>
    </nav>
    <!-- NAVBAR -->

    <!-- MAIN -->
    <main>
      <div class="head-title">
        <div class="left">
          <h1>แก้ไขสินค้า</h1>
        </div>
      </div>

      <div class="table-data">
        <div class="order">
          <form action="edit.php?id=<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">
            <div class="upload-wrapper <?php
              if ($data['image_path']){
                echo "active";
              }
            ?>">
              <div class="upload-image">
                <img id="upload-image" src="<?php
                  if ($data['image_path']){
                    echo $data['image_path'];
                  }
                ?>">

                <input type="hidden" name="image_path" value="<?php echo $data['image_path'];  ?>">
              </div>
              <div class="upload-content">
                <div class="upload-icon"><i class='bx bxs-cloud-upload'></i></div>
                <div class="upload-text">ไม่มีไฟล์</div>
              </div>
              <div id="upload-cancel-btn"><i class='bx bx-x'></i></div>
              <button type="button" onclick="defaultBtnActive()" id="upload-btn" class="upload-btn">เลือกไฟล์</button>
            </div>
            <input type="file" id="upload-default-btn" name="upload" accept="image/*" hidden>

            <div class="form-inline">
              <div class="form">
                <input type="text" id="name" name="name" value="<?php echo $data['name']; ?>" <?php 
                  if ($data['name']) { echo "class='valid'"; }
                ?> required />
                <label for="name">ชื่อสินค้า</label>
              </div>
              <div class="form">
                <input type="text" id="code" name="code" value="<?php echo $data['code']; ?>" <?php 
                  if ($data['code']) { echo "class='valid'"; }
                ?> required />
                <label for="code">รหัส</label>
              </div>
            </div>

            <div class="form-inline">
              <div class="form">
                <input type="number" id="stock" name="stock" value="<?php echo $data['stock']; ?>" <?php 
                  if ($data['stock']) { echo "class='valid'"; }
                ?> required />
                <label for="stock">จำนวน</label>
              </div>
              <div class="form">
                <input type="number" step=".01" id="price" name="price" value="<?php echo $data['price']; ?>" <?php 
                  if ($data['price']) { echo "class='valid'"; }
                ?> required />
                <label for="price">ราคา</label>
              </div>
            </div>

            <div class="form">
              <textarea id="detail" name="detail" cols="30" rows="10" <?php 
                  if ($data['detail']) { echo "class='valid'"; }
                ?>><?php echo $data['detail']; ?></textarea>
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