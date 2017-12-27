<?php

	class dbo
	{
		private $host = "localhost";
		private $user = "root";
		private $pass = "";
		private $dbnm = "blog";
		
		private $link;
		
		function dml($q)
		{
			if( ! $this->link) {
				$this->link = mysqli_connect($this->host, $this->user, $this->pass, $this->dbnm) or die(mysqli_connect_error());
			}
			mysqli_query($this->link, $q) or die(mysqli_error($this->link));
		}
		
		function get($q)
		{
			if( ! $this->link) {
				$this->link = mysqli_connect($this->host, $this->user, $this->pass, $this->dbnm) or die(mysqli_error($this->link));
			}
			$res = mysqli_query($this->link, $q) or die(mysqli_error($this->link));
			return $res;
		}
		
		function get_scalar($q)
		{
			$res = $this->get($q);
			$row = mysqli_fetch_array($res);
			return $row[0];
		}
		
		function found($q)
		{
			$res = $this->get($q);
			return ( mysqli_num_rows($res) == 0 ) ? false : true;
		}
	}
	
	$db = new dbo();
?>