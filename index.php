<?php
    session_start();
    $username = 'root';
    $password = '';
 
    if(!empty($_POST['email'])){
        //var_dump("SELECT * FROM pessoa WHERE email = '{$_POST['email']}' AND password = '{$_POST['password']}'");
        try {
            $conn = new PDO('mysql:host=localhost;dbname=sql_injection', $username, $password);
            $stmt = $conn->query("SELECT * FROM users WHERE email = '{$_POST['email']}' AND password = '{$_POST['password']}'");
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user'] = $row; 
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
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php if(isset($row) and $row == false) :?>
        <div class="error-message">
             <h1 class="colored">Credenciais incorretas!</h1>
        </div>
    <?php endif; ?>

    <?php if( $_SESSION['user'] != null) :?>
        <div class="success-message">
             <h1 class="colorgreen">Você está logado!</h1>
        </div>
        <form  method="POST" action="logout.php">
            <button type="submit"> Sair</button>
        </form>
    <?php else: ?>   
    <h1>Login</h1>
    <form method="POST">
        <input type="text" name="email"/>
        <input type="password" name="password" />

        <button type="submit">Entrar</button>
    </form>
    <?php endif; ?>  
</body>
</html>