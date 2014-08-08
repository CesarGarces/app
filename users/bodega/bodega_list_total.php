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
require'../class/warehouse.php';
require'../class/materiales.php';

//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

//consultamos el listado de los usuarios!!
$objWa = new Warehouse();
$objMa = new Material();
$objUse = new Users();
$list_bodega = $objWa->list_bodega();
$img_users = $objUse->img_users();
$total = 0;
?>

<!DOCTYPE html>
<html lang="es">
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        
        <title>Consultas</title>
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
        <li><a href="material_list.php">Materiales</a></li>
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
            	<tr>
                  <th colspan="8" align="center">Valor Total de Productos En Bodega.</th></tr>
                <tr>
                  <td>Imagen</td>
                  <td>Codigo</td>
                  <td>Descripcion</td>
                  <td>Unidad</td>
                  <td>Cantidad</td>
                  <td colspan="2" align="center">Valor</td></tr>
                
            </thead>
            <tbody>
            
            	<?php
        	
				$numrows = mysql_num_rows($list_bodega);
				
				if($numrows > 0){
					
					while($row=mysql_fetch_array($list_bodega)){?>
                    
                    	<tr>
                            <td><img src= "<?php echo $row["imagen"];?>" class="img-rounded" width="75" height="50"></td>
                        	<td><?php echo $row["codigo"];?></td>
                            <td><?php echo $row["nombre"]; ?></td>
                            <td><?php echo $row["unidad"];?></td>
                            <?php
							if ($row["cantidad"] <= $row["minimo"]){
							?>
							<td class="danger"><?php echo $row["cantidad"];?></td>
                            <?php
							}else{
							?>
							<td><?php
							 echo $row["cantidad"];?></td>
                             <?php
							}
							?>
                            
                            
                            <td >$ <?php 
                            $result = $objMa->price_material($row['codigo']);
      			    $numrows = mysql_num_rows($result);
                             if($numrows > 0){
                                $precio_unitario = mysql_fetch_array($result);
                                $valor = intval($precio_unitario[0]) * intval($row['cantidad']);
                                echo $valor;
                                $total += $valor;					    
                                $valor = 0;                         
                             }

                            
                            
                            ?></td>
                        </tr>
                        
						<?php
					}
	
				?>
				<tr>
					<td colspan="4">
					</td>
					<td>Total:</td>
					<td>$ <?php echo $total; ?></td>
				
				</tr>
				<?php
				
           
					
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
    				console.log(search_string);
			    	$.ajax({	
			              type: "POST",
			              url: "bodega_list_ajax.php",
			              data: { 
			              	msg: search_string 
			              	},
			              dataType: 'json',	
			              cache: false,
			              success: function(data){			             
			                html = "<ul>";
			                //console.log(data);
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