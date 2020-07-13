<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if (isset($_POST["sbm"])) {
            $str = "" ;
            foreach($_POST["mua"] as $keys => $value){
                $str .= $value . " " ;
               
            }
        }
    ?>
    <form action="" method="POST">
        Xuan <input type="checkbox" name="mua[]" value="xuan">
        Ha <input type="checkbox" name="mua[]" value="ha">
        Thu <input type="checkbox" name="mua[]" value="thu">
        Dong <input type="checkbox" name="mua[]" value="dong">
        <input type="submit" name="sbm" value="Send">
    </form>
    <hr>
    <h2>Toi yeu thich mua :<?php if(isset($str)){echo $str ;} ?> </h2>
</body>
</html>