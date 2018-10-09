<?php
/*
Template Name: All posts
*/
?>
<?php get_header(); ?>
<?php
$debut = 0; //The first article to be displayed
?>
<?php while(have_posts()) : the_post(); ?>
<h2><?php the_title(); ?></h2>
<ul>
<?php
$args = array(
	'post_type' => 'car',
	'posts_per_page' => 300
 );
$myposts = get_posts( $args );
foreach($myposts as $post) :
?>
<li><?php the_time('d/m/y') ?>: <a href="<?php the_permalink(); ?>">View this car - </a><?php the_title(); ?></li>
<?php endforeach; ?>
</ul>
<?php endwhile; ?>