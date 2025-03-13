<?php
function GetAllProduct()
{  
    $DBH=connect();
    $query="select * from product";
    $STH = $DBH->query($query);
    return $STH;
}
function GetProductViewALot()
{  
    $DBH=connect();
    $query="select * from product order by view DESC limit 3";
    $STH = $DBH->query($query);
    return $STH;
}

function GetTopBuyed()
{
    $DBH=connect();
    $query="select * from product order by buyed DESC limit 8";
    $STH = $DBH->query($query);
    return $STH;
} 
?>