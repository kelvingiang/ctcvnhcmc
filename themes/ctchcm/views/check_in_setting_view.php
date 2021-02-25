<?php
require_once ( HCM_DIR_MODEL . 'check_in_report_model.php' );
$model = new Admin_Check_In_Report_model();
//$list = $model->ReportView();
$page = getParams('page');
$msg = getParams('msg');

$list = $model->ReportjoinView();
?>
<div id="check_setting">
    <?php 
       $mess='';
       if(!empty($msg)){
           switch ($msg){
            case "1" :
               $mess = '批次重新產生QRCode檔案成功!';
               break;
            case "2" :
                $mess = '批次取QRCode檔案,檔名是會員編號-條碼成功!';
                break;
            case "3" :
                $mess ='刪除所有報到記錄成功!';
                break;
            default :
                $mess ='';
           }
        if(!empty($mess)){   
    ?>
    
     <div id="mess">
        <div class="close">X</div>
        <div class="mess_text"><h3><?php echo $mess ?></h3></div>
    </div>
    <?php
       }
     }
    ?>
   
    <div>
        <a class="btn button button-primary button-large" 
           href="<?php echo "admin.php?page=$page&action=report" ?>" 
        >導出報到細節</a>
    </div>
    <div>
        <a class="btn button button-primary button-large"
           href="<?php echo "admin.php?page=$page&action=guests" ?>"
        >導出會員</a>
    </div>
    <hr>
    <div>
        <a class=" btn button btn-warning button-large" 
           onclick="myConfirm('您確定刪除所有報到記錄','reset')"
        >刪除所有報到記錄</a>
    </div>
    <div>
        <a class=" btn button btn-warning button-large" 
           onclick="myConfirm('您確定產生新的QRCode,舊的會被刪除','qrcode')"
        >批次產生QRCode</a>
    </div>
    <div>
        <a class=" btn button btn-warning button-large" 
           onclick="myConfirm('您確定修改QRCode檔名,舊的會被刪除','modify')"
        >批次改QRCode檔名含編號</a>
    </div>
</div>

<style>
    #check_setting div{
         margin-top: 10px;
    }
    .btn-warning{
        background-color: red !important;
        color: white !important;
        border-radius: 5px !important;
    }
    .btn {
     margin-top: 2px; 
     margin-right: 20px; 
     letter-spacing: 4px   
    }
    
    #mess{
       height: 50px; 
       margin: 10px 10px 10px 0px; 
       background-color:#bedde9;
       border-radius: 3px;
       color: #8e8e8f;
       position: relative;
    }
    
  
    #mess .close{
        position: absolute;
        top:-8px;
        right: 8px;
        font-weight: bold;
        cursor: pointer;
    }
    #mess .mess_text h3{
          color: #8e8e8f;
        margin-left: 30px;
        line-height: 2.8;
        letter-spacing: 3px;
    }
</style>

<script type="text/javascript">
 jQuery(document).ready(function() {
    jQuery('.close').click(function() {
      jQuery(this).parent('#mess').hide(200);
    });

 }); 
    
    function myConfirm(title,action) {
        if (confirm(title)) {
            location.href = "<?php echo "admin.php?page=$page&action=" ?>"+action;
        } else {
            window.stop();
        }
    }
 </script>
