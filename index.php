<?php
    $username = 'root';
    $password = '';
 
    if(!empty($_POST['email'])){
        //var_dump("SELECT * FROM pessoa WHERE email = '{$_POST['email']}' AND password = '{$_POST['password']}'");
        try {
            $conn = new PDO('mysql:host=localhost;dbname=sql_injection', $username, $password);
            $stmt = $conn->query("SELECT * FROM users WHERE email = '{$_POST['email']}' AND password = '{$_POST['password']}'");
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            var_dump($row);
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sql injection example</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST">
        <input type="text" name="email"/>
        <input type="password" name="password" />

        <button type="submit">Entrar</button>
    </form>
</body>
</html>