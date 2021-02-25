<?php get_header(); ?>
<?php get_template_part('template', 'slider-multi'); ?>

<section id="content" role="main">

    <!--TAM AN SHOW THONG TIN  BAU CU-->  
    <div class="col-md-4 ">
        <?php get_template_part('template', 'directory'); ?>
    </div>
    <div class="col-md-4 ">
        <?php get_template_part('template', 'assembly'); ?>
    </div>


 <div class="col-md-4 ">
        <?php get_template_part('template', 'news'); ?>
    </div>
<!--    <div class="col-md-8">
      <?php// get_template_part('template', 'vote-result')  ?>
    </div>-->
</section>
<?php
get_footer();
