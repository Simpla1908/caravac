<?php

function reference()
{
$code='';
for($i=1;$i<9;$i++)
{
$nb=rand(48,57);
$code.=chr($nb);
}
return $code;
}
?>