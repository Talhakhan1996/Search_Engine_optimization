<?php
$con=mysql_connect('localhost','root','');

$db=mysql_select_db('masroor',$con);
//$btn="Save";
//$editpic="";
include('functions.php');

/*if(isset($_POST['Save']))
{
	$name=$_POST['txtname'];
	$catid=$_POST['category'];
	$pic=$_FILES['pic']['name'];
	if($pic!="")
	{
	//upload the picture
	$newfile=rand()*1200;
	$ext=strrchr($pic,".");
	$newpic=$newfile.$ext;
	save($_FILES['pic'],"","images/");
	rename("images/".$pic,"images/".$newpic);
	}
	$sql="insert into subcategory (id,name,categoryid,pic) values('','$name','$catid','$newpic')";
	mysql_query($sql);
	
	echo "<script>alert('Record Saved'); 	
	window.location='subcategory.php';</script>";	
}
if(isset($_GET['del']))
{
	$del=$_GET['del'];
	$sql="select pic from subcategory where id=$del";
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
		$delpic=mysql_result($result,0,'pic');
	@@unlink("images/".$delpic);
	}

	$sql="delete from subcategory where id=$del";
	mysql_query($sql);
	
	echo "<script>alert('Record Deleted'); 	
	window.location='subcategory.php';</script>";	
}
if(isset($_GET['edit']))
{
	$edit=$_GET['edit'];
	echo $sql="select * from subcategory  where id=$edit";
	$result=mysql_query($sql);
	while($rs=mysql_fetch_array($result))
	{
	$editname=$rs['name'];	
	$editpic=$rs['pic'];
	$editcatid=$rs['categoryid'];
	}
	$btn="update";
}
if(isset($_POST['update']))
{
	$name=$_POST['txtname'];
	$categoryid=$_POST['category'];
	$pic=$_FILES['pic']['name'];
	if($pic!="")
	{
	//upload the picture
	$newfile=rand()*1200;
	$ext=strrchr($pic,".");
	$newpic=$newfile.$ext;
	save($_FILES['pic'],"","images/");
	rename("images/".$pic,"images/".$newpic);
	@@unlink("images/".$editpic);
	$sql="update subcategory set name='$name',categoryid='$categoryid',pic='$newpic' where id=$edit";
	}
	else
	{
		$sql="update subcategory set name='$name',categoryid='$categoryid' where id=$edit";	
	}

	mysql_query($sql);
	
	echo "<script>alert('Record updated'); 	
	window.location='subcategory.php';</script>";	
}
*/


?>
<!--<form method="post" enctype="multipart/form-data">
<div id="myform">
<ul>
<li>Select Category</li>
<li>
<select name="category">-->
<?php
/*$sql="select * from category";
$result=mysql_query($sql);
while($rs=mysql_fetch_array($result))
{
$catid=$rs['id'];
$catname=$rs['name'];
if($catid==$editcatid)
{
$sel="selected";	
}
else
{
$sel="";	
}
echo "<option $sel value='$catid'>$catname</option>";
}*/
?>
<!--</select>
</li>
<li>Name</li>
<li><input type="text" name="txtname" value="<?php //echo $editname;?>" /></li>
<li>Picture</li>
<li><input type="file" name="pic" />
</li>
<li>click here to save</li>
<li><input type="submit" name="<?php //echo $btn;?>" value="<?php //echo $btn;?>" /></li>

</ul>
</div>
</form>-->

<form>
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
$limit=3;
$sql="select count(*) from subcategory";
$resultcount=mysql_query($sql);
if(mysql_num_rows($resultcount)>0)
{
$total=mysql_result($resultcount,0,0);	// row and colum
}				  
$pager=Pager::getPagerData($total,$limit,$page); // static class from function file

$offset=$pager->offset;
$limit=$pager->limit;
$page=$pager->page;
$tp=$pager->numPages;

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
	
	echo "<tr><td>$id</td><td>$name</td><td>$categoryid</td><td><img src='images/$pic' width=50 height=50></td><td><a href='subcategory.php?edit=$id'>Edit</a> 	<a href='#' onclick=confirmdel('subcategory.php?del=$id')>Delete</a></td>    </tr>";
}//end while
echo "<tr><td colspan=4>";

for($p=1;$p<=$tp;$p++) // for pagination
{
echo "<a href='subcategoryPage.php?page=$p'>$p</a>&nbsp;&nbsp;&nbsp;&nbsp;";	
}
echo "</td></tr>";
	echo "</table>";
?>

<script>
function confirmdel(url)
{
	if(confirm('Are You Sure to Delete record'))
	{
window.location=url;	
	}
}
</script>