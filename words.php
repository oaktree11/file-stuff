<?php
$myfile = fopen("input.txt", "r");
// Output one line until end-of-file
 $wcnt = array();
while(!feof($myfile)) {
  $line = fgets($myfile);
  $words = str_word_count($line, 1);
 
  for ($i=0;$i <count($words);$i++){
     $word = $words[$i];
//echo $word;
     if (!isset($wcnt[$word]))
        $wcnt[$word]=1;
     else
         $wcnt[$word] +=1;
  }
}
//echo count($wcnt);
foreach($wcnt as $word => $numWords) {
    echo "Num of Occurrences of $word =" . $numWords;
    echo "<br>";
}
fclose($myfile);
?> 

