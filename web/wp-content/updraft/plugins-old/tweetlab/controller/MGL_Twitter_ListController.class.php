<?php
class MGL_Twitter_ListController extends MGL_Twitter_BaseController {

	public 	$givenArgs,
	        $count,
			$slides,
			$tweets,
			$search,
			$customQuery,
			$direction,
			$type;

	public function __construct( $atts ){
        parent::__construct( $atts );
        $this->givenArgs	= $atts;
        $this->search       = $atts['search'];
        $this->count        = $atts['count'];
        $this->slides       = $atts['slides'];
        $this->direction 	= $atts['direction'];
        $this->customQuery 	= $atts['custom_query'];

        $this->type 		= 'search';


		$this->repository 	= new MGL_TwitterRepository("https://api.twitter.com/1.1/search/tweets.json");
		
        $this->tweets 		= $this->getTweets();
    }

    public function buildQuery(){

    	// If all fields are empty throw exception
    	if($this->username == '' && $this->search == '' && $this->customQuery == '') {
			throw new Exception("Username / search or custom_query can't be empty, fill at last one of them");	
		}

		// It is only one username?
		$users = explode(',',$this->username);
		if( count( $users ) == 1 && $users[0] != '' && $this->search == '' && $this->customQuery == '' ) {
			// Set type
			$this->type = 'user';
			// Set repository
			$this->repository 	= new MGL_TwitterRepository("https://api.twitter.com/1.1/statuses/user_timeline.json");
			// Add query args
			$query_args = array(
				'screen_name'	=> $this->username,
				'count'			=> $this->count
			);

			return $query_args;
		}
		

		if(trim($this->customQuery) != '') {
			// If custom query is not empty use it
			// Replace simple quote by doubles to make the custom query works
			// on Search API (Wordpress shortcode doesn´t allow double quotes as a parameter of a shortcode
			$query_vars = str_replace( "'", '"', $this->customQuery);

		} else {
			// Build query with users & search
			$query_vars = $this->generateUserSearchQuery();
		}

		$query_args = array(
			'q'				=> $query_vars,
			'result_type'	=> 'recent',
			'count'			=> $this->count
		);

		return $query_args;
    }

	private function getTweets(){

		$query_vars = $this->buildQuery();

		$result = $this->repository->get_result($query_vars, $this->cache);

		if($this->type == 'user') {
			return $result;
		} else {
			return $result->statuses;		
		}

	}

	public function loadScriptsAndStyles(){
		
		parent::loadScriptsAndStyles();
		
		if($this->direction == 'vertical') {
			wp_enqueue_script('mgl_twitter_slider_vertical');
		} else {
			wp_enqueue_script('mgl_twitter_slider');
		}
	}

	public function render(){
        $this->loadScriptsAndStyles();
    
        return $this->renderTemplate( 'list', array(
        	'args'			=> $this->getUrlEncodedArgs(),
            'template'      => $this->template,
            'direction'		=> $this->direction,
            'display'		=> explode(',',$this->display),
            'tweets'		=> $this->tweets
        ));
    }

    public function getUrlEncodedArgs(){
        return http_build_query( $this->givenArgs );
    }

    public function generateUserSearchQuery() {

		$query_vars = '';
		$operator = 'and';
		
		// Check users
		if($this->username != '') {
			$users = explode(',',$this->username);
			// If more than one, explode and connect
			if(count($users) > 1) {
				foreach ($users as $key => $user) {
					if($key > 0) {
						$query_vars .= ' OR ';
					}
					$query_vars .= 'from:'.trim($user);
				}
			} else {
				$query_vars .= 'from:'.$users[0];
			}
		}	

		// Check hashtags
		if($this->search != '') {
			if($this->username != '') { $query_vars .=' '; }
			
			$hashtags = explode(',',$this->search);
			// If more than one, explode and connect
			if(count($hashtags) > 1) {
				foreach ($hashtags as $key => $hashtag) {
					if($key > 0) {
						if($operator == 'OR' || $operator == 'or') {
							$query_vars .= ' OR ';		
						} else {
							$query_vars .= ' ';
						}

					}
					$query_vars .= $hashtag;
				}
			} else {
				$query_vars .= $hashtags[0];
			}
		}

	    return $query_vars;
    }
}