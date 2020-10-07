<?php 
	echo "<ul class='pagination pull-left margin-zero mt0'>";

	//The first page button
	if ($page > 1) {
		$prev_page = $page - 1;
		echo "<li>";
			echo "<a href='{$page_url}page={$prev_page}'>";
				echo "<span style='margin:0 .5em;'>«</span>";
			echo "</a>";
		echo "</li>";
	}

	//Clickable page numbers

	//Find out total pages
	$total_pages = ceil($total_rows / $records_per_page);

	//Range of num links to show
	$range = 1;

	//Display links to 'range of pages' around 'current page'
	$initial_num = $page - $range;
	$condition_limit_num = ($page + $range)  + 1;

	for ($x=$initial_num; $x<$condition_limit_num; $x++) { 
		//Be sure '$x is grater tahn 0' AND 'less than or equal to the $total_pages'
		if (($x > 0) && ($x <= $total_pages)) {
			//Current page
			if ($x == $page) {
				echo "<li class='active'>";
					echo "<a href='javascript::void();'>{$x}</a>";
				echo "</li>";
			} else { //Not current page
			echo "<li>";
				echo " <a href='{$page_url}page={$x}'>{$x}</a> ";
			echo "</li>";
		}
		} 
		
	}

	//Last page button 
	if ($page < $total_pages) {
		$next_page = $page + 1;

		echo "<li>";
			echo "<a href='{$page_url}page={$next_page}'>";
				echo "<span style='margin:0 .5em;'>»</span>";
			echo "</a>";
		echo "</li>";
	}

	echo "</ul>";
?>