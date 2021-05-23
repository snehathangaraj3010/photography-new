    <div id="myCarousel" class="carousel slide carousel-fade">
    <ol class="carousel-indicators">
    <?php for($i=0; $i<7; $i++){ 
        $active = ($i==0)?'active':''; 
        echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" class="'.$active.'"></li>';
    }
    ?>
    </ol>
    <!-- Carousel items -->
    <div class="carousel-inner">
    <?php 
        $z = 0;
        for($i=1; $i<=7; $i++){  
    
            $slide = get_post(edenfresh_get_theme_opts('slider_'.$i));
            $meta = get_post_meta($slide->ID, 'wpeden_post_meta');
            $url = isset($meta['url'])?$meta['url']:'';
            $active = (++$z==1)?'active':''; 
            echo "<div class='{$active} item'>".wpeden_get_timthumb($slide,1000,400)."
                  <div class='carousel-caption'>
                        <h2 class='hidden-phone'><a href='{$url}'>{$slide->post_title}</a></h2>
                  </div>
                  </div>";   
   
    } ?>
    </div>
    <!-- Carousel nav -->
    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div>
   