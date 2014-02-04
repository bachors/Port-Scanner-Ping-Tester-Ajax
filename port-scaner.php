<form method="post" >
	<input type="text" class="putin" name="domain" title="Masukan Domain atau IP address Target" placeholder="Domain / IP" required/>
	<input type="submit" value="Scan" />
</form>

<?php
	if(!empty($_POST['domain'])) {
		$ports = array(21, 22, 23, 25, 53, 80, 110, 1433, 3306, 8080);
		$results = array();
		foreach($ports as $port) {
			if($pf = @fsockopen($_POST['domain'], $port, $err, $err_string, 1)) {
				$results[$port] = true;
				fclose($pf);
			} 
			else {
			$results[$port] = false;
			}
		}
		foreach($results as $port=>$val) {
			$prot = getservbyport($port,"tcp");
			echo "Port $port ($prot): ";
			if($val) {
				echo "<span style=\"color:green\">Buka</span><br/>";
			}
			else {
				echo "<span style=\"color:red\">Tutup</span><br/>";
			}
		}
	}
?>
