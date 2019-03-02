<html>
<header>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>DBViewer</title>
</header>
<body>
<font face="leelawadee,tahoma"  size=2>
<?php


if (!isset($_POST['db']))
{
    $db = "test";
}
else {
    $db = $_POST['db'];
}

if ($db == "test") {
    $dbname = "occdbs_db_test";
} else {
    $dbname = "occdbs_db_dev";
}

if (!isset($_POST['sql']))
{
    $sql = "nosql";
}
else {
    $sql = $_POST['sql'];
}


function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Fuck';
    exit;
} else {
    echo "<p>Hello {$_SERVER['PHP_AUTH_USER']}.</p>";

    $pass="not";

    if ( ($_SERVER['PHP_AUTH_USER'] == "DB") && ($_SERVER['PHP_AUTH_PW'] == "dbnaja")) {
        $pass="yes";
    }


    if ( ($_SERVER['PHP_AUTH_USER'] == "bateam") && ($_SERVER['PHP_AUTH_PW'] == "RunNanNanRunDeeDee")) {
        $pass="yes";
    }



    if ( ($_SERVER['PHP_AUTH_USER'] == "vitty") && ($_SERVER['PHP_AUTH_PW'] == "0010")) {
        $pass="yes";
    }


    if ( ($_SERVER['PHP_AUTH_USER'] == "yok") && ($_SERVER['PHP_AUTH_PW'] == "yokdtac")) {
        $pass="yes";
    }





    if ( $pass == "not" ) {
        exit;
    }
    
    $today = date('Y-m-d');
    $filename="log/access.log.".$today;
    $mode="w";
    if (file_exists($filename)) {
        $mode="a";
    }

    date_default_timezone_set("Asia/Bangkok");
    $date = date('Y/m/d H:i:s');
//    echo $filename;
    $lfile = fopen($filename,$mode) or die("Unable to open file!");
    $txt = $date." | ".getRealIpAddr()." | Have access from user ".$_SERVER['PHP_AUTH_USER']." , run command : ".$sql."\n";
    fwrite($lfile, $txt);


}

?>
<form action="db.php" method="post">
database: <input name="db" type="text" value="<?=$db;?>"><br><br>

sql command: <br>
<textarea rows = "5" cols = "60" name = "sql">
<?=$sql;?>
</textarea><br>
<br>
<input type = "submit" value = "submit" />

</form>

<?php

function displayAllRecords($serverName, $userName, $password, $databaseName,$sqlQuery='')
{
    $databaseConnectionQuery =  mysqli_connect($serverName, $userName, $password, $databaseName);
    if($databaseConnectionQuery === false)
    {
        die("ERROR: Could not connect. " . mysqli_connect_error());
        return false;
    }

    mysqli_set_charset($databaseConnectionQuery,"utf8");
    $resultQuery = mysqli_query($databaseConnectionQuery,$sqlQuery);
    $fetchFields = mysqli_fetch_fields($resultQuery);
    $fetchValues = mysqli_fetch_fields($resultQuery);

    if (mysqli_num_rows($resultQuery) > 0) 
    {           

        echo "<table margin='0' padding='1' bgcolor='#aeaeae' cellpadding=4>";
        echo "<tr>";
        foreach ($fetchFields as $fetchedField)
         {          
            echo "<td bgcolor='#ebebeb'>";
            echo "<b>" . $fetchedField->name . "<b></a>";
            echo "</td>";
        }       
        echo "</tr>";
        while($totalRows = mysqli_fetch_array($resultQuery)) 
        {           
            echo "<tr>";                                
            for($eachRecord = 0; $eachRecord < count($fetchValues);$eachRecord++)
            {           
                echo "<td bgcolor='#ffffff'>";
                echo $totalRows[$eachRecord];
                echo "</td>";               
            }
            echo "</tr>";           
        } 
        echo "</table>";        

    } 
    else
    {
      echo "No Records Found in";
    }
}



$servername = "10.1.23.153";
$username = "occdbs_own";
$password = "rpCQfX83p9jprHZUzFtz";

if ($sql != "nosql") {

#$queryStatment = "SELECT * From core_config_data "; 
$result = displayAllRecords($servername,$username,$password,$dbname,$sql); 

echo $result;

}

?>
</font>
</body>
</html>
