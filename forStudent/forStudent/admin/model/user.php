<?php
function CheckLogin($email,$pass)
{ 
    $DBH=connect(); 
    $query="
    SELECT * FROM admin
    where email='$email'
    AND password='$pass'
    ";
    $STH = $DBH->query($query);
    $rows_affected = $STH->rowCount();  
    if ($rows_affected == 0)
    {
        return false;
    }
    return true;
}

?>