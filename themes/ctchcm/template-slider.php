
    <div class="border_box">
        <div class="skitter-large-box">
            <div class="skitter skitter-large with-dots">
                <ul>
                    <?php
                    $_arr = array(
                        'post_type' => 'silder',
                        'posts_per_page' => -1,
                    );
                    $wp_query = new WP_Query($_arr);
                    if ($wp_query->have_posts()):
                        while ($wp_query->have_posts()):
                            $wp_query->the_post();
                            // cac hieu ung chuyen doi lay
                            $a = array("fade", "circlesRotate", "cubeSpread" ,"glassCube" ,"blindHeight", "circles", "swapBars", "tube", "cubeJelly", "blindWidth", "paralell", "showBarsRandom", "block");
                            $random_keys = array_rand($a); // random array tren de doi hieu ung
                            ?>
                            <li>

                                <a href="#cube"><img src="<?php echo the_post_thumbnail_url(); ?>" class="<?php echo $a[$random_keys]; ?>" /></a>
                                <div class="label_text">
                                    <p> <?php the_title(); ?> </p>                            
                                </div>
                            </li>
                            <?php
                        endwhile;
                    endif;
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <style type="text/css">
        
        .info_slide_dots{
           top : 10px;
           right: 10px !important;
           left: 90% !important;
            
        }
        .progressbar{
            background-color: white !important;
        }
                 
        .preview_slide{
            top : 30px;
        }
    @media only screen and (max-device-width : 1920px) {
        .border_box {
            background-color:  #fff;
            height: 560px;
        }
        .skitter    {
            max-width: 100% !important;
            height: 550px !important;

        }
        .container_skitter  .image_main{
            height: 550px !important;
        }
    }
     
    @media only screen and (max-device-width : 1366px)  {
        .border_box {
            background-color:  #fff;
            height: 410px;
        }
        .skitter    {
            max-width: 100% !important;
            height: 400px !important;

        }
        .container_skitter  .image_main{
            height: 400px !important;
        }
     }
     
    @media only screen and (max-device-width : 1280px)  {
        .border_box {
            background-color:  #fff;
            height: 360px;
        }
        .skitter    {
            max-width: 100% !important;
            height: 350px !important;

        }
        .container_skitter  .image_main{
            height: 350px !important;
        }
     }
    </style>
  <script type="text/javascript">
    jQuery(document).ready(function() {
//     console.log(screen.width);
        
    jQuery('.skitter-large').skitter({
//          thumbs: true,
        progressbar: true,
        preview: true,
//        height:'300px',
        
    });

    jQuery('.skitter-large').skitter('next');

});
</script>