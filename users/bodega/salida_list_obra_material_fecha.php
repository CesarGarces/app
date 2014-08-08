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
$salidas_total = 0;
if(isset($_POST['obra'])){

	$result = $objObra->busqueda_obra($_POST['obra']);
	
	if(mysql_num_rows($result)!= 0){
		$obra = mysql_fetch_assoc($result);
		var_dump($obra['codigo']);
		
		if(isset($_POST['material'])){
		
		
			
			$result = $objMa->busqueda_material($_POST['material']);
			if(mysql_num_rows($result)!= 0){
					
				if(isset($_POST['fecha_inicio']) && isset($_POST['fecha_fin'])){
					$fecha_inicio = $_POST['fecha_inicio'];
					$fecha_fin = $_POST['fecha_fin'];
					$material = mysql_fetch_assoc($result);
					var_dump($material['codigo']);
					$result = $objSal->list_salidas_obra_material_fecha($obra['codigo'],$fecha_inicio,$fecha_fin,$material['codigo']);
				
					if(mysql_num_rows($result)!= 0){
						
						
						
						while(($salidas[] = mysql_fetch_assoc($result))||array_pop($salidas));
							
						
						
						
						
						
						
						
						//$materiales
					
				
					}else{
						$mensaje = "no hay salidas del material asociadas a la obra";					

					} //fin salidas
				}else{
					$mensaje = "debe seleccionar ambas fechas";					

				} //fin fechas
	
			}else{
			
				$mensaje = "no se encontró ningún material con el nombre ".$_POST['material'];
				
				} //fin material	
		} //fin post material
	}else{
		$mensaje = "no se encontró ninguna obra con el nombre ".$_POST['obra'];
	} //fin obra

} //fin post obra
					/*echo "<br />";
					echo "<pre>";
					var_dump($_POST);
					var_dump($material['codigo']);
					var_dump($obra['codigo']);
					echo "<h1>SALIDAS </h1>";
					
					var_dump($salidas);
					
					echo "</pre>";
					exit(0);*/
?>

<!DOCTYPE html>
<html lang="es">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
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
            	
                  <th colspan="11" align="center">Salidas para un material según obra 
                  <?php if(isset($_POST['obra'])){
                  	echo ": ".$_POST['obra'];
                  } ?>
                  </th></tr>
                  <form action="salida_list_obra_material_fecha.php" method="post">
                  <tr>
                  <th colspan="4" align="center">Ingrese la obra: 
                    <div >
                    <input id="buscar" type="text" autofocus name="obra" autocomplete="off"/>
                            <div id="resultados_ajax">
	                      
	                      
	                    </div>
                    </div>
                    </th>
                  <th colspan="4" align="center">Ingrese el material: 
                    <div >
                    <input id="buscar2" type="text"  name="material" autocomplete="off"/>
                            <div id="resultados_ajax2">
	                      
	                      
	                    </div>
                    </div >
                    </th>
                    </tr>
                    <tr>
                  <th colspan="4" align="center">Desde Fecha: 
                    <div >
                    <input id="datepicker" type="text" autofocus name="fecha_inicio" autocomplete="off"/>
                            <div id="resultados_ajax">
	                      
	                      
	                    </div>
                    </div>
                    </th>
                  <th colspan="4" align="center">Hasta Fecha: 
                    <div >
                    <input id="datepicker2" type="text"  name="fecha_fin" autocomplete="off"/>&nbsp;<input type="submit" value="Buscar" />
                            <div id="resultados_ajax2">
	                      
	                      
	                    </div>
                    </div >
                    </th>
                    </tr>
                  
                    </form>
	      
                <tr>
                  
                  <td>Orden N</td>
                  <td>Despacho N</td>
                  <td>Fecha</td>
                  <td>Codigo Material</td>
                  <td>Descripcion</td>
                  <td>Valor</td>     
                  <td>Cant Mat</td>
                  <td>Total</td> 
                 
                 </tr>           
                  
                
            </thead>
            <tbody>
            
            	<?php
            		if(isset($mensaje)){
            		echo '<p class="alert-danger">'.$mensaje.'</p>';	
        		}
            		if(isset($salidas)){	
        			foreach($salidas as $salida){
				?>
                    
                    	<tr>
                            <td><?php echo $salida["orden"];?></td>                        	
                            <td><?php echo $salida["despacho"];?></td>
                            <td><?php echo $salida["fecha"];?></td>
                            <td><?php echo $salida["codmat"];?></td>
                            <td><?php echo $salida["descripcion"];?></td>
                            <td>$<?php echo $salida["valor"];?></td>
                            <td><?php echo $salida["cantmat"];?></td>
                            <td>$<?php
                            		$salidas_total += $salida["total"];
		                        echo $salida["total"];             
                             ?></td>
                            
                        </tr>
                        
						<?php
				} //fin de foreach
				?>
				<tr>
					<td colspan="6"></td>
					<td>TOTAL:</td>
					<td>$<?php echo $salidas_total;?></td>
				</tr>
			<?php
			}// fin salidas
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
 		$(document).on('mouseover',"#resultados_ajax2 li",function(e){
 		
			var selected = $(".selected2");
			selected.removeClass('selected2');
			$(this).addClass('selected2');
			return false;
 		});
 		$(document).on('click',"#resultados_ajax li ",function(e){
 		
 	 		 $("#buscar").val($(this).children('a').html());
 	 		 $("#resultados_ajax").html("");
			 $("#resultados_ajax").css("display","none");
 	 		 return false;
 		});
 		$(document).on('click',"#resultados_ajax2 li ",function(e){
 		
 	 		 $("#buscar2").val($(this).children('a').html());
 	 		 $("#resultados_ajax2").html("");
			 $("#resultados_ajax2").css("display","none");
 	 		 return false;
 		});
 		/*
 		$("#buscar").on('blur', function(){
    		       $("#resultados_ajax").css("display","none");
    		});	
    		$("#buscar2").on('blur', function(){
    		       $("#resultados_ajax2").css("display","none");
    		});
    		*/
    		$("#buscar").on('keyup', desplegarajax);
    		$("#buscar").on('focus', desplegarajax);
    		$("#buscar2").on('keyup', desplegarajax2);
    		$("#buscar2").on('focus', desplegarajax2);
    		
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
	   			           	html += '<li class="selected"><a href="javascript:void(0)">'+data[i]+'</a></li>';	
	   			           }else{
	   			           
	   			           	html += '<li><a href="javascript:void(0)">'+data[i]+'</a></li>';
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
    	    function desplegarajax2(e){
    	        if( e.keyCode == 38 ){
    	        	return false;
    	        }
    	        if( e.keyCode == 40 ){
    	        	return false;
    	        }
    	    	search_string = $(this).val();
    	
			    	$.ajax({	
			              type: "POST",
			              url: "material_list_ajax.php",
			              data: { 
			              	msg: search_string 
			              	},
			              dataType: 'json',	
			              cache: false,
			              success: function(data){			             
			                html = "<ul>"
			                for (i = 0; i < data.length; ++i) {
	   			            if(i == 0){
	   			           	html += '<li class="selected2"><a href="javascript:void(0)">'+data[i]+'</a></li>';	
	   			           }else{
	   			           
	   			           	html += '<li><a href="javascript:void(0)">'+data[i]+'</a></li>';
	   			           }
	   			           
    					   
					}
					html += "</ul>";
					$("#resultados_ajax2").html(html);
					$("#resultados_ajax2").css("display","block");	
					$("#buscar2").off('keydown.flechas');
					$("#buscar2").on('keydown.flechas', moverflechas2 );	
					
			              },
			              error: function(data){			             
			                $("#resultados_ajax2").html("");			
			                $("#resultados_ajax2").css("display","none");
			                $("#buscar2").off('keydown.flechas');
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
		function moverflechas2(e){
						//console.log(e.which);
						if (e.keyCode == 39) { // derecha
						      var selected2 = $(".selected2 a");
						      $("#buscar2").val(selected2.html());
						      $("#resultados_ajax2").html("");
						      $("#resultados_ajax2").css("display","none");
						      return false;
						        
						    }
						if(e.keyCode == 38){
							var selected2 = $(".selected2");
						        $("#resultados_ajax2 ul li").removeClass("selected2");
						        if (selected2.prev().length == 0) {
						            selected2.siblings().last().addClass("selected2");

						        } else {
						            selected2.prev().addClass("selected2");
						        }	
						        return false;					
						}
						
						if(e.keyCode == 40){
							var selected2 = $(".selected2");
						        $("#resultados_ajax2 ul li").removeClass("selected2");
						        if (selected2.next().length == 0) {
						            selected2.siblings().first().addClass("selected2");
						        } else {
						            selected2.next().addClass("selected2");
						    
						      	}
						      	return false;					
						}
					}
        </script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../libs/js/bootstrap.min.js"></script>
    </body>
</html>