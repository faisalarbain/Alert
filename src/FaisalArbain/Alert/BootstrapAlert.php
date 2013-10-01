<?php namespace FaisalArbain\Alert;

use Illuminate\Support\Contracts\MessageProviderInterface;
/**
 * BootstrapAlert
 */
 class BootstrapAlert
 {
 	public static $KEY = "BOOTSTRAP_ALERT";
 	public $session;

 	function __construct($session)
 	{
 		$this->session = $session;
 	}

 	public function add($key = false, $message = false)
 	{	
 		$messages = $this->get($key);
 		$messages[] = $message;

 		$all = $this->all();
 		$all[$key] = $messages;

 		$this->session->flash(static::$KEY, $all);
 		return $this;
 	}

 	public function get($key)
 	{
 		$all = $this->all();
 		if(!isset($all[$key])){
 			$all[$key] = array();
 		}

 		return $all[$key];
 	}

 	public function all()
 	{
 		return $this->session->get(static::$KEY, array());
 	}

 	public function render($type = false)
 	{
 		if(!$type){
 			$all = $this->all();
 		}else{
 			$all = array($type => $this->get($type));
 		}

 		$output = "";
 		foreach ($all as $type => $messages) {
 			foreach ($messages as $msg) {
 				
 				if($msg instanceof MessageProviderInterface){
 					$msg = join("<br/>", array_flatten($msg->toArray()));
				}
				
				$output .= "<div class='alert alert-$type'>$msg</div>\n";
				
 			}
 		}

 		return $output;
 	}
}
