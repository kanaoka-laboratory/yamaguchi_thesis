// get launch package from apk
function get_launch_package($apk){
	global $aapt;
	exec("$aapt dump xmltree '$apk' AndroidManifest.xml", $result);

	$launch_package = '';
	$package_name = '';
	$imax=count($result);
	$i=0;

	// search package name
	for(; $i<$imax; $i++){
		if(strpos($result[$i], 'A: package=') !== false ){
			$package_name = explode('"', $result[$i], 3)[1];
			break;
		}
	}
	if($package_name==='') return '';

	// search string 'android.intent.category.LAUNCHER'
	for($i++; $i<$imax; $i++){
		if(strpos($result[$i], 'android.intent.category.LAUNCHER')){
			$j = $i;
			break;
		}
	}
	// search activity
	// activity name form: "foo.bar.StartActivity" or ".LoginActivity"
	for($i--; $i>0; $i--){
		if(preg_match('/A: android:name\(0x\d{8}\)="(.*?)\.?[^\.]+?"/', $result[$i], $m))
			$launch_package = $m[1];
		elseif(strpos($result[$i], 'E: activity') !== false)
			break;
	}
	if($i===0 || $launch_package==='') $launch_package = $package_name;
	elseif($launch_package[0]==='.') $launch_package = $package_name.$launch_package;

	// output launch_package
	return $launch_package;
}