<?php

$conn=mysqli_connect("13.80.183.196","pbi","63yTbzjZdafBA7Ay","leadexp") or die("Failed to connect to MySQL: " . mysqli_connect_error());

    if($_POST["optin2"]==2)
    {
        $query_nt   = "update leads set optin=2 where id='".$_POST["id"]."'";
        $results_l = mysqli_query($conn, $query_nt);
        echo  $query_nt;
    }
else if($_POST["optin2"]==1)
    {
        $query_nt   = "update leads set optin=1 where id='".$_POST["id"]."'";
        $results_l = mysqli_query($conn, $query_nt);
        echo  $query_nt;
    }
    else
    
    {
      $query_nt   = "update leads set optin=9 where id='".$_POST["id"]."'";
        $results_l = mysqli_query($conn, $query_nt);
        echo  $query_nt;  
    }








    

?>