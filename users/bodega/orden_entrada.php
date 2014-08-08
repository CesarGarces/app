<script type="text/javascript">
<!--
num=0;
function crear(obj) {
  num++;
  fi = document.getElementById('fiel'); // 1
  contenedor = document.createElement('div'); // 2
  contenedor.id = 'div'+num; // 3
  fi.appendChild(contenedor); // 4
 
  ele = document.createElement('input'); // 5
  ele.type = 'text'; // 6
  ele.name = 'codigom'+num; // 6
  contenedor.appendChild(ele); // 7

   ele = document.createElement('input'); // 5
  ele.type = 'text'; // 6
  ele.name = 'valor'+num; // 6
  contenedor.appendChild(ele); // 7
  
  
  ele = document.createElement('input'); // 5
  ele.type = 'text'; // 6
  ele.name = 'cantidad'+num; // 6
  contenedor.appendChild(ele); // 7
  

  
  
  ele = document.createElement('input'); // 5
  ele.type = 'button'; // 6
  ele.value = 'Borrar'; // 8
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
//realizamos la conexi贸n a la base de datos
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
$contador = "<script> document.write(num) </script>";
?>
<!DOCTYPE html>
<html lang="esp">

    <head>
    <meta charset="utf-8" />
    
            <title>Nueva Orden Entrada</title>
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
       <form name="entrada" action="entradas_resp.php" method="post">
        <table align="center" class="table table-striped" border="1">
        	
            <thead>
            	
                    <th colspan="11" align="center">Orden de Entada</th>
                <tr>
                  
                  <td>Proveedor</td>
                  <td>Codigo Proveedor</td>
                  <td>Nombre de Obra</td>
                  <td>Codigo de Obra</td>
                  <td>Factura N</td>
                  <td>Fecha</td></tr>
                  
                
            </thead>
            <tbody>
            
      <tr>
                            
                            <td><input type="text" id="buscar3" name="prov" autocomplete="off"/><div id="resultados_ajax3"></div></td>
                            <td><input type="text" id="codprov" name="codprov" autocomplete="off"/></td>                          
                            <td><input type="text" id="buscar2" name="obra" autocomplete="off"/><div id="resultados_ajax2"></div></td>
                            <td><input type="text" id="obra" name="codobra" autocomplete="off"/></td>
                            <td><input type="text" name="fact" autocomplete="off"/></td>
                            <td><input type="text" id="datepicker" name="fecha" placeholder="AAAA/MM/DD" autocomplete="off"/> </td>
                            </tr>
                            
                            <tr>
                              <th colspan="11" align="center"><p>&nbsp;</p>
              <p>Material</p></th></tr>
              
                <tr>
                 
                  <td>Codigo</td>
                  <td>Descripcion</td>
                  <td>U/N</td>
                  <td>Valor</td>                 
                  <td>Cantidad</td>
                  <td>Tipo de Ingreso</td>
                  </tr>
                  
                  <tr>
                            
                            <td><input type="text" id="codigo" name="codigo" autocomplete="off" /></td>
                            <td><input type="text" id="buscar" name="nombre"  autocomplete="off"/>
                    <div id="resultados_ajax"></div></td>
                            <td><input type="text" id="unidad" value="" name="unidad"  /></td>
                            <td><input type="text" id="valor" name="valor"  autocomplete="off" /></td>
                            
                            <td><input type="text" value="" name="cantidad" /></td>
                            <td>
                            <label for="compra">compra</label>
                            <input id="compra" type="radio" value="0" name="tipo_entrada" />
                            <label for="devolucion">devolución</label>
                            <input id="devolucion" type="radio" value="1" name="tipo_entrada" />
                            </td>
                            
                            
          
                        <tr><td colspan="8" align="center"><input type="submit" name="send" id="send" value="SEND" /></td></tr>
				
            
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
        </footer>
        <script src="https://code.jquery.com/jquery.js"></script>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
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
		$(document).on('mouseover',"#resultados_ajax3 li",function(e){
 		
			var selected = $(".selected3");
			selected.removeClass('selected3');
			$(this).addClass('selected3');
			return false;
 		});
 		$(document).on('click',"#resultados_ajax li ",function(e){
 		
 	 		 $("#buscar").val($(this).children('a').html());
 	 		 $("#resultados_ajax").html("");
			 $("#resultados_ajax").css("display","none");
			 insertarCodigo($(this).children('a').html());
			 insertarValor($(this).children('a').html());
			 insertarUnidad($(this).children('a').html());
 	 		 return false;
 		});
 		$(document).on('click',"#resultados_ajax2 li ",function(e){
 		
 	 		 $("#buscar2").val($(this).children('a').html());
 	 		 $("#resultados_ajax2").html("");
			 $("#resultados_ajax2").css("display","none");
			 insertarCodigoObra($(this).children('a').html());
 	 		 return false;
 		});
		$(document).on('click',"#resultados_ajax3 li ",function(e){
 		
 	 		 $("#buscar3").val($(this).children('a').html());
 	 		 $("#resultados_ajax3").html("");
			 $("#resultados_ajax3").css("display","none");
			 insertarCodigoProv($(this).children('a').html());
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
			$("#buscar3").on('keyup', desplegarajax3);
    		$("#buscar3").on('focus', desplegarajax3);
    		
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
			function desplegarajax3(e){
    	        if( e.keyCode == 38 ){
    	        	return false;
    	        }
    	        if( e.keyCode == 40 ){
    	        	return false;
    	        }
    	    	search_string = $(this).val();
    	
			    	$.ajax({	
			              type: "POST",
			              url: "prov_list_ajax.php",
			              data: { 
			              	msg: search_string 
			              	},
			              dataType: 'json',	
			              cache: false,
			              success: function(data){			             
			                html = "<ul>"
			                for (i = 0; i < data.length; ++i) {
	   			            if(i == 0){
	   			           	html += '<li class="selected3"><a href="javascript:void(0)">'+data[i]+'</a></li>';	
	   			           }else{
	   			           
	   			           	html += '<li><a href="javascript:void(0)">'+data[i]+'</a></li>';
	   			           }
	   			           
    					   
					}
					html += "</ul>";
					$("#resultados_ajax3").html(html);
					$("#resultados_ajax3").css("display","block");	
					$("#buscar3").off('keydown.flechas');
					$("#buscar3").on('keydown.flechas', moverflechas3 );	
					
			              },
			              error: function(data){			             
			                $("#resultados_ajax3").html("");			
			                $("#resultados_ajax3").css("display","none");
			                $("#buscar3").off('keydown.flechas');
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
					
		function moverflechas3(e){
						//console.log(e.which);
						if (e.keyCode == 39) { // derecha
						      var selected3 = $(".selected3 a");
						      $("#buscar3").val(selected3.html());
							  insertarCodigoProv(selected3.html());
						      $("#resultados_ajax3").html("");
						      $("#resultados_ajax3").css("display","none");
						      return false;
						        
						    }
						if(e.keyCode == 38){
							var selected3 = $(".selected3");
						        $("#resultados_ajax3 ul li").removeClass("selected3");
						        if (selected3.prev().length == 0) {
						            selected3.siblings().last().addClass("selected3");

						        } else {
						            selected3.prev().addClass("selected3");
						        }	
						        return false;					
						}
						
						if(e.keyCode == 40){
							var selected3 = $(".selected3");
						        $("#resultados_ajax3 ul li").removeClass("selected3");
						        if (selected3.next().length == 0) {
						            selected3.siblings().first().addClass("selected3");
						        } else {
						            selected3.next().addClass("selected3");
						    
						      	}
						      	return false;					
						}
					}			
					
		function insertarCodigoProv(nombre){
				
				$.ajax({	
				              type: "POST",
				              url: "prov_codigo_ajax.php",
				              data: { 
				              	msg:nombre
				              	},
				              dataType: 'json',	
				              cache: false,
				              success: function(data){
				              console.log("data es igual a: "+data);
				              $("#codprov").val(data);
				              
			              	},
						error:function(){
				              $("#codprov").val("error!");
				             
			              	}
			              	
			        });
			        
		
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
        <script>
$( "#datepicker" ).datepicker({ dateFormat: "yy/mm/dd" });
</script>
    <script src="../../libs/js/bootstrap.min.js"></script>
    </body>
</html>