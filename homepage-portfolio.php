<div class="row-fluid">
    <div class="edenfresh-portfolio-section">
    <div class="container">
     
        <div class="row-fluid portfolio-head">
            <div class="span12"><br>
                <h3 class="section-head bottom-div" align="center">Portfolio</h3><br>
            </div>
        </div>
        <div class="" id="portfolio-carousel">
        <div class="carousel-inner">
        <div class="item active">
        <div class="row-fluid edenfresh-portfolio">
            <?php  
                $fi = 0;
                query_posts('post_type=portfolio&posts_per_page=8');
                 while(have_posts()){  the_post();                 
            ?>
            <div class="span3 portfolio-item">
             
              <?php wpeden_post_timthumb(250, 167); ?> 
              <div class="mask text-center">
              <div class="info btn-group"> 
              <a data-lightbox="<?php echo edenfresh_post_thumb_url(); ?>" data-title="<?php the_title(); ?>" href="<?php echo edenfresh_post_thumb_url(); ?>" class="btn btn-primary"><i class="icon icon-search icon-white"></i></a> 
              <a href="<?php the_permalink(); ?>" class="btn btn-success"><i class="icon icon-arrow-right icon-white"></i></a> 
              </div>
              <h3><?php the_title(); ?></h3>
              </div>
              <div class="clear"></div>
             
            </div>
            
            <?php 
                 }
            ?>
        </div>  
        </div> 
        
        
        </div>   
        </div>   
    </div>
    </div>
</div>