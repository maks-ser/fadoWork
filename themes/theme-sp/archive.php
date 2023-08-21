<?php
$category = get_queried_object();
$taxonomy = $category->taxonomy;
$term_id = $category->term_id;

get_header();

require_once get_template_directory() . '/template/cat-news.php';

get_footer();