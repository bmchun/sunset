<?php
$fp = fopen('1','r');
var_dump($fp);exit;
$a = array();
while(!FEOF($fp))
{
$a[] = fgets($fp);
}
var_dump($a);exit;
$b = array();
$fp_2 = fopen('2','r');
while(!FEOF($fp_2))
{
$b[] = fgets($fp_2);
}

foreach($b as $key=>$value)
{
        if(in_array($value,$a))
                continue;
        else
                echo $value;
}

?>