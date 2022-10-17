<?php 
  include('./config/connect.php'); 

  $from = $_POST['from'];
  $to = $_POST['to'];
  $select = $_POST['select'];


  if ($select == 0) {
    $sql = "SELECT * FROM product WHERE Date(product.create_date) BETWEEN '$from' AND '$to'";
    $query = mysqli_query($connect, $sql);

    $delimiter = ","; 
    $filename = "product-data_" . date('Y-m-d') . ".csv"; 
    $f = fopen('php://memory', 'w'); 

    $fields = array('ชื่อสินค้า', 'รหัส', 'จำนวน', 'ราคา'); 
    fputcsv($f, $fields, $delimiter); 

    while ($data = mysqli_fetch_assoc($query)) {  
      $lineData = array($data['name'], $data['code'], $data['stock'], $data['price']); 
      fputcsv($f, $lineData, $delimiter); 
    }

    fseek($f, 0); 

    header('Content-Type: text/csv; charset=utf-8'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
    fpassthru($f); 
  }

  if ($select == 1) {
    $sql = "SELECT * FROM log INNER JOIN product ON log.id_product = product.id WHERE Date(log.datetime) BETWEEN '$from' AND '$to'";
    $query = mysqli_query($connect, $sql);

    $delimiter = ","; 
    $filename = "product-data_" . date('Y-m-d') . ".csv"; 
    $f = fopen('php://memory', 'w'); 

    $fields = array('ชื่อสินค้า', 'รหัส', 'จำนวน', 'สถานะ'); 
    fputcsv($f, $fields, $delimiter); 

    while ($data = mysqli_fetch_assoc($query)) {  
      $status_text = "เพิ่ม";
      if ($data['status'] == 1) {
        $status_text = "ออก";
      }

      $lineData = array($data['name'], $data['code'], $data['amount'], $status_text); 
      fputcsv($f, $lineData, $delimiter); 
    }

    fseek($f, 0); 
     
    header('Content-Type: text/csv; charset=utf-8'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
    fpassthru($f); 
  }

  if ($select == 2) {
    $sql = "SELECT * FROM log INNER JOIN product ON log.id_product = product.id WHERE log.status = 1 AND Date(log.datetime) BETWEEN '$from' AND '$to'";
    $query = mysqli_query($connect, $sql);

    $delimiter = ","; 
    $filename = "product-data_" . date('Y-m-d') . ".csv"; 
    $f = fopen('php://memory', 'w'); 

    $fields = array('ชื่อสินค้า', 'รหัส', 'จำนวน', 'ราคาต่อหน่วย', 'จำนวนเงิน (THB)'); 
    fputcsv($f, $fields, $delimiter); 
    $sum2 = 0;

    while ($data = mysqli_fetch_assoc($query)) {  
      $sum = $data['amount'] * $data['price'];
      $sum2 = $sum2 + $sum;

      $lineData = array($data['name'], $data['code'], $data['amount'], $data['price'], $sum); 
      fputcsv($f, $lineData, $delimiter); 
    }

    $lineData = array('', '', '', 'จำนวนเงินรวมทั้งสิ้น', $sum2); 
    fputcsv($f, $lineData, $delimiter); 

    fseek($f, 0); 
     
    header('Content-Type: text/csv; charset=utf-8'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
    fpassthru($f); 
  }
?>