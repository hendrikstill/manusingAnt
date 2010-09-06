<?php
require_once('./lib/Classloader.php');

/**
 * @author Hendrik
 * @package Lib
 */
class Manusing
{
	#	internal variables
	var $classloader;
	var $dataConnector;
	var $routingEngine;
	var $templateEngine;

	static private $instance;
	static public function getInstance()
	{
		if (null === self::$instance) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	#	Constructor
	private function __construct (  )
	{
		$this->classloader =  Classloader::getInstance();
		$this->classloader->initLoadLib();
			
		$this->dataConnector =  DataConnector::getInstance();
		$this->routingEngine =  RoutingEngine::getInstance();
		$this->templateEngine = TemplateEngine::getInstance();
			
			
	}

	/**
	 * Entrypoint for the Framework.
	 * Normaly it is only used once in the index.php
	 */
	public function run()
	{
		$this->routingEngine->route();
	}



}
###

?>