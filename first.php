<?php
//error_reporting(0);

/*$name=$_GET["txt1"];
$Last=$_GET["txt2"];
$Email=$_GET["txt3"];
echo $name."<br>".$Last."<br>".$Email."<br>";*/
$n1=$_GET["num1"];
$n2=$_GET["num2"];
$rest=$n1/$n2;
echo $rest;
?>
<html>
<body>
<form method="get">
<ul>
<li><input type="text" name="txt1" placeholder="Enter Your Name"/></li>
<li><input type="text" name="txt2" placeholder="Enter Your Last Name"/></li>
<li><input type="text" name="txt3" placeholder="Enter Your Email Address"/></li>
<li><input type="submit" name="sub" value="GO"/></li>
</ul>
</form>
<form method="get">
<ul>
<li><input type="text" name="num1" placeholder="Enter Your Number"/></li>
<li><input type="text" name="num2" placeholder="Enter Your 2nd Number"/></li>
<li><input type="submit" name="sub1" value="GO"/></li>
</ul>
</form>
</body>
</html>