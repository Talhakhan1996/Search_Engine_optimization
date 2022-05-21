 <?php
	$conn=mysql_connect('localhost','root','');
	mysql_select_db('searchengine',$conn);
	include('admin/functions.php');
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search Engine 2</title>

<style>body {
        background: #555 url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAB9JREFUeNpi/P//PwM6YGLAAuCCmpqacC2MRGsHCDAA+fIHfeQbO8kAAAAASUVORK5CYII=);
        font: 13px 'Lucida sans', Arial, Helvetica;
        color: #eee;
        text-align: left;
    }
    
    a {
        color: #ccc;
    }
	form-wrapper {
		width: 450px;
        padding: 15px;
        margin: 150px auto 50px auto;
        background: #444;
        background: rgba(0,0,0,.2);
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border-radius: 10px;
        -moz-box-shadow: 0 1px 1px rgba(0,0,0,.4) inset, 0 1px 0 rgba(255,255,255,.2);
        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.4) inset, 0 1px 0 rgba(255,255,255,.2);
        box-shadow: 0 1px 1px rgba(0,0,0,.4) inset, 0 1px 0 rgba(255,255,255,.2);
    }
	.form-wrapper input {
        width:330px ;
        height: 20px;
        padding: 10px 5px;
        float: left;    
        font: bold 15px 'lucida sans', 'trebuchet MS', 'Tahoma';
        border: 0;
        background: #eee;
        -moz-border-radius: 3px 0 0 3px;
        -webkit-border-radius: 3px 0 0 3px;
        border-radius: 3px 0 0 3px;      
    }
	.form-wrapper button {
		overflow: visible;
        position: relative;
        float: left;
        border: 0;
        padding: 0;
        cursor: pointer;
        height: 40px;
        width: 110px;
        font: bold 15px/40px 'lucida sans', 'trebuchet MS', 'Tahoma';
        color: #fff;
        text-transform: uppercase;
        background: #d83c3c;
        -moz-border-radius: 0 3px 3px 0;
        -webkit-border-radius: 0 3px 3px 0;
        border-radius: 0 3px 3px 0;      
        text-shadow: 0 -1px 0 rgba(0, 0 ,0, .3);
    }   
      
    .form-wrapper button:hover{		
        background: #e54040;
    }
	.form-wrapper button:before {
        content: '';
        position: absolute;
        border-width: 8px 8px 8px 0;
        border-style: solid solid solid none;
        border-color: transparent #d83c3c transparent;
        top: 12px;
        left: -6px;
    }
    
    .form-wrapper button:hover:before{
        border-right-color: #e54040;
    }
    
    .form-wrapper button:focus:before{
        border-right-color: #c42f2f;
    }    
    
    .form-wrapper button::-moz-focus-inner {
        border: 0;
        padding: 0;
    }	


 </style>

<script type = "text/javascript">
	document.getElementsByName("txtsearch").value = $_SESSION['mysearch'];
</script>

</head>

<body>

<form class="form-wrapper cf" method="get">
<table>
  	<tr><td align="left"><input type="text"  name="txtsearch" placeholder="Search here..." required></td>
     <td><button type="submit"  name="submit"> Search</button></td>
    <td></td>
    </tr>
	 
</table>     
</form>

<div class="byline"><p><a href="http://speckyboy.com/2012/02/15/how-to-build-a-stylish-css3-search-box/"></a><a href="http://thecodeblock.com/search-box-tutorials-using-css3-jquery/"></a></p></div>

</body>
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
$sql="select count(*) from sites";
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

		if(isset($_GET['submit']))
			{
				$keywords=$_GET['txtsearch'];
				$sql="select * from sites where site_keywords like '%$keywords%' ";
				}
else
{
echo $sql="select * from sites limit $offset,$limit";
}


				$result=mysql_query($sql) or die(mysql_error());
					
					while($rs=mysql_fetch_array($result))
						{
							$title=$rs['site_title'];
							$link=$rs['site_link'];
							$keywords=$rs['site_keywords'];
							$description=$rs['site_description'];
							
							echo"<tr><td><h2>$title</h2>
								<a href='$link'>$link</a>
								<p>$description</p></td></tr>";
						}

			for($p=1;$p<=$tp;$p++) // for pagination
{
echo "<a href='page2.php'=$p'>$p</a>&nbsp;&nbsp;&nbsp;&nbsp;";	
}


?>
</html>