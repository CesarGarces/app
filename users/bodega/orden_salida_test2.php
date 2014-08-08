<script type="text/javascript">
<!--
num=0;
function crear(obj) {
  num++;
  fi = document.getElementById('fiel'); // 1
  contenedor = document.createElement('tr'); // 2
  contenedor.id = 'div'+num; // 3
  fi.appendChild(contenedor); // 4

  
 
  ele = document.createElement('input'); // 5
  ele.type = 'text'; // 6
  ele.name = 'codigo'+num;
  ele.id = 'codigo'+num; // 6
  ele.autocomplete = "off";
  contenedor.appendChild(ele);

 //   fi2 = document.getElementById('fiel'); // 1
 // contenedor = document.createElement('div'); // 2
 // contenedor.id = 'resultados_ajax'+num; // 3
 // fi2.appendChild(contenedor); // 4

  
  ele = document.createElement('input'); // 5
  ele.type = 'text'; // 6
  ele.name = 'nombre'+num; // 6
  ele.id = 'buscar'+num;
  ele.autocomplete = "off";
  contenedor.appendChild(ele); // 7

  
  ele = document.createElement('input'); // 5
  ele.type = 'text'; // 6
  ele.name = 'unidad'+num; // 6
  ele.id = 'unidad'+num;
  ele.autocomplete = "off";
  contenedor.appendChild(ele); // 7

  
  ele = document.createElement('input'); // 5
  ele.type = 'text'; // 6
  ele.name = 'valor'+num; // 6
  ele.id = 'valor'+num;
  ele.autocomplete = "off";
  contenedor.appendChild(ele); // 7
  

  
  ele = document.createElement('input'); // 5
  ele.type = 'text'; // 6
  ele.name = 'cantidad'+num; // 6
  ele.id = 'cantidad'+num;
  ele.autocomplete = "off";
  contenedor.appendChild(ele); // 7



  
  ele = document.createElement('input'); // 5
  ele.type = 'text'; // 6
  ele.name = 'compra'+num; // 6
  ele.id = 'compra'+num;
  ele.autocomplete = "off";
  contenedor.appendChild(ele); // 7


  
  
  ele = document.createElement('input'); // 5
  ele.type = 'text'; // 6
  ele.name = 'total'+num; // 6
  ele.id = 'total'+num;
  ele.autocomplete = "off";
  contenedor.appendChild(ele); // 7



 
  ele = document.createElement('input'); // 5
  ele.type = 'button'; // 6
  ele.value = '-'; // 8
  ele.name = 'div'+num; // 8
  ele.onclick = function () {borrar(this.name)} // 9
  contenedor.appendChild(ele); // 7


}
function borrar(obj) {
  fi = document.getElementById('fiel'); // 1 
  fi.removeChild(document.getElementById(obj)); // 10
}
--> 
</script>

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
       	
       <form id="datos" name="salida" action="salidas_exe.php" method="post">
        <table align="center" class="table table-striped" border="1">
        	
            <thead>
            	
                      <th colspan="12" align="center">Orden de Salida</th>
                <tr>
                  <td>Orden N</td>
                  <td>Nombre de Obra</td>
                  <td>Codigo de Obra</td>
                  <td>Despacho N</td>
                  <td colspan="3">Fecha</td></tr>
                  
                
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
                                            
                            <td><input type="text" id="buscarObra" name="obra" autocomplete="off"/>
                            <div id="resultados_ajaxObra"></div></td>
                            <td><input type="text" id="obra" name="codobra" autocomplete="off"/></td>
                            <td><input type="text" name="despacho" autocomplete="off"/></td>
                            <td colspan="3"><input type="text" id="datepicker" name="fecha" placeholder="AAAA/MM/DD" autocomplete="off"/> </td>
      </tr>

                            
              <tr>
                              <th colspan="12" align="center"><p>&nbsp;</p>
              <p>Material</p></th>
              </tr>
                <tr>
                 
                  <td>Codigo</td>
                  <td>Descripcion</td>
                  <td>Unidad</td>
                  <td>Valor</td>                 
                  <td>Cantidad</td>
                  <td>Compra</td>
                  <td>Total</td>
                </tr>
                  
                  <tr>
 		                            <td><input type="text" id="codigo" name="codigo" autocomplete="off" /></td>
		                            <td><input type="text" id="buscar" name="nombre"  autocomplete="off"/>
		                            <div id="resultados_ajax"></div></td>
		                            <td><input type="text" id="unidad" name="unidad" autocomplete="off" /></td>
		                            <td><input type="text" id="valor" name="valor"  autocomplete="off" /></td>
		                            <td><input type="text" id="cantidad" name="cantidad" autocomplete="off" /></td>
		                            <td><input type="text"  name="compra" autocomplete="off" /></td>
		                            <td><input type="text"  name="total" autocomplete="off" /></td>
		                        <tr>
		                        <td id="fiel2" colspan="12"><fieldset id="fiel"></fieldset></td>
		                        </tr>
		         </tr>
                            
                 
                            
          
              <tr><td colspan="12"  align="center">             	
              	<input type="button" value="+" onClick="crear(this)" />
              	<input type="button" id="send" value="SEND" /></td></tr>
				
            
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
 		$(document).on('mouseover',"#resultados_ajaxObra li",function(e){
 		
			var selected = $(".selectedObra");
			selected.removeClass('selectedObra');
			$(this).addClass('selectedObra');
			return false;
 		});
 		$(document).on('mouseover',"#resultados_ajax1 li",function(e){
 		
			var selected = $(".selected1");
			selected.removeClass('selected1');
			$(this).addClass('selected1');
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
 		$(document).on('click',"#resultados_ajaxObra li ",function(e){
 		
 	 		 $("#buscarObra").val($(this).children('a').html());
 	 		 $("#resultados_ajaxObra").html("");
			 $("#resultados_ajaxObra").css("display","none");
			 insertarCodigoObra($(this).children('a').html());
 	 		 return false;
 		});
 		$(document).on('click',"#resultados_ajax1 li ",function(e){
 		
 	 		 $("#buscar1").val($(this).children('a').html());
 	 		 $("#resultados_ajax1").html("");
			 $("#resultados_ajax1").css("display","none");
			 insertarCodigo1($(this).children('a').html());
			 insertarValor1($(this).children('a').html());
			 insertarUnidad1($(this).children('a').html());
			 insertarCantidad1($(this).children('a').html());
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
    		$("#buscarObra").on('keyup', desplegarajaxObra);
    		$("#buscarObra").on('focus', desplegarajaxObra);
    		$("#buscar1").on('keyup', desplegarajax1);
    		$("#buscar1").on('focus', desplegarajax1);
    		
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
    	    function desplegarajax1(e){
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
					$("#resultados_ajax1").html(html);
					$("#resultados_ajax1").css("display","block");	
					$("#buscar1").off('keydown.flechas');
					$("#buscar1").on('keydown.flechas', moverflechas );	
					
			              },
			              error: function(data){			             
			                $("#resultados_ajax1").html("");			
			                $("#resultados_ajax1").css("display","none");
			                $("#buscar1").off('keydown.flechas');
			              }
			        	
			            });	
    	    
    	    
    	    }
    	    function desplegarajaxObra(e){
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
	   			           	html += '<li class="selectedObra"><a href="javascript:void(0)">'+data[i]+'</a></li>';	
	   			           }else{
	   			           
	   			           	html += '<li><a href="javascript:void(0)">'+data[i]+'</a></li>';
	   			           }
	   			           
    					   
					}
					html += "</ul>";
					$("#resultados_ajaxObra").html(html);
					$("#resultados_ajaxObra").css("display","block");	
					$("#buscarObra").off('keydown.flechas');
					$("#buscarObra").on('keydown.flechas', moverflechasObra );	
					
			              },
			              error: function(data){			             
			                $("#resultados_ajaxObra").html("");			
			                $("#resultados_ajaxObra").css("display","none");
			                $("#buscarObra").off('keydown.flechas');
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
		function moverflechas1(e){
						//console.log(e.which);
						if (e.keyCode == 39) { // derecha
						      var selected = $(".selected1 a");
						      $("#buscar1").val(selected1.html());
							  insertarCodigo1(selected1.html());
						      insertarValor1(selected1.html());
							  insertarUnidad1(selected1.html());
							  insertarCantidad1(selected1.html());
						      $("#resultados_ajax1").html("");
						      $("#resultados_ajax1").css("display","none");
						      return false;
						        
						    }
						if(e.keyCode == 38){
							var selected1 = $(".selected1");
						        $("#resultados_ajax1 ul li").removeClass("selected1");
						        if (selected1.prev().length == 0) {
						            selected1.siblings().last().addClass("selected1");

						        } else {
						            selected1.prev().addClass("selected1");
						        }	
						        return false;					
						}
						
						if(e.keyCode == 40){
							var selected1 = $(".selected1");
						        $("#resultados_ajax1 ul li").removeClass("selected1");
						        if (selected1.next().length == 0) {
						            selected1.siblings().first().addClass("selected1");
						        } else {
						            selected1.next().addClass("selected1");
						    
						      	}
						      	return false;					
						}
					}			
		function moverflechasObra(e){
						//console.log(e.which);
						if (e.keyCode == 39) { // derecha
						      var selected2 = $(".selectedObra a");
						      $("#buscarObra").val(selectedObra.html());
							  insertarCodigoObra(selectedObra.html());
						      $("#resultados_ajaxObra").html("");
						      $("#resultados_ajaxObra").css("display","none");
						      return false;
						        
						    }
						if(e.keyCode == 38){
							var selectedObra = $(".selectedObra");
						        $("#resultados_ajaxObra ul li").removeClass("selectedObra");
						        if (selectedObra.prev().length == 0) {
						            selectedObra.siblings().last().addClass("selectedObra");

						        } else {
						            selectedObra.prev().addClass("selectedObra");
						        }	
						        return false;					
						}
						
						if(e.keyCode == 40){
							var selectedObra = $(".selectedObra");
						        $("#resultados_ajaxObra ul li").removeClass("selectedObra");
						        if (selectedObra.next().length == 0) {
						            selectedObra.siblings().first().addClass("selectedObra");
						        } else {
						            selectedObra.next().addClass("selectedObra");
						    
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
		function insertarCodigo1(nombre){
				
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
				              $("#codigo1").val(data);
				              
			              	},
						error:function(){
				              $("#codigo1").val("error!");
				             
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
		function insertarValor1(nombre){
				
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
				              $("#valor1").val(data);
				              
			              	},
						error:function(){
				              $("#valor1").val("error!");
				             
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
		function insertarUnidad1(nombre){
				
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
				              $("#unidad1").val(data);
				              
			              	},
						error:function(){
				              $("#unidad1").val("error!");
				             
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
		function insertarCantidad1(nombre){
				
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
				              $("#cantidad1").val(data);
				              
			              	},
						error:function(){
				              $("#cantidad1").val("error!");
				             
			              	}
			              	
			        });	        
		
		}
		$('#send').click(function() {
			$('#datos').submit(); pre
				
			
		});
			
        </script>
        <script>
$( "#datepicker" ).datepicker({ dateFormat: "yy/mm/dd" });
</script>
    <script src="../../libs/js/bootstrap.min.js"></script>
    </body>
</html>