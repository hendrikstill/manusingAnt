<?php

/**
 * @author Hendrik
 * @package Plugin
 */
class Example extends Plugin
{
	#	Metainformation
	var $creator = "Hendrik Still";
	var $version = "1.0";
	var $email = "gamma32@gmail.com";
	var $description = "This is a Example plugin";


	#	Constructor
	function __construct (  )
	{
		# code...
	}
	###

	public function init()
	{
		Log::getInstance()->event("Loaded my Plugin",Log::INFO);
		TemplateEngine::getInstance()->replaceMarks("info", "Test");
	}
}
###

?>