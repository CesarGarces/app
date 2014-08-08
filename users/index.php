<?php
// Evitar los warnings the variables no definidas!!!
$err = isset($_GET['error']) ? $_GET['error'] : null ;

?>

<!DOCTYPE html>

<html lang="esp">

	<head>
    	<meta charset="utf-8" />
    	<title>Session Form</title>
        <!--diseño-->
        <link href="../libs/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="../favicon.ico">
    </head>
    
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation"><!--barra superior-->
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <img src="global/img/livianos.jpg" width="212" height="63">
        </div>
        <div class="navbar-collapse collapse">
          <span class="navbar-form navbar-right">
          
          </span>
          <form class="navbar-form navbar-right" role="form" action="session_init.php" method="post">
            <div class="form-group">
              <input type="text" name="usern" id="usern" placeholder="Nombre" maxlength="15" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" name="passwd" id="passwd" maxlength="10" placeholder="password" class="form-control">
              <input type="submit" name="enter2" class="btn btn-success" id="enter" value="Enter">
            
            </button>
            </div>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
    <p></p>
    <p></p>
   <div class="jumbotron">
   <div class="container">
    	
        	<p class="alert-danger"><?php if($err==1){
				echo "Usuario o Contraseña Erróneos <br />";
			}
			if($err==2){
				echo "Debe iniciar sesion para poder acceder el sitio. <br />";
			}
			?></p>
            <div class="row">
  <div class="col-md-12"><h2><font color="#000000">Bienvenido </font><small><font color="#000000">LIVIANOS APP</font></small></h2></div>
   <div class="col-md-12"><h3><font color="#000000">Por favor ingresar sus datos</font></h3></div>
</div>
   </div>
    </div>
        <footer>
        <p>&copy; <a href="http://co.linkedin.com/in/cesargarces" target="_blank">Cesar Garces 2014</a></p>
      </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../libs/js/bootstrap.min.js"></script>
    </body>
    
</html>