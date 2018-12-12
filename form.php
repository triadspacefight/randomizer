<html>
<head>
<title>DistorteDDraW</title>
<link rel="stylesheet" type="text/css" href="./dd.css">
<style>
@font-face {
  font-family: "ddraw";
  src: url("./fonts/2051plastic-alp53.ttf") format('truetype');
}
div {
    font-family: "ddraw";
}

</style>


</head>

<body>
<center>
<img src="./images/logo.png">

<form action="results.php" method="post">

<table id="t1" align=center>
<tr><td>
<div>
Select Style Folder
</div>
</td>
<td>
<select name="iidxstyle">
  <option value="0" selected="selected">All Folders(Rootage AC)</option>
  <option value="26" >Rootage</option>
  <option value="25" >Cannon Ballers</option>
</select>
</td></tr>
<tr><td>
Difficulty Choice
</td>
<td>

<!-- Inital Difficulty Selection, Single

<select name="difsel">
  <option value="1" selected="selected">1</option>
  <option value="2" >2</option>
  <option value="3" >3</option>
  <option value="4" >4</option>
  <option value="5" >5</option>
  <option value="6" >6</option>
  <option value="7" >7</option>
  <option value="8" >8</option>
  <option value="9" >9</option>
  <option value="10" >10</option>
  <option value="11" >11</option>
  <option value="12" >12</option>
</select>
-->
Min
<select name="difmin">
  <option value="1" selected="selected">1</option>
  <option value="2" >2</option>
  <option value="3" >3</option>
  <option value="4" >4</option>
  <option value="5" >5</option>
  <option value="6" >6</option>
  <option value="7" >7</option>
  <option value="8" >8</option>
  <option value="9" >9</option>
  <option value="10" >10</option>
  <option value="11" >11</option>
  <option value="12" >12</option>
</select>
Max
<select name="difmax">
  <option value="1" selected="selected">1</option>
  <option value="2" >2</option>
  <option value="3" >3</option>
  <option value="4" >4</option>
  <option value="5" >5</option>
  <option value="6" >6</option>
  <option value="7" >7</option>
  <option value="8" >8</option>
  <option value="9" >9</option>
  <option value="10" >10</option>
  <option value="11" >11</option>
  <option value="12" >12</option>
</select>
</tr>
<tr><td>
Number Of Songs:
</td>
<td>
<select name="songcount">
  <option value="1" selected="selected">1</option>
  <option value="2" >2</option>
  <option value="3" >3</option>
  <option value="4" >4</option>
  <option value="5" >5</option>
  <option value="6" >6</option>
  <option value="7" >7</option>
  <option value="8" >8</option>
  <option value="9" >9</option>
  <option value="10" >10</option>
</select>
</td></tr>
<tr colspan=2><td colspan=2 align=center>
<input type="checkbox" name="legg" value="leg"> Include Leggendaria Charts
</td></tr>
<tr colspan=2><td colspan=2 align=center>
<input type="submit" value="Draw!" />
</td></tr>
</table>
</form>
</center>
</body>
</html>