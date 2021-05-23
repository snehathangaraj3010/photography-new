<?php get_header(); ?>    
    
     
            
<div class="container">
<div class="row-fluid">
<div class="span12 acthive-page-2">
      
<div class="row-fluid">      
<?php 
while(have_posts()): the_post(); ?> 
<div  class='arc thumbnail span6' >
<a href="<?php the_permalink(); ?>">
<?php wpeden_post_timthumb(500,300); ?>  
</a>
<div class="media-body">
<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>&nbsp;</h2> 
</div> <!-- mediia body ends -->
<div class="clear"></div>
<div class="breadcrumb"><i class="icon icon-user"></i> Posted by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a> <i class="icon icon-time"></i> Posted on <?php echo get_the_date(); ?>  <a href="<?php the_permalink();?>">read more <i class="icon icon-arrow-right"></i> </a></div>
</div> 
<?php endwhile; ?>               
</div>
 
<?php 
global $wp_query;
if (  $wp_query->max_num_pages > 1 ) : ?>
<div class="clear"></div>
                <div id="nav-below" class="navigation post box arc">
                    <?php get_template_part('pagination'); ?>
                </div><!-- #nav-below -->
<?php endif; ?>

</div>
 
</div>
</div>
      
<?php get_footer(); ?>
