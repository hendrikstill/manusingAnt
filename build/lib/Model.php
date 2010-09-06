<?php


/**
 * @author Hendrik
 * @package Lib
 * @abstract
 */
class Model
{
	#	internal variables

	#	Constructor
	function __construct (  )
	{
		# code...
	}
	###

	/**
	 * Creates or updates the instance on the database
	 */
	public function save ()
	{
		//Creating model
		if(!isset($this->id)){
			$this->create();
		}else{
			$this->update();
		}
	}

	/**
	 * Removes instance completly from the database
	 */
	public function delete ()
	{
		$query = 'DELETE FROM '.$this->table.' WHERE id ='.$this->id.';';
		DataConnector::getInstance()->query($query);
	}

	/**
	 * Updates all attributes of the model defined in the model class
	 */
	public function update ()
	{
		//updates model
		$notFirst = false;
		$query = 'UPDATE '.$this->table.' SET ';
		foreach($this->attributes as $attribute){
			if($notFirst)
			{
				$query .= ',';
			}else{
				$notFirst = true;
			}
			$query .= $attribute[0].' = \''.$this->$attribute[0].'\'';
		}
		$notFirst = false;
		$query .=' WHERE id = \''.$this->id.'\';';
		DataConnector::getInstance()->query($query);
	}

	/**
	 * Creates model in the database with a INSERT INTO query
	 */
	public function create ()
	{
		$notFirst = false;
		$query = 'INSERT INTO '.$this->table.' (';
		foreach($this->attributes as $attribute){
			if($notFirst)
			{
				$query .= ',';
			}else{
				$notFirst = true;
			}
			$query .= $attribute[0];
		}
		$notFirst = false;
		$query .=') VALUES (';
		foreach($this->attributes as $attribute){

			if($notFirst)
			{
				$query .= ',';
			}else{
				$notFirst = true;
			}
			if($attribute[0] != 'id')
			{
				$query .= '\''.$this->$attribute[0].'\'';
			}else{
				$query .= 'NULL';
			}
		}
		$query .= ');';
		DataConnector::getInstance()->query($query);

		$this->id = DataConnector::getInstance()->lastInsertId();
	}

	/**
	 * Returns a model object with the given id and loads all the attributes into the current instance.
	 * @param int $id
	 * @return model
	 */
	public function find ($id)
	{
		$query = 'SELECT * FROM '.$this->table.' WHERE id ='.$id.';';
		foreach(DataConnector::getInstance()->query($query) as $row){

			foreach($this->attributes as $attribute){
				$this->{$attribute[0]} = $row[$attribute[0]];
			}
		}
		return $this;
	}


	/**
	 * Returns single model from the database. You can define the where clause by youre selfe.
	 * @param string $where
	 * @return model
	 */
	public function findWhere ( $where )
	{
		$query = 'SELECT * FROM '.$this->table.' WHERE '.$where.' LIMIT 1;';
		foreach(DataConnector::getInstance()->query($query) as $row){

			foreach($this->attributes as $attribute){
				$this->{$attribute[0]} = $row[$attribute[0]];
			}
		}
		return $this;
	}

	/**
	 * Returns numbers of models in the database 
	 */
	public function count ()
	{
		$query = '';
		return 0;
	}

	/**
	 * Returns an array of all models from the Database
	 * @return array
	 */
	public function findAll ( )
	{
		$className = get_class($this);
		$query = 'SELECT * FROM '.$this->table.';';
		foreach(DataConnector::getInstance()->query($query) as $row){
			$element = new $className();
				
			foreach($this->attributes as $attribute){
				$element->{$attribute[0]} = $row[$attribute[0]];
			}
			$elements[$i] = $element;
			$i++;
		}
		return $elements;
	}

	/**
	 * Returns an array of all models from the Database. Use the where clause to filter the results.
	 * @param string $where
	 * @return array
	 */
	public function findAllWhere($where)
	{
		$className = get_class($this);
		$query = 'SELECT * FROM '.$this->table.' WHERE '.$where.';';
		foreach(DataConnector::getInstance()->query($query) as $row){
			$element = new $className();
				
			foreach($this->attributes as $attribute){
				$element->{$attribute[0]} = $row[$attribute[0]];
			}
			$elements[$i] = $element;
			$i++;
		}
		return $elements;
	}

	/**
	 * Creats table of the model like it is defined.
	 * This is very usefull for the install process in your webapp.
	 */
	public function createDatabaseTable ()
	{
		$notFirst = false;
		$query = 'CREATE TABLE '.$this->table.' (';
		foreach($this->attributes as $attribute){
			if($notFirst)
			{
				$query .= ',';
			}else{
				$notFirst = true;
			}
			$query .= $attribute[0].' '.$attribute[1];
		}
		$query .= ');';
		DataConnector::getInstance()->query($query);
			
	}

	/**
	 * Returns the Model name
	 * @param string $name
	 * @return string
	 */
	static public function getName ( $name='' )
	{
		return ucfirst($name);
	}
	/**
	*returns all attributes as an array.
	*@return array
 	*/
	public function getAttributes ()
	{
		return $this->attributes;
	}



}
###

?>