<!DOCTYPE html>
<html lang="en">

<head>
    <title>reported</title>
</head>

<body>
    <?php
    function myUrlEncode($string)
    {
        $entities = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
        $replacements = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
        return str_replace($entities, $replacements, $string);
    }
    if (isset($_POST["name"])) {
        $res = file_get_contents($_ENV["NODE"] . '?name=' . myUrlEncode($_POST["name"]));
        echo $res;
    } else {
        echo "something went wrong";
    }
    ?>
    <br>
    <a href="#" onClick="history.back(); return false;">back</a>
</body>

</html>