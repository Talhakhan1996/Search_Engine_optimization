<?php
$conn=mysql_connect('localhost','root','');
mysql_select_db('searchengine',$conn);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin panel</title>
<style>body {
        background: #555 url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAB9JREFUeNpi/P//PwM6YGLAAuCCmpqacC2MRGsHCDAA+fIHfeQbO8kAAAAASUVORK5CYII=);
        font: 18px 'Lucida sans', Arial, Helvetica;
        color: #eee;
        text-align: left;
    }
    
    a {
        color: #ccc;
    }
	.cf:before, .cf:after{
      content:"";
      display:table;
    }
    
    .cf:after{
      clear:both;
    }

    .cf{
      zoom:1;
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
</head>

<body>
<img src="../images/admin-panel-header.jpg"/ width="500px">
	<form class="form-wrapper cf" method="get" enctype="multipart/form-data">
    	
        <ul>
        	<li>Title</li>
            <input type="text" name="txttitle" placeholder="Insert the title">
            <br>
            <br>
            <br>
            <br>
            <li>Link</li>
            <input type="text" name="txtlink" placeholder="Insert the link">
            <br>
            <br>
            <br>
            <br>
            <li>Keywords</li>
            <input type="text" name="txtkeyword" placeholder="Insert the keywords">          
            <br>
            <br>
            <br>
            <br>
            <li>Description</li>
            <input type="text" name="txtdescp" placeholder="Insert the description">
            <br>
            <br>
            <br>
            <br>
            <br>
            <button name="Insert" value="Insert">Insert</button>
        </ul>
            
    </form>
</body>

<?php
	if(isset($_POST['insert']))
	{
		$pagetitle=$_POST['txttitle'];
		$pagelink=$_POST['txtlink'];
		$sitekeyword=$_POST['txtkeyword'];
	 	$pagedescp=$_POST['txtdescp'];
		
		if($pagetitle== "" or $pagelink=="" or $sitekeyword=="" or  $pagedescp=="" )
			{
				print "<script>alert('plz fill all field')</script>";
				}
	 	$insertquery="insert into sites (site_title,site_link,site_keywords,site_description) values('$pagetitle','$pagelink','$sitekeyword','$pagedescp')";
		
		mysql_query($insertquery) or die(mysql_error());
		
		echo "<script>alert('record inserted')</script>";
		}
		 
		
		


?>
</html>