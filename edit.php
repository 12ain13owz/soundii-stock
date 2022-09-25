<?php 
  include("./config/connect.php");
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
    header( "location: index.php" );
    exit(0);
  }

  $sql = "SELECT * FROM product WHERE product.id = '$id'";
  $query = mysqli_query($connect, $sql);
  $data = mysqli_fetch_array($query);

  if (isset($_POST['submit'])) {    
    $id = $_GET['id'];
    $name = $_POST['name'];    
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

    $sql = "UPDATE product SET name='$name',price='$price', detail='$detail', image_path='$image_path'
            WHERE id = '$id'";
    $query = mysqli_query($connect, $sql);
       
    header( "location: index.php" );
    exit(0);
  }

  if (isset($_POST['submitStock'])) {    
    $id = $_GET['id'];
    $select = $_POST['select'];    
    $stock = $_POST['stock'];
    $cut = $_POST['cut'];
    $specs = $_POST['specs'];
    $amount = 0;

    if ($select == 0) {
      $amount = $stock + $cut;
    } elseif ($select == 1) {
      $amount = $stock - $cut;
    }
    
    $sql = "UPDATE product SET stock='$amount' WHERE id = '$id'";
    $query = mysqli_query($connect, $sql);

    $sql = "INSERT INTO log (id_product, amount, specs, status)
            VALUES ('$id', '$cut', '$specs', '$select');";
    $query = mysqli_query($connect, $sql);
    
    header( "location: log.php" );
    exit(0);
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
                <input type="text" id="code" name="code" value="<?php echo $data['code']; ?>" <?php 
                  if ($data['code']) { echo "class='valid'"; }
                ?> disabled />
                <label for="code">รหัส</label>
              </div>
              <div class="form">
                <input type="text" id="name" name="name" value="<?php echo $data['name']; ?>" <?php 
                  if ($data['name']) { echo "class='valid'"; }
                ?> required />
                <label for="name">ชื่อสินค้า</label>
              </div>
            </div>

            <div class="form-inline">
              <div class="form">
                <input type="number" id="stock" name="stock" value="<?php echo $data['stock']; ?>" <?php 
                  if ($data['stock']) { echo "class='valid'"; }
                ?> disabled />
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

      <div class="head-title" style="margin-top: 40px;">
        <div class="left">
          <h1>จัดการสต็อก</h1>
        </div>
      </div>

      <div class="table-data">
        <div class="order">
          <form action="edit.php?id=<?php echo $data['id']; ?>" method="post">
            <input type="number" id="stock2" name="stock" value="<?php echo $data['stock']; ?>" hidden />

            <div class="radio-box">
              <input type="radio" name="select" id="option1" value="0" checked>
              <input type="radio" name="select" id="option2" value="1">

              <label for="option1" class="option-1">
                <div class="dot"></div>
                <div class="text">เพิ่มสต็อก</div>
              </label>
              <label for="option2" class="option-2">
                <div class="dot"></div>
                <div class="text">ตัดสต็อก</div>
              </label>
            </div>

            <div class="form">
              <input type="number" id="cut" name="cut" value="" required />
              <label for="stock">จำนวน</label>
            </div>

            <div class="form">
              <textarea id="specs" name="specs" cols="30" rows="10"></textarea>
              <label for="detail">รายละเอียด</label>
            </div>

            <button type="submit" name="submitStock" class="btn-submit">Submit</button>
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
const stock2 = Number(document.querySelector('#stock2').value)
const cut = document.querySelector('#cut')

cut.addEventListener("input", function() {
  const select = document.querySelector('input[name="select"]:checked').value;
  let value = cut.value || 0

  if (select == 0) {
    if (value < 1) cut.value = 1
  } else if (select == 1) {
    if (value > stock2) cut.value = stock2
  }
})
</script>