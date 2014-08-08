<?php  

 include("conexion.php");
  
  $seleciona_dados = mysql_query("SELECT * FROM material WHERE descripcion = '" .$_GET['cli_codigo']. "'");
  $lin_dado_cli = mysql_fetch_array($seleciona_dados);
  
  
  echo '
  
  
  <table align="center" class="table table-striped" border="1">
        	
            <thead>
            	
                    <th colspan="11" align="center"></th>
                <tr>
                  
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td></tr>
                  
                
            </thead>
            <tbody>
            
      <tr>
                            
                            <td></td>
                            <td></td>                          
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            </tr>
              <tr>
                              <th colspan="11" align="center"><div class="ui-widget">

<div id="test">
        
    </div>
    </div>
</th></tr>
                <tr>
                 
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>                 
                  <td></td></tr>
                  
                  <tr>
                             <div id="datos_esenciales">
                            <td><input type="text" value="'.$lin_dado_cli['codigo'].'" name="codigom"  /></td>
                            <td><input type="text" value="'.$lin_dado_cli['descripcion'].'" name="descrip"  /></td>
                            <td><input type="text" value="'.$lin_dado_cli['unidad'].'" name="unidad"  /></td>
                            <td><input type="text" value="'.$lin_dado_cli['precio_unidad'].'" name="valor" /></td>
							</div>
                            <td><input type="text" value="" name="cantidad" /></td>
                            
                            
          
                        <tr><td colspan="8" align="center"></td></tr>
				
            
            </tbody>
        
        </table>
		
  
  
                            

  
  ';
 
?>  