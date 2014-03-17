$ports = array(21, 22, 23, 25, 53, 80, 110, 1433, 3306, 8080); //Daftar port yang akan di scan / bisa disesuaikan
$results = array();
foreach($ports as $port) {
	if($pf = @fsockopen($_POST['domain'], $port, $err, $err_string, 1)) {
		$results[$port] = true;
		fclose($pf);
	} else {
		$results[$port] = false;
	}
}
foreach($results as $port=>$val) {
$sken = getservbyport($port,"tcp");
echo "Port $port (<span style=\"color:#3978f7\">$sken</span>): ";
if($val) {
	if($port==80){
	echo "<span style=\"color:#f361f5\">Ping Test</span> <a href='http://".$_POST['domain']."' target='blank'><span style=\"color:#26fd44\">Online</span></a><br/>";
	}else{
	echo "<span style=\"color:#26fd44\">Buka</span><br/>";
	}
}
else {
	if($port==80){
	echo "<span style=\"color:#f361f5\">Ping Test</span> <span style=\"color:#ee4444\">Offline</span><br/>";
	}else{
	echo "<span style=\"color:#ee4444\">Tutup</span><br/>";
	}
}
