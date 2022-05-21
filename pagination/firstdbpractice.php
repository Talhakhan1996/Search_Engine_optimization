<?php 
$con=mysql_connect('localhost','root','');

$db=mysql_select_db('jamal',$con);

$sql="select * from products";

$result=mysql_query($sql);

echo "<table width=70% border=2>";
echo "<tr><th>Id</th><th>Name</th><th>Price</th><th>Details</th>			<th>Categoryid</th><th>Subcatgoryid</th></tr>";

while($rs=mysql_fetch_array($result))
{
$id=$rs['id'];
$name=$rs['name'];
$price=$rs['price'];
$details=$rs['details'];
$categoryid=$rs['categoryid'];
$subcategoryid=$rs['subcategoryid'];
echo "<tr><td>$id</td><td>$name</td><td>$price</td><td>$details</td><td>$categoryid</td><td>$subcategoryid</td></tr>";
}
echo '</table>';
?>