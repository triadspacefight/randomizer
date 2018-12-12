<?php

header('Content-Type: text/html;charset=utf-8');
echo "<html><head>";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"dd.css\">";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"modal.css\">";
echo "<script type=\"text/javascript\" src=\"modal.js\" charset=\"utf-8\" async defer></script>";
echo "</head><body>";


echo "<div class=\"context\" align=center>";
echo "<p><img src='./images/logo.png'></p>";
echo "</div>";


$mysqli = new mysqli("localhost", "randomizer", "dL7Qlqf7Mvp9s0kH", "randomizer");
$mysqli->set_charset("utf8");
$song = $_POST['nameofsong'];
$style = $_POST['iidxstyle'];
//$dif = $_POST['difsel'];
$difmin = $_POST['difmin'];
$difmax = $_POST['difmax'];
$count = $_POST['songcount'];
$leg = $_POST['legg'];

//if (isset($_POST['legg'])){
//echo "<center><img src='./images/leg.png' height=60 width=197></center>";
//}

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

//echo "Connected successfully!<br>";
echo "<table align=center id=\"t1\"><tr><td>";
echo "<div align=center>";
echo "<p>Difficulty Selection: $difmin - $difmax</p>";
echo "<p>Number of Songs: $count</p>";
if (isset($_POST['legg'])) {
  echo "<p>Leggendaria: ON</p>";
}  else {
  echo "<p>Leggendaria: OFF</p>";
}

echo "</div></td></tr></table>";


//echo "<table align=\"center\"><tr><td><button id=\"trigger\" class=\"trigger-button\" type=\"button\">ReDraw</button>";  
//echo "<div id=\"content\">";
//echo "<center><iframe src=\"https://remywiki.com\" border=0 height=\"100%\" width=\"100%\"></iframe></center> </div>";
//echo "</td></tr></table>";


echo "<table align=center width=80%><tr><td align=center><a href=./form.php><img src='./images/redraw.png' alt='ReDraW!'></a></td><td align=center><a href='javascript:window.location.reload(true)'><img src='./images/refresh.png' alt='ReDraW!'></a></center></td></tr>";

if (isset($_POST['legg'])) {
        
        $sql = "SELECT genre,song,artist,spn,sph,spa,songid,style 
                FROM Songs 
                spn BETWEEN '$difmin' and '$difmax' OR
                sph BETWEEN '$difmin' and '$difmax' OR
                spa BETWEEN '$difmin' and '$difmax'  
                ORDER BY RAND() 
                LIMIT $count";

}  elseif ($style!="0") {

        $sql = "SELECT genre,song,artist,spn,sph,spa,songid,style 
                FROM Songs 
                WHERE style LIKE '$style' 
                AND '0' NOT IN(spn) 
                spn BETWEEN '$difmin' and '$difmax' OR
                sph BETWEEN '$difmin' and '$difmax' OR
                spa BETWEEN '$difmin' and '$difmax'  
                ORDER BY RAND() 
                LIMIT $count";

}  else {

        $sql = "SELECT genre,song,artist,spn,sph,spa,songid,style 
                FROM Songs 
                WHERE '$leg' NOT IN(style) AND
                spn BETWEEN '$difmin' and '$difmax' OR
                sph BETWEEN '$difmin' and '$difmax' OR
                spa BETWEEN '$difmin' and '$difmax'              
                ORDER BY RAND() 
                LIMIT $count";
}

$result = $mysqli->query($sql);


if ($result->num_rows > 0) {
    echo "<tr><td colspan=2><table id=\"t1\" align=center>";
    echo "<col class=\"c1\" /><col class=\"c2\" /><col class=\"c3\" /><col class=\"c4\" /><col class=\"c5\" /><col class=\"c6\" /><col class=\"c7\" />";
    echo "<tr><th>Genre</th><th>Name</th><th>Artist</th><th>SPN</th><th>SPH</th><th>SPA</th><th>Style Folder</th></tr>";
    // output data of each row
    
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["genre"]."</td><td>".$row["song"]."</td><td>".$row["artist"]."</td>";
        
        if ($row['spa'] >= $difmin && $row['spa'] <= $difmax && $row['sph'] >= $difmin && $row['sph'] <= $difmax && $row['spn'] >= $difmin && $row['spn'] <= $difmax) {
            echo "<td style=\"text-decoration: underline; color: green\">".$row["spn"]."</td><td style=\"text-decoration: underline; color: green\">".$row["sph"]."</td><td style=\"text-decoration: underline; color: green\">".$row["spa"]."";
            
        } elseif ($row['spn'] >= $difmin && $row['spn'] <= $difmax && $row['sph'] >= $difmin && $row['sph'] <= $difmax) {
            echo "<td style=\"text-decoration: underline; color: green\">".$row["spn"]."</td><td style=\"text-decoration: underline; color: green\">".$row["sph"]."</td><td>".$row["spa"]."";
        
        } elseif ($row['spa'] >= $difmin && $row['spa'] <= $difmax && $row['sph'] >= $difmin && $row['sph'] <= $difmax) {
            echo "<td>".$row["spn"]."</td><td style=\"text-decoration: underline; color: green\">".$row["sph"]."</td><td style=\"text-decoration: underline; color: green\">".$row["spa"]."";
        
        } elseif ($row['spn'] >= $difmin && $row['spn'] <= $difmax) {
            echo "<td style=\"text-decoration: underline; color: green\">".$row["spn"]."</td><td>".$row["sph"]."</td><td>".$row["spa"]."";

        } elseif ($row['sph'] >= $difmin && $row['sph'] <= $difmax) {
            echo "<td>".$row["spn"]."</td><td style=\"text-decoration: underline; color: green\">".$row["sph"]."</td><td>".$row["spa"]."";

        } elseif ($row['spa'] >= $difmin && $row['spa'] <= $difmax) {
            echo "<td>".$row["spn"]."</td><td>".$row["sph"]."</td><td style=\"text-decoration: underline; color: green\">".$row["spa"]."";



        } else {
            echo "<td>".$row["spn"]."</td><td>".$row["sph"]."</td><td>".$row["spa"]."";

        }
            echo "</td><td><center><img src=./images/styles/".$row["style"].".png height=60 width=197></center></td></tr>";
    }
    echo "</table></td></tr></table>";
} else {
    echo "0 results";
}
$mysqli->close();

echo "<br><br>";

//echo rand() . "\n <br>";
//echo rand() . "\n <br>";

//echo rand(5, 15);

?>

