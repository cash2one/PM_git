<?php
$data=$_POST['data'];
file_put_contents('post.txt',$data);
echo 200;
?>