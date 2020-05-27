<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Login Screen">
        <meta name="author" content="Lex Software Mexico">

        <link href="production/components/css/login/styles.css" rel="stylesheet">
        
        
        <title> Login </title>
        <!--Links-->        
    </head>
    
    <body>
        <div class="login-box">
            <img src="production/components/css/login/user.png" class="avatar">
            <h1> Bienvenido </h1>
            <form method="post" action="production/core/login/actions/validate.php">
                    <p> Nombre de Usuario </p>
                    <input type="text" id="Username_Login" name="Username_Login" placeholder="Usuario" required>
                    
                    <p> Contraseña de Usuario </p>
                    <input type="password" id="Password_Login" name="Password_Login"  placeholder="Contraseña" required>
                    <input type="submit" name="submit" value="Login">
                </form>
        </div>    
    </body>
</html>