<?php require_once("classes/dbo.class.php");

	class voting
	{
	
		private $image_vup = "images/vote_up.gif";
		private $image_vdown = "images/vote_down.gif";
		private $class_vote_text = "vote_text";
		
		private $itm_tbl_nm = "blogs";
		private $itm_tbl_pk = "b_id";
		private $itm_tbl_vup_col = "b_vote_up";
		private $itm_tbl_vdown_col = "b_vote_down";
		
		private $log_tbl_nm = "vote_log";
		private $log_tbl_usr_col = "vl_u_id";
		private $log_tbl_itm_col = "vl_b_id";
		
		private $session_user_id = "uid";
		private $qs_itm_var_nm = "bid";
		private $qs_vote_var_nm = "vote";
	
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
				
			//Is voting??
			if(isset($_GET[$this->qs_vote_var_nm]) && !empty($_GET[$this->qs_vote_var_nm]))
			{
				$this->do_voting($_GET[$this->qs_vote_var_nm]);
				header("location: ".$this->get_url());
				exit;
			}
		}
		
		
		function show()
		{
			$db = new dbo();
		
			$q = "select ".$this->itm_tbl_vup_col.", ".$this->itm_tbl_vdown_col." from ".$this->itm_tbl_nm." where ".$this->itm_tbl_pk." = '".$this->itm."'";
			$res = $db->get($q);
			$row = mysqli_fetch_assoc($res);
			$vote_up = $row[$this->itm_tbl_vup_col];
			$vote_down = $row[$this->itm_tbl_vdown_col];
		
			if( $this->has_voted() )
			{
				echo '<div style="opacity: 0.5;">';
				echo '<img src="'.$this->image_vup.'" />';
				echo '<span class="'.$this->class_vote_text.'">'.$vote_up.'</span>';
				echo '<img src="'.$this->image_vdown.'" />';
				echo '<span class="'.$this->class_vote_text.'">'.$vote_down.'</span>';
				echo '</div>';
			}
			else
			{
				echo '<a href="'.$this->get_url()."&".$this->qs_vote_var_nm."=up".'">';
				echo '<img src="'.$this->image_vup.'" />';
				echo '</a>';
				echo '<span class="'.$this->class_vote_text.'">'.$vote_up.'</span>';
				
				echo '<a href="'.$this->get_url()."&".$this->qs_vote_var_nm."=down".'">';
				echo '<img src="'.$this->image_vdown.'" />';
				echo '</a>';
				echo '<span class="'.$this->class_vote_text.'">'.$vote_down.'</span>';
			
			}
		
		}
		
		function do_voting($type)
		{
			if( $this->has_voted() ) { return; } 

			$db = new dbo();
			
			//Vote query
			$q = "";
			if($type == "up")
				$q = "update ".$this->itm_tbl_nm." set ".$this->itm_tbl_vup_col." = ".$this->itm_tbl_vup_col." + 1 where ".$this->itm_tbl_pk." = '".$this->itm."'";
			else if($type == "down")
				$q = "update ".$this->itm_tbl_nm." set ".$this->itm_tbl_vdown_col." = ".$this->itm_tbl_vdown_col." + 1 where ".$this->itm_tbl_pk." = '".$this->itm."'";
			$db->dml($q);
			
			//Log Query
			$lq = "insert into ".$this->log_tbl_nm." (".$this->log_tbl_usr_col.", ".$this->log_tbl_itm_col.") values('".$this->usr."','".$this->itm."')";
			$db->dml($lq);
		}
		
		function has_voted()
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
			$pos = strpos($_SERVER["QUERY_STRING"], $this->qs_vote_var_nm);
			
			if( $pos )
			{
				return basename($_SERVER["SCRIPT_NAME"])."?".substr($_SERVER["QUERY_STRING"], 0, $pos-1);
			}
		
			return basename($_SERVER["SCRIPT_NAME"])."?".$_SERVER["QUERY_STRING"];
		}
		
	}

?>