<?PHP
$secrets = array('Alice', 'Bob');
$dir='./tiny_url_file_server/';
$request;
foreach($_GET as $key => $value){
	if(strlen($value)==0){
		$request=$key;
	}
}
foreach($_POST as $key => $value){
	if(strlen($value)==0){
		$request=$key;
	}
}
function randStr($length = 144){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < $length; $i++) {
	$randstring .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randstring;
}
$secret;
if(isSet($_GET['secret'])){
	$secret=$_GET['secret'];
}
if(isSet($_POST['secret'])){
	$secret=$_POST['secret'];
}
if(isSet($request)){
	$file;
	$dh = opendir($dir);
	while (false !== ($filename = readdir($dh))) {
		$p=strpos(basename($filename), $request);
		// < 10 prevents hijaking and if you have more than 2147483647 files you have other problems.
		if( $p > -1 && $p < 10 ){
			$file=$filename;
			break;
		}
	}
	if(isSet($file)){
		header('Content-type: application/octet-stream');
		header('Content-Disposition: attachment; filename="' . basename($file) . '"');
		header('Content-Length: ' . filesize($dir.$file));
		//ob_clean();
		//flush();
		readfile($dir.$file);
		flush();
		exit();
	}else{
		http_response_code(404);
	}
}else if ( isSet($secret) && $_FILES['file']['tmp_name'] !='' ){
	if(!in_array($secret, $secrets)){
		http_response_code(403);
		exit();
	}
	$fn=1;
	$files = glob($dir. '*');
	if ($files){
		$fn = count($files)+1;
	}
	$length = 144-strlen('http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'?'.$fn.'_');
	$key = randStr($length);
	$target_Path = $dir.$fn.'_'.$key.'_'.preg_replace ('/[^\.a-zA-Z0-9]+/i', '_', basename($_FILES['file']['name']));
	move_uploaded_file( $_FILES['file']['tmp_name'], $target_Path );
	print($fn.'_'.$key);
}else{
	http_response_code(400);
}
?>
