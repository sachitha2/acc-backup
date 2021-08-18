<?php

function mgl_twitter_directions( $inverse = false ) {
	
	$modes = array(
      'ltr'    		=> __('Left to right', MGL_TWITTER_DOMAIN), 
      'rtl'       	=> __('Right to left', MGL_TWITTER_DOMAIN), 
      'vertical' 	=> __('Vertical', MGL_TWITTER_DOMAIN)
    );

	if($inverse) {
		$modes = mgl_twitter_reverse_array($modes);
	}

	return $modes;
	
}

function mgl_twitter_reverse_array( $givenArray ) {
	$dummyArray = array();

	foreach ($givenArray as $key => $givenValue) {
		$dummyArray[$givenValue] = $key;
	}

	return $dummyArray;
}

function mgl_twitter_display($display, $part) {
	
	$result = false;

	if(is_array($part)) {
		
		foreach ($part as $value) {
			if(mgl_twitter_display_check($display, $value)) {
				$result = true;
			}
		}
		
	} else {

		$result = mgl_twitter_display_check($display, $part);

	}

	return $result;
}

function mgl_twitter_display_check($display, $value) {
	
	if(in_array($value, $display)) {
		return true;
	} else {
		return false;
	}

}

function mgl_twitter_print_banner($bannerUrl) {

	$response = wp_remote_get( $bannerUrl );
	$response_code = wp_remote_retrieve_response_code( $response );

	if($response_code == 200) {
		return "style=\"background-image: url('.$bannerUrl.');\"";
	} else {
		return $response_code;
	}

	return 'merdapura';

	//print_r($result);

}

function mgl_twitter_templates( $withKey = false ) {
	
	$defaultTemplates = array(
      'default',
      'square',
      'balloon',
      'card'
    );

	$themeTemplates = $customTemplates = array();
	$themeTemplatesDirectory = get_template_directory().'/tweetlab'; 

	if( file_exists($themeTemplatesDirectory) ) {
		$weeds = array('.', '..', '.DS_Store'); 
		$themeTemplates = array_diff(scandir($themeTemplatesDirectory), $weeds); 
	}

    $templates = array_merge($defaultTemplates, $themeTemplates, $customTemplates);

    $templates = array_map('trim', $templates);
    $templates = array_unique($templates);
	
	foreach ($templates as $key => $template) {
    	if($template == '') {
    		unset($templates[$key]);
    	}
    }
    
    if($withKey) {
    	$dummyArray = array();

    	foreach ($templates as $template) {
    		$dummyArray[$template] = $template;
    	}
    	return $dummyArray;
    }

    return $templates;
}

function mgl_twitter_print_select($values, $selectedValue, $selectId, $selectName, $withKey = true) {
?>
	<select class="widefat" id="<?php echo $selectId; ?>" name="<?php echo $selectName; ?>">
		<?php 
		if($withKey) {
			foreach ($values as $key => $value) { 
				$value = ( is_array($value) ) ? $value['name'] : $value;
				$selected = ( $key == $selectedValue ) ? ' selected="selected"' : '';
				echo '<option'.$selected.' value="'.$key.'">'.$value.'</option>';
			}
		} else {
			foreach ($values as $value) { 
				$selected = ( $value == $selectedValue ) ? ' selected="selected"' : '';
				echo '<option'.$selected.' value="'.$value.'">'.$value.'</option>';
			}
		}
		?>
	</select>
<?php
}

function mgl_twitter_option($key, $value) {
	return $value;
}