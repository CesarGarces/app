<?php 
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I')); 
print "&nbsp;$hora&nbsp;"; 
?> 