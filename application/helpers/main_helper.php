
<?php

function www_meta($meta = null)
{	if(is_array($meta)) $meta = (object)$meta;

	$esc_description = htmlspecialchars(isset($meta->description) ? $meta->description : "");
	$esc_keywords = htmlspecialchars(isset($meta->keywords) ? $meta->keywords : "");
	if(isset($meta->keywords) && $meta->keywords === false) $esc_keywords = false;
	if(isset($meta->description) && $meta->description === false) $esc_description = false;
    $esc_robots = isset($meta->robots) ? $meta->robots : true;

	$icon = isset($meta->favicon) ? $meta->favicon : 'favicon.png';

	$meta_keywords = $esc_keywords === false ? '' : '<meta name="keywords" content="'.$esc_keywords.'">';
        $meta_robots = $esc_robots === false ? '<meta name="robots" content="noindex, nofollow">' : '<meta name="robots" content="index, follow">';
	$meta_description = $esc_description === false ? '' : '<meta name="description" content="'.$esc_description.'">';
		
	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]".strtok($_SERVER["REQUEST_URI"],'?');
	if(isset($meta->canonical)) $actual_link = $meta->canonical;

	echo <<<html
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
$meta_description
$meta_keywords
$meta_robots
<link rel="shortcut icon" type="/image/x-icon" href="$icon">
<link rel="canonical" href="$actual_link" />
html;
}


function format_development_url ($path = null, $transform = true)
{
    $rs = preg_replace('#(.*)\.(v\d+?)\.(js|css)#', '$1.$3?$2', $path);
	return $rs;
	// if ($transform && defined('ENVIRONMENT') && ENVIRONMENT == 'production') {
	// 	return format_cdn_url( $path );
	// }
	// else if (ENVIRONMENT == 'productionXXX') {
	// 	$rs = preg_replace('#(.*)\.(v\d+?)\.(js|css)#', '$1.$3?$2', $path);
	// 	if ((substr($rs, 0, 4) == '/cd/') || ((substr($rs, 0, 8) == '/assets/'))) {
	// 		$num = (crc32($rs) % 4) + 1;
	// 		if (www_is_clozette())
	// 			$rs = 'http://static'. $num. '.clozette.co'. $rs;
	// 		else 
	// 			$rs = 'http://static'. $num. '.id.clozette.co'. $rs;
	// 	}
		
	// 	return $rs;
	// }
	// else {
	// 	$rs = preg_replace('#(.*)\.(v\d+?)\.(js|css)#', '$1.$3?$2', $path);
	// 	return $rs;
	// }
}

function format_cdn_url($path = null)
{
	$cdn = '//cdn-path-here';
	return empty($path) ? $cdn : $cdn .'/'. ltrim($path, '/');
}
