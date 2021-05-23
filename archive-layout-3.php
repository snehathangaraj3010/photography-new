<?php get_header(); ?>    
    
     
<div class="container"><div class="row-fluid"><div class="span12 arc-header">
      <h1>
                        <?php if ( is_day() ) : ?>                            
                        <?php echo get_the_date(); ?>    
                        <?php elseif ( is_month() ) : ?>
                        Monthly Archives: <?php echo get_the_date( 'F Y' ); ?>                        
                        <?php elseif ( is_year() ) : ?>
                        <?php echo get_the_date( 'Y' ); ?>                            
                        <?php elseif(is_category()) : ?>
                        <?php echo single_cat_title( '', false ); ?>
                        <?php elseif(is_tag()) : ?> 
                        <?php echo single_tag_title(); ?>
                        <?php else : the_post(); ?> 
                        <?php echo get_the_author(); ?>
                        <?php rewind_posts(); endif; ?>
      </h1>
      </div></div></div>
                  
<div class="container">
<div class="row-fluid">
<div class="span8 acthive-page-3">      
<?php 
while(have_posts()): the_post(); ?> 
<div class="row-fluid">
<div  <?php post_class('box arc span12'); ?>>
<div class="blog_head media">
<div class="media-body">                                           
<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<div class="meta">
<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a>  <i class="icon icon-calendar"></i> <?php echo get_the_date(); ?>   <a href="<?php the_permalink();?>">read more <i class="icon icon-arrow-right"></i></a>
</div><div class="clear"></div>
</div>
</div>
<a href="<?php the_permalink(); ?>">
<?php wpeden_post_timthumb(900,300,'thumbnail'); ?>  
</a>
<div class="media-body">
<div class="entry-content"><?php the_excerpt(); ?>
</div>
</div> <!-- mediia body ends -->
<div class="clear"></div>
</div> 
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
