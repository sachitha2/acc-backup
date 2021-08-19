<?php
abstract class MGL_Twitter_BaseController {

	public 	$repository,
            $cache,
			$template,
			$username,
            $display;

	public function __construct( $atts ){

        $this->cache        = $atts['cache'];
        $this->template     = $atts['template'];
        $this->username     = $atts['username'];
        $this->display      = $atts['display'];
        
    }

    public function loadScriptsAndStyles(){
        wp_enqueue_style('mgl_twitter');
    }

    public function includeTemplate( $templatePart, $accessibleVars ){
        extract( $accessibleVars );

        $childThemeTemplateUrl = get_stylesheet_directory() . '/tweetlab/' . $this->template . '/' . $templatePart .'.php';
        $themeTemplateUrl   = get_template_directory() . '/tweetlab/' . $this->template . '/' . $templatePart .'.php';
        $pluginTemplateUrl  = MGL_TWITTER_INCLUDE_BASE_PATH . '/templates/' . $this->template . '/' . $templatePart .'.php';
        $defaultTemplateUrl = MGL_TWITTER_INCLUDE_BASE_PATH . '/templates/default/' . $templatePart .'.php';

        if( file_exists( $childThemeTemplateUrl ) ){
            include( $childThemeTemplateUrl );
        }elseif( file_exists( $themeTemplateUrl ) ){
            include( $themeTemplateUrl );
        }elseif( file_exists( $pluginTemplateUrl ) ){
            include( $pluginTemplateUrl );
        } else {
            include( $defaultTemplateUrl );
        }
    }

    public function renderTemplate( $template, $accessibleVars){
        ob_start();
        $this->includeTemplate( $template, $accessibleVars );
        return ob_get_clean();
    }

    static function rich_text($input) {
        // Links
        $input = preg_replace('@(https?://([-\w.]+[-\w])+(:\d+)?(/([\w-.~:/?#\[\]\@!$&\'()*+,;=%]*)?)?)@', '<a href="$1" target="_blank">$1</a>', $input);
        // Mentions
        $input = preg_replace('/(?<=^|\s)@([a-z0-9_]+)/i', '<a href="http://www.twitter.com/$1" target="_blank">@$1</a>', $input);
        // Hastags
        $input = preg_replace('/(?<=^|\s)#([a-z0-9_]+)/i', '<a href="http://www.twitter.com/search?q=%23$1" target="_blank">#$1</a>', $input);
        return $input;
    }

    static function relative_date($date) {

        $secs = date('U', time() - strtotime($date));;

        $second = 1;
        $minute = 60;
        $hour = 60*60;
        $day = 60*60*24;
        $week = 60*60*24*7;
        $month = 60*60*24*7*30;
        $year = 60*60*24*7*30*365;
        
        if ($secs <= 0) { $output = ''; $interval = "now";
        }elseif ($secs > $second && $secs < $minute) {  $output = round($secs/$second);     $interval = "second";
        }elseif ($secs >= $minute && $secs < $hour) {   $output = round($secs/$minute);     $interval = "minute";
        }elseif ($secs >= $hour && $secs < $day) {      $output = round($secs/$hour);       $interval = "hour";
        }elseif ($secs >= $day && $secs < $week) {      $output = round($secs/$day);        $interval = "day";
        }elseif ($secs >= $week && $secs < $month) {    $output = round($secs/$week);       $interval = "week";
        }elseif ($secs >= $month && $secs < $year) {    $output = round($secs/$month);      $interval = "month";
        }elseif ($secs >= $year && $secs < $year*10) {  $output = round($secs/$year);       $interval = "year";
        }else{ $output = ''; $interval = ""; }

        switch ($interval) {
            case 'now':
                    $time = __('now', MGL_TWITTER_DOMAIN);
                break;
            case 'second':
                    $time = __('second', MGL_TWITTER_DOMAIN);
                    if($output > 1) { $time = __('seconds', MGL_TWITTER_DOMAIN); } 
                break;
            case 'minute':
                    $time = __('minute', MGL_TWITTER_DOMAIN);
                    if($output > 1) { $time = __('minutes', MGL_TWITTER_DOMAIN); } 
                break;
            case 'hour':
                    $time = __('hour', MGL_TWITTER_DOMAIN);
                    if($output > 1) { $time = __('hours', MGL_TWITTER_DOMAIN); } 
                break;
            case 'day':
                    $time = __('day', MGL_TWITTER_DOMAIN);
                    if($output > 1) { $time = __('days', MGL_TWITTER_DOMAIN); } 
                break;
            case 'week':
                    $time = __('week', MGL_TWITTER_DOMAIN);
                    if($output > 1) { $time = __('weeks', MGL_TWITTER_DOMAIN); } 
                break;
            case 'month':
                $time = __('month', MGL_TWITTER_DOMAIN);
                if($output > 1) { $time = __('months', MGL_TWITTER_DOMAIN); } 
                break;
            case 'year':
                $time = __('year', MGL_TWITTER_DOMAIN);
                if($output > 1) { $time = __('years', MGL_TWITTER_DOMAIN); } 
                break;
            default:
                $time = ' more than a decade ago';
                break;
        }

        
        if ($interval == "now"){
            return $time;
        }
        return sprintf(__( '%1$s %2$s ago' , MGL_TWITTER_DOMAIN) ,$output, $time);
    }

    abstract function render();
    abstract function buildQuery();
}