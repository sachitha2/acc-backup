<?php

if(isset($_POST['mgl_update'])) {
    
    update_option( 'mgl_twitter_account_settings', $_POST['mgl_twitter_account_settings'] );


    if(isset($_POST['mgl_twitter_jquery'])) {

        update_option( 'mgl_twitter_jquery', true );
    } else {
        update_option( 'mgl_twitter_jquery', false );
    }


    ?>
    <div class="updated settings-error" id="setting-error-settings_updated"> 
        <p><strong><?php _e('Settings saved', MGL_TWITTER_DOMAIN); ?></strong></p>
    </div>
    <?php
}


$mgl_twitter_account_settings = get_option('mgl_twitter_account_settings', array('consumer_key' => '', 'consumer_secret' => '', 'access_token' => '', 'access_token_secret' => ''));


?>
<div class="wrap"> 
    <div class="icon32 ">
        <br>
    </div> 
    <?php    echo "<h2>Tweetlab</h2>"; ?>
   <div class="col_left"> 
    <h3><?php _e('Twitter settings', MGL_TWITTER_DOMAIN); ?></h3>
    <p><?php printf(__('You need to register a new Twitter application from %s in order to make this plugin work', MGL_TWITTER_DOMAIN), '<a href="https://dev.twitter.com/apps/new" target="_blank">'.__('here',MGL_TWITTER_DOMAIN).'</a>'); ?></p> 
    <p><?php _e('After creating the app you need to create an access token', MGL_TWITTER_DOMAIN); ?></p>
    <p><?php _e('Fill the fields below with the App settings you will find in the "OAuth tool" tab', MGL_TWITTER_DOMAIN); ?></p>
    <form name="mgl_twitter_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>"> 
    <input type="hidden" name="mgl_update" value="Y"> 
    <p><?php _e('Fill this two fields with the information of your App', MGL_TWITTER_DOMAIN); ?></p>
    <table class="form-table">
        <tr valign="top"> 
            <th scope="row">Consumer key</th>
            <td><input class="regular-text" type="text" name="mgl_twitter_account_settings[consumer_key]" value="<?php echo $mgl_twitter_account_settings['consumer_key']; ?>" /></td>
        </tr>      
        <tr valign="top"> 
            <th scope="row">Consumer secret</th>
            <td><input class="regular-text" type="text" name="mgl_twitter_account_settings[consumer_secret]" value="<?php echo $mgl_twitter_account_settings['consumer_secret']; ?>" /></td>
        </tr> 
        <tr valign="top"> 
            <th scope="row">Access token</th>
            <td><input class="regular-text" type="text" name="mgl_twitter_account_settings[access_token]" value="<?php echo $mgl_twitter_account_settings['access_token']; ?>" /></td>
        </tr> 
        <tr valign="top"> 
            <th scope="row">Access token secret</th>
            <td><input class="regular-text" type="text" name="mgl_twitter_account_settings[access_token_secret]" value="<?php echo $mgl_twitter_account_settings['access_token_secret']; ?>" /></td>
        </tr>    
    </table>
    <p class="submit">
        <input class="button" type="submit" name="Submit" value="<?php _e('Save settings', MGL_TWITTER_DOMAIN ) ?>" />  
    </p>
    <h3><?php _e('Configuration', MGL_TWITTER_DOMAIN); ?></h3>
     <table class="form-table">
        <tr valign="top"> 
            <th scope="row"><?php _e('Load jQuery', MGL_TWITTER_DOMAIN); ?></th>
            <td>
                <p class="description"> 
                    <input type="checkbox" name="mgl_twitter_jquery" <?php if(get_option('mgl_twitter_jquery', false) == true) { echo 'checked="checked"'; } ?> />
                    <?php _e('Mark this if you\'re not loading jQuery by yourself', MGL_TWITTER_DOMAIN); ?>
                </p>
            </td>
        </tr>
    </table> 
    <p class="submit">
        <input class="button" type="submit" name="Submit" value="<?php _e('Save settings', MGL_TWITTER_DOMAIN ) ?>" />  
    </p>
    </form> 
</div> 
<div class="col_right">
    <a href="http://codecanyon.net/user/MaGeekLab?ref=mageeklab" title="Follow us on CodeCanyon" target="_blank"><img  title="Follow us on CodeCanyon"  alt="Follow us on CodeCanyon" src="<?php echo MGL_TWITTER_URL_BASE.'assets/images/mageeklab_banner_codecanyon.png'; ?>" alt=""></a>
    <h3>Shortcodes</h3>

    <h4><?php _e('User feed', MGL_TWITTER_DOMAIN); ?></h4>
    <p><?php _e('If you want to show an user\'s last tweets simply put', MGL_TWITTER_DOMAIN); ?>:</p>
    [mgl_twitter username="mageeklab"]
    <p><em><?php _e('Add attributes to configure the aspect of the carousel', MGL_TWITTER_DOMAIN); ?></em></p>
    
    <h4><?php _e('Search feed', MGL_TWITTER_DOMAIN); ?></h4>
    <p><?php _e('If you want to show the last tweets from an specific hashtag or search', MGL_TWITTER_DOMAIN); ?>:</p>
    [mgl_twitter search="#envato"]
    
    <h4><?php _e('User card', MGL_TWITTER_DOMAIN); ?></h4>
    <p><?php _e('Display a card with the information of a user', MGL_TWITTER_DOMAIN); ?>:</p>
    [mgl_twitter_card username="mageeklab"]
    <p><em><?php _e('Attributes will let you hide/show different settings', MGL_TWITTER_DOMAIN); ?></em></p>
    
    <p><em><?php _e('See all the options avaible in the plugin\'s documentation', MGL_TWITTER_DOMAIN); ?></em></p>
</div>
</div>
