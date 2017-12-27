<?php require_once("classes/dbo.class.php");

	class rating
	{
	
		private $image_star = "images/star.png";
		private $image_star_blank = "images/star_blank.png";
		
		private $itm_tbl_nm = "blogs";
		private $itm_tbl_pk = "b_id";
		private $itm_tbl_r1_col = "b_r1";
		private $itm_tbl_r2_col = "b_r2";
		private $itm_tbl_r3_col = "b_r3";
		private $itm_tbl_r4_col = "b_r4";
		private $itm_tbl_r5_col = "b_r5";
		
		private $log_tbl_nm = "rate_log";
		private $log_tbl_usr_col = "rl_u_id";
		private $log_tbl_itm_col = "rl_b_id";
		
		private $session_user_id = "uid";
		private $qs_itm_var_nm = "bid";
		private $qs_rate_var_nm = "rate";
	
		//-- DO NOT EDIT BELOW -------------------------------------------
		
		private $itm = "";
		private $usr = "";
	
		function __construct()
		{
			//Get User
			if(isset($_SESSION[$this->session_user_id]))
				$this->usr = $_SESSION[$this->session_user_id];
			
			//Get Item
			if(isset($_GET[$this->qs_itm_var_nm]) && ! empty($_GET[$this->qs_itm_var_nm]) && ctype_digit($_GET[$this->qs_itm_var_nm]))
				$this->itm = $_GET[$this->qs_itm_var_nm];
			else
				die("Voting Class Error: No Item Found!");
				
			//Is rating??
			if(isset($_GET[$this->qs_rate_var_nm]) && !empty($_GET[$this->qs_rate_var_nm]))
			{
				$this->do_rating($_GET[$this->qs_rate_var_nm]);
				header("location: ".$this->get_url());
				exit;
			}
		}
		
		
		function show()
		{
			$db = new dbo();
		
			$q = "select * from ".$this->itm_tbl_nm." where ".$this->itm_tbl_pk." = '".$this->itm."'";
			$res = $db->get($q);
			$row = mysqli_fetch_assoc($res);
			$r1 = $row[$this->itm_tbl_r1_col];
			$r2 = $row[$this->itm_tbl_r2_col];
			$r3 = $row[$this->itm_tbl_r3_col];
			$r4 = $row[$this->itm_tbl_r4_col];
			$r5 = $row[$this->itm_tbl_r5_col];
		
			$tot_persons = $r1 + $r2 + $r3 + $r4 + $r5;
			$tot_stars = (1 * $r1) + (2 * $r2) + (3 * $r3) + (4 * $r4) + (5 * $r5);
			
			$rating = 0;
			
			if($tot_persons != 0)
				$rating = round($tot_stars / $tot_persons);
		
			if( $this->has_rated() )
			{
				for($i=1; $i<=5; $i++)
				{
					echo '<img src="'.(( $i<=$rating ) ? $this->image_star : $this->image_star_blank).'" height="25" width="25" />';
				}
			}
			else
			{
				
				for($i=1; $i<=5; $i++)
				{
					echo '<a href="'.$this->get_url()."&".$this->qs_rate_var_nm."=".$i.'">';
					echo '<img src="'.(( $i<=$rating ) ? $this->image_star : $this->image_star_blank).'" height="20" width="20" />';
					echo '</a>';
				}
			}
		}
		
		function do_rating($rate)
		{
			if( $this->has_rated() ) { return; } 

			$db = new dbo();
			
			//Rate query
			$q = "";
			switch($rate)
			{
				case "1":
					$q = "update ".$this->itm_tbl_nm." set ".$this->itm_tbl_r1_col." = ".$this->itm_tbl_r1_col." + 1 where ".$this->itm_tbl_pk." = '".$this->itm."'";
				break;
				case "2":
					$q = "update ".$this->itm_tbl_nm." set ".$this->itm_tbl_r2_col." = ".$this->itm_tbl_r2_col." + 1 where ".$this->itm_tbl_pk." = '".$this->itm."'";
				break;
				case "3":
					$q = "update ".$this->itm_tbl_nm." set ".$this->itm_tbl_r3_col." = ".$this->itm_tbl_r3_col." + 1 where ".$this->itm_tbl_pk." = '".$this->itm."'";
				break;
				case "4":
					$q = "update ".$this->itm_tbl_nm." set ".$this->itm_tbl_r4_col." = ".$this->itm_tbl_r4_col." + 1 where ".$this->itm_tbl_pk." = '".$this->itm."'";
				break;
				case "5":
					$q = "update ".$this->itm_tbl_nm." set ".$this->itm_tbl_r5_col." = ".$this->itm_tbl_r5_col." + 1 where ".$this->itm_tbl_pk." = '".$this->itm."'";
				break;
				
			}
			$db->dml($q);
			
			//Log Query
			$lq = "insert into ".$this->log_tbl_nm." (".$this->log_tbl_usr_col.", ".$this->log_tbl_itm_col.") values('".$this->usr."','".$this->itm."')";
			$db->dml($lq);
		}
		
		function has_rated()
		{
			if( ! empty($this->usr))
			{
				$db = new dbo();
				$q = "select * from ".$this->log_tbl_nm." where ".$this->log_tbl_usr_col." = '".$this->usr."' and ".$this->log_tbl_itm_col." = '".$this->itm."'";
				
				return $db->found($q);
			}
			else 
				return true;
		}
		
		function get_url()
		{
			$pos = strpos($_SERVER["QUERY_STRING"], $this->qs_rate_var_nm);
			
			if( $pos )
			{
				return basename($_SERVER["SCRIPT_NAME"])."?".substr($_SERVER["QUERY_STRING"], 0, $pos-1);
			}
		
			return basename($_SERVER["SCRIPT_NAME"])."?".$_SERVER["QUERY_STRING"];
		}
		
	}

?>