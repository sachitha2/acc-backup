<?php
class MGL_TwitterRepository {

	protected 	$url_base,
				$connection;

	public function __construct( $url_base ) {
		$this->url_base = $url_base;
		$this->connection = $this->getConnectionWithAccessToken();
	}

    public function getConnectionWithAccessToken() {

        //Path to twitteroauth library
        if(!class_exists ('TwitterOAuth')) {
            require_once(__DIR__."/twitteroauth/twitteroauth.php"); 
        }
        
        // Get connection values
        $mgl_twitter_account_settings = get_option('mgl_twitter_account_settings', array('consumer_key' => '', 'consumer_secret' => '', 'access_token' => '', 'access_token_secret' => ''));

        // Check if empty
        
        if($mgl_twitter_account_settings['consumer_key'] == '')         { throw new Exception('Consumer key is empty!'); }
        if($mgl_twitter_account_settings['consumer_secret'] == '')      { throw new Exception('Consumer secret is empty!'); }
        if($mgl_twitter_account_settings['access_token'] == '')         { throw new Exception('Access token is empty!'); }
        if($mgl_twitter_account_settings['access_token_secret'] == '')  { throw new Exception('Access token secret is empty!'); }

        // Create variables

        $consumerkey        = trim($mgl_twitter_account_settings['consumer_key']);
        $consumersecret     = trim($mgl_twitter_account_settings['consumer_secret']);
        $accesstoken        = trim($mgl_twitter_account_settings['access_token']);
        $accesstokensecret  = trim($mgl_twitter_account_settings['access_token_secret']);

        // Create connection
        $connection = new TwitterOAuth($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
        return $connection;
    }

    public function get_result($query_vars, $expiration = 900 ) {

    	$url_query = $this->url_base . '?' . http_build_query( $query_vars );

    	$cache_key = sha1( $url_query . $expiration );

    	$result = $this->get_cached_result( $cache_key );
    	
    	if( $result !== false ) return $result;
    	$result = $this->connection->get( $url_query );

    	if( isset($result->errors) ) {
			$errors = '';
			foreach ($result->errors as $error) {
				$errors .= 'Error: '.$error->code.' '.$error->message;
			}
			// Throw exception
			throw new Exception($errors);
			
		}

		$this->set_cached_result( $cache_key, $result, $expiration );

		return $result;
    }

    public function get_cached_result( $cache_key ){
    	$cached_content = get_transient( $cache_key );
    	if( $cached_content === false ) return false;
    	return unserialize( base64_decode( $cached_content ) );
    }

    public function set_cached_result( $cache_key, $result, $expiration = 900 ){
    	$result = base64_encode( serialize( $result ) );
    	return set_transient( $cache_key, $result, $expiration );
    }



}