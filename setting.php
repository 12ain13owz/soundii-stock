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

  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $select = $_POST['select'];

    $sql = "SELECT * FROM account WHERE account.username = '$username';";
    $query = mysqli_query($connect, $sql);
    $rows = mysqli_num_rows($query);
    $status = false;

    if ($rows < 1) {
      $sql = "INSERT INTO account (username, password, role)
              VALUES ('$username', '$password', $select);";
      $query = mysqli_query($connect, $sql);
      $status = true;
    }
  }
    
  $perpage = 10;
  $page = 1;

  if (isset($_GET['page'])) {
    $page = $_GET['page'];
  } else {
    $page = 1;
  }

  $start = ($page - 1) * $perpage;

  $sql = "SELECT * FROM account limit $start,$perpage";
  $query = mysqli_query($connect, $sql);

  $sql2 = "SELECT COUNT(*) as total FROM account";
  $query2 = mysqli_query($connect, $sql2);
  $data2 = mysqli_fetch_assoc($query2);
  $total_page = ceil($data2['total'] / $perpage);

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
          <h1>ตั้งค่า</h1>
        </div>
      </div>

      <?php 
        if (isset($_POST['submit'])) {          
      ?>

      <div class="table-data">
        <div class="order">
          <?php             
            if ($status) {
              echo "<span class='message-success'>เพิ่มพนักงานสำเร็จ</span>";
            } else {
              echo "<span class='message-error'>Username ซ้ำเพิ่มพนักงานไม่สำเร็จ</span>";
            }             
          ?>
        </div>
      </div>

      <?php } ?>

      <div class="table-data">
        <div class="order">
          <div class="head">
            <h3>พนักงานทั้งหมด</h3>
          </div>
          <table>
            <thead>
              <tr>
                <th>Uername</th>
                <th>Role</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
              </tr>
            </thead>
            <tbody>
              <?php
                while ($data = mysqli_fetch_array($query)) {                
              ?>

              <tr>
                <td><?php echo "$data[username]"; ?></td>
                <td><?php 
                  $role = "พนักงาน";
                  if ($data['role'] == 0) {
                    $role = "แอดมิน";
                  }
                  echo "$role"; 
                ?></td>
                <td>
                  <?php echo "<a href='edit_setting.php?id=$data[id]' class='completed'><i class='bx bx-edit'></i></a>"; ?>
                </td>
                <td>
                  <button type="button"
                    onclick="onPopup('<?php echo $data['username'];?>', '<?php echo 'delete_setting.php?id='.$data['id'];?>')"
                    class="pending"><i class='bx bx-x'></i></a></button>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <div>
            <ul class="page">
              <?php
                if ($page == 1 ) {
                  echo "<a href='#' class='disabled'><li>ก่อนหน้า</li></a>";
                } else {
                  $pervious = $page - 1;
                  echo "<a href='index.php?page=$pervious'><li>ก่อนหน้า</li></a>";
                }

                if ($page == $total_page ) {
                  echo "<a href='#' class='disabled'><li>ถัดไป</li></a>";
                } else {
                  $next = $page + 1;
                  echo "<a href='index.php?page=$next'><li>ถัดไป</li></a>";
                }

                $page_pervious = $page - 1;
                $page_next = $page + 1;
                $page_last = $total_page - $page;
                $p = 0;

                if ($total_page < 7) {
                  for ($i = 1 ; $i <= $total_page; $i++) {                    
                    if ($i == $page) {
                      echo "<a href='index.php?page=$i' class='active'><li>$i</li></a>";
                    } else {
                      echo "<a href='index.php?page=$i'><li>$i</li></a>";
                    }                    
                  }
                } else {        
                  $p = 1;                                 
                  if ($page == $p) {
                    echo "<a href='index.php?page=$p' class='active'><li>$p</li></a>";
                  } else {
                    echo "<a href='index.php?page=$p'><li>$p</li></a>";
                  }               
                                    
                  $p = 2;  
                  if ($page >= 4) {
                    echo "<a href='#'><li>...</li></a>";
                  } else {                                        
                    if ($page == $p) {
                      echo "<a href='index.php?page=$p' class='active'><li>$p</li></a>";
                    } else {
                      echo "<a href='index.php?page=$p'><li>$p</li></a>";
                    }      
                  }                    
                               
                  $p = 3; 
                  if ($page >= 4 && $page_last > 2) {                      
                    echo "<a href='index.php?page=$page_pervious'><li>$page_pervious</li></a>";
                  } else if ($page >= 4 && $page_last <= 2) {
                    $p = $total_page - 4;                    
                    echo "<a href='index.php?page=$p'><li>$p</li></a>";
                  } else {                                      
                    if ($page == $p) {
                      echo "<a href='index.php?page=$p' class='active'><li>$p</li></a>";
                    } else {
                      echo "<a href='index.php?page=$p'><li>$p</li></a>";
                    }  
                  }    

                  $p = 4;
                  if ($page_last <= 2) {
                    $p = $total_page - 3;                    
                    echo "<a href='index.php?page=$p'><li>$p</li></a>";
                  } else {                   
                    if ($page >= 4 && $page_last >= 3) {                      
                      echo "<a href='index.php?page=$page' class='active'><li>$page</li></a>";                       
                    } else if ($page >= 4 && $page_last < 3) {                         
                      echo "<a href='index.php?page=$page'><li>$page</li></a>";
                    } else {
                      echo "<a href='index.php?page=$p'><li>$p</li></a>";
                    }     
                  } 
                    
                  $p = 5;                       
                  if ($page_last <= 2) {
                    $p = $total_page - 2;                   
                    
                    if ($page == $p) {
                      echo "<a href='index.php?page=$p' class='active'><li>$p</li></a>";
                    } else {
                      echo "<a href='index.php?page=$p'><li>$p</li></a>";
                    }                                            
                  } else {                                       
                    if ($page >= 4) {                                                            
                      echo "<a href='index.php?page=$page_next'><li>$page_next</li></a>";
                    } else {
                      echo "<a href='index.php?page=$p'><li>$p</li></a>";
                    }
                  }                                                 
                                     
                  if ($page_last > 3) {
                    echo "<a href='#'><li>...</li></a>";
                  } else {                      
                    $p = $total_page - 1;
                    if ($page == $p) {
                      echo "<a href='index.php?page=$p' class='active'><li>$p</li></a>";
                    } else {
                      echo "<a href='index.php?page=$p'><li>$p</li></a>";
                    }                     
                  }                  
                                      
                  if ($total_page == $page) {
                    echo "<a href='index.php?page=$total_page' class='active'><li>$total_page</li></a>";
                  } else {
                    echo "<a href='index.php?page=$total_page'><li>$total_page</li></a>";
                  }                                                                                                    
                }                            
              ?>
            </ul>
          </div>
        </div>
      </div>

      <div class="head-title" style="margin-top: 40px;">
        <div class="left">
          <h1>เพิ่มพนักงาน</h1>
        </div>
      </div>

      <div class="table-data">
        <div class="order">
          <form action="setting.php" method="post">
            <div class="radio-box">
              <input type="radio" name="select" id="option1" value="0">
              <input type="radio" name="select" id="option2" value="1" checked>

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
              <input type="text" id="username" name="username" required />
              <label for="username">Username</label>
            </div>

            <div class="form">
              <input type="password" id="password" name="password" required />
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
<script src="./js/form.js"></script>