<?php
/*
  Template Name:  Vote Result
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
                <!--                <div class="col-lg-12" style="text-align: right">
                                    <label class="btn btn-large btn-default" onclick="FunctionExportExcle(1)">理事結果導出</label>
                                    <label class="btn btn-large btn-default" onclick="FunctionExportExcle(2)">監事投票導出</label>
                                </div>-->
                <?php
                $lishiList = getVoteResult(1);
                $vote_lishi_total = get_option('_vote_total_lishi');
                ?>
                <div class="col-lg-12 title-space">
                    <label>理事選舉結果</label>
                    <div style="text-align: left; font-size: 13px">
                        <i style="color: #6d6f72; margin-right: 10px"> 總票數：<?php echo $vote_lishi_total ?>;</i> 
                        <i style="color: #6d6f72"> 廢票數：<?php echo get_option('_vote_total_lishi_fail'); ?></i> 
                    </div>
                </div>
                <div class="col-lg-12">
                    <ul class="list_style">
                        <li>
                            <div><label>姓名</label></div>
                            <div><label>照片</label></div>
                            <div><label>公司</label></div>
                            <div><label>票數</label></div>
                            <div><label>比率</label></div>
                        </li>
                        <?php
                        foreach ($lishiList as $val) {
                            ?>
                            <li>
                                <div style=" font-weight: bold"><?php echo $val['name'] ?></div>
                                <div> <img   src="<?php echo get_vote_img($val['img']) ?>" /></div>
                                <div style=" justify-content: flex-start"><?php echo $val['company'] ?></div>
                                <div><?php echo $val['vote_total'] ?></div>
                                <div><?php
                                    if ($val['vote_total'] > 0 && $vote_lishi_total > 0) {
                                            echo round($val['vote_total'] * 100 / $vote_lishi_total, 2) . '%';
                                    }
                                    ?></div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <div></div>
                </div>
                <div class="col-lg-12" style="height: 15px; background-color: #a9a398"></div>
                <!--//=================================================================-->               
                <?php
                $jianshiList = getVoteResult(2);
                $vote_jianshi_total = get_option('_vote_total_jianshi');
                ?>
                <div class="col-lg-12 title-space" style="margin-top: 70px" >
                    <label>監事選舉結果</label>
                    <div style="text-align: left; font-size: 13px">
                        <i style="color: #6d6f72; margin-right: 10px"> 總票數：<?php echo $vote_jianshi_total; ?>;</i>
                        <i style="color: #6d6f72"> 廢票數：<?php echo get_option('_vote_total_jianshi_fail'); ?></i>
                    </div>
                </div>
                <div class="col-lg-12">
                    <ul class="list_style">
                        <li>
                            <div><label>姓名</label></div>
                            <div><label>照片</label></div>
                            <div><label>公司</label></div>
                            <div><label>票數</label></div>
                            <div><label>比率</label></div>
                        </li>
                        <?php
                        foreach ($jianshiList as $val) {
                            ?>
                            <li>
                                <div style="font-weight: bold"><?php echo $val['name'] ?></div>
                                <div> <img   src="<?php echo get_vote_img($val['img']) ?>" /></div>
                                <div style="justify-content: flex-start"><?php echo $val['company'] ?></div>
                                <div><?php echo $val['vote_total'] ?></div>
                                <div><?php
                                    if ($val['vote_total'] > 0) {
                                        echo round($val['vote_total'] * 100 / $vote_jianshi_total, 2) . '%';
                                    }
                                    ?>
                                </div>
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
//        function FunctionExportExcle(id) {
//            window.location = "<?php // echo HCM_URL  ?>vote-result?kid=" + id;
//        }

        jQuery(document).ready(function () {

        });
    </script>
</html>
