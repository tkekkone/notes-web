<?php
if(isset($_GET['page']))
{
	$onlyfile = basename($_GET['page']);
	include("pages/".filter_var($onlyfile, FILTER_SANITIZE_STRING));
	exit();
}
echo "<!DOCTYPE html>\n<html>\n<head>\n";
echo "<link rel=\"stylesheet\" href=\"style.css\">\n";
echo "<script src=\"https://cdn.jsdelivr.net/npm/marked/marked.min.js\"></script>\n";
include ("header.html");
echo "</head>\n";
echo "<body>\n";
echo "<div id=\"main\">\n<div id=\"navigation\">";
$files = glob('pages/*.md');
foreach($files as $filename)
{
	$justfilename = basename($filename);
	$displayfilename = substr($justfilename, 0, -3);
	echo "\n<a class=\"pagelinks\" href=# onClick=\"getMarkDown('".$justfilename."')\">".$displayfilename."</a><br>"; 
}
echo "\n</div>\n</div>\n";
include("body.html");
echo "<footer>";
include("footer.html");
echo "</footer>\n";
echo "</body>\n";
echo "</html>";
?>
