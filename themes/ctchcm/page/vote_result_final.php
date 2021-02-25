<?php
/*
  Template Name:  Vote Final Result
 */

if (isset($_GET['kid'])) {
    VoteExportToExcel($_GET['kid']);
}
?>
<html id="main">
    <head>
        <title>ctcvn vote system</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php wp_head(); ?>

    </head>

    <body id="main_bg">
        <div class=" container-fluid ">
            <div class="row">
                <div class="col-lg-12">
                    <?php get_template_part('template', 'vote-title') ?>
                </div>

                <?php
                $lishiList = getVoteFinalResult();
                $vote_lishi_total = get_option('_vote_total_lishi');
                ?>
                <div class="col-lg-12 title-space">
                    <label>理監事選舉結果</label>
                </div>
                <div class="col-lg-12">
                    <ul class="result-list" style=" text-align: center">
                        <?php
                        foreach ($lishiList as $val) {
                            switch ($val['position']) {
                                case "a":
                                    $position = "會長";
                                    $color = "#fcf5ea";
                                    break;
                                case "b":
                                    $position = "副會長";
                                    $color = "#e3f3f9";
                                    break;
                                case "c":
                                    $position = "常務理事";
                                    $color = "#cfeef9";
                                    break;
                                case "d":
                                    $position = "監事長";
                                    $color = "#e3edf7";
                                    break;
                            }
                            ?>
                            <li style="height: 100vh; letter-spacing: 2px;  border-left: 1px solid #ccc; background-color: <?php echo $color ?>">
                                <div style=" font-weight: bold; height: 50px; padding-top: 10px; background-color:#e45a00   ; color: white">
                                    <?php echo $position ?>
                                </div>
                                <div style=" font-weight: bold; height: 50px; padding-top: 10px; color: #333">
                                    <?php echo $val['name'] ?>
                                </div>
                                <div style="margin-bottom: 50px;  margin-top: 30px"> <img style=" max-width: 80%; border-radius: 5px;
                                                                                         box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                                                                                         border: 1px solid #999"  src="<?php echo get_vote_img($val['img']) ?>" /></div>
                                <div style=" justify-content: flex-start; font-size: 0.7em"><?php echo $val['company'] ?></div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <div></div>
                </div>

            </div>
        </div>
    </body>

    <script>
        jQuery(document).ready(function () {

        });
    </script>
</html>
