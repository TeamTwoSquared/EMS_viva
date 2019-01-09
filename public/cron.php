<?php
$servername="localhost";
$username="admin_ems";
$password="ccs709-1";
$databasename="admin_ems";

//create connection
$connection = mysqli_connect($servername, $username, $password,$databasename)  or die("Unable to connect");

if (!$connection) {
die("Connection failed: " . mysqli_connect_error());
}

date_default_timezone_set('Asia/Colombo');
$current_date = date("Y/m/d");;

$sql = "SELECT * FROM service_providers";
$result = mysqli_query($connection,$sql);
while($row = mysqli_fetch_assoc($result))
{
    $datetime = explode(" ",$row['reg_date']);
    $dateOnly = $datetime[0];

    $datetime1 = new DateTime($current_date);
	$datetime2 = new DateTime($dateOnly);
	
    $difference = $datetime1->diff($datetime2);

    $dayDiff = $difference->d + $difference->m*31 + $difference->y*366;

    //Levelling up
    if($row['star']==5 && $dayDiff > 732) 
    {
        $update = "UPDATE service_providers SET level = 3 WHERE service_provider_id = '$row[0]'";
        $updateR = mysqli_query($connection,$update);
    }

    else if($row['star']==5 && $dayDiff > 366)
    {
        $update = "UPDATE service_providers SET level = 2 WHERE service_provider_id = '$row[0]'";
        $updateR = mysqli_query($connection,$update);
    } 

    else if($row['star']==5 && $dayDiff > 186)
    {
        $update = "UPDATE service_providers SET level = 1 WHERE service_provider_id = '$row[0]'";
        $updateR = mysqli_query($connection,$update);
    }

    //Level Down
    if($row['level']==3 && $row['star']<4)
    {
        $update = "UPDATE service_providers SET level = 2 WHERE service_provider_id = '$row[0]'";
        $updateR = mysqli_query($connection,$update);
    }
	else if($row['level']==2 && $row['star']<4)
    {
        $update = "UPDATE service_providers SET level = 1 WHERE service_provider_id = '$row[0]'";
        $updateR = mysqli_query($connection,$update);
    }
	else if($row['level']==1 && $row['star']<4)
    {
        $update = "UPDATE service_providers SET level = 0 WHERE service_provider_id = '$row[0]'";
        $updateR = mysqli_query($connection,$update);
    }

                    
}
        
?>