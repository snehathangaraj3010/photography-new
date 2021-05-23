<?php get_header(); ?>    
    
     
            
<div class="container">
<div class="row-fluid">
<div class="span8 acthive-page-1">
      
<?php 
while(have_posts()): the_post(); ?> 
<div  <?php post_class('post box arc media'); ?>>
<a href="<?php the_permalink(); ?>" class="pull-left">
<?php wpeden_post_timthumb(300,200); ?>  
</a>
<div class="media-body">
<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>&nbsp;</h2> 
<div class="entry-content"><?php the_excerpt(); ?>

</div>
</div> <!-- mediia body ends -->
<div class="clear"></div>
<div class="breadcrumb">Posted by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a> / Posted on <?php echo get_the_date(); ?> / <a href="<?php the_permalink();?>">read more &#187;</a></div>
</div> 
<?php endwhile; ?>               

<?php 
global $wp_query;
if (  $wp_query->max_num_pages > 1 ) : ?>
<div class="clear"></div>
                <div id="nav-below" class="navigation post box arc">
                    <?php get_template_part('pagination'); ?>
                </div><!-- #nav-below -->
<?php endif; ?>

</div>
<div class="span4">
 
<?php dynamic_sidebar('Archive Page'); ?>
</div>
</div>
</div>
      
<?php get_footer(); ?>
