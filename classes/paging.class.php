<?php require_once("classes/dbo.class.php");

	class paging
	{
	
		private $items_per_page = 2;
		private $class_paging = "paging";
		private $class_paging_disabled = "paging_disabled";
		private $qs_paging_var = "page";
		
		//-- DO NOT EDIT BELOW THIS LINE ----------------------------
		
		private $q;
		private $total_items;
		private $current_page;
		private $last_page;
		
		function __construct($q)
		{
			$db = new dbo();
			
			//Copy Query
			$this->q = $q;
			
			//Get Total
			$count_q = $this->convert_to_count_query($q);
			$this->total_items = $db->get_scalar($count_q);
			
			//Fetch Current Page
			$this->current_page = isset($_GET[$this->qs_paging_var]) ? $_GET[$this->qs_paging_var] : 1;
			
			//Fetch Last Page
			$this->last_page = ceil( $this->total_items / $this->items_per_page );
			
		}
		
		function get_result()
		{
			$db = new dbo();
			
			$q = $this->q.$this->get_limits();
			return $db->get($q);
		}
		
		function page_links()
		{
			for($i=1; $i<=$this->last_page; $i++)
			{
				if($this->is_current($i))
					echo '<a href="'.$this->page_link($i).'" class="'.$this->class_paging_disabled.'">'.$i.'&nbsp;</a> ';
				else
					echo '<a href="'.$this->page_link($i).'" class="'.$this->class_paging.'">'.$i.' </a>&nbsp;';
			}
		}
		
		function next_link()
		{
			return $this->page_link($this->current_page + 1);
		}
		
		function previous_link()
		{
			return $this->page_link($this->current_page - 1);
		}
		
		function page_link($page)
		{
			if($this->is_valid_page($page))
				return $this->get_url()."&".$this->qs_paging_var."=".$page;
			else 
				return "#";
		}
		
		function has_previous()
		{
			return $this->current_page > 1;
		}
		
		function has_next()
		{
			return $this->current_page < $this->last_page;
		}
		
		function is_first()
		{
			return $this->current_page == 1;
		}
		
		function is_last()
		{
			return $this->current_page == $this->last_page;
		}
		
		function is_current($page)
		{
			return $page == $this->current_page;
		}
		
		function is_valid_page($page)
		{
			return $page >= 1 && $page <= $this->last_page;
		}
		
		function get_limits()
		{
			$this_page_start = ($this->current_page - 1) * $this->items_per_page;
			return " LIMIT ".$this_page_start.", ".$this->items_per_page;
		}
		
		function convert_to_count_query($q)
		{
			return substr_replace($q, " count(*) ", 7, strpos($q, "from")- 7);
		}
		
		function get_url()
		{
			$pos = strpos($_SERVER["QUERY_STRING"], $this->qs_paging_var);
			
			if( $pos )
			{
				return basename($_SERVER["SCRIPT_NAME"])."?".substr($_SERVER["QUERY_STRING"], 0, $pos-1);
			}
		
			return basename($_SERVER["SCRIPT_NAME"])."?".$_SERVER["QUERY_STRING"];
		}
	}

?>