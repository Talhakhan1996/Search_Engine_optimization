<?php
	session_start();
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Search Engine 1</title>

      <link rel="stylesheet" type="text/css"	$myValue = "<script>document.write(value)</script>";css" href="css/style.css">
      
	  <script type="text/javascript">
	  function myFunc() {
	  	var value = document.getElementByName("txtsearch").value;		
		
		<?php

			$_SESSION['mysearch'] = $myValue;
		?>	  
		
		alert( value );
	  }
      </script>

 
</head>

<body> <img src="images/seo-icon.png"/> 
<div id="image"/>
  <form class="form-wrapper cf" method="get">
    <input type="text" name="txtsearch" placeholder="Search here..." required>
    <button formaction="page2.php" type="submit" name="submit" onClick="myFunc()">Search</button>
</form>
  
  
</body>
</html>
