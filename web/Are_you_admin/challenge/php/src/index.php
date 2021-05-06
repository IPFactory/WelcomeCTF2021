<?php
if (!isset($_COOKIE["isadmin"])) {
    setcookie("isadmin", 0);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Are you admin??</title>
</head>

<body>
    <h1>こんにちは！</h1>
    <?php
    if ($_COOKIE["isadmin"] == 0) {
        echo "<p>あなたにはこのページを表示する権限がありません。</p>";
    } else {
        echo "flag{c00k13_1s_34s1ly_r3wr1tt3n}";
    }
    ?>
</body>

</html>