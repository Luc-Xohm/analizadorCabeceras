<?php
    if(session_status()==PHP_SESSION_NONE){
    session_start();}//indico que voy a trabajar con sesiones
    
    //cargo la libreria de login/logout y consulto si hay errores
    include_once '../helpers/funciones.php';
    $outMesagge='';
    try {
        login();
    } catch (Exception $e) {
        if ($e->getMessage()=='Login incorrecto')
        {
            $outMesagge="Este usuario no está autorizado a entrar en esta página.";
        }else{
           $outMesagge="Se ha producido un error con la autentificación del usuario vuelva a probar.";
        }
    }
        
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Analizador Cabeceras</title> 
</head>
<body>
   <header >
   		<h1>Analizador de cabeceras de páginas web</h1>
    	<?php
    		if(empty($_SESSION['usuario'])){?>
        		<!--  FORMULARIO DE LOGIN -->
    	      	<form  action="" method="POST" action="<?php echo ($_SERVER['PHP_SELF']);?>" id="formularioLogin"  autocomplete="off">
                    <label for="inUsuario">Usuario:</label>
                    <input type="text" id="inUsuario" name="usuario" placeholder="usuario" size="10">
                    <label for="inPassword">Contraseña:</label>
                    <input type="password" id="inPassword" name="password" placeholder="contraseña" size="10">
                    <input type="submit" name="login" value="Login  ">
                </form>
            <?php }else{?>
                <!-- FORMULARIO DE LOGOUT -->
                <form action="<?php echo ($_SERVER['PHP_SELF'])?>" method="POST" id="formularioLogout"  autocomplete="off">
        				<label>Bienvenido <b> <?=$_SESSION['usuario']?></b></label>
        				<input type="submit" name="logout" value="logout">
        		</form>
    	<?php 
    		}
        echo $outMesagge;
    	?> 
    	
    	
    </header>
    <body>
    	<br>
    	 <?php if(isset($_SESSION['usuario']) && $_SESSION['usuario']=='admin'){?>
    	     <form action="<?php echo ($_SERVER['PHP_SELF'])?>" method="POST" id="formularioBusqueda"  autocomplete="off">
                <label for="inBusqueda" >Busqueda página web:</label>
                <input type="search" id="inBusqueda" name="url" placeholder="página web" size="35">
                <input type="submit" name="busquedaUrl" value="Buscar">
            </form>
         <?php }      
        
         visualizadorCabeceras();
         ?>
         
    </body>
   
    	
    	
    	
   
</body>
</html>
