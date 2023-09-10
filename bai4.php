<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 4</title>
</head>

<body>
    <?php if(isset($_POST["sodau"]) && isset($_POST["socuoi"])){
        $sodau=$_POST["sodau"];
        $socuoi=$_POST["socuoi"];
        $tong=0;
        $tong_chan=0;
        $tong_le=0;
        $tich=1;
        for($i=$sodau; $i<=$socuoi; $i++)
        $tong= $tong+$i;
        for($i=$sodau; $i<=$socuoi; $i++)
        $tich= $tich*$i;
        for($i=$sodau; $i<=$socuoi; $i++)
        if($i%2==0)
        $tong_chan=$tong_chan+$i;
        for($i=$sodau; $i<=$socuoi; $i++)
        if($i%2!=0)
        $tong_le=$tong_le+$i;

    }
    ?>
    <form action="bai4.php" method="post">
        <table width="728" border="1">
            <tr>
                <td width="122">&nbsp;</td>
                <td width="76">Số bắt đầu</td>
                <td width="169"><label for="textfield"></label>
                    <input type="text" name="sodau" id="textfield" value="<?php if(isset($_POST["sodau"])) echo $_POST["sodau"]; ?>" />
                </td>
                <td width="152">Số kết thúc</td>
                <td width="175"><label for="textfield2"></label>
                    <input type="text" name="socuoi" id="textfield2" value="<?php if(isset($_POST["socuoi"])) echo $_POST["socuoi"] ?>" />
                </td>
            </tr>
            <tr>
                <td colspan="5">Kết quả
                    <label for="textfield3"></label>
                </td>
            </tr>
            <tr>
                <td>Tổng các số</td>
                <td colspan="4"><label for="textfield4"></label>
                    <input type="text" name="tong" id="textfield4" value=" <?php if(isset($tong)) echo $tong; ?>" />
                </td>
            </tr>
            <tr>
                <td>Tích các số</td>
                <td colspan="4"><label for="textfield5"></label>
                    <input type="text" name="tich" id="textfield5" value="<?php if(isset($tich)) echo $tich; ?>" />
                </td>
            </tr>
            <tr>
                <td>Tổng các số chẵn</td>
                <td colspan="4"><label for="textfield6"></label>
                    <input type="text" name="tong_chan" id="textfield6" value="<?php if(isset($tong_chan)) echo $tong_chan; ?> " />
                </td>
            </tr>
            <tr>
                <td>Tổng các số lẻ</td>
                <td colspan="4"><label for="textfield7"></label>
                    <input type="text" name="tong_le" id="textfield7" value="<?php if(isset($tong_le)) echo $tong_le; ?> " />
                </td>
            </tr>
            <tr>
                <td colspan="5"><input type="submit" name="button" id="button" value="Tính toán" /></td>
            </tr>
        </table>
    </form>
</body>

</html>