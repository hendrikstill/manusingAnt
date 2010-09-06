<?php

/**
 * @author Hendrik
 * @package Lib
 */
class DataConnector
{
	#	internal variables
	var $pdo;

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
		$this->startConnection();
	}

	/**
	 * Initiates database connection via PDO.
	 * Manusing should do this for you
	 */
	public function startConnection()
	{
		$this->pdo = new PDO($this->getDNS(),DB_USER,DB_PASSWORD);
	}

	/**
	 * Sould close the connection. 
	 */
	public function endConnection()
	{

	}

	/**
	 * Returns DNS string for the databaseconnection
	 * @return string
	 */
	public function getDNS( )
	{
		return 'mysql:host='.DB_HOST.';dbname='.DB_NAME;
	}

	/**
	 * Does some abstact query ( at the moment only MySQL)
	 * @param string $query
	 * @return queryResult
	 */
	public function query( $query )
	{
		return $this->nativQuery($query);
	}

	/**
	 * Does nativ query(MySQL)
	 * Returns PDO result
	 * @param string $query
	 * @return queryResult
	 */
	public function nativQuery ( $query )
	{
		//Log::getInstance()->event($query,Log::INFO);
		try{
			return $this->pdo->query($query);
		}catch (PDOException $e){
			Log::getInstance()->event($e->getMessage(),Log::ERROR);
		}
	}

	/**
	 * Returns last autoincrement id
	 * @return id
	 */	
	public function lastInsertId()
	{
		return $this->pdo->lastInsertId();
	}
	###

}
###

?>