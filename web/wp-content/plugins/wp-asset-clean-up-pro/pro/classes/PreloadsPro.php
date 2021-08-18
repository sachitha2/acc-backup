<?php
namespace WpAssetCleanUpPro;

use WpAssetCleanUp\Main;
use WpAssetCleanUp\Misc;
use WpAssetCleanUp\Plugin;
use WpAssetCleanUp\Preloads;

/**
 * Class PreloadsPro
 * @package WpAssetCleanUpPro
 */
class PreloadsPro
{
	/**
	 *
	 */
	public function init()
	{
	    add_filter('wpacu_wpfc_update_deferred_css_links', array($this, 'wpfcUpdateDeferredCssLinks'));
	    add_filter('wpacu_preload_css_async_tag', array($this, 'preloadCssAsync'));

		add_action('wp_head', array($this, 'preloadAsyncCssFallback'), PHP_INT_MAX);
	}

	/**
	 * @param $htmlTag
	 *
	 * @return string
	 */
	public function preloadCssAsync($htmlTag)
	{
		return str_ireplace(
			array('<link ', 'rel=\'stylesheet\'', 'rel="stylesheet"', 'id=\'', 'id="'),
			array('<link rel=\'preload\' as=\'style\' data-wpacu-preload-it-async=\'1\' ', 'onload="this.rel=\'stylesheet\'"', 'onload="this.rel=\'stylesheet\'"', 'id=\'wpacu-preload-', 'id="wpacu-preload-'),
			$htmlTag
		);
	}

	/**
	 * Firefox is known to be using the fallback
	 */
	public function preloadAsyncCssFallback()
	{
		if ((WPACU_GET_LOADED_ASSETS_ACTION === true) || Plugin::preventAnyChanges() || Main::isTestModeActive()) {
			return;
		}

		$preloadsClass = new Preloads();
		$preloads = $preloadsClass->getPreloads();

		if (! (isset($preloads['styles']) && in_array('async', $preloads['styles']))) {
			return;
		}

		echo Misc::preloadAsyncCssFallbackOutput();
	}

	/**
     * In case "Minify CSS" is enabled in WP Fastest Cache,
     * make sure the deferred Asset CleanUp CSS links (from BODY)
     * are also updated with the minified version
     *
	 * @param $buffer
	 *
	 * @return mixed
	 */
	public static function wpfcUpdateDeferredCssLinks($buffer)
    {
	    preg_match_all('#<link[^>]*preload[^>]*' . 'data-href-before=([\'"])(.*)([\'"])'.'*'. 'href=([\'"])(.*)([\'"])' . '.*(>)#Usmi', $buffer, $matchesSourcesFromLinkTags, PREG_SET_ORDER);

	    if (! empty($matchesSourcesFromLinkTags)) {
		    $toLaterClear = array();

		    foreach ($matchesSourcesFromLinkTags as $linkTagArray) {
			    $linkHrefBefore = isset($linkTagArray[2]) ? trim($linkTagArray[2], '"\' ') : false;
			    $linkHref = isset($linkTagArray[5]) ? trim($linkTagArray[5]) : false;

			    // Do the replacement for the deferred CSS
			    $buffer = str_replace("'".$linkHrefBefore."';", "'".$linkHref."';", $buffer);

			    $toLaterClear[] = "data-href-before='".$linkHrefBefore."'";
		    }

		    $buffer = str_replace($toLaterClear, '', $buffer);
	    }

	    return $buffer;
    }
}
