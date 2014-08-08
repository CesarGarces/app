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
require'../class/warehouse.php';


//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();
$objUse = new Users();
$img_users = $objUse->img_users();
$objWa = new Warehouse();


?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Nuevo Producto</title>
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
        <p><?php require'../global/menu.php';?></p>
      </div>
        
        <form name="newProd" action="new_prod_exe.php" method="post" enctype="multipart/form-data">
        <table align="center" border="1">
        
        
        	<tbody>
            	
                <tr>
                    <td><input id="codigo" type="text" name="codigo" placeholder="Codigo del Material" autocomplete="off"/></td>
                    <td><input id="buscar" type="text" name="nombre" placeholder="Descripcion" autocomplete="off" />
                    <div id="resultados_ajax"></div>
                    </td>
                    <td><input type="text" id="unidad" name="unidad" placeholder="Unidad" autocomplete="off"/></td>
                    <td><input type="text" name="cantidad" placeholder="Cantidad" autocomplete="off"/></td>                   
                    <td><input type="text" name="minimo" placeholder="Minimo" autocomplete="off"/></td>
                    <td><input type="file" id="imagen" name="imagen" value="Imagen" autocomplete="off"/></td>
                    <tr><td colspan="9" align="center"><input type="submit" name="send" id="send" value="SEND" /></td></tr>
                </tr>
            	
            </tbody>
        
        </table>
        </form>
        </div>
        </div>
        </div>
    <p>&copy; <a href="http://co.linkedin.com/in/cesargarces" target="_blank">Cesar Garces 2014</a></p>
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
			 insertarCodigo($(this).children('a').html());
			 insertarUnidad($(this).children('a').html());
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
			              url: "material_list_ajax.php",
			              data: { 
			              	msg: search_string 
			              	},
			              dataType: 'json',	
			              cache: false,
			              success: function(data){			             
			                html = "<ul>";
			                 
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
						     
						      insertarCodigo(selected.html());
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