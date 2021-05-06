<?php
ini_set('mysqlnd.net_read_timeout', 5);
try {
    $db = new PDO('mysql:host=' . $_ENV["DB"] . ';dbname=users', 'y0d3n', 'password');
    $sql = 'SELECT name,pass FROM user WHERE name LIKE  \'' . $_POST["user"] . '\';';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>sqli</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        table th,
        table td {
            padding: 10px 0;
            text-align: center;
        }

        table tr:nth-child(odd) {
            background-color: #eee
        }
    </style>
</head>

<body>
    <form method="POST">
        <select name="user">
            <option value="admin">admin</option>
            <option value="root">root</option>
            <option value="user1">user1</option>
        </select>
        <input type="submit" value="Enter">
    </form>
    <hr>
    <table border=1>
        <th>name</th>
        <th>pass</th>
        <?
            foreach( $result as $value ) {
                echo "<tr><td>$value[name] </td><td>$value[pass]</tt></tr>";
	        }
        ?>
    </table>
</body>

</html>