<?php
	echo "はてなブックマーク".$result["me"];
	$i = $result["i"];
	for($j=0;$j<$i;$j++){
		$k = $j+1;
		echo "$k:".$result["title"]["$j"];
		echo $result["key"]["$j"];
	}
?>