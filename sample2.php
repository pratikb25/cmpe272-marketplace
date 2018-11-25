<?php
	include('./track_page_visits.php');
	store_visited_pages("Sample2");
	display_visited_pages();
	echo "This is Sample2 page";
?>