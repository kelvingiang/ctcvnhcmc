<?php
require_once ( HCM_DIR_MODEL . 'check_in_report_model.php' );
$model = new Admin_Check_In_Report_model();
//$list = $model->ReportView();
$page = getParams('page');

$list = $model->ReportjoinView();
$signUpList = $model->signUpTotal();
?>
<div class="report_head" style="height: 90px">
    <h3>登記總數 : <?php echo count($signUpList); ?></h3> 
    <h3>出席總數 : <?php echo count($list); ?></h3> 
    <a style=' margin-top: 2px; margin-right: 20px; letter-spacing: 4px ' 
       class="button button-primary button-large" 
       href="<?php echo home_url('print-check-in'); ?>" 
       target="_blank"> 列印報表</a>
    
    <a style=' margin-top: 2px; margin-right: 40px; letter-spacing: 4px ' 
       class="button button-primary button-large" 
       href="<?php echo "admin.php?page=$page&action=export" ?>"> 導出報到細節</a>
    
    <a style=' margin-top: 2px; margin-right: 40px; letter-spacing: 4px ' 
       class="button button-primary button-large" 
       href="<?php echo "admin.php?page=$page&action=waiting" ?>"> 標題 - 刷卡</a>
</div>
<div class="report_content">
    <div>
        <table cellpadding="0"  Cellspacing='0' style='width: 98%; margin-top: 20px; border-left: 1px solid #000; border-right:  1px solid #000 '>
            <tr style=' background-color: #2b95fd; color: white; height: 50px; font-size: 18px'>
                <th style=" border-right:  1px white solid; width: 25px">編號</th>
                <th style=' border-right:  1px white solid; width: 100px'>姓名</th>
<!--                <th style=' border-right: 1px white solid; width: 80px'><?php // _e('Country')   ?></th>-->
                <th style=' border-right: 1px white solid;width: 100px'>職稱</th>
                <!--<th style=' border-right: 1px white solid'><?php // _e('Career')   ?></th>-->
                <th style=' border-right: 1px white solid; width: 100px'>電話</th>
                <th style="border-right: 1px white solid; width: 200px">公司名稱</th>
                <th style=' border-right: 1px white solid; width: 150px'>報到時間</th>
            </tr>
            <?php foreach ($list as $key => $val) { ?>
                <tr class="report">
                    <td style=" text-align: center"> <?php echo $val['stt']; ?></td>
                    <td> <?php echo $val['full_name'] ?></td>  
    <!--                    <td> <?php
                    //echo get_country($val['country'])
                    ?>
                    </td>  -->
                    <td > <?php echo $val['position'] ?></td>  
                    <td> <?php echo $val['phone'] ?></td>  
                    <td> <?php echo $val['company'] ?></td>   
                    <td >

                        <?php
                        echo $val['time'] . ' --- ' . $val['date'];
//                        $listDetail = $model->ReportDetailView($val['guests_id']);
//                        foreach ($listDetail as $item) {
//                            echo '<lable>' . $item['time'] . ' __ ' . $item['date'] . '</lable><br>';
//                        }
                        ?> 
                    </td>  

                </tr> 
            <?php } ?>

        </table>
    </div>
</div>