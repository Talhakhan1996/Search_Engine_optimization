 <?php
	$conn=mysql_connect('localhost','root','');
	mysql_select_db('searchengine',$conn);
 ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="project.css" rel="stylesheet" type="text/css"/>
<title>Search Engine</title>

<style>
	form ul{
		list-style:none;
		alignment-adjust:central;
	}
	form ul li
	{
		float:left;
		alignment-adjust:central;
		}	
</style>

</head>
<body>

	<h2>my Search Engine</h2>
 <form method="get">
	<ul>
		
		<li><input type="text" width="100px" name="txtsearch" placeholder="Search"></li>
		<li><input type="submit" name="submit" value="Search"></li><br>
	</ul>
 </form>

 <hr>
</body>
<?php
		if(isset($_GET['submit']))
			{
				$keywords=$_GET['txtsearch'];
				if($keywords=="")
				{ exit();}
				else
				{
				$select="select * from sites where site_keywords like '%$keywords%' ";
				$result=mysql_query($select) or die(mysql_error());
					
					while($rs=mysql_fetch_array($result))
						{
							$title=$rs['site_title'];
							$link=$rs['site_link'];
							$keywords=$rs['site_keywords'];
							$description=$rs['site_description'];
							
							echo"<h2>$title</h2>
								<a href='$link'>$title</a>
								<p>$description</p>";
						}
						}
			
			}
?>
</html>