<?php
// いたずらする人が多いので、WAFを導入しました。
if (isset($_GET["name"])) {
    $name = $_GET["name"];
    $isTag = 0;
    for ($i = 0; $i < strlen($name); $i++) {
        if ($name[$i] == "<") {
            $isTag++;
        }
        if ($name[$i] == ">") {
            $isTag--;
        }
        if ($isTag > 0) {
            continue;
        }
        $msg .= $name[$i];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Your name</title>
    <style>
        body {
            font: bold large/150% "ＭＳ ゴシック";
        }
    </style>
</head>

<body>
    <p>
        「大事な人、忘れたくない人、忘れちゃダメな人。誰だ、誰だ、誰だ・・・名前はー」
    </p>
    <p>
        <strong>
            「君の、名前はーー」
        </strong>
    </p>

    <form method="GET">
        <input type="text" name="name">
        <input type="submit" value="Enter">
    </form>
    <p>
        <?php
        if (isset($msg)) {
            echo " ｎ∩ｎ<br>";
            echo " |||||ｈ<br>";
            echo "∩￣￣  |<br>";
            echo "|" . $msg . "|<br>";
            echo "ヽ )　ノ";
        }
        ?>
    </p>
    <hr>
    <p>名前を思い出したら、教えてください。</p>
    <form action="worker.php" method="POST">
        <input type="text" name="name">
        <input type="submit" value="Enter">
    </form>
</body>

</html>