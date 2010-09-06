<?php

/**
 * @author Hendrik
 * @package Plugin
 */
class Menu extends Plugin
{
	#	Metainformation
	var $creator = "Hendrik Still";
	var $version = "1.0";
	var $email = "gamma32@gmail.com";
	var $description = "This is a Menu plugin";

	var $menuEntries;

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
		$this->classloader = Classloader::getInstance();
		TemplateEngine::getInstance()->hookBeforeRender($this);
			
	}
		
	public function addMenuEntry($name,$link){
		$this->menuEntries[$name] = $link;
	}

	public function beforeRender(){
		$menuSource = "";
		foreach ($this->menuEntries as $name => $link)
		{
			$menuSource .= '<li><a href="'.$link.'">'.$name.'</a></li>';
		}
			
		TemplateEngine::getInstance()->replaceMarks("menu",$menuSource);
	}
}
###

?>