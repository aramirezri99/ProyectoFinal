<?php

class Database{
	public static function connect(){
		$db = new mysqli('localhost', 'root', '', 'blog_master');
		
		return $db;
	}
}