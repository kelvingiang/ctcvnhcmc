<?php
//Template Name: Page Check In Waiting
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width">    
        <link type="image/x-icon" href="/favicon.ico" rel="icon"> <!-- icon show on web title -->
        <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon"/>

        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <!-- B--- phan cho bootstrap -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- E --- phan bootstrap ------------->
        <!--[if lt IE 9]>
        <script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/html5.js"></script>
        <![endif]-->
              <!-- them jquery tu google    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> -->
        <meta name="geo.region" content="VN" />
        <meta name="geo.position" content="10.725377;106.720064" />
        <meta name="ICBM" content="10.725377, 106.720064" />
        <?php// suite_seo(); ?>
        <?php// wp_head(); ?>
    </head>

  <body>
        <div class="container-fluid" style="background-color: white; height: 90vh; padding: 0px 20px" >
             <div id="loggo" style="margin: 2px 0">
                <a style=" float: left"  href="<?php echo home_url() ?>" >
                    <img src ="<?php echo get_img('ctcvnhcmc_logo.png') ?>" 
                         alt="ctcvn_logo" 
                         title="ctcvn_logo"
                         style='width: 100px'
                         />
                </a> 
                <h1 style=" float: left; margin-left: 10px; font-size: 35px; color: #0F127E">胡 志 明 市 台 灣 商 會 </h1>
            </div>
            <div class="row" style="padding-top:  75px">
              <div class="col-lg-12" style="height: 70px; background-color:  #0F127E; border-radius: 5px;  margin-bottom: 20px ">
                  <h1 style="font-weight:  bold; line-height: 2.3; margin-left: 10px; color: white; letter-spacing: 3px"><?php echo get_option('_title_text'); ?></h1>
              </div>    
              <div class=" col-lg-12" style="text-align: center; height:300px; line-height: 300px;" >
                  <label ID="waiting_txt"><?php echo get_option('_waiting_text'); ?></label>              
             </div>
                
        </div>
      </div>
    </body>
    
    <style>
        #waiting_txt{
            font-size:50px;
            font-weight: bold;
            letter-spacing: 10px;
            -webkit-animation-name: example; /* Safari 4.0 - 8.0 */
            -webkit-animation-duration: 10s; /* Safari 4.0 - 8.0 */
            -webkit-animation-iteration-count: infinite; /* Safari 4.0 - 8.0 */
            animation-name: example;
            animation-duration: 10s;
            animation-iteration-count: infinite;
            
        }
        
        
        /* Safari 4.0 - 8.0 */
        @-webkit-keyframes example {
          0%   {color:#333; font-size: 60px}
          20%   {color:#333; font-size: 60px}
          40%  {color:#0F127E; font-size: 72px}
          41%  {color:#0F127E; font-size: 70px}
          42%  {color:#0F127E; font-size: 71px}
          50%  {color:#0F127E; font-size: 70px}
          70%  {color:#0F127E; font-size: 70px}
          100% {color:#333; font-size: 60px;}
        }

        /* Standard syntax */
        @keyframes example {
          0%   {color:#333; font-size: 60px}
          20%   {color:#333; font-size: 60px}
          40%  {color:#0F127E; font-size: 72px}
          41%  {color:#0F127E; font-size: 70px}
          42%  {color:#0F127E; font-size: 71px}
          50%  {color:#0F127E; font-size: 70px}
          70%  {color:#0F127E; font-size: 70px}
          100% {color:#333; font-size: 60px;}
        }
    </style>




