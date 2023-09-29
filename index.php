<html>
<head>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Open+Sans:wght@300&family=Roboto:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="style.css">
<body>
<?php
//Getting Database Variables
//$host = "localhost";
//$user = $_ENV["databaseuser"];
//$pass = $_ENV["databasepassword"];
//$db = $_ENV["databasename"];
$user = getenv("databaseuser");
$pass = getenv("databasepassword");
$db = getenv("databasename");
//$bgcolora = $_ENV["bgcolora"];
//$bgcolorb = $_ENV["bgcolorb"];
//$bgcolorc = $_ENV["bgcolorc"];
//$messsage = $_ENV["message"];
//echo "BGCOLORX - " . $bgcolora;



if (!isset($_ENV["bgcolora"])) echo "<div class='sectiona'>";
else echo "<div class='sectiona' style='background-color:" . $_ENV["bgcolora"] . ";'>";
if (!isset($_ENV["message"])) { echo "Hello to my web page!";
    $command = "python python\hello.py";
    $result = shell_exec($command);
    echo $result;
}
else {
    echo $_ENV['message'];
    $command = "python python\hello.py";
    $result = shell_exec($command);
    echo $result;
}
echo "</div>";

echo "<div style='width:100%;height:80%;'>";
    if (!isset($_ENV["bgcolorb"])) echo "<div class='sectionb'>";
    else echo "<div class='sectionb' style='background-color:" . $_ENV["bgcolorb"] . ";'>";
    try
    {
        $fileName = 'GothamCSV.csv';
        
        if ( !file_exists($fileName) ) {
            throw new Exception('File not found.');
        }
        
        $fp = fopen($fileName, "r");
        if ( !$fp ) {
            throw new Exception('File open failed.');
        }
        $header = true;  
        echo "<table><caption>CSV</caption>";
        $file = fopen('GothamCSV.csv', 'r') or die(print_r(error_get_last(),true));;
        while (($data = fgetcsv($file)) !== FALSE) {
            if ($header) echo "<tr><td style='font-weight:bold;'>Villian</td><td style='font-weight:bold;'>Name</td><td style='font-weight:bold;'>Crimes</td><td style='font-weight:bold;'>Henchmen</td></tr>";
            else {
                echo "<tr>";
                echo "<td>" . $data[1] . "</td>";
                echo "<td>" . $data[2] . " " . $data[3] . "</td>";
                echo "<td>" . $data[6] . "</td>";  
                echo "<td>" . $data[7] . "</td>";
                echo "</tr>";
            }
            $header = false;
        }
        fclose($file);
        echo "</table>";
        fclose($fp);
    } 
    catch ( Exception $e ) {
        echo "Error printing CSV data";
    } 
    echo "</div>";

    if (!isset($_ENV["bgcolorc"])) echo "<div class='sectionc'>";
    else echo "<div class='sectionc' style='background-color:" . $_ENV["bgcolorc"] . ";'>";
    echo $user . " - " . $pass . " - " . $db . "<br>";
    $con = mysqli_connect($user, $pass, $db);

    mysqli_select_db($con, "gotham_db");

    if (!$con) print ("Not Connected<br>".mysqli_error());
    else {
        echo "<table><caption>DB</caption><tr>";
        echo "<b><td>Villian</td><td>Name</td><td>Crimes</td><td>Henchmen</td></b>";
        echo "</tr>";
        $request = mysqli_query($con, "SELECT Villian, FirstName, LastName, Crimes, Henchmen FROM Villians") or die("Could not connect: " . mysqli_error()); ;
        while($row = mysqli_fetch_array($request)) {
            echo "<tr>";
            echo "<td>" . $row['Villian'] . "</td>";
            echo "<td>" . $row['FirstName'] . " " . $row['LastName'] . "</td>";
            echo "<td>" . $row['Crimes'] . "</td>";
            echo "<td>" . $row['Henchmen'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }	
    echo "</div>";
echo "</div>";
?>
</body>
</html>

