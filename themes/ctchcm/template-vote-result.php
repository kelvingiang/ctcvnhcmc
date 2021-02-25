


<div class=" container-fluid ">
    <div class="row">
        <div class="col-lg-12">
            <label class="vote-title-text">胡志明台灣商會 理事 - 監事 投票結果</label>
        </div>

        <?php
        $lishiList = getVoteResult(1);
        $vote_total = voteTotal(1);
        ?>
        <div class="col-lg-12 title-space">理事選舉結果 <i style="color: #6d6f72"> 總票數：<?php echo $vote_total['total']; ?></i> </div>
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
                        <div><img   src="<?php echo get_vote_img($val['img']) ?>" /></div>
                        <div style="justify-content:  flex-start"><?php echo $val['company'] ?></div>
                        <div><?php echo $val['vote_total'] ?></div>
                        <div><?php echo round($val['vote_total'] * 100 / $vote_total['total'], 2) ?>%</div>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <div></div>
        </div>

        <!--//=================================================================-->   
        <div class="col-lg-12" style="height: 10px; background-color: #ccc; margin: 20px 0"></div>
        <?php
        $zangsiList = getVoteResult(2);
        $zangsi_vote_total = voteTotal(2);
        ?>
        <div class="col-lg-12 title-space" style="margin-top: 20px" >監事選舉結果 <i style="color: #6d6f72"> 總票數：<?php echo $zangsi_vote_total['total']; ?></i></div>
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
                foreach ($zangsiList as $val) {
                    ?>
                    <li>
                        <div style=" font-weight: bold"><?php echo $val['name'] ?></div>
                        <div> <img   src="<?php echo get_vote_img($val['img']) ?>" /></div>
                        <div style="justify-content:  flex-start" ><?php echo $val['company'] ?></div>
                        <div><?php echo $val['vote_total'] ?></div>
                        <div><?php echo round($val['vote_total'] * 100 / $zangsi_vote_total['total'], 2) ?>%</div>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <div></div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function () {

    });
</script>