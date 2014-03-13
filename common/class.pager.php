<?php 
/************************************************************************************** 
* Class: navigation_pager 
* Original Author: Tsigo <tsigo@tsiris.com> 
* Modified By: OnlineTechTools.com
*
* Methods: 
*         find_start 
*         page_amount
*         page_navigation
**************************************************************************************/

class navigation_pager
{
	//Usage: int find_start(int limit)
	//Returns the start offset based on $_GET['page'] and $limit
	function find_start($limit)
	{ 
		if ((!isset($_GET['p'])) || ($_GET['p'] == "1"))
		{
			$start = 0;
			$_GET['p'] = 1;
		} else {
			$start = ($_GET['p']-1) * $limit;
	}
	return $start;
    }
	//Usage: int page_amount(int count, int limit)
	//Returns the number of pages needed based on a count and a limit
	function page_amount($count, $limit)
	{
		$pages = (($count % $limit) == 0) ? $count / $limit : floor($count / $limit) + 1;
		return $pages;
	}
	//Usage: string pageList(int curpage, int pages)
	//Returns a list of pages in the format of "« < [pages] > »" 
	function page_navigation($curpage, $pages, $query_status, $query_order, $direction)
	{
		$page_list  = '';

		//Print the first and previous page links if necessary...
		if (($curpage != 1) && ($curpage))
		{
			$page_list .= "  <a href=\"".$_SERVER['PHP_SELF']."?p=1&s=".$query_status."&o=".$query_order."&d=".$direction."\" title=\"First page\"><img src='images/first.gif' alt='First page' width='11' height='11' border='0' align='middle'></a> ";
		}
		if (($curpage-1) > 0)
		{
			$page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?p=".($curpage-1)."&s=".$query_status."&o=".$query_order."&d=".$direction."\" title=\"Previous page\"><img src='images/back.gif' alt='Previous page' width='11' height='11' border='0' align='middle'></a> ";
		}

		// Print the numeric page list; make the current page unlinked and bold...
		for ($i=1; $i<=$pages; $i++)
		{
			if ($i == $curpage)
	        {
				$page_list .= "<b>".$i."</b>";
	        } else { 
				$page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?p=".$i."&s=".$query_status."&o=".$query_order."&d=".$direction."\" title=\"Page ".$i."\">".$i."</a>";
			}
			$page_list .= " ";
		}

		//Print the Next and Last page links if necessary...
		if (($curpage+1) <= $pages)
		{
			$page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?p=".($curpage+1)."&s=".$query_status."&o=".$query_order."&d=".$direction."\" title=\"Next page\"><img src='images/right.gif' alt='Next page' width='11' height='11' border='0' align='middle'></a> ";
		}

		if (($curpage != $pages) && ($pages != 0))
		{
			$page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?p=".$pages."&s=".$query_status."&o=".$query_order."&d=".$direction."\" title=\"Last page\"><img src='images/last.gif' alt='Last page' width='11' height='11' border='0' align='middle'></a> ";
		}
	$page_list .= "</td>\n";
	return $page_list;
	}
}
?>