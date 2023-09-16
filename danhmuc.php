
<?php
    include 'connect.php';

    $sql = "SELECT * FROM danhmuc";
    
    $kq = mysqli_query($conn, $sql);

    if(!empty($_GET['iddm'])){
        $sql2 = "SELECT * FROM sanpham WHERE id_danhmuc =".$_GET['iddm'];
        $kq2 = mysqli_query($conn, $sql2);
    }else{
        $sql2 = "SELECT * FROM sanpham ";
        $kq2 = mysqli_query($conn, $sql2);
    }

    if(isset($_POST['ThemDM'])){
        
        $sql3 = "INSERT INTO `danhmuc` (`ID`, `tendm`) VALUES (NULL, '".$_POST['TenDM']."');";
        mysqli_query($conn,$sql3);
        header('location:danhmuc.php');
    }

    if(isset($_POST['ThemSP'])){
        $sql4 = "INSERT INTO `sanpham`(`id`, `tensp`, `gia`, `soluong`, `id_danhmuc`) VALUES (NULL,'".$_POST['TenSP']."','".$_POST['gia']."','".$_POST['soluong']."','".$_POST['idDM']."')";
        mysqli_query($conn,$sql4);
        header('location:danhmuc.php');
    }
  if(isset($_POST['XoaDM'])){
    $sqlxoa="DELETE FROM danhmuc WHERE ID =".$_POST['iddm'];
    mysqli_query($conn,$sqlxoa);
    header('location:danhmuc.php');
  }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="danhmuc.php" method="POST">

        <h2>Thêm danh muc</h2>
            Tên danh muc: <input type="text" name="TenDM" id="">
            <input type="submit" name="ThemDM" id="" value="Thêm">
            <input type="submit" name="XoaDM" id="" value="Xoa">
        <hr>

        <h2>Thêm sản phẩm</h2>
            Tên sản phẩm: <input type="text" name="TenSP" id="">
            Giá: <input type="text" name="gia" id="">
            Số lượng: <input type="text" name="soluong" id="">
            ID danh muc: <input type="text" name="idDM" id="">
            <input type="submit" name="ThemSP" id="" value="Thêm">
        <hr>

        <h2>Danh mục sản phẩm</h2>
    </form>
    <?php
        while($row = mysqli_fetch_array($kq)){
         echo 'ID: '.$row['ID']. '<br>';
         echo 'Tên sản phẩm: <a href="danhmuc.php?iddm='.$row['ID'].'">'.$row['tendm'].'</a><br>';
         echo '<hr>';
        }
    ?>
    <h2>Các sản phẩm</h2>
    <?php
        while($row = mysqli_fetch_array($kq2)){
            echo 'ID: '.$row['id']. '<br>';
            echo 'Tên sản phẩm: '.$row['tensp'].'<br>';
            echo 'Giá: '.$row['gia']. '<br>';
            echo 'Số lượng: '.$row['soluong']. '<br>';
        }
    ?>
</body>
</html>