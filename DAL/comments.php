<?php
/*
Author:			This code was generated by DALGen version 1.0.0.0 available at https://github.com/H0r53/DALGen 
Date:			10/18/2017
Description:	Creates the DAL class for  comments table and respective stored procedures

*/



class Comments {

	// This is for local purposes only! In hosted environments the db_settings.php file should be outside of the webroot, such as: include("/outside-webroot/db_settings.php");
	protected static function getDbSettings() { return "DAL/db_localsettings.php"; }

	/******************************************************************/
	// Properties
	/******************************************************************/

	protected $CommentID;
	protected $AccountID;
	protected $Description;
	protected $TaskID;
	protected $CommentStatusTypeID;


	/******************************************************************/
	// Constructors
	/******************************************************************/
	public function __construct() {
		$argv = func_get_args();
		switch( func_num_args() ) {
			case 0:
				self::__constructBase();
				break;
			case 1:
				self::__constructPK( $argv[0] );
				break;
			case 5:
				self::__constructFull( $argv[0], $argv[1], $argv[2], $argv[3], $argv[4] );
		}
	}


	public function __constructBase() {
		$this->CommentID = 0;
		$this->AccountID = 0;
		$this->Description = "";
		$this->TaskID = 0;
		$this->CommentStatusTypeID = 0;
	}


	public function __constructPK($paramId) {
		$this->load($paramId);
	}


	public function __constructFull($paramCommentID,$paramAccountID,$paramDescription,$paramTaskID,$paramCommentStatusTypeID) {
		$this->CommentID = $paramCommentID;
		$this->AccountID = $paramAccountID;
		$this->Description = $paramDescription;
		$this->TaskID = $paramTaskID;
		$this->CommentStatusTypeID = $paramCommentStatusTypeID;
	}


	/******************************************************************/
	// Accessors / Mutators
	/******************************************************************/

	public function getCommentID(){
		return $this->CommentID;
	}
	public function setCommentID($value){
		$this->CommentID = $value;
	}
	public function getAccountID(){
		return $this->AccountID;
	}
	public function setAccountID($value){
		$this->AccountID = $value;
	}
	public function getDescription(){
		return $this->Description;
	}
	public function setDescription($value){
		$this->Description = $value;
	}
	public function getTaskID(){
		return $this->TaskID;
	}
	public function setTaskID($value){
		$this->TaskID = $value;
	}
	public function getCommentStatusTypeID(){
		return $this->CommentStatusTypeID;
	}
	public function setCommentStatusTypeID($value){
		$this->CommentStatusTypeID = $value;
	}


	/******************************************************************/
	// Public Methods
	/******************************************************************/


	public function load($paramId) {
		include(self::getDbSettings());
		$conn = new mysqli($servername, $username, $password, $dbname);
		$stmt = $conn->prepare('CALL usp_comments_Load(?)');
		$stmt->bind_param('i', $paramId);
		$stmt->execute();

		$result = $stmt->get_result();
		if (!$result) die($conn->error);

		while ($row = $result->fetch_assoc()) {
		 $this->setCommentID($row['CommentID']);
		 $this->setAccountID($row['AccountID']);
		 $this->setDescription($row['Description']);
		 $this->setTaskID($row['TaskID']);
		 $this->setCommentStatusTypeID($row['CommentStatusTypeID']);
		}
	}


	public function save() {
		if ($this->getCommentID() == 0)
			$this->insert();
		else
			$this->update();
	}

	/******************************************************************/
	// Private Methods
	/******************************************************************/



	private function insert() {
		include(self::getDbSettings());
		$conn = new mysqli($servername, $username, $password, $dbname);
		$stmt = $conn->prepare('CALL usp_comments_Add(?,?,?,?)');
		$arg1 = $this->getAccountID();
		$arg2 = $this->getDescription();
		$arg3 = $this->getTaskID();
		$arg4 = $this->getCommentStatusTypeID();
		$stmt->bind_param('isii',$arg1,$arg2,$arg3,$arg4);
		$stmt->execute();

		$result = $stmt->get_result();
		if (!$result) die($conn->error);
		while ($row = $result->fetch_assoc()) {
			// By default, the DALGen generated INSERT procedure returns the scope identity as id
			$this->load($row['id']);
		}
	}


	private function update() {
		include(self::getDbSettings());
		$conn = new mysqli($servername, $username, $password, $dbname);
		$stmt = $conn->prepare('CALL usp_comments_Update(?,?,?,?,?)');
		$arg1 = $this->getCommentID();
		$arg2 = $this->getAccountID();
		$arg3 = $this->getDescription();
		$arg4 = $this->getTaskID();
		$arg5 = $this->getCommentStatusTypeID();
		$stmt->bind_param('iisii',$arg1,$arg2,$arg3,$arg4,$arg5);
		$stmt->execute();
	}

	private static function setNullValue($value){
		if ($value == "")
			return null;
		else
			return $value;
	}

	/******************************************************************/
	// Static Methods
	/******************************************************************/



	public static function loadall() {
		include(self::getDbSettings());
		$conn = new mysqli($servername, $username, $password, $dbname);
		$stmt = $conn->prepare('CALL usp_comments_LoadAll()');
		$stmt->execute();

		$result = $stmt->get_result();
		if (!$result) die($conn->error);
		if ($result->num_rows > 0) {
			$arr = array();
			while ($row = $result->fetch_assoc()) {
				$comments = new Comments($row['CommentID'],$row['AccountID'],$row['Description'],$row['TaskID'],$row['CommentStatusTypeID']);
				$arr[] = $comments;
			}
			return $arr;
		}
		else {
			die("The query yielded zero results.No rows found.");
		}
	}


	public static function remove($paramId) {
		include(self::getDbSettings());
		$conn = new mysqli($servername, $username, $password, $dbname);
		$stmt = $conn->prepare('CALL usp_comments_Remove(?)');
		$stmt->bind_param('i', $paramId);
		$stmt->execute();
	}


	public static function search($paramCommentID,$paramAccountID,$paramDescription,$paramTaskID,$paramCommentStatusTypeID) {
		include(self::getDbSettings());
		$conn = new mysqli($servername, $username, $password, $dbname);
		$stmt = $conn->prepare('CALL usp_comments_Search(?,?,?,?,?)');
		$arg1 = Comments::setNullValue($paramCommentID);
		$arg2 = Comments::setNullValue($paramAccountID);
		$arg3 = Comments::setNullValue($paramDescription);
		$arg4 = Comments::setNullValue($paramTaskID);
		$arg5 = Comments::setNullValue($paramCommentStatusTypeID);
		$stmt->bind_param('iisii',$arg1,$arg2,$arg3,$arg4,$arg5);
		$stmt->execute();

		$result = $stmt->get_result();
		if (!$result) die($conn->error);
		if ($result->num_rows > 0) {
			$arr = array();
			while ($row = $result->fetch_assoc()) {
				$comments = new Comments($row['CommentID'],$row['AccountID'],$row['Description'],$row['TaskID'],$row['CommentStatusTypeID']);
				$arr[] = $comments;
			}
			return $arr;
		}
		else {
			die("The query yielded zero results.No rows found.");
		}
	}
}
