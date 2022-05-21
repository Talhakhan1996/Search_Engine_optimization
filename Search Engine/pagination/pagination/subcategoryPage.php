<?php
$con=mysql_connect('localhost','root','');

$db=mysql_select_db('masroor',$con);
//$btn="Save";
//$editpic="";
include('functions.php');
?>

<form method="get">
<input type="text" name="txtsearch" />
<input type="submit" name="search" value="Search" />
</form>

<?php
if(isset($_GET['page']))
{
$page=$_GET['page'];	
}
else
{
$page=1;//default	
}
$limit=2;
$sql="select count(*) from subcategory";
$resultcount=mysql_query($sql);
if(mysql_num_rows($resultcount)>0)
{
$total=mysql_result($resultcount,0,0);	// row and colum
}				  
$pager=Pager::getPagerData($total,$limit,$page); // static class from function file

$offset=$pager->offset;
echo $offset;
$limit=$pager->limit;
echo $offset;
$page=$pager->page;
echo $page;
$tp=$pager->numPages;
echo $tp;

if(isset($_GET['search']))
{
$txtsearch=$_GET['txtsearch'];	
$sql="select * from subcategory where name like '%$txtsearch%'";	
}
else
{
echo $sql="select * from subcategory limit $offset,$limit";
}
$result=mysql_query($sql);

echo "<table border=2 width=70%>";
echo "<tr><th>Id</th><th>Name</th><th>Categoryid</th><th>Pic</th><th>Action</th></tr>";

while($rs=mysql_fetch_array($result))
{
	$id=$rs['id'];
	$name=$rs['name'];
	$categoryid=$rs['categoryid'];
	$categoryid=getname("category","name","id",$categoryid);
	$pic=$rs['pic'];
	if($pic=="")
	{
	$pic="nopic.jpg";	
	}
	
	echo "<tr>
	<td>$id</td>
	<td>$name</td>
	<td>$categoryid</td>
	<td><img src='images/$pic' width=50 height=50></td><td><a href='subcategory.php?edit=$id'>Edit</a> 	
	<a href='#' onclick=confirmdel('subcategory.php?del=$id')>Delete</a></td>    
	</tr>";
}//end while
echo "<tr><td colspan=4>";

for($p=1;$p<=$tp;$p++) // for pagination
{
echo "<a href='subcategoryPage.php?page=$p'>$p</a>&nbsp;&nbsp;&nbsp;&nbsp;";	
}
echo "</td></tr>";
	echo "</table>";
?>

