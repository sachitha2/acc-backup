<?php
// Before removing this file, please verify the PHP ini setting `auto_prepend_file` does not point to this.

if (file_exists('/home/anucentr/public_html/wp-content/plugins/wordfence/waf/bootstrap.php')) {
	define("WFWAF_LOG_PATH", '/home/anucentr/public_html/wp-content/wflogs/');
	include_once '/home/anucentr/public_html/wp-content/plugins/wordfence/waf/bootstrap.php';
}
?>