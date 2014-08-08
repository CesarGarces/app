<?php

require'../class/sessions.php';
$objses = new Sessions();
$objses->init();

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null ;

if($user == ''){
	header('Location: ../index.php?error=2');
}

?>
<?php
//Llamado de los archivos clase
require'../class/config.php';
require'../class/users.php';
require'../class/dbactions.php';
require'../class/profiles.php';


//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();
$objUse = new Users();
$img_users = $objUse->img_users();
$objPro = new Profiles();

$idProf = $_GET['idPerfil'];

//Obtenemos el usuario a modificar
$single_pro = $objPro->single_profile($idProf);

//Obtenemos los perfiles existentes
$profiles = $objPro->show_profiles();

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Modulo de Usuarios!!</title>
    <link href="../../libs/css/bootstrap.min.css" rel="stylesheet">
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
          <img src="../global/img/livianos.jpg"  width="212" height="59">
        </div>
        
        <div class="navbar-collapse collapse">
          <span class="navbar-form navbar-right">
          
          </span>
          
            <div class="form-group">
              <h3>
                <p class="text-right"><?php
			  
        	
				$numrows = mysql_num_rows($img_users);
				
				if($numrows > 0){
					
					while($row=mysql_fetch_array($img_users)){?>
                    <img src = "<?php echo $row["imagen"];?>" class="img-circle" width="45" height="30">
					<?php }
				}
			   echo "Bienvenido, " . $_SESSION['user'];
			   			   			   			   
			   ?></p></h3>
            </div>
            <div class="form-group">
              
            </div>
         
        </div><!--/.navbar-collapse -->
      </div>
    </div>
    <div class="jumbotron">
    <div class="container">
        <p><?php require'../global/menu.php';?></p>
      </div>
        
        <form name="modUser" action="modify_profile_exe.php" method="post">
        <input type="hidden" name="idProf" value="<?php echo $idProf;?>" />
        <table align="center" border="1">
        
        
        	<tbody>
            	
                <?php
                
				$num_rows = mysql_num_rows($single_pro);
				
				if($num_rows > 0){
					
					if($row=mysql_fetch_array($single_pro)){ ?>
						
						<tr>
                        	<td><input type="text" name="code" value="<?php echo $row["codeProfi"];?>" maxlength="15" /></td>
                            <td><input type="text" name="name" value="<?php echo $row["nameProfi"];?>" maxlength="10" /></td>
                            <td><textarea name="desc" cols="10" rows="10"><?php echo $row["descProfi"];?></textarea></td>
                            <td><select name="status">
                            
                            		<option value="<?php echo $row["statusPro"];?>"><?php echo $row["statusPro"];?></option>
                                    <option value=""></option>
                                    <option value="Enabled">Enabled</option>
                                    <option value="Disabled">Disabled</option>
                                
                            	</select>
                            </td>
                            <tr><td colspan="5" align="center"><input type="submit" name="send" id="send" value="SEND" /></td></tr>
                        </tr>
                        
						<?php
					}
					
				}
				
				?>
            	
            </tbody>
        
        </table>
        </form>
        </div>
        </div>
        </div>
    <p>&copy; <a href="http://co.linkedin.com/in/cesargarces" target="_blank">Cesar Garces 2014</a></p>
      </footer>
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../libs/js/bootstrap.min.js"></script>
    </body>
</html>