<?php
$html=file_get_contents($_POST["url"]);
$html=explode('its.serverData=',$html);
$html2=(explode('}}</script>',$html[1]));
$json=$html2[0];
$html2=explode('<div id="content">',$html2[1]);
$html2=explode('<object classID',$html2[1]);
echo("<div><div><div>".$html2[0]);
?>