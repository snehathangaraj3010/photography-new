<?php 
if ( !defined('ABSPATH')) exit; 
get_header(); 
?>
<br>
<div class="container" style="margin-bottom: 30px;">
    <div class="row-fluid">
        <div class="span12" align="center">                  
                <h3><?php echo edenfresh_get_theme_opts('home_featured_title','Welcome to Luminus'); ?></h3>
                <?php echo edenfresh_get_theme_opts('home_featured_desc','Fully responsive, clean looking WordPress Theme') ?>
                <br><br><br>
                <a href="<?php echo edenfresh_get_theme_opts('home_featured_btnurl','http://wpeden.com'); ?>" class="btn"><?php echo edenfresh_get_theme_opts('home_featured_btntxt','Get It Now!'); ?></a>              
        </div>
    </div>
</div>
<br><br><br> <br><br>
<div class="container fps-services"> 
    <div class="row-fluid">
    
     <?php for($i=1;$i<=4;$i++): ?>
        <div class="span3">
        <?php $tpid = (int)edenfresh_get_theme_opts('home_featured_page_'.$i); if($tpid) { $meta = get_post_meta($tpid,'wpeden_post_meta', true); $intropage = get_page($tpid); $introcontent = esc_attr($meta['excerpt']); $atitle = $intropage->post_title; $aurl = get_permalink($tpid);  } else { $atitle = "Featured Page {$i}"; $introcontent = "Featured Page {$i} Excerpt Comes Here"; $aurl = "#";  }  ?>
        <div class="service-box">
            <div class="entry-content">
            <span class="service-icon"><i class="icon  <?php echo $meta['icon']?$meta['icon']:'icon-beaker';?>"></i></span> 
            <h3><a href="<?php echo $aurl; ?>"><?php echo esc_attr($atitle); ?></a></h3>
            <?php echo esc_attr($introcontent); ?>
            </div>
        </div>  
        </div>
        
     <?php endfor; ?>
     
    </div>
</div>
<div class="container fps-portfolio">      
    <?php get_template_part('homepage','portfolio'); ?>
    <div class="clear"></div>
</div>   

</div> 
</div>

<?php get_footer();