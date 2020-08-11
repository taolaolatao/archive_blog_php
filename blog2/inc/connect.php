<?php 

	/**
	 *  Class Connect to Database 
	**/
	class Connection
	{
		protected $hostname = 'localhost';
		protected $usr = 'root';
		protected $pass = '';
		protected $dbname = 'test';
		static $conn = NULL;
		static $pre = NULL;
		static $result = NULL;
		static $sql = NULL;

		public function __construct()
		{
			$this->connect();
		}

		public function connect()
		{
			if(self::$conn === NULL)
			{
				try
				{
					self::$conn = new PDO('mysql:host=' . $this->hostname . ';dbname=' . $this->dbname, $this->usr, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
					self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					return self::$conn;
				}
				catch(PDOException $ex)
				{ echo $ex->getMessage(); }
			}
		}

		public static function dis_connect()
		{
			if(self::$conn !== NULL)
			{
				self::$conn = NULL;
			}
		}

		public function CountTotal($table, $field)
	    {
	    	if(self::$conn !== NULL)
	    	{
	    		self::$sql = "SELECT COUNT($field) FROM $table";
	        	self::$pre = self::$conn->prepare(self::$sql);
	        	self::$pre->execute();
	        	return self::$pre->fetchColumn();
	    	}
	    	else
	    	{ return 0; }
	    }

		public function getDataById($table, $id)
		{
			if(self::$conn !== NULL)
	        {
	        	self::$sql = "SELECT * FROM $table WHERE ID IN ($id)";
	        	self::$pre = self::$conn->prepare(self::$sql);
	        	self::$pre->execute();
	        	while ($rows = self::$pre->fetch(PDO::FETCH_OBJ)) {
	        		self::$result[] = $rows;
	        	}
	        	return self::$result;
	        }
	        else
	        { return 0; }
		}

		public function getAllData($table){
	        if(self::$conn !== NULL)
	        {
	        	self::$sql = "SELECT * FROM $table";
	        	self::$pre = self::$conn->prepare(self::$sql);
	        	self::$pre->execute();
	        	while ($rows = self::$pre->fetch(PDO::FETCH_OBJ)) {
	        		self::$result[] = $rows;
	        	}
	        	return self::$result;
	        }
	        else
	        { return 0; }
	    }

	    public function getDataLimit($table, $page = 0, $limit = 4)
	    {
	    	if(self::$conn !== NULL)
	        {
	        	$count = $this->CountTotal($table, 'ID');
	        	$numpage = ceil($count / $limit);
	        	// $from = ($page - 1) * $limit;
	        	$from = ($limit * $page) - $limit;
	        	if($page == 0)
	        	{
	        		self::$sql = "SELECT * FROM $table LIMIT $page,$limit";
	        	}
	        	else
	        	{
	        		self::$sql = "SELECT * FROM $table LIMIT $from,$limit";
	        	}
	        	
	        	self::$pre = self::$conn->prepare(self::$sql);
	        	self::$pre->execute();
	        	while ($rows = self::$pre->fetch(PDO::FETCH_OBJ)) {
	        		self::$result[] = $rows;
	        	}
	        	return self::$result;
	        }
	        else
	        { return 0; }
	    }
	     
		public function insert($table, $data)
		{
			if(self::$conn !== NULL)
			{
				if((is_string($table) AND $table === 'product') && (is_array($data)))
				{
					self::$sql = "INSERT INTO product(NAME,IMAGE,PRICE,UNIT) VALUES(?,?,?,?)";
					self::$pre = self::$conn->prepare(self::$sql);
					return self::$pre->execute($data);
				}
				else
				{
					return 0;
				}
			}
		}
    }
?>
