<?php

function numero_bon()
{
$code='';
for($i=1;$i<4;$i++)
{
$nb=rand(48,57);
$code.=chr($nb);
}
return $code;
}
?>