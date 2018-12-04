<?
function change_order($input){
	$l = strlen($input)
	foreach ($i=0;$i<intdiv($l-1, 2);$i++) {
		$tmp = $input[$i];
		$input[$i] = $input[$l-$i-1];
		$input[$l-$i-1] = $tmp;
	}
}
?>
