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
require'../class/entradas.php';


//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

//consultamos el listado de los usuarios!!
$objMa = new Entrada();
$objUse = new Users();
$list_entrada = $objMa->list_entrada();
$img_users = $objUse->img_users();

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Lista de Orden entradas</title>
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
            	  
                <tr>
                  <th colspan="15" align="center">Devolucion segun obra.</th></tr>
                  
                  <form action="entrada_devolucion.php" method="post">
                  <tr>
                  <th colspan="6" align="center">Insumo: 
                    <input type="text" id="buscar" autofocus name="insumo" />&nbsp;<div id="resultados_ajax"></div></th>
                    <th colspan="9" align="center">Obra: 
                      <input type="text" id="buscar2" name="obra" />&nbsp;
                      <input type="submit" value="Filtrar" /><div id="resultados_ajax2"></div></th></tr></form>
                <tr>
                  <td>Orden</td>
                  <td>Proveedor</td>
                  <td>Codigo Prov</td>
                  <td>Obra</td>
                  <td>Cod Obra</td>
                  <td>Factura N.</td>
                  <td>Fecha</td>
                  <td>Codigo Material</td>
                  <td>Descripcion</td>
                  <td>Unidad</td>
                  <td>Valor</td>     
                  <td>Cant Mat</td>
                  <td>Total</td>
                  <td>Tipo</td> 
                             
                  </tr>
                
            </thead>
            <tbody>
            
            	<?php
            		if(isset($_POST['insumo']) && isset($_POST['obra'])){
            			
            					$insumo = $_POST['insumo'];
            					$obra = $_POST['obra'];
					          		
		            	$list_entrada_devolucion = $objMa->list_entrada_devolucion($insumo,$obra);        	
						$numrows = mysql_num_rows($list_entrada_devolucion);
				
				if($numrows > 0){
					
					while($row=mysql_fetch_array($list_entrada_devolucion)){?>
		                    
		                    	<tr>
                            <td><?php echo $row["codentr"];?></td>
                            <td><?php echo $row["prov"];?></td>
                        	<td><?php echo $row["codprov"];?></td>
                            <td><?php echo $row["obra"]; ?></td>
                            <td><?php echo $row["codobra"];?></td>
                            <td><?php echo $row["nfac"];?></td>
                            <td><?php echo $row["fecha"];?></td>
                            <td><?php echo $row["codmat"];?></td>
                            <td><?php echo $row["descrip"];?></td>
                            <td><?php echo $row["unidad"];?></td>
                            <td>$<?php echo $row["valor"];?></td>
                            <td><?php echo $row["cantmat"];?></td>
                            <td>$<?php echo $row["total"];?></td>
                            <td><?php 
							
							
							$tipo = $row["tipo_entrada"];
							
							if ($tipo == 0){
							echo "Compra";
							}else{
								echo "Devolucion";
							}
							
							
							?></td>
                            
                            
							
                        </tr>
		                        
								<?php
							}
							
						}
            		
            		
            		
            		
            		} //fin if isset
			
			
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
					
					
					
					
		function insertarCodigoObra(nombre){
				
				$.ajax({	
				              type: "POST",
				              url: "obra_codigo_ajax.php",
				              data: { 
				              	msg:nombre
				              	},
				              dataType: 'json',	
				              cache: false,
				              success: function(data){
				              console.log("data es igual a: "+data);
				              $("#obra").val(data);
				              
			              	},
						error:function(){
				              $("#obra").val("error!");
				             
			              	}
			              	
			        });
			        
		
		}					
		function insertarCodigo(nombre){
				
				$.ajax({	
				              type: "POST",
				              url: "material_codigo_ajax.php",
				              data: { 
				              	msg:nombre
				              	},
				              dataType: 'json',	
				              cache: false,
				              success: function(data){
				              console.log("data es igual a: "+data);
				              $("#codigo").val(data);
				              
			              	},
						error:function(){
				              $("#codigo").val("error!");
				             
			              	}
			              	
			        });
			        
		
		}		
		function insertarValor(nombre){
				
				$.ajax({	
				              type: "POST",
				              url: "material_valor_ajax.php",
				              data: { 
				              	msv:nombre
				              	},
				              dataType: 'json',	
				              cache: false,
				              success: function(data){
				              console.log("data es igual a: "+data);
				              $("#valor").val(data);
				              
			              	},
						error:function(){
				              $("#valor").val("error!");
				             
			              	}
			              	
			        });	        
		
		}
		function insertarUnidad(nombre){
				
				$.ajax({	
				              type: "POST",
				              url: "material_unidad_ajax.php",
				              data: { 
				              	msv:nombre
				              	},
				              dataType: 'json',	
				              cache: false,
				              success: function(data){
				              console.log("data es igual a: "+data);
				              $("#unidad").val(data);
				              
			              	},
						error:function(){
				              $("#unidad").val("error!");
				             
			              	}
			              	
			        });	        
		
		}	
			
        </script>
    <script src="../../libs/js/bootstrap.min.js"></script>
    </body>
</html>