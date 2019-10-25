<title><?php echo htmlentities($_title); ?></title>

<?php www_meta($meta); ?>

<?php
//Temporarily put time() to prevent cache
if(isset($_css)) {
	$_css_list=[];
	if(is_array($_css)) {
		foreach($_css as $k=>$v) {
			if(!in_array($v, $_css_list)) {
				echo '<link rel="stylesheet" type="text/css" media="all" href="'.$v.'">';
				$_css_list[]=$v;
			}
		}
	} else {
		if(!in_array($_css, $_css_list)) {
			echo '<link rel="stylesheet" type="text/css" media="all" href="'.$_css.'">';
			$_css_list[]=$_css;
		}
	}
}
?>

<?php
if(isset($_js)) {
	$_js_list=[];
	if(is_array($_js)) {
		foreach($_js as $k=>$v) {
			if(!in_array($v, $_js_list)) {
				if(strpos($v, '<script')!==false) {
					echo $v;
				} else {
					echo '<script type="text/javascript" src="'.$v.'"></script>';
				}
				$_js_list[]=$v;
			}
		}
	} else {
		if(!in_array($_js, $_js_list)) {
			echo '<script type="text/javascript" src="'.$_js.'"></script>';
			$_js_list[]=$_js;
		}
	}
}
?>
