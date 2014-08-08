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
require'../class/materiales.php';
require'../class/salidas.php';
require'../class/obra.php';

//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

//consultamos el listado de los usuarios!!
$objMa = new Material();
$objSal = new Salida();
$objUse = new Users();
$objObra = new Obra();

$img_users = $objUse->img_users();

if(isset($_POST['obra'])){

	$result = $objObra->busqueda_obra($_POST['obra']);
	
	if(mysql_num_rows($result)!= 0){
	
		$obra = mysql_fetch_assoc($result);
		var_dump($obra['codigo']);
		
		$result = $objSal->list_salidas_obra($obra['codigo']);
	
		if(mysql_num_rows($result)!= 0){
			
			var_dump($result);
			
			while(($salidas[] = mysql_fetch_assoc($result))||array_pop($salidas));
				$contador = 0;		
				 foreach( $salidas as $salida){
				 
				 	$cod_materiales[] = $materiales_temp[$contador]['codigo'] = $salida['codmat'];
				 	$materiales_temp[$contador]['cantidad'] = $salida['cantmat'];
				 	$contador++;
				 }
				 $cod_materiales = array_unique($cod_materiales);
			
				foreach($cod_materiales as $cod_material){
				
					$materiales[$cod_material]['total'] = 0;
					
					$result = $objMa->single_material_cod($cod_material);
					$materiales[$cod_material]['datos'] = mysql_fetch_assoc($result);
								
					foreach($materiales_temp as $material_temp){
							
						if($cod_material == $material_temp['codigo']){
						
							$materiales[$cod_material]['total'] += intval($material_temp['cantidad']);	
						
						}
					  
					
					
					}
							
				}
			/*
			echo "<br />";
			echo "<pre>";
			
			var_dump($salidas);
			var_dump($cod_materiales);
			var_dump($materiales_temp);
			echo "<h1>MATERIALES </h1>";
			var_dump($materiales);
			echo "</pre>";
			exit(0);
			*/
			
			
			
			
			//$materiales
		
	
		}else{
			$mensaje = "no hay salidas para mostrar asociadas a la obra";
		
		} //fin salidas
		

	}else{
		$mensaje = "no se encontró ninguna obra con el nombre ".$_POST['obra'];
	} //fin obra

} //fin post

?>

<!DOCTYPE html>
<html lang="es">
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        
        <title>Consulta</title>
        <link href="../../libs/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../libs/css/custom.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="../../favicon.ico">
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
    <p></p>
         <ul class="nav nav-tabs">
        <li><a href="index.php">Inicio</a></li>
        <li ><a href="material_list.php">Materiales</a></li>
        <li><a href="obra_list.php">Obras</a></li>
        <li><a href="prov_list.php">Proveedores</a></li>
		<li><a href="bodega_list.php">Inventario en bodega</a></li>
		<li><a href="salida_list.php">Orden de salida</a></li>
        <li><a href="entrada_list.php">Orden de entrada</a></li>
        <li class="active"><a href="consultas.php">Consultas</a></li>
        <li><a href="log_out.php">Salir</a></li>
        </ul>
      </div>
        
    <div class="container">
       <div class="table-responsive"> 
        <table align="center" class="table table-striped" border="1">
        	
            <thead>
            	
                  <th colspan="11" align="center">Cantidad de material total según obra</th></tr>
                  <form action="material_total_obra.php" method="post">
                  <tr>
                  <th colspan="15" align="center">Ingrese la obra: 
                    <div >
                    <input id="buscar" type="text" autofocus name="obra" autocomplete="off"/>&nbsp;<input type="submit" value="Buscar" />
                            <div id="resultados_ajax">
	                      
	                      
	                    </div>
                    </div>
                    </th></tr></form>
	      
                <tr>
                  <td>Imagen</td>
                  <td>Codigo</td>
                  <td>Descripcion</td>
                  <td>Unidad</td>
                  <td>Total</td>
                  
                
            </thead>
            <tbody>
            
            	<?php
            		if(isset($mensaje)){
            		echo '<p class="alert-danger">'.$mensaje.'</p>';	
        		}
            		if(isset($materiales)){	
        			foreach($materiales as $material){
				?>
                    
                    	<tr>
                            <td><img src= "<?php echo $material['datos']["imagen"];?>" class="img-rounded" width="75" height="50"></td>
                        	<td><?php echo $material['datos']["codigo"];?></td>
                            <td><?php echo $material['datos']["descripcion"]; ?></td>
                            <td><?php echo $material['datos']["unidad"];?></td>
                            <td><?php echo $material['total'];?></td>
                            
                        </tr>
                        
						<?php
				}
			}
				?>
            
            </tbody>
        
        </table>
      </div>
      </div>
    </div>                 
        </div>
        <footer>
        <p>&copy; Cesar Garces 2014</p>
      </footer>
        <script src="https://code.jquery.com/jquery.js"></script>
        <script>
        
        $( document ).ready(function() {
        	
 		$(document).on('mouseover',"#resultados_ajax li",function(e){
 		
			var selected = $(".selected");
			selected.removeClass('selected');
			$(this).addClass('selected');
			return false;
 		});
 		$(document).on('click',"#resultados_ajax li ",function(e){
 		
 	 		 $("#buscar").val($(this).children('a').html());
 	 		 $("#resultados_ajax").html("");
			 $("#resultados_ajax").css("display","none");
 	 		 return false;
 		});
 		
 		$("#buscar").parent().on('blur', function(){
    		       $("#resultados_ajax").css("display","none");
    		});	
    		
    		$("#buscar").on('keyup', desplegarajax);
    		$("#buscar").on('focus', desplegarajax);
		//$("#buscar").on('keydown', function(e){console.log(e.keyCode)});
    	    
    	    
    		
	});//fin document ready
	
	//funciones
	
	function desplegarajax(e){
    	        if( e.keyCode == 38 ){
    	        	return false;
    	        }
    	        if( e.keyCode == 40 ){
    	        	return false;
    	        }
    	    	search_string = $(this).val();
    	
			    	$.ajax({	
			              type: "POST",
			              url: "obra_list_ajax.php",
			              data: { 
			              	msg: search_string 
			              	},
			              dataType: 'json',	
			              cache: false,
			              success: function(data){			             
			                html = "<ul>"
			                for (i = 0; i < data.length; ++i) {
	   			            if(i == 0){
	   			           	html += '<li class="selected"><a href="javascript:void(0)">'+data[i]+'</li>';	
	   			           }else{
	   			           
	   			           	html += '<li><a href="javascript:void(0)">'+data[i]+'</li>';
	   			           }
	   			           
    					   
					}
					html += "</ul>";
					$("#resultados_ajax").html(html);
					$("#resultados_ajax").css("display","block");	
					$("#buscar").off('keydown.flechas');
					$("#buscar").on('keydown.flechas', moverflechas );	
					
			              },
			              error: function(data){			             
			                $("#resultados_ajax").html("");			
			                $("#resultados_ajax").css("display","none");
			                $("#buscar").off('keydown.flechas');
			              }
			        	
			            });	
    	    
    	    
    	    }
    	    function moverflechas(e){
						//console.log(e.which);
						if (e.keyCode == 39) { // derecha
						      var selected = $(".selected a");
						      $("#buscar").val(selected.html());
						      $("#resultados_ajax").html("");
						      $("#resultados_ajax").css("display","none");
						      return false;
						        
						    }
						if(e.keyCode == 38){
							var selected = $(".selected");
						        $("#resultados_ajax ul li").removeClass("selected");
						        if (selected.prev().length == 0) {
						            selected.siblings().last().addClass("selected");

						        } else {
						            selected.prev().addClass("selected");
						        }	
						        return false;					
						}
						
						if(e.keyCode == 40){
							var selected = $(".selected");
						        $("#resultados_ajax ul li").removeClass("selected");
						        if (selected.next().length == 0) {
						            selected.siblings().first().addClass("selected");
						        } else {
						            selected.next().addClass("selected");
						    
						      	}
						      	return false;					
						}
					}
        </script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../libs/js/bootstrap.min.js"></script>
    </body>
</html>