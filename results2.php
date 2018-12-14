<?php

header('Content-Type: text/html;charset=utf-8');
echo "<html><head>";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"dd.css\">";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"veto.css\">";
echo "<script type=\"text/javascript\" src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js' charset=\"utf-8\" async defer></script>";
echo "<script type='text/javascript' src='./veto.js'></script>";
echo "<script src=\"jquery.translucent.min.js\"></script>";
echo "<script src=\"cards.js\"></script>";
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


echo "<table align=center width=80%><tr><td align=center><a href=./form2.php><img src='./images/redraw.png' alt='ReDraW!'></a></td><td align=center><a href='javascript:window.location.reload(true)'><img src='./images/refresh.png' alt='ReDraW!'></a></center></td></tr>";

echo "<div id=\"your-background\"><div class=\"your-card\"><div class=\"tl-card-contents\">Hello!</div></div></div>";

echo $leg;

if ($leg=='leg') {
        
        $sql = "SELECT genre,song,artist,spn,sph,spa,songid,style 
                FROM Songs 
                WHERE spn BETWEEN '$difmin' and '$difmax' OR
                sph BETWEEN '$difmin' and '$difmax' OR
                spa BETWEEN '$difmin' and '$difmax'  
                ORDER BY RAND() 
                LIMIT $count";

}  elseif ($style!="0") {

        $sql = "SELECT genre,song,artist,spn,sph,spa,songid,style 
                FROM Songs 
                WHERE style LIKE '$style' AND
                spn BETWEEN '$difmin' and '$difmax' OR
                sph BETWEEN '$difmin' and '$difmax' OR
                spa BETWEEN '$difmin' and '$difmax'  
                ORDER BY RAND() 
                LIMIT $count";

}  else {

        $sql = "SELECT songid,genre,song,artist,spn,sph,spa,style 
                FROM Songs 
                WHERE spn BETWEEN '$difmin' and '$difmax' OR
                sph BETWEEN '$difmin' and '$difmax' OR
                spa BETWEEN '$difmin' and '$difmax' AND
                style!='leg'         
                ORDER BY RAND() 
                LIMIT $count";
}

$result = $mysqli->query($sql);


if ($result->num_rows > 0) {
    echo "<tr><td colspan=2><table id=\"t1\" align=center>";
    echo "<col class=\"c1\" /><col class=\"c2\" /><col class=\"c3\" />";
    echo "<tr><th>Song Info</th><th>Difficulty</th><th>Style Folder</th></tr>";
    // output data of each row

$loop=0;

    while($row = $result->fetch_assoc()) {
        $loop=$loop+1;
//echo $loop;
        echo "<tr><td><div id=\"display-one".$loop."\"><a href='#'>".$row["genre"]."</a></div><div id=\"display-two".$loop."\"><a href='#'>Vetoed!</a></div><div>".$row["song"]."</div><div>".$row["artist"]."</div></div></td>";
        
        if ($row['spa'] >= $difmin && $row['spa'] <= $difmax && $row['sph'] >= $difmin && $row['sph'] <= $difmax && $row['spn'] >= $difmin && $row['spn'] <= $difmax) {
            echo "<td><div>Normal:".$row["spn"]."</div><div>Hyper:".$row["sph"]."</div><div>Another:".$row["spa"]."</div></td>";
            
        } elseif ($row['spn'] >= $difmin && $row['spn'] <= $difmax && $row['sph'] >= $difmin && $row['sph'] <= $difmax) {
            echo "<td><div>Normal:".$row["spn"]."</div><div>Hyper:".$row["sph"]."</div><div>Another:".$row["spa"]."</div></td>";
        
        } elseif ($row['spa'] >= $difmin && $row['spa'] <= $difmax && $row['sph'] >= $difmin && $row['sph'] <= $difmax) {
            echo "<td><div>Normal:".$row["spn"]."</div><div>Hyper:".$row["sph"]."</div><div>Another:".$row["spa"]."</div></td>";
        
        } elseif ($row['spn'] >= $difmin && $row['spn'] <= $difmax) {
            echo "<td><div>Normal:".$row["spn"]."</div><div>Hyper:".$row["sph"]."</div><div>Another:".$row["spa"]."</div></td>";

        } elseif ($row['sph'] >= $difmin && $row['sph'] <= $difmax) {
            echo "<td><div>Normal:".$row["spn"]."</div><div>Hyper:".$row["sph"]."</div><div>Another:".$row["spa"]."</div></td>";

        } elseif ($row['spa'] >= $difmin && $row['spa'] <= $difmax) {
            echo "<td><div>Normal:".$row["spn"]."</div><div>Hyper:".$row["sph"]."</div><div>Another:".$row["spa"]."</div></td>";

        } else {
            echo "<td><div>Normal:".$row["spn"]."</div><div>Hyper:".$row["sph"]."</div><div>Another:".$row["spa"]."</div></td>";

        }
            echo "<td><center><img src=./images/styles/".$row["style"].".png height=60 width=197></center></td></tr>";
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







