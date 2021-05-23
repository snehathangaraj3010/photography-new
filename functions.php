<?php
 
if ( ! isset( $content_width ) ) $content_width = 960;


require_once(dirname(__FILE__)."/admin/engine.php"); 
require_once(dirname(__FILE__)."/libs/nav-menu-walker.class.php"); 
 

 
//generate thumbnail 
function edenfresh_thumb($post, $size='', $extra = array(), $echo = true){    
    $size = $size?$size:'thumbnail';   
    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large'); 
    $large_image_url = $large_image_url[0];    
    $large_image_url = $large_image_url?$large_image_url:'';        
    $class = isset($extra['class'])?$extra['class']:'';
    if($echo&&has_post_thumbnail($post->ID ))
    echo get_the_post_thumbnail($post->ID, $size, $extra );
    else if(!$echo&&has_post_thumbnail($post->ID ))
    return get_the_post_thumbnail($post->ID, $size, $extra );  
    else if($echo)
    echo "";
    else
    return "";
    
}

function edenfresh_register_portfolio() {
 
    $labels = array(
        'name' => 'Portfolio',
        'singular_name' => 'Portfolio', 'post type singular name',
        'add_new' => 'Add New', 'portfolio',
        'add_new_item' => 'Add New Portfolio',
        'edit_item' => 'Edit Portfolio',
        'new_item' => 'New Portfolio',
        'view_item' => 'View Portfolio',
        'search_items' => 'Search Portfolio',
        'not_found' =>  'Nothing found',
        'not_found_in_trash' => 'Nothing found in Trash',
        'parent_item_colon' => ''
    );
 
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'menu_icon' => get_stylesheet_directory_uri().'/images/portfolio.png',
        'supports' => array( 'title', 'editor', 'thumbnail', 'comments','excerpt' ),
      ); 
 
    register_post_type( 'portfolio' , $args );
} 

function edenfresh_register_slider() {
 
    $labels = array(
        'name' => 'Slider',
        'singular_name' => 'Slider',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Slide',
        'edit_item' => 'Edit Slide',
        'new_item' => 'New Slide',
        'view_item' => 'View Slider',
        'search_items' => 'Search Slide',
        'not_found' =>  'Nothing found',
        'not_found_in_trash' => 'Nothing found in Trash',
        'parent_item_colon' => ''
    );
 
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'menu_icon' => get_stylesheet_directory_uri().'/images/slider.png',
        'supports' => array( 'title', 'editor', 'thumbnail', 'comments','excerpt' ),
      ); 
 
    register_post_type( 'minimax_slider' , $args );
} 

 
//post thumbnail function
function edenfresh_post_thumb($size='', $echo = true, $extra = null){
    global $post;
    $size = $size?$size:'thumbnail';   
    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large'); 
    $large_image_url = $large_image_url[0];
    if((is_single()||is_page())&&$large_image_url=='') return;
    $large_image_url = $large_image_url?$large_image_url:'';              
    $class = isset($extra['class'])?$extra['class']:'';
    if($echo&&has_post_thumbnail($post->ID ))
    echo get_the_post_thumbnail($post->ID, $size, $extra );    
    else if(!$echo&&has_post_thumbnail($post->ID ))
    return get_the_post_thumbnail($post->ID, $size, $extra );  
    else if($echo)
    echo "";
    else
    return "";
}

//post thumbnail url
function edenfresh_post_thumb_url($size='', $echo = true, $extra = null){
    global $post;
    $size = $size?$size:'thumbnail';   
    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large'); 
    $large_image_url = $large_image_url[0];
    return $large_image_url;
}

//generate cutom excerpt
function edenfresh_post_excerpt($length){
    global $post;
    $uexcerpt = $post->post_excerpt?$post->post_excerpt:$post->post_content;
    $uexcerpt = strip_tags($uexcerpt);
    $excerpt = substr($uexcerpt,0,$length);
    $eexcerpt = substr($uexcerpt,$length);
    $excerpt .= array_shift(explode(" ",$eexcerpt));
    echo $excerpt.'...';
}

//comments
function edenfresh_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; 
   $GLOBALS['comment'] = $comment;
    
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
        ?>
    <li class="pingback">
        <div class="row-fluid"><div class="span11">Pingback: <?php comment_author_link(); ?></div><div class="span1"><?php edit_comment_link( 'Edit', '<span class="btn btn-mini edit-link">', '</span>' ); ?></div>
        </div> 
    <?php
        break;
        default :
   ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">         
            <div class="comment-body">
               <div id="comment-<?php comment_ID(); ?>" class="media">
                    <div class="author-box pull-left">
                        <?php echo get_avatar($comment,100); ?>
                         
                    </div> <!-- end .avatar-box -->
                    <div class="media-body">                        
                        <div class="comment-meta commentmetadata">
                        <?php printf('<span class="fn">%s</span>', get_comment_author_link()) ?>
                        <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                            <?php
                                /* translators: 1: date, 2: time */
                                printf( '%1$s at %2$s', get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link(  '(Edit)', ' ' );
                            ?>
                        </div><!-- .comment-meta .commentmetadata -->

                        <?php if ($comment->comment_approved == '0') : ?>
                            <em class="moderation">Your comment is awaiting moderation.</em>
                            <br />
                        <?php endif; ?>

                        <div class="comment-content"><?php comment_text() ?></div> <!-- end comment-content-->
                        <div class="reply-container"><?php comment_reply_link(array_merge( $args, array('reply_text' => 'Reply','depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
                    </div> <!-- end comment-wrap-->
                    <div class="comment-arrow"></div>
                </div> <!-- end comment-body-->
            </div> <!-- end comment-body-->
         
 
<?php 
        break;
    endswitch;    
 }
 
 
 
 //Sidebars
 function edenfresh_widget_init(){
     
    register_sidebar(array(
      'name' => 'Single Post',
      'id' => 'single_post_sidebar',
      'description' => 'Sidebar For Single post.',
      'before_widget' => '<div class="box widget">',
      'after_widget' => '</div>',
      'before_title' => '<h3>',
      'after_title' => '</h3>'
    ));
        
     register_sidebar(array(
      'name' => 'Archive Page',
      'id' => 'archive_page_sidebar',
      'description' => 'Sidebar For Archive Page.',
      'before_widget' => '<div class="box widget box_yellow">',
      'after_widget' => '</div>',
      'before_title' => '<h3>',
      'after_title' => '</h3>'
    ));    
       
    
    register_sidebar(array(
      'name' => 'Footer Left',
      'id' => 'footer1',
      'description' => 'Footer Left',
      'before_widget' => '<div class="widget widget-footer">',
      'after_widget' => '</div>',
      'before_title' => '<h3>',
      'after_title' => '</h3>'
    )); 
    
    register_sidebar(array(
      'name' => 'Footer Middle',
      'id' => 'footer2',
      'description' => 'Footer Middle',
      'before_widget' => '<div class="widget widget-footer">',
      'after_widget' => '</div>',
      'before_title' => '<h3>',
      'after_title' => '</h3>'
    )); 
    
    register_sidebar(array(
      'name' => 'Footer Right',
      'id' => 'footer3',
      'description' => 'Footer Right',
      'before_widget' => '<div class="widget widget-footer">',
      'after_widget' => '</div>',
      'before_title' => '<h3>',
      'after_title' => '</h3>'
    )); 
 }
 
 // wp_title filter
 function edenfresh_filter_wp_title( $old_title, $sep, $sep_location ){
    $ssep = ' ' . $sep . ' ';
    // find the type of index page this is
    if( is_category() ) $insert = $ssep . 'Category';
    elseif( is_tag() ) $insert = $ssep . 'Tag';
    elseif( is_author() ) $insert = $ssep . 'Author';
    elseif( is_year() || is_month() || is_day() ) $insert = $ssep . 'Archives';
    else $insert = NULL;
     
    // get the page number we're on (index)
    if( get_query_var( 'paged' ) )
    $num = $ssep . 'page ' . get_query_var( 'paged' );
     
    // get the page number we're on (multipage post)
    elseif( get_query_var( 'page' ) )
    $num = $ssep . 'page ' . get_query_var( 'page' );
     
    // else
    else $num = NULL;
    
    $site_description = get_bloginfo( 'description', 'display' );
    if ( is_home() && $site_description )
    $old_title .=  $ssep  . $site_description;
     
    // concoct and return new title
    return get_bloginfo( 'name' ) . $insert . $old_title . $num;
}
 
 
//Theme setup function 
function edenfresh_setup(){
    register_nav_menus( array(
        'primary' => 'Top Menu' 
          
    ) );
    
    edenfresh_register_portfolio();
    edenfresh_register_slider();
    add_theme_support( 'post-thumbnails' );
    if(has_post_format('aside'))
    add_theme_support("post-formats");
    add_theme_support("automatic-feed-links");
    add_theme_support("excerpt",array('post','page'));
    add_theme_support('custom-background');
     
    add_image_size( 'edenfresh-responsive-post-thumb', 960, 99999, false );
    add_image_size( 'edenfresh-responsive-blog-thumb', 960, 300, true ); 
    add_image_size( 'edenfresh-responsive-intro-thumb', 470, 200, true ); 
    add_image_size( 'edenfresh-responsive-category-thumb', 270, 270, true ); 
 
 }
 
 function edenfresh_enqueue_scripts(){
    wp_enqueue_script('edenfresh-bootstrap',get_stylesheet_directory_uri().'/bootstrap/js/bootstrap.min.js',array('jquery'));                 
    wp_enqueue_script('edenfresh-site',get_stylesheet_directory_uri().'/js/site.js',array('jquery'));     
    wp_enqueue_script('lightbox-js',get_stylesheet_directory_uri().'/js/lightbox/js/lightbox.min.js',array('jquery'));
    wp_enqueue_style('lightbox-css',get_stylesheet_directory_uri().'/js/lightbox/css/lightbox.css');
    wp_enqueue_script( 'comment-reply' ); 
 }
 
 

           
 
//generate thumbnail 
function wpeden_thumb($post, $size='', $extra = array(), $echo = true){    
    $size = $size?$size:'thumbnail';   
    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large'); 
    $large_image_url = $large_image_url[0];    
    $blankimage = isset($extra['altimg'])?$extra['altimg']:WPEDEN_THEME_URL.'/images/wpeden-medium.png';
    $large_image_url = $large_image_url?$large_image_url:$blankimage;        
    $class = isset($extra['class'])?$extra['class']:'';
    if($echo&&has_post_thumbnail($post->ID ))
    echo get_the_post_thumbnail($post->ID, $size, $extra );
    else if(!$echo&&has_post_thumbnail($post->ID ))
    return get_the_post_thumbnail($post->ID, $size, $extra );  
    else if($echo)
    echo "<img  class='$class wpeden-blank-thumb' src='$blankimage'/> ";
    else
    return "<img class='$class wpeden-blank-thumb' src='$blankimage'/> ";
    
} 

//post thumbnail function
function wpeden_post_thumb($size='', $echo = true, $extra = null){
    global $post;
    $size = $size?$size:'thumbnail';   
    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large'); 
    $large_image_url = $large_image_url[0];
    if((is_single()||is_page())&&$large_image_url=='') return;
    $blankimage = isset($extra['altimg'])?$extra['altimg']:WPEDEN_THEME_URL.'/images/wpeden-medium.png';
    $large_image_url = $large_image_url?$large_image_url:$blankimage;              
    $class = isset($extra['class'])?$extra['class']:'';
    if($echo&&has_post_thumbnail($post->ID ))
    echo get_the_post_thumbnail($post->ID, $size, $extra );    
    else if(!$echo&&has_post_thumbnail($post->ID ))
    return get_the_post_thumbnail($post->ID, $size, $extra );  
    else if($echo)
    echo "<img class='$class wpeden-blank-thumb' src='$blankimage'/> ";
    else
    return "<img class='$class wpeden-blank-thumb' src='$blankimage'/> ";
}

function wpeden_post_thumb_url(){
   global $post; 
   $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large'); 
   return $large_image_url[0];
}

function wpeden_thumb_url($post){
   $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large'); 
   return $large_image_url[0];
}

function wpeden_post_timthumb($w, $h, $c=''){
    global $post;
    $img = wpeden_post_thumb_url();
    if($img)
    echo "<img src=\"".get_stylesheet_directory_uri()."/timthumb.php?src=$img&w=$w&h=$h&zc=1\" title='{$post->post_title}' alt='{$post->post_title}' class='$c' />"; 
}

function wpeden_timthumb($post, $w, $h, $c = ''){
   if(is_array($c)) $c = $c['class'];
   $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large'); 
   $img = $large_image_url[0];
   echo "<img src=\"".get_stylesheet_directory_uri()."/timthumb.php?src=$img&w=$w&h=$h&zc=1\" title='{$post->post_title}' alt='{$post->post_title}' class='$c' />"; 
}

function wpeden_get_timthumb($post, $w, $h, $c = ''){
   $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); 
   $img = $large_image_url[0];
   return "<img src=\"".get_stylesheet_directory_uri()."/timthumb.php?src=$img&w=$w&h=$h&zc=1\" title='{$post->post_title}' alt='{$post->post_title}' class='$c' />"; 
} 

function wpeden_meta_box_icons(){
        global $post;
        $icons['icon-cloud-download'] = 'Cloud Download';
        $icons['icon-cloud-upload'] = 'Cloud Upload';
        $icons['icon-lightbulb'] = 'Lightbulb';
        $icons['icon-exchange'] = 'Exchange';
        $icons['icon-bell-alt'] = 'Bell Alt';
        $icons['icon-file-alt'] = 'File Alt';
        $icons['icon-beer'] = 'Beer';
        $icons['icon-coffee'] = 'Coffee';
        $icons['icon-food'] = 'Food';
        $icons['icon-fighter-jet'] = 'Fighter Jet';
        $icons['icon-user-md'] = 'User Md';
        $icons['icon-stethoscope'] = 'Stethoscope';
        $icons['icon-suitcase'] = 'Suitcase';
        $icons['icon-building'] = 'Building';
        $icons['icon-hospital'] = 'Hospital';
        $icons['icon-ambulance'] = 'Ambulance';
        $icons['icon-medkit'] = 'Medkit';
        $icons['icon-h-sign'] = 'H Sign';
        $icons['icon-plus-sign-alt'] = 'Plus Sign Alt';
        $icons['icon-spinner'] = 'Spinner';
        $icons['icon-angle-left'] = 'Angle Left';
        $icons['icon-angle-right'] = 'Angle Right';
        $icons['icon-angle-up'] = 'Angle Up';
        $icons['icon-angle-down'] = 'Angle Down';
        $icons['icon-double-angle-left'] = 'Double Angle Left';
        $icons['icon-double-angle-right'] = 'Double Angle Right';
        $icons['icon-double-angle-up'] = 'Double Angle Up';
        $icons['icon-double-angle-down'] = 'Double Angle Down';
        $icons['icon-circle-blank'] = 'Circle Blank';
        $icons['icon-circle'] = 'Circle';
        $icons['icon-desktop'] = 'Desktop';
        $icons['icon-laptop'] = 'Laptop';
        $icons['icon-tablet'] = 'Tablet';
        $icons['icon-mobile-phone'] = 'Mobile Phone';
        $icons['icon-quote-left'] = 'Quote Left';
        $icons['icon-quote-right'] = 'Quote Right';
        $icons['icon-reply'] = 'Reply';
        $icons['icon-github-alt'] = 'Github Alt';
        $icons['icon-folder-close-alt'] = 'Folder Close Alt';
        $icons['icon-folder-open-alt'] = 'Folder Open Alt';
        $icons['icon-adjust'] = 'Adjust';
        $icons['icon-asterisk'] = 'Asterisk';
        $icons['icon-ban-circle'] = 'Ban Circle';
        $icons['icon-bar-chart'] = 'Bar Chart';
        $icons['icon-barcode'] = 'Barcode';
        $icons['icon-beaker'] = 'Beaker';
        $icons['icon-beer'] = 'Beer';
        $icons['icon-bell'] = 'Bell';
        $icons['icon-bell-alt'] = 'Bell Alt';
        $icons['icon-bolt'] = 'Bolt';
        $icons['icon-book'] = 'Book';
        $icons['icon-bookmark'] = 'Bookmark';
        $icons['icon-bookmark-empty'] = 'Bookmark Empty';
        $icons['icon-briefcase'] = 'Briefcase';
        $icons['icon-bullhorn'] = 'Bullhorn';
        $icons['icon-calendar'] = 'Calendar';
        $icons['icon-camera'] = 'Camera';
        $icons['icon-camera-retro'] = 'Camera Retro';
        $icons['icon-certificate'] = 'Certificate';
        $icons['icon-check'] = 'Check';
        $icons['icon-check-empty'] = 'Check Empty';
        $icons['icon-circle'] = 'Circle';
        $icons['icon-circle-blank'] = 'Circle Blank';
        $icons['icon-cloud'] = 'Cloud';
        $icons['icon-cloud-download'] = 'Cloud Download';
        $icons['icon-cloud-upload'] = 'Cloud Upload';
        $icons['icon-coffee'] = 'Coffee';
        $icons['icon-cog'] = 'Cog';
        $icons['icon-cogs'] = 'Cogs';
        $icons['icon-comment'] = 'Comment';
        $icons['icon-comment-alt'] = 'Comment Alt';
        $icons['icon-comments'] = 'Comments';
        $icons['icon-comments-alt'] = 'Comments Alt';
        $icons['icon-credit-card'] = 'Credit Card';
        $icons['icon-dashboard'] = 'Dashboard';
        $icons['icon-desktop'] = 'Desktop';
        $icons['icon-download'] = 'Download';
        $icons['icon-download-alt'] = 'Download Alt';
        $icons['icon-edit'] = 'Edit';
        $icons['icon-envelope'] = 'Envelope';
        $icons['icon-envelope-alt'] = 'Envelope Alt';
        $icons['icon-exchange'] = 'Exchange';
        $icons['icon-exclamation-sign'] = 'Exclamation Sign';
        $icons['icon-external-link'] = 'External Link';
        $icons['icon-eye-close'] = 'Eye Close';
        $icons['icon-eye-open'] = 'Eye Open';
        $icons['icon-facetime-video'] = 'Facetime Video';
        $icons['icon-fighter-jet'] = 'Fighter Jet';
        $icons['icon-film'] = 'Film';
        $icons['icon-filter'] = 'Filter';
        $icons['icon-fire'] = 'Fire';
        $icons['icon-flag'] = 'Flag';
        $icons['icon-folder-close'] = 'Folder Close';
        $icons['icon-folder-open'] = 'Folder Open';
        $icons['icon-folder-close-alt'] = 'Folder Close Alt';
        $icons['icon-folder-open-alt'] = 'Folder Open Alt';
        $icons['icon-food'] = 'Food';
        $icons['icon-gift'] = 'Gift';
        $icons['icon-glass'] = 'Glass';
        $icons['icon-globe'] = 'Globe';
        $icons['icon-group'] = 'Group';
        $icons['icon-hdd'] = 'Hdd';
        $icons['icon-headphones'] = 'Headphones';
        $icons['icon-heart'] = 'Heart';
        $icons['icon-heart-empty'] = 'Heart Empty';
        $icons['icon-home'] = 'Home';
        $icons['icon-inbox'] = 'Inbox';
        $icons['icon-info-sign'] = 'Info Sign';
        $icons['icon-key'] = 'Key';
        $icons['icon-leaf'] = 'Leaf';
        $icons['icon-laptop'] = 'Laptop';
        $icons['icon-legal'] = 'Legal';
        $icons['icon-lemon'] = 'Lemon';
        $icons['icon-lightbulb'] = 'Lightbulb';
        $icons['icon-lock'] = 'Lock';
        $icons['icon-unlock'] = 'Unlock';
        $icons['icon-magic'] = 'Magic';
        $icons['icon-magnet'] = 'Magnet';
        $icons['icon-map-marker'] = 'Map Marker';
        $icons['icon-minus'] = 'Minus';
        $icons['icon-minus-sign'] = 'Minus Sign';
        $icons['icon-mobile-phone'] = 'Mobile Phone';
        $icons['icon-money'] = 'Money';
        $icons['icon-move'] = 'Move';
        $icons['icon-music'] = 'Music';
        $icons['icon-off'] = 'Off';
        $icons['icon-ok'] = 'Ok';
        $icons['icon-ok-circle'] = 'Ok Circle';
        $icons['icon-ok-sign'] = 'Ok Sign';
        $icons['icon-pencil'] = 'Pencil';
        $icons['icon-picture'] = 'Picture';
        $icons['icon-plane'] = 'Plane';
        $icons['icon-plus'] = 'Plus';
        $icons['icon-plus-sign'] = 'Plus Sign';
        $icons['icon-print'] = 'Print';
        $icons['icon-pushpin'] = 'Pushpin';
        $icons['icon-qrcode'] = 'Qrcode';
        $icons['icon-question-sign'] = 'Question Sign';
        $icons['icon-quote-left'] = 'Quote Left';
        $icons['icon-quote-right'] = 'Quote Right';
        $icons['icon-random'] = 'Random';
        $icons['icon-refresh'] = 'Refresh';
        $icons['icon-remove'] = 'Remove';
        $icons['icon-remove-circle'] = 'Remove Circle';
        $icons['icon-remove-sign'] = 'Remove Sign';
        $icons['icon-reorder'] = 'Reorder';
        $icons['icon-reply'] = 'Reply';
        $icons['icon-resize-horizontal'] = 'Resize Horizontal';
        $icons['icon-resize-vertical'] = 'Resize Vertical';
        $icons['icon-retweet'] = 'Retweet';
        $icons['icon-road'] = 'Road';
        $icons['icon-rss'] = 'Rss';
        $icons['icon-screenshot'] = 'Screenshot';
        $icons['icon-search'] = 'Search';
        $icons['icon-share'] = 'Share';
        $icons['icon-share-alt'] = 'Share Alt';
        $icons['icon-shopping-cart'] = 'Shopping Cart';
        $icons['icon-signal'] = 'Signal';
        $icons['icon-signin'] = 'Signin';
        $icons['icon-signout'] = 'Signout';
        $icons['icon-sitemap'] = 'Sitemap';
        $icons['icon-sort'] = 'Sort';
        $icons['icon-sort-down'] = 'Sort Down';
        $icons['icon-sort-up'] = 'Sort Up';
        $icons['icon-spinner'] = 'Spinner';
        $icons['icon-star'] = 'Star';
        $icons['icon-star-empty'] = 'Star Empty';
        $icons['icon-star-half'] = 'Star Half';
        $icons['icon-tablet'] = 'Tablet';
        $icons['icon-tag'] = 'Tag';
        $icons['icon-tags'] = 'Tags';
        $icons['icon-tasks'] = 'Tasks';
        $icons['icon-thumbs-down'] = 'Thumbs Down';
        $icons['icon-thumbs-up'] = 'Thumbs Up';
        $icons['icon-time'] = 'Time';
        $icons['icon-tint'] = 'Tint';
        $icons['icon-trash'] = 'Trash';
        $icons['icon-trophy'] = 'Trophy';
        $icons['icon-truck'] = 'Truck';
        $icons['icon-umbrella'] = 'Umbrella';
        $icons['icon-upload'] = 'Upload';
        $icons['icon-upload-alt'] = 'Upload Alt';
        $icons['icon-user'] = 'User';
        $icons['icon-user-md'] = 'User Md';
        $icons['icon-volume-off'] = 'Volume Off';
        $icons['icon-volume-down'] = 'Volume Down';
        $icons['icon-volume-up'] = 'Volume Up';
        $icons['icon-warning-sign'] = 'Warning Sign';
        $icons['icon-wrench'] = 'Wrench';
        $icons['icon-zoom-in'] = 'Zoom In';
        $icons['icon-zoom-out'] = 'Zoom Out';
        $icons['icon-file'] = 'File';
        $icons['icon-file-alt'] = 'File Alt';
        $icons['icon-cut'] = 'Cut';
        $icons['icon-copy'] = 'Copy';
        $icons['icon-paste'] = 'Paste';
        $icons['icon-save'] = 'Save';
        $icons['icon-undo'] = 'Undo';
        $icons['icon-repeat'] = 'Repeat';
        $icons['icon-text-height'] = 'Text Height';
        $icons['icon-text-width'] = 'Text Width';
        $icons['icon-align-left'] = 'Align Left';
        $icons['icon-align-center'] = 'Align Center';
        $icons['icon-align-right'] = 'Align Right';
        $icons['icon-align-justify'] = 'Align Justify';
        $icons['icon-indent-left'] = 'Indent Left';
        $icons['icon-indent-right'] = 'Indent Right';
        $icons['icon-font'] = 'Font';
        $icons['icon-bold'] = 'Bold';
        $icons['icon-italic'] = 'Italic';
        $icons['icon-strikethrough'] = 'Strikethrough';
        $icons['icon-underline'] = 'Underline';
        $icons['icon-link'] = 'Link';
        $icons['icon-paper-clip'] = 'Paper Clip';
        $icons['icon-columns'] = 'Columns';
        $icons['icon-table'] = 'Table';
        $icons['icon-th-large'] = 'Th Large';
        $icons['icon-th'] = 'Th';
        $icons['icon-th-list'] = 'Th List';
        $icons['icon-list'] = 'List';
        $icons['icon-list-ol'] = 'List Ol';
        $icons['icon-list-ul'] = 'List Ul';
        $icons['icon-list-alt'] = 'List Alt';
        $icons['icon-angle-left'] = 'Angle Left';
        $icons['icon-angle-right'] = 'Angle Right';
        $icons['icon-angle-up'] = 'Angle Up';
        $icons['icon-angle-down'] = 'Angle Down';
        $icons['icon-arrow-down'] = 'Arrow Down';
        $icons['icon-arrow-left'] = 'Arrow Left';
        $icons['icon-arrow-right'] = 'Arrow Right';
        $icons['icon-arrow-up'] = 'Arrow Up';
        $icons['icon-caret-down'] = 'Caret Down';
        $icons['icon-caret-left'] = 'Caret Left';
        $icons['icon-caret-right'] = 'Caret Right';
        $icons['icon-caret-up'] = 'Caret Up';
        $icons['icon-chevron-down'] = 'Chevron Down';
        $icons['icon-chevron-left'] = 'Chevron Left';
        $icons['icon-chevron-right'] = 'Chevron Right';
        $icons['icon-chevron-up'] = 'Chevron Up';
        $icons['icon-circle-arrow-down'] = 'Circle Arrow Down';
        $icons['icon-circle-arrow-left'] = 'Circle Arrow Left';
        $icons['icon-circle-arrow-right'] = 'Circle Arrow Right';
        $icons['icon-circle-arrow-up'] = 'Circle Arrow Up';
        $icons['icon-double-angle-left'] = 'Double Angle Left';
        $icons['icon-double-angle-right'] = 'Double Angle Right';
        $icons['icon-double-angle-up'] = 'Double Angle Up';
        $icons['icon-double-angle-down'] = 'Double Angle Down';
        $icons['icon-hand-down'] = 'Hand Down';
        $icons['icon-hand-left'] = 'Hand Left';
        $icons['icon-hand-right'] = 'Hand Right';
        $icons['icon-hand-up'] = 'Hand Up';
        $icons['icon-circle'] = 'Circle';
        $icons['icon-circle-blank'] = 'Circle Blank';
        $icons['icon-play-circle'] = 'Play Circle';
        $icons['icon-play'] = 'Play';
        $icons['icon-pause'] = 'Pause';
        $icons['icon-stop'] = 'Stop';
        $icons['icon-step-backward'] = 'Step Backward';
        $icons['icon-fast-backward'] = 'Fast Backward';
        $icons['icon-backward'] = 'Backward';
        $icons['icon-forward'] = 'Forward';
        $icons['icon-fast-forward'] = 'Fast Forward';
        $icons['icon-step-forward'] = 'Step Forward';
        $icons['icon-eject'] = 'Eject';
        $icons['icon-fullscreen'] = 'Fullscreen';
        $icons['icon-resize-full'] = 'Resize Full';
        $icons['icon-resize-small'] = 'Resize Small';
        $icons['icon-phone'] = 'Phone';
        $icons['icon-phone-sign'] = 'Phone Sign';
        $icons['icon-facebook'] = 'Facebook';
        $icons['icon-facebook-sign'] = 'Facebook Sign';
        $icons['icon-twitter'] = 'Twitter';
        $icons['icon-twitter-sign'] = 'Twitter Sign';
        $icons['icon-github'] = 'Github';
        $icons['icon-github-alt'] = 'Github Alt';
        $icons['icon-github-sign'] = 'Github Sign';
        $icons['icon-linkedin'] = 'Linkedin';
        $icons['icon-linkedin-sign'] = 'Linkedin Sign';
        $icons['icon-pinterest'] = 'Pinterest';
        $icons['icon-pinterest-sign'] = 'Pinterest Sign';
        $icons['icon-google-plus'] = 'Google Plus';
        $icons['icon-google-plus-sign'] = 'Google Plus Sign';
        $icons['icon-sign-blank'] = 'Sign Blank';
        $icons['icon-ambulance'] = 'Ambulance';
        $icons['icon-beaker'] = 'Beaker';
        $icons['icon-h-sign'] = 'H Sign';
        $icons['icon-hospital'] = 'Hospital';
        $icons['icon-medkit'] = 'Medkit';
        $icons['icon-plus-sign-alt'] = 'Plus Sign Alt';
        $icons['icon-stethoscope'] = 'Stethoscope';
        $icons['icon-user-md'] = 'User Md';
        $data = maybe_unserialize(get_post_meta($post->ID,'wpeden_post_meta', true));
        
        //if(is_array($data))
        $icon = isset($data['icon']) ? esc_attr($data['icon']) : '';
        $excerpt = isset($data['excerpt']) ? esc_attr($data['excerpt']) : '';       
        ?>
        <style type="text/css">        
        i.noicon{
           padding: 5px;
        }
        label.xdicon{
                float: left;
                min-width: 20px !important;
                max-width: 20px !important;
                min-height: 20px !important;
                max-height: 20px !important;
                text-align: center;
                line-height: 16px;
                font-size: 14px;
                padding:5px 7px;
                display: inline-table;
                border: 1px solid #dddddd;
                border-radius: 2px;
                transition: all 0.3s ease-in-out;
                margin: 3px;
            }
            label.xdicon i{
                width: 16px !important;
            }
            .xdicon:hover{
                border: 1px solid #1E8CBE;
                transition: all 0.3s ease-in-out;
            }
            .xdicon.active{
                border: 1px solid #1E8CBE;
                background: #1E8CBE;
                color: #ffffff;
                transition: all 0.3s ease-in-out;
            }
            #tabpane .row{
                margin-bottom: 20px;
            }
        </style>
        <script>
            jQuery(function($){
                $('.xdicon').click(function(){
                    $('.xdicon').removeClass('active');
                    $(this).addClass('active');
                });
            });
        </script>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" />
        <label for="icons"><b>Select Page Icon:</b></label>     
        <div style="height: 200px;padding: 10px;border: 1px solid #ddd">
                <div style="height: 180px;overflow: auto;">
                    <div style="clear: both"></div>
                    <?php
                    if($icon != '')
                            echo "<label class='xdicon active' title='{$icon}'><input style='display:none;' type=radio name='wpeden_post_meta[icon]' value='{$icon}' checked=checked ><i class='{$icon}'></i></label>";
                    foreach($icons  as $class => $name){
                        if($icon != $class) 
                            echo "<label class='xdicon' title='$name'><i class='$class'></i><input style='display:none' type='radio' name='wpeden_post_meta[icon]' value='{$class}' ".checked($class, $icon, false)." title='{$name}' /></label>";     
                    }
                    ?>
                    <div style="clear: both"></div>                       
                </div>                    
        </div>
        
        <label for="icons"><b>Excerpt:</b></label><br>   
        <textarea class="widefat" style="max-width: 100%; min-width: 100%; min-height: 80px; overflow: hidden;" name="wpeden_post_meta[excerpt]"><?php echo $excerpt; ?></textarea>  
        <?php       
    
} 

function wpeden_save_meta_data($postid, $post){
       if(isset($_POST['wpeden_post_meta'])){
        update_post_meta($postid, 'wpeden_post_meta',$_POST['wpeden_post_meta']);   
       }
}

 function wpeden_meta_boxes(){ 
                                       
    $meta_boxes = array(
                    'wpeden-icons'=>array('title'       =>  __('Page Info',"luminus"),
                                          'callback'    =>  'wpeden_meta_box_icons',
                                          'position'    =>  'side',
                                          'priority'    =>  'core')
                   );
                       
    $meta_boxes = apply_filters("wpmp_meta_box", $meta_boxes);
    
    foreach($meta_boxes as $id=>$meta_box){
        extract($meta_box);
        add_meta_box($id, $title, $callback,'page', $position, $priority);
    }    
}


add_action( 'admin_init', 'wpeden_meta_boxes', 0 );
add_action( 'save_post', 'wpeden_save_meta_data',10,2);
add_action( 'wp_enqueue_scripts', 'edenfresh_enqueue_scripts');
add_filter( 'wp_title', 'edenfresh_filter_wp_title', 10, 3 );
add_action( 'init', 'edenfresh_widget_init' );  
add_action( 'after_setup_theme', 'edenfresh_setup' );  
 
