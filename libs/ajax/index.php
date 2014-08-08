<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css" />
<title>Untitled Document</title>
<script>
    $(function() {
       
        $( "#cli_codigo" ).autocomplete({
            source: "json.php?",
             select: function(event, ui) {  
            $('#cli_codigo').val(ui.item.label) ;
           }  
        });
    });
</script>
<script type="text/jscript">

			function completar_campos(){
				document.getElementById("loading").style.display = "block";
				var con_consulta;
				if(window.XMLHttpRequest){
					con_consulta = new XMLHttpRequest();
				}else{
					con_consulta = new ActiveXObject("Microsoft.XMLHTTP");
				}
				
				con_consulta.onreadystatechange = function (){
					if(con_consulta.readyState == 4 && con_consulta.status == 200){
						document.getElementById("datos_esenciales").innerHTML = con_consulta.responseText;
						document.getElementById("loading").style.display = "none";
					}
				}
				var cli_codigo = document.getElementById("cli_codigo").value;
				con_consulta.open("GET", "procesar.php?cli_codigo="+cli_codigo, true);
				con_consulta.send(null);
			}


</script>
</head>

<body>
<form action="" method="post">
<div class="ui-widget">
<label for="lista">DESCRIPCION;</label> <input type="text" value="" onblur="completar_campos();" id="cli_codigo" />
<div id="test">
        
    </div>
    </div>
<img src="loading.gif" id="loading" width="70" height="70" style="display:none" />
<div id="datos_esenciales">
<label>codigo;</label> <input type="text" value="" name="cod" />
<label>descripcion;</label> <input type="text" value="" name="des" />
<label>un;</label> <input type="text" value="" name="unidad" />
<label>precio;</label> <input type="text" value="" name="precio" />
</div>
<input type="submit" value="Enviar" />
</form>
</body>
</html>
