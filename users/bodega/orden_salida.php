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
require'../class/prov.php';
require'../class/materiales.php';
require'../class/obra.php';
require'../class/salidas.php';
require'../class/warehouse.php';
//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

//consultamos el listado de los usuarios!!
$objUse = new Users();
$img_users = $objUse->img_users();
$objPr = new Prov();
$list_prov = $objPr->list_prov();
$objOb = new Obra();
$list_obra = $objOb->list_obra();
$objMt = new Material();
$list_material = $objMt->list_material();
$objMa = new Salida();
$list_salida_ultimo = $objMa->list_salida_ultimo();
$objLa = new Warehouse();
$list_bodega = $objLa->list_bodega();
$contador = "<script> document.write(num) </script>";
?>
<!DOCTYPE html>

<html lang="esp">

    <head>
    <meta charset="utf-8" />
            <title>Nueva Orden Salida</title>
             <link href="../../libs/css/bootstrap.min.css" rel="stylesheet">
             <link href="../../libs/css/custom.css" rel="stylesheet">
             <link rel="icon" type="image/x-icon" href="../../favicon.ico">
             <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
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
          <img src="../global/img/livianos.jpg" width="212" height="59">
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
                    <img src= "<?php echo $row["imagen"];?>" class="img-circle" width="45" height="30">
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
        
    <div class="container">
       <div class="table-responsive"> 
       	
       <form id="datos" name="salida" action="salidas_resp.php" method="post">
        <table align="center" class="table table-striped" border="1">
        	
            <thead>
            	
                      <th colspan="12" align="center">Orden de Salida</th>
                <tr>
                  <td>Orden N</td>
                  <td>Nombre de Obra</td>
                  <td>Codigo de Obra</td>
                  <td>Despacho N</td>
                  <td colspan="2">Fecha</td></tr>
                  
                
            </thead>
            <tbody>
            
      <tr>
      <?php
        	
				$numrows = mysql_num_rows($list_salida_ultimo);
				
				if($numrows > 0){
					
					while($row=mysql_fetch_array($list_salida_ultimo)){?>
                            <td><input type="text" name="orden" autocomplete="off" value="<?php  $dato = $row["orden"] + 1; echo $dato; ?>"/></td>
                            <?php
					}
					
					
				}else{?>
                <td><input type="text" name="orden" autocomplete="off" value="1"/></td>
                <?php
					
				}
			
				?>
                                            
                            <td><input type="text" id="buscar2" name="obra" autocomplete="off"/><div id="resultados_ajax2"></div></td>
                            <td><input type="text" id="obra" name="codobra" autocomplete="off"/></td>
                            <td><input type="text" name="despacho" autocomplete="off"/></td>
                            <td colspan="2"><input type="text" id="datepicker" name="fecha" placeholder="AAAA/MM/DD" autocomplete="off"/> </td>
                            </tr>
              <tr>
                              <th colspan="11" align="center"><p>&nbsp;</p>
              <p>Material</p></th></tr>
                <tr>
                 
                  <td>Codigo</td>
                  <td>Descripcion</td>
                  <td>Unidad</td>
                  <td>Valor</td>                 
                  <td>Cantidad</td>
                  <td>Compra</td></tr>
                  
                  <tr>

                            
                            	
                            		<td><input type="text" id="codigo" name="codigo" autocomplete="off" /></td>
                            
		                            <td><input type="text" id="buscar" name="nombre"  autocomplete="off"/>
		                            <div id="resultados_ajax"></div></td>
		                            <td><input type="text" id="unidad" name="unidad" autocomplete="off" /></td>
		                            <td><input type="text" id="valor" name="valor"  autocomplete="off" /></td>
		                            <td><input type="text" id="cantidad" name="cantidad" autocomplete="off" /></td>
		                            <td><input type="text"  name="compra" autocomplete="off" /></td>

								<tr>
		                            <td><input type="text" id="codigo0" name="codigo0" autocomplete="off" /></td>
                            
		                            <td><input type="text" id="buscar0" name="nombre0"  autocomplete="off"/>
		                            <div id="resultados_ajax0"></div></td>
		                            <td><input type="text" id="unidad0" name="unidad0" autocomplete="off" /></td>
		                            <td><input type="text" id="valor0" name="valor0"  autocomplete="off" /></td>
		                            <td><input type="text" id="cantidad0" name="cantidad0" autocomplete="off" /></td>
		                            <td><input type="text"  name="compra0" autocomplete="off" /></td>
		                        </tr>
		         </tr>
                            
                 
                            
          
              <tr><td colspan="10"  align="center">             	
              	<input type="button" id="agrega" value="+" />
              	<input type="submit" name="send" id="send" value="SEND" /></td></tr>
				
            
            </tbody>
        
        </table>
        </form>
    
      </div>
      </div>
    </div>                 
        </div>
        <footer>
        <p>&copy; Cesar Garces 2014</p>
      </footer>
        <script src="https://code.jquery.com/jquery.js"></script>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>

        <script type="text/javascript">
        
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
 		$(document).on('mouseover',"#resultados_ajax0 li",function(e){
 		
			var selected = $(".selected0");
			selected.removeClass('selected0');
			$(this).addClass('selected0');
			return false;
 		});


 		$(document).on('click',"#resultados_ajax li ",function(e){
 		
 	 		 $("#buscar").val($(this).children('a').html());
 	 		 $("#resultados_ajax").html("");
			 $("#resultados_ajax").css("display","none");
			 insertarCodigo($(this).children('a').html());
			 insertarValor($(this).children('a').html());
			 insertarUnidad($(this).children('a').html());
			 insertarCantidad($(this).children('a').html());
 	 		 return false;
 		});
 		$(document).on('click',"#resultados_ajax2 li ",function(e){
 		
 	 		 $("#buscar2").val($(this).children('a').html());
 	 		 $("#resultados_ajax2").html("");
			 $("#resultados_ajax2").css("display","none");
			 insertarCodigoObra($(this).children('a').html());
 	 		 return false;
 		});
 		$(document).on('click',"#resultados_ajax0 li ",function(e){
 		
 	 		 $("#buscar0").val($(this).children('a').html());
 	 		 $("#resultados_ajax0").html("");
			 $("#resultados_ajax0").css("display","none");
			 insertarCodigo0($(this).children('a').html());
			 insertarValor0($(this).children('a').html());
			 insertarUnidad0($(this).children('a').html());
			 insertarCantidad0($(this).children('a').html());
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
    		$("#buscar0").on('keyup', desplegarajax0);
    		$("#buscar0").on('focus', desplegarajax0);
    		
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
    	    function desplegarajax0(e){
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
					$("#resultados_ajax0").html(html);
					$("#resultados_ajax0").css("display","block");	
					$("#buscar0").off('keydown.flechas');
					$("#buscar0").on('keydown.flechas', moverflechas );	
					
			              },
			              error: function(data){			             
			                $("#resultados_ajax0").html("");			
			                $("#resultados_ajax0").css("display","none");
			                $("#buscar0").off('keydown.flechas');
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
							  insertarCodigo(selected.html());
						      insertarValor(selected.html());
							  insertarUnidad(selected.html());
							  insertarCantidad(selected.html());
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
		function moverflechas0(e){
						//console.log(e.which);
						if (e.keyCode == 39) { // derecha
						      var selected = $(".selected0 a");
						      $("#buscar0").val(selected0.html());
							  insertarCodigo0(selected0.html());
						      insertarValor0(selected0.html());
							  insertarUnidad0(selected0.html());
							  insertarCantidad0(selected0.html());
						      $("#resultados_ajax0").html("");
						      $("#resultados_ajax0").css("display","none");
						      return false;
						        
						    }
						if(e.keyCode == 38){
							var selected0 = $(".selected0");
						        $("#resultados_ajax0 ul li").removeClass("selected0");
						        if (selected0.prev().length == 0) {
						            selected0.siblings().last().addClass("selected0");

						        } else {
						            selected0.prev().addClass("selected0");
						        }	
						        return false;					
						}
						
						if(e.keyCode == 40){
							var selected0 = $(".selected0");
						        $("#resultados_ajax0 ul li").removeClass("selected0");
						        if (selected0.next().length == 0) {
						            selected0.siblings().first().addClass("selected0");
						        } else {
						            selected0.next().addClass("selected0");
						    
						      	}
						      	return false;					
						}
					}			
		function moverflechas2(e){
						//console.log(e.which);
						if (e.keyCode == 39) { // derecha
						      var selected2 = $(".selected2 a");
						      $("#buscar2").val(selected2.html());
							  insertarCodigoObra(selected2.html());
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
		function insertarCodigo0(nombre){
				
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
				              $("#codigo0").val(data);
				              
			              	},
						error:function(){
				              $("#codigo0").val("error!");
				             
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
		function insertarValor0(nombre){
				
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
				              $("#valor0").val(data);
				              
			              	},
						error:function(){
				              $("#valor0").val("error!");
				             
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
		function insertarUnidad0(nombre){
				
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
				              $("#unidad0").val(data);
				              
			              	},
						error:function(){
				              $("#unidad0").val("error!");
				             
			              	}
			              	
			        });	        
		
		}	
		function insertarCantidad(nombre){
				
				$.ajax({	
				              type: "POST",
				              url: "material_cantidad_ajax.php",
				              data: { 
				              	msv:nombre
				              	},
				              dataType: 'json',	
				              cache: false,
				              success: function(data){
				              console.log("data es igual a: "+data);
				              $("#cantidad").val(data);
				              
			              	},
						error:function(){
				              $("#cantidad").val("error!");
				             
			              	}
			              	
			        });	        
		
		}
		function insertarCantidad0(nombre){
				
				$.ajax({	
				              type: "POST",
				              url: "material_cantidad_ajax.php",
				              data: { 
				              	msv:nombre
				              	},
				              dataType: 'json',	
				              cache: false,
				              success: function(data){
				              console.log("data es igual a: "+data);
				              $("#cantidad0").val(data);
				              
			              	},
						error:function(){
				              $("#cantidad0").val("error!");
				             
			              	}
			              	
			        });	        
		
		}
			
        </script>
        <script>
$( "#datepicker" ).datepicker({ dateFormat: "yy/mm/dd" });
</script>
    <script src="../../libs/js/bootstrap.min.js"></script>
    </body>
</html>