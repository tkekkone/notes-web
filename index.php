<?php
if(isset($_GET['page']))
{
	$onlyfile = basename($_GET['page']);
	$path="pages/".filter_var($onlyfile, FILTER_SANITIZE_STRING);
	error_log($path);	
	if(file_exists($path))
	{
		include($path);
	}
	exit();
}
echo "<!DOCTYPE html>\n<html>\n<head>\n";
echo "<link rel=\"stylesheet\" href=\"style.css\">\n";
echo "<script src=\"https://cdn.jsdelivr.net/npm/marked/marked.min.js\"></script>\n";
include ("header.html");
echo "</head>\n";
echo "<body>\n";
echo "<div id=\"main\">\n<div id=\"navigation\">";
//$files = glob('pages/*.md');
$files = listdir_by_date('pages/', ".md");
foreach($files as $filename)
{
	$justfilename = basename($filename);
	$displayfilename = str_replace("_", " ", substr($justfilename, 0, -3));
	echo "\n<a class=\"pagelinks\" href=# onClick=\"getMarkDown('".$justfilename."')\">".$displayfilename."</a><br>"; 
}
echo "\n</div>\n";
include("body.html");
echo "</div>";
echo "<footer>";
include("footer.html");
echo "</footer>\n";
echo "</body>\n";
echo "</html>";



function listdir_by_date($path, $filetype){
    $dir = opendir($path);
    $list = array();
    while($file = readdir($dir)){
        if (endsWith($file, $filetype) and $file != '.' and $file != '..'){
            $ctime = filemtime($path . $file) . ',' . $file;
            $list[$ctime] = $file;
        }
    }
    closedir($dir);
    krsort($list);
    return $list;
}

function endsWith($string, $endString) 
{ 
  $len = strlen($endString); 
  if ($len == 0) { 
    return true; 
  } 
  return (substr($string, -$len) === $endString); 
} 

?>
