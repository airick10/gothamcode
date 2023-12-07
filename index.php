<html>
<head>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Open+Sans:wght@300&family=Roboto:wght@300&display=swap" rel="stylesheet">
<style>
.sectiona
{
    width:100%;
    height:20%;
    background-color:#BAE4FA;
    font-family: 'Roboto', sans-serif;
    text-align: center;
    font-size: 24px;
    font-weight: bold;
}

.sectionb
{
    width: 50%;
    height: auto;
    background-color: #FDBE8C;
    float: left;
    font-family: 'Open Sans', sans-serif;
}

.sectionc
{
    width: 50%;
    height: auto;
    background-color: #8CFD9F;
    float: right;
    font-family: 'Lato', sans-serif;
}    
</style>
<body>
<?php
//Getting Database Variables
$user = getenv("MYSQL_USERNAME");
$pass = getenv("MYSQL_PASSWORD");
$db = getenv("MYSQL_DATABASE");




    if (!isset($_ENV["bgcolorc"])) echo "<div class='sectionc'>";
    else echo "<div class='sectionc' style='background-color:" . $_ENV["bgcolorc"] . ";'>";
    echo $user . " - " . $pass . " - " . $db . "<br>";
    $con = mysqli_connect("mysql-service", $user, $pass);
    if ($con -> connect_errno) {
    echo "Failed to connect to MySQL: " . $con -> connect_error;
    exit();
}

    mysqli_select_db($con, $db);

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

