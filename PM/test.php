<?php
echo('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].(str_replace('test.php','',$_SERVER['PHP_SELF'])));
?>