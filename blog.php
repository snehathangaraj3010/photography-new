<?php 
//Template Name: Blog
get_header(); ?>    
    
     
            
<div class="container">
<div class="row-fluid">
<div class="span8 blog-page">   
<h2 class="entry-title mt0"><?php the_post(); the_title(); ?></h2>   
<?php 
query_posts('post_type=post&posts_per_page=10&paged='.get_query_var('paged'));
while(have_posts()): the_post(); ?> 
<div <?php post_class('box arc row-fluid'); ?>>
<div class="span2" align="center">
<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
<?php echo get_avatar($post->post_author,85); ?>
</a>
<div class="date">
<div class="day"><?php echo get_the_date('d'); ?></div>
<div class="month"><?php echo get_the_date('F'); ?></div>
<div class="year"><?php echo get_the_date('Y'); ?></div>
</div>
</div>
<div class="span10">
<div class="blog_head">                                            
<h3 class="entry-title mt0"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<div class="clear"></div>
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
                <div id="nav-below" class="navigation">
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
