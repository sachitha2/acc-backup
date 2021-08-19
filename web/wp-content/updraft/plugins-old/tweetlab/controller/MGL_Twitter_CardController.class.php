<?php
class MGL_Twitter_CardController extends MGL_Twitter_BaseController {

	public 	$userInfo,
			$search,
            $button;

	public function __construct( $atts ){
        parent::__construct( $atts );
        $this->button       = $atts['button'];

        $this->repository 	= new MGL_TwitterRepository("https://api.twitter.com/1.1/users/show.json");

        $this->userInfo 	= $this->getUserinfo();
    }

    public function buildQuery() {
    	
    	if($this->username == '') {
			throw new Exception("Username can't be empty");	
		}

		$query_args = array( 
			'screen_name' 		=> $this->username,
			'include_entities' 	=> 'true'
		);

		return $query_args;
    }

	private function getUserinfo(){

		$query_vars = $this->buildQuery();

		$result = $this->repository->get_result($query_vars, $this->cache);

		return $result;

	}

	public function render(){
        $this->loadScriptsAndStyles();

        return $this->renderTemplate( 'card', array(
            'template'      => $this->template,
            'user'			=> $this->userInfo,
            'display'		=> explode(',',$this->display),
            'button'		=> $this->button
        ));
    }

}