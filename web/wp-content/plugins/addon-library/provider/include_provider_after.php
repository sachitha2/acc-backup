<?php

$pathProvider = dirname(__FILE__)."/";

if(GlobalsUC::$is_admin){
	require_once $pathProvider . 'provider_gridbuilder.class.php';
	require_once $pathProvider . 'visual_composer/unitevc_exporter.class.php';
}

require_once $pathProvider . 'visual_composer/settings_output_vc.class.php';
require_once $pathProvider . 'visual_composer/unitevc_integrate.class.php';
require_once $pathProvider . 'widget_layout.class.php';


HelperProviderUC::registerPlugins();
