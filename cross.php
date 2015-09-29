<html>
<head>
<title></title>
<body>
<style type=”text/css”>


h3:target {
	color: white;
	background: #f60;
}
</style>
<script>
var oldid = null;
var oldcolor = null;

function highlightLine(id) {
    if (oldid != null){
       document.getElementById(oldid).style.color = oldcolor;
    }
    oldcolor= document.getElementById(id).style.color;
    oldid = id;
    document.getElementById(id).style.color = 'red';
}
</script>
<?php

/*see:
http://www.w3schools.com/php/php_file_upload.asp
for details on file upload using php.
*/
$target_dir = "uploads/";
$target_file = $target_dir. basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 0;

if(isset($_POST["submit"])) 
{
   
        $uploadOk = 1;
  }

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
   move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file); 
    
}


$lineno=1;
echo "<pre>";
$cross = array();
$data = array();
$file = fopen($target_file,"rb");
while (($line = fgets($file))!= NULL){
   $data[$lineno] = $line; 
   $theWords =str_word_count($line, 1);
   for ($i=0;$i<count($theWords);$i++){
      $word = $theWords[$i];
      if (!isset($cross[$word])){
         $cross[$word] = array();      
      }
      array_push($cross[$word],$lineno);
   }
$lineno++;
}

/* Output the cross reference Table */
$len = count($cross);
foreach ($cross as $key => $val){
   echo $key.' '; 
   $len1 = count($val);
   for ($j=0;$j<$len1;$j++){
       echo '<a href="#'.$val[$j].'" onclick='.'"highlightLine(';
       echo "'".$val[$j]."')".'"> ';  
       echo $val[$j].'</a> ';
       }
  echo "<br>";
}
$len = count($data);
for ($i=1;$i<$len;$i++){
   /* output an anchor */
   echo '<a name="'.$i.'" id='.'"'.$i.'">'.$data[$i].'</a>';
} 
echo "</pre>";    
?>
</body>
</html>
