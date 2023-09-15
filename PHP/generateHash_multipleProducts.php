<?php 

$codes = $_POST['codes'];
$total_Cost = (int)$_POST['total_Cost'];

$hash = strtoupper(
    md5(
        '1221855' . 
        $codes . 
        number_format($total_Cost, 2, '.', '') . 
        'USD' .  
        strtoupper(md5('MjA3NjQwMTM1OTE3NTE3MTk1ODgyOTQxMzQ2ODAyMzUzNzQ5MjE4OA==')) 
    ) 
);

echo $hash;
?>