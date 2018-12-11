<?php

header('Content-Type: text/html;charset=utf-8');

echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"dd.css\">";

echo "<div class=\"context\" align=center>";
echo "<p><img src='./images/logo.png'></p>";
echo "</div>";


$mysqli = new mysqli("localhost", "randomizer", "dL7Qlqf7Mvp9s0kH", "randomizer");
$mysqli->set_charset("utf8");
$song = $_POST['nameofsong'];
$style = $_POST['iidxstyle'];
$dif = $_POST['difsel'];
$count = $_POST['songcount'];
$leg = $_POST['legg'];

if (isset($_POST['legg'])){
echo "<center><img src='./images/leg.png' height=60 width=197></center>";
}

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
//echo "Connected successfully!<br>";

echo "<center><a href=./form.php><img src='./images/redraw.png' alt='ReDraW!'></a>   <a href='javascript:window.location.reload(true)'><img src='./images/refresh.png' alt='ReDraW!'></a></center>";

if (isset($_POST['legg'])) {
        
        $sql = "SELECT genre,song,artist,spn,sph,spa,songid,style FROM Songs WHERE '$dif' IN(SPN,SPH,SPA) ORDER BY RAND() LIMIT $count";

}  elseif ($style!="0") {

        $sql = "SELECT genre,song,artist,spn,sph,spa,songid,style FROM Songs WHERE style LIKE '$style' AND '0' NOT IN(spn) AND '$dif' IN(SPN,SPH,SPA) ORDER BY RAND() LIMIT $count";

}  else {

        $sql = "SELECT genre,song,artist,spn,sph,spa,songid,style FROM Songs WHERE '$dif' IN(SPN,SPH,SPA) AND '0' NOT IN(spn) ORDER BY RAND() LIMIT $count";
}

$result = $mysqli->query($sql);


if ($result->num_rows > 0) {
    echo "<table id=\"t1\" align=center>";
    echo "<col class=\"c1\" /><col class=\"c2\" /><col class=\"c3\" /><col class=\"c4\" /><col class=\"c5\" /><col class=\"c6\" /><col class=\"c7\" />";
    echo "<tr><th>Genre</th><th>Name</th><th>Artist</th><th>SPN</th><th>SPH</th><th>SPA</th><th>Style Folder</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["genre"]."</td><td>".$row["song"]."</td><td>".$row["artist"]."</td>";
	echo "<td>".$row["spn"]."</td><td>".$row["sph"]."</td><td>".$row["spa"]."</td><td><center><img src=./images/styles/".$row["style"].".png height=60 width=197></center></td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$mysqli->close();

echo "<br><br>";

//echo rand() . "\n <br>";
//echo rand() . "\n <br>";

//echo rand(5, 15);

?>

