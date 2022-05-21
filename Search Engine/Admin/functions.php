<?php 



class Pager
   { 
       function getPagerData($numHits, $limit, $page)	//numhits = total number of records ...
       { 
           $numHits  = (int) $numHits; 					//total number of records
           $limit    = max((int) $limit, 1); 		
           $page     = (int) $page; 
           $numPages = ceil($numHits / $limit); 

           $page = max($page, 1); 
           $page = min($page, $numPages); 

           $offset = ($page - 1) * $limit; 				//offset =  initial value, limit = final value ...
           $ret = new stdClass; 
           $ret->offset   = $offset; 
           $ret->limit    = $limit; 
           $ret->numPages = $numPages; 
           $ret->page     = $page; 						//page = current page ...
           return $ret; 
       } 
   }
   
 /* Captcha */
function watermarkImage($SourceFile, $WaterMarkText, $DestinationFile)
 {
   list($width, $height) = getimagesize($SourceFile);
   $image_p = imagecreatetruecolor($width, $height);
   $image = imagecreatefromjpeg($SourceFile);
   imagecopyresampled($image_p, $image, 00, 0, 0, 0, $width, $height, $width, $height);
//   $black = imagecolorallocate($image_p, 172, 186, 144);
   $black = imagecolorallocate($image_p, 150, 165, 255);
   $font='timesi.ttf';
   $font_size = 32;
  //setting text 
   imagettftext($image_p, $font_size,0,25, 103, $black, $font, $WaterMarkText);
   if ($DestinationFile<>'') {
      imagejpeg ($image_p, $DestinationFile,100);
   } else {
      header('Content-Type: image/jpeg');
      imagejpeg($image_p, null, 100);
   };
  // imagedestroy($image);
//  echo "<img src=$SourceFile><br>";
//set image size and display
   echo "<img src=$DestinationFile width=150 height=50>";
 //  imagedestroy($image_p);
};

function getCountData($table,$exp,$id)
{
$sql="select count(*) from $table where $exp=$id";
$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
	$data=mysql_result($result,0,0);
	}
	return $data;
}

function getCount($id)
{
echo "<script>alert('data');</script>";
echo $sql="select count(*) from subcategories where categid=$id";
$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
	$data=mysql_result($result,0,0);
	}
	return $data;
}
function viewDataPathPage($query,$field,$link,$path,$fnames,$sql,$limit,$page,$gname)
{
$fields=Array();
//$sql="select count(*) from products";
$result = mysql_query($sql); 

//TOTAL RECORDS
$total = mysql_result($result, 0, 0);//GET THE FIRST ROW OF COUNT 
$pager  = Pager::getPagerData($total, $limit, $page); 
    $offset = $pager->offset; //start of record 
    $limit  = $pager->limit; //end of records
    $page   = $pager->page; 
$query=$query." limit $offset,$limit";	
$result=mysql_query($query);

	if($field=='*')
	{
		$nf=mysql_num_fields($result);
		for($i=0;$i<$nf;$i++)
		{
		$field=mysql_field_name($result,$i);
		$fields[$i]=mysql_field_name($result,$i);
		//code for image 
		//end of code for image 
		echo "<td class='style3'>$fnames[$i]</td>";

		}
	echo "<td colspan=2 align=center>Action </td></tr>";
if(mysql_num_rows($result)>0)
{
	while ($rs=mysql_fetch_array($result))
	{
	$id=$rs[0];
	echo"<tr>";
	$gf=$gname[4];
	$fc=0;
	foreach($fields as $f )
	{
		if($f!="id")
		{
			if($f=="pic" || $f=="pic1")
			{
echo "<td><img src='$path/$rs[$f]' width=60 height=60></td>";
			}
			else
			{
/*
			foreach($gf as $fn)
			{
			if($fc==$fn)
			getname(
			}
			*/
		echo "<td>$rs[$f]</td>";
			}
		}
		else
		{
		echo "<td>$rs[$f]</td>";
		}
		$fc++;
	}//end foreach

	
	echo "<td><a href=control_panel.php?mode=$link&eid=$id>Edit</a></td><td><a href=control_panel.php?mode=$link&did=$id>Delete</a></td></tr>";
 }//end while
}//end num_rows
//code for paging here 
if ($total>0)
{
echo "<table border=0 align=center><TR><TD COLSPAN=5 style='color:blue; font:vardana;' >";	
	if ($page == 1)
	{
//		echo "1 "; 
	} 
    else
    {
    	echo "<a href=\"control_panel.php?mode=$link&page=" . ($page - 1) . "&limit=$limit\" style='color:blue;'>Previous</a>";
		
    } 

    for ($i = 1; $i <= $pager->numPages; $i++) 
    { 
        if ($i == $pager->page) 
        {
			echo "&nbsp;".$i."&nbsp;";
		}
        else
        { 
            echo "<a href=\"control_panel.php?mode=$link&page=$i&limit=$limit\" style='color:blue;'>&nbsp;$i&nbsp;&nbsp;</a>";
        }
    } //end for 
$last=$pager->numPages;
    if ($page == $pager->numPages) //if last page 
    {
	}
    else //show NEXT 
    {
        echo " <a href=\"control_panel.php?mode=$link&page=" . ($page + 1) ."&limit=$limit\" style='color:blue;' >Next</a>&nbsp;<a href=\"control_panel.php?mode=$link&page=" . ($last) . "&limit=$limit\" style='color:blue;'>Last</a></td></tr></table>";
    } 
}//end if (total)
echo "</table>";
}
}//end function 

function viewData1($query,$field,$link)
{
echo"<table align='center' border=1 width='600'>";
$result=mysql_query($query);
if(mysql_num_rows($result)>0)
{
	while ($rs=mysql_fetch_array($result))
	{
			echo"<tr>";
	foreach($field as $f)
	{
		echo "<td>$f</td>";
	}
		echo "</tr>";
	$id=$rs[0];
	echo"<tr>";
	foreach($field as $f)
	{
		if($f!="id")
		{
			if($f!="image")
			{
				if($f=='catid')
				{
					$catid=$rs[$f];
					$catid=getname('category','name','id',$catid);
				echo "<td>$catid</td>";					
				}
				else
				{
		echo "<td>$rs[$f]</td>";
				}
			}
			else
			{
				$img=$rs[$f];
			echo "<td><img src='image/$img' width=50 height=50></td>";
			}
		}
		else
		{
				echo "<td>$rs[$f]</td>";	
		}
	}//end foreach
	
//	echo "<td><a href=control_panel.php?mode=$link&eid=$id>Edit</a></td><td><a href=control_panel.php?mode=$link&did=$id>Delete</a></td></tr>";
	}//end  while
 }//end num_rows
 else
{
echo "<b align=center>NO  RECORD  FOUND</b>";
}
echo "</table>";
}

function viewDataPath($query,$field,$link,$path,$fnames)
{
$fields=Array();
$result=mysql_query($query);
if($field=='*')
	{
		$nf=mysql_num_fields($result);
		for($i=0;$i<$nf;$i++)
		{
	$field=mysql_field_name($result,$i);
	$fields[$i]=mysql_field_name($result,$i);
	//code for image 
	//end of code for image 
	echo "<td class='style3'>$fnames[$i]</td>";

	}
	echo "<td colspan=2 align=center class='style3'>Action </td>";
if(mysql_num_rows($result)>0)
{
	while ($rs=mysql_fetch_array($result))
	{
		$id=$rs[0];
	echo"<tr>";
	
	foreach($fields as $f )
	{
		if($f!="id")
		{
			if($f=="pic" || $f=="pic1")
			{
echo "<td><img src='$path/$rs[$f]' width=60 height=60></td>";
			}
			else
			{
		echo "<td>$rs[$f]</td>";
			}
		}
		else
		{
		echo "<td>$rs[$f]</td>";
		}
	}

	
	echo "<td><a href=control_panel.php?mode=$link&eid=$id>Edit</a></td><td><a href=control_panel.php?mode=$link&did=$id>Delete</a></td></tr>";
			}//end else
	}
}
}
function viewData($query,$field,$link)
{
echo"<table class='tabsearch' align='center' width='400'>";
$result=mysql_query($query);
if(mysql_num_rows($result)>0)
{echo "<tr>";
	foreach($field as $f)
	{
	echo "<td>$f</td>";
	}
	echo "</tr>";

	while ($rs=mysql_fetch_array($result))
	{

	$id=$rs[0];

	$id=$rs[0];
	echo "<tr><td colspan=3><hr></td></tr>";
	echo "<tr>";
	foreach($field as $f)
	{
		if($f!="id")
		{
			if($f!="image")
			{
		echo "<td>$rs[$f]</td>";
			}
			else
			{
				$img=$rs[$f];
			echo "<td><img src='image/$img' width=50 height=50></td>";
			}
		}
	}
	
	echo "<td><a href=control_panel.php?$link&eid=$id>Edit</a></td><td><a href=control_panel.php?mode=$link&did=$id>Delete</a></td></tr>";
	}
 }
 else
{
echo "<b align=center>NO  RECORD  FOUND</b>";
}
echo "</table>";
}
function viewDropDownSub($table,$id,$name,$catid,$exp,$sub)
{
echo $sql="select * from $table where $exp='$sub'";
$result=mysql_query($sql);
	while($rs=mysql_fetch_array($result))
	{
	$cid=$rs[$id];
	$cname=$rs[$name];

	if($catid==$cid)
	{
	$sel="selected";
	}
	else
	{
	$sel="";
	}
	echo "<option $sel value=$cid>$cname</option>";
	}

}
function getname($table,$field,$id,$val)
{
$name="";
$sql="select $field from $table where $id='$val'";
$result=mysql_query($sql);
if((!$result==''))
{
if(mysql_num_rows($result)>0)
	{
	$name=mysql_result($result,0,$field);
	}

}
return $name;
}

function GenerateCode ($num, $mach) {
		
	$let = array('Q', 'q', 'W', 'w', 'E', 'e', 'R', 'r', 'T', 't', 'Y', 'y', 'U', 'u',
			  	 'A', 'a', 'S', 's', 'D', 'd', 'F', 'f', 'G', 'g', 'H', 'h', 'J', 'j', 'K', 'k',
				 'Z', 'z', 'X', 'x', 'C', 'c', 'V', 'v', 'B', 'b', 'N', 'n', 'M', 'm', '0', '1',
				 '2', '3', '4', '5', '6', '7', '8', '9');
				 
	srand((float) microtime() * 10000000);
		for ($i=0;$i<$mach;$i++)
		{
			unset ($code);
			$ids = array_rand ($let, $num);
				foreach ($ids as $val)
					$code .=$let[$val];
			$return=strtoupper($code);
		}
		return $return;
	}//end GenerateCode

function save($pic,$oldfile,$path)
{
$upload_dir =$path;            
$size_bytes = 9388608;

$extlimit = "yes";
$limitedext = array(".gif",".jpg",".GIF",".JPG",".png",".jpeg",".swf",".png",".Png",".PNG",".txt",".doc",".docx");
          if (!is_dir("$upload_dir")) { 
         die ("<center>The directory <b>($upload_dir)</b> doesn't exist"); 
          } 
          if (!is_writeable("$upload_dir")){ 
             die ("<center>The directory <b>($upload_dir)</b> is NOT writable, Please CHMOD (777)"); 
          }
               	$file =  $oldfile; 
              if(file_exists($upload_dir.$file)){ 
				@unlink($upload_dir."/$file");//delete the previous file
              }
              $size = $pic['size']; 
              if ($size > $size_bytes) 
              { 
                    $kb = $size_bytes / 1024; 
                    echo "<center>File Too Large. File must be <b>$kb</b> KB. <br>�<a href=\"$_SERVER[PHP_SELF]\">back</a>"; 
                    exit(); 
              } 
              $ext = strrchr($pic['name'],'.'); 
              if (($extlimit == "yes") && (!in_array($ext,$limitedext))) { 
                    echo("<center>Wrong file extension. ");
                    echo "<br><a href='javascript:history.go(-1)'>Click here to go back</a>"; 
                    exit(); 
              } 
              $filename =  $pic['name']; 
              if(file_exists($upload_dir.$filename)){ 
                    echo "<center>A image with the name <b>$filename </b>already exists change the name of your Image. <br>�<a href=\"$_SERVER[PHP_SELF]\">back</a>"; 
                    exit(); 
              }  
              if (move_uploaded_file($pic['tmp_name'],$upload_dir.$filename)) {
				  chmod($upload_dir.$filename, 0644);
              } 
                  else 
              { 
                  echo "<center>There was a problem saving your file.<br>please try again later <br>�<a href=\"$_SERVER[PHP_SELF]\">back</a>"; 
                   
              }
              
}
function save1($pic,$oldfile,$path)
{
$upload_dir =$path;            
$size_bytes = 288608;

$extlimit = "yes";
$limitedext = array(".gif",".jpg",".GIF",".JPG",".png",".jpeg","JPEG",".xls",".swf");
          if (!is_dir("$upload_dir")) { 
         die ("<center>The directory <b>($upload_dir)</b> doesn't exist"); 
          } 
          if (!is_writeable("$upload_dir")){ 
             die ("<center>The directory <b>($upload_dir)</b> is NOT writable, Please CHMOD (777)"); 
          }
               	$file =  $oldfile; 
              if(file_exists($upload_dir.$file)){ 
				@unlink($upload_dir."/$file");//delete the previous file
              }
              $size = $pic['size']; 
              if ($size > $size_bytes) 
              { 
                    $kb = $size_bytes / 1024; 
                    echo "<center>File Too Large. File must be <b>$kb</b> KB. <br>�<a href=\"$_SERVER[PHP_SELF]\">back</a>"; 
                    exit(); 
              } 
              $ext = strrchr($pic['name'],'.'); 
              if (($extlimit == "yes") && (!in_array($ext,$limitedext))) { 
                    echo("<center>Wrong file extension. ");
                    echo "<br><a href='javascript:history.go(-1)'>Click here to go back</a>"; 
                    exit(); 
              } 
              $filename =  $pic['name']; 
              if(file_exists($upload_dir.$filename)){ 
                    echo "<center>A image with the name <b>$filename </b>already exists change the name of your Image. <br>�<a href=\"$_SERVER[PHP_SELF]\">back</a>"; 
                    exit(); 
              }  
              if (move_uploaded_file($pic['tmp_name'],$upload_dir.$filename)) {
				  chmod($upload_dir.$filename, 0644);
              } 
                  else 
              { 
                  echo "<center>There was a problem saving your file.<br>please try again later <br>�<a href=\"$_SERVER[PHP_SELF]\">back</a>"; 
                   
              }
              
}
function hightlight($str, $keywords = '')
{
$keywords = preg_replace('/\s\s+/', ' ', strip_tags(trim($keywords))); // filter
 
$style = 'highlight';
$style_i = 'highlight_important';
 
/* Apply Style */
 
$var = '';
 
foreach(explode(' ', $keywords) as $keyword)
{
$replacement = "<span class='".$style."'>".$keyword."</span>";
$var .= $replacement." ";
 
$str = str_ireplace($keyword, $replacement, $str);
}
 
/* Apply Important Style */
 
$str = str_ireplace(rtrim($var), "<span class='".$style_i."'>".$keywords."</span>", $str);
 
return $str;
}
function viewDataSearch($txtsearch,$field,$link,$sql,$txtcountry)
{

//----------------

//GET THE TOTAL RECORDS:-
//-----------------------
$limit=10;
if($txtcountry=='')
{
$sqlcount="select count(*) from companies where name like '%$txtsearch%' or details like '%$txtsearch%' or keywords like  '%$txtsearch%' order by isfeatured,name" ;
}
elseif($txtsearch=='')
{
$sqlcount="select count(*) from companies where address like '%$txtcountry%' or details like '%$txtcountry%' or keywords like  '%$txtcountry%' or   city in (select id from city where name like '%$txtcountry%') or country in  (select id from country where id like '%$txtcountry%') order by isfeatured,name" ;

}
else
{
$sqlcount="select count(*) from companies where name like '%$txtsearch%' or details like '%$txtsearch%' or keywords like  '%$txtsearch%' or  city like (select id from city where name like '%$txtcountry%') or country like (select id  from country where name like '%$txtcountry%')  order by isfeatured,name" ;
	
}
//$sqlcount="select count(*) from companies where name like '%$txtsearch%' or details like '%$txtsearch%' or keywords like  '%$txtsearch%' ";
$result=mysql_query($sqlcount);
if(!($result==''))
{
$total=mysql_result($result,0,0);
if(isset($_GET['page']) || $_GET['page']!='')
{
$page=$_GET['page'];	
}

$pager=Pager::getPagerData($total,$limit,$page);
$offset=$pager->offset;//Starting of Page
$limit=$pager->limit;//Ending of Page
//$page=$pager->page;//Current Page
$offsetview=$offset;
$firstpage=1;//First Page
$totalnumpages=$lastpage=$pager->numPages;//Total and Last Page
$currentpage=$pager->page;//Current Page for more simplify coding
}
//$sql="select * from companies where name like '%$txtsearch%' or details like '%$txtsearch%' or keywords like  '%$txtsearch%' order by name limit $offset,$limit " ;
$sql=$sql." limit $offset,$limit";
/*$field[0]='id';
$field[1]='logopath';
$field[2]='name';
$field[3]='details';
$field[4]='compcat';
$field[5]='keywords';	
$field[6]='phone';	
$field[5]='keywords';	
*/
//PAGINATION (2):-

if(isset($_GET['txtsearch']) || isset($_GET['txtcategory']))
{
$width="585";
}
else
{
$width="574";
}
echo"<table class='border_box' border=0  style='' align='left' width='$width' cellspacing=0 cellpadding=0>";
echo "<tr><td width='$width' colspan=3 align=center bgcolor='#2269A0' class='Box_heading'><strong>Search Results</strong></td></tr>";
$result=mysql_query($sql);
if(!($result==''))
{
if(mysql_num_rows($result)>0)
{
	$c=0;
	while ($rs=mysql_fetch_array($result))
	{
		$c++;
		
	$id=$rs['id'];
	//echo "<tr><td colspan=3 valign=top><hr width=100%></td></tr>";
	foreach($field as $f)
	{
	echo "<tr>";
		if($f!="id")
		{
			if($f!="logopath")
			{
			if($rs[$f]=='')
			{
			$data='---';
			}
			else
			{
				if($f=='compcat')
				{
			$data=$rs[$f];					
			$data=getname('categories','categid','name',$data);
			$data=hightlight($data, $txtsearch);
			$f='Category';
				}
			if($f=='name')
				{
				$data=$rs[$f];
			//	$data=$data."....".$rs['phone'];
				$data=hightlight($data, $txtsearch);
				//$companyname=$data;
				}	
				if($f=='country')
				{
			$data=$rs[$f];					
			$data=getname('country','name','id',$data);
			$data=hightlight($data, $txtcountry);
			$f='Country';
				}
				elseif($f=='city')
				{
			$data=$rs[$f];					
			$data=getname('city','name','id',$data);
			$data=hightlight($data, $txtcountry);
			$f='City';
				}
				else
				{
			$data=$rs[$f];
			$data=hightlight($data, $txtsearch);
				}
			}
			if($f=='compcat')
			{
			$f="Category";	
			}
echo "<tr>
<td class='mainsearchbox' valign=top  align=left >$f</td>
<td class='mainsearchbox'  align=left border=0>$data</td>
</tr>";
			}
			else
			{
				$img=$rs[$f];
				$img=trim($img,' ');
				if($img=='')
				{
				$img="nopic.jpg";
				}
		echo "<td width=100 align=center valign=middle rowspan=16><table border=0><tr><td>
		<img src='images/$img' alt='$companyname' width=75 height=75></td></tr></table></td>";
			}
		}
		//echo "</td></tr></table>";
		echo "</tr>";
	}
	 /*if($c%2==0)
		{
echo "<tr><td colspan=7 align=center><hr></a></td></tr>";
		
		}
	*/
	echo "<td></td><td></td></tr></td></tr>";
	
	echo "<tr><td colspan=3 align=center width=580 style='border-bottom:#999 1px solid;'><span style='width:580;color:white;'><a class='main1' href=index.php?show=$link&vid=$id>View Details&nbsp;</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class='main1'  href=index.php?mode=claim&claimid=$id>Claim</a></span></td></tr>";
	}
 }
 	$search=$_GET['Search'];
  $txtsearch=$_GET['txtsearch'];
?>
 
 
 <tr>
    <td align="center" td colspan=3>

	
<?php
	
	
	
	
				$numlimit=$limit;
	
			if(true)
			{
			?>	


	<table border="0" >
	<tr>
	<td class="main">
<?php echo "Showing ".($offsetview+1)." to ".($offsetview+10)." of ".($totalnumpages*10); ?>&nbsp;&nbsp; | &nbsp;Page No
<?php
//$pg=$_GET['page'];
$url="txtsearch=$txtsearch&Search=Search&limit=10"; ?>
	<input type="hidden" name="Search" value="Search" />
    <input id="tgo" type='text' name='txtpage' class='' size='5' /></td>
	<td><input type='button' name='btn1page' value='Go' onclick="javascript:window.location='index.php?&<?php echo $_SERVER['QUERY_STRING'];?>&page='+document.getElementById('tgo').value+''" class='btn' />&nbsp;&nbsp;</td>
	</div>
	<td class='pagin'>
	
<?php
	if($total>0)
	
	
	//FOR PREVIOUS:-
	//--------------
	
	if($page==$firstpage)
	{
		//do nothing
	}
	else
	{
		if($totalnumpages>1)
		{
		echo
		"
		
		<!--FOR FIRST-->
		<!--=========-->
		
		 <a class='main' href=index.php?txtsearch=$txtsearch&Search=$search&page=$firstpage&limit=$limit>First</a>
		 
		 <!--FOR PREVIOUS-->
		 <!--============-->
		 
		 <a class='main' href=\"index.php?txtsearch=$txtsearch&Search=$search&page=".($currentpage-1)."&limit=$limit\">Previous</a>
		";
		}
	}
	
	//FOR NORMAL PAGINATION:-
	//-----------------------
	$cp=$currentpage;
	$tp=currentpage+5;
	if($cp<1)
		{
		$cp=1;
		}
		elseif($cp<5)
		{
		$cp=$cp+5;	
		}
		
	if($totalnumpages<$tp)
	{
		$tp=$totalnumpages;
	}
		
		
	for($i=$firstpage;$i<=($tp);$i++)
	{
		if($i==$currentpage)
		{
			echo "<span class='headermenu_heading'>".$i."</span>";
		}
		else
		{
			echo
			"
			<a class='main' href='index.php?txtsearch=$txtsearch&Search=$search&page=$i&limit=$limit'>$i</a>
			";
		}
	}
	
	if($page==$lastpage)
	{
		//do nothing
	}
	else
	{
			if($totalnumpages>1)
		{
		echo
		"
		
		<!--FOR NEXT-->
		<!--========-->
		
		 <a class='main' href=\"index.php?txtsearch=$txtsearch&Search=$search&page=".($currentpage+1)."&limit=$limit\">Next</a>
		 
		 <!--FOR LAST-->
		 <!--========-->
		 
		<a class='main' href=index.php?txtsearch=$txtsearch&Search=$search&page=$lastpage&limit=$limit>Last</a>
		";
		}
	}
	}
?>
</td>
</tr>
</table>
</td>
</tr>
<?php
}
//}//end if total>numlimit
else
{
echo "<tr><td><font color=#18619c>Your search did not match any business name / category.
  	Suggestions:</font><br>

 Make sure all words are spelled correctly.
 	<ul style='list-style:nonel;'>
 <li>Try more general keywords.</li>
 <li>Try different keywords.</li>
 <li>Try fewer keywords.</li>
 </ul>
</td></tr>";
}
echo "</table>";	
}



function viewDataQuery($query,$field,$link)
{
echo"<table border=0 align='center' width='600'>";
$result=mysql_query($query);
if(!($result==''))
{
if(mysql_num_rows($result)>0)
{
	while ($rs=mysql_fetch_array($result))
	{

	$id=$rs[0];
	echo "<tr><td colspan=3><hr></td></tr>";
	foreach($field as $f)
	{
	echo "<tr>";
		if($f!="id")
		{
			if($f!="pic")
			{
			if($rs[$f]=='')
			{
			$data='---';
			}
			else
			{
			$data=$rs[$f];
			}
echo "<tr><td class='tbsearch'  align=center border=0>$f</td><td   aligan=center border=0>$data</td></tr>";

			}
			else
			{
				$img=$rs[$f];
				if($img=='')
				{
				$img="nopic.jpg";
				}
		echo "<td width=200 rowspan=10><table border=0><tr><td><img src='images/$img' width=200 height=100></td></tr></table></td>";
			}
		}
		//echo "</td></tr></table>";
		echo "</tr>";
	}
	
	echo "<td><a href=index.php?mode=$link&vid=$id>View Details</a></td></tr></td></tr>";
	}
	
}}
 else
{
?>
<tr><td class='mainsearchheading' align=center><strong>No Record Found</strong></td></tr>
<?php

}
echo "</table>";
?>
<tr>
<td align="center" colspan="3"><a href="#" onClick="javascript:history.go(-1);" class="main"><font face="verdana" size="2"> <b> <- back ...</b></a></td>
</tr>
<?php
}

//
function forgetpass($memberid)
{
echo "<script>window.alert('calll');</script>";
if ($memberid!=''){

	
   //change this to your email.
//  $to=getname('tbl_accountinfo','email','userID',$memberid);
/*   	$emaiid=mysql_result(mysql_query("select email from tbl_accountinfo where userID='$memberid'"),0,0);
*/    
	$to = "nomisupersoft@gmail.com";
    $from = "supersoftz@gmail.com";
    $subject = "Test Email";
    $fileatt = "/root/Desktop/doc.pdf";
    $fileatttype = "application/pdf";
    $fileattname = "doc.pdf";
    //begin of HTML message
    $message = <<<EOF
	
<html>
  <body bgcolor="#DCEEFC">
<table class="referance" width="100%">
<tr><td> Your New password is 
EOF;
    $message1 = <<<EOF
,Please change your password first when you login.</td>
</tr>
</table>
	<br><br><br>
        <font size="1"<b><i> Note : this is System Generated Email......</b></font></i> <br><br><br><br><br><br>
        <font color="blue">Regards;</font> <br>
        <font color="blue"><b>Support Department</font> <br>
	<font color="blue"><b>AMAFHH Marketing </font> <br>
  </body>
</html>
EOF;

    $headers  = "From: $from\r\n";


   $headers .= "Content-type: text/html\r\n";
	$getnumber=getrandno();
    if (mail($to, $subject, $message.$getnumber.$message1, $headers))
	{
	echo "<script>alert('Your new password has been sent to your mobile no#. please check your sms to continue.');";
		    $sql="update members set pass='".md5($getnumber)."' where memberid='$memberid'"; 
			mysql_query($sql);
			
	}
else
	{

		echo "Message has Not been sent....!";
	}
}
}
?>