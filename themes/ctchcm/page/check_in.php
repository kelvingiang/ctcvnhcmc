<?php
//Template Name: Page Check In
//get_header();
?>
<script src="<?php echo get_template_directory_uri() . '/js/jquery-1.4.2.min.js' ?>" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#txt-barcode").focus();
        jQuery('#check-form').submit(function (e) {
            var barcode = jQuery('#txt-barcode').val();
            jQuery('.my-waiting').css('display', 'block');
            jQuery.ajax({
                url: '<?php echo get_template_directory_uri() . '/ajax/updata-checkin.php' ?>', // lay doi tuong chuyen sang dang array
                type: 'post',
//                data: $(this).serialize(),
                data: {id: barcode},
                dataType: 'json',
                success: function (data) {  // set ket qua tra ve  data tra ve co thanh phan status va message
                    if (data.status === 'done') {
                        jQuery("#txt-barcode").val('');
                        // window.location.reload();
                        jQuery('#barcode-error, #barcode-unactive').css('display', 'none');
                        jQuery('#guest-main, #last-check-in').css('display', 'block');
                        jQuery('#last-check-in').children().remove();
                        if (data.info.TotalTimes !== null) {
                            jQuery('#last-check-in').append("<h5>登入次數 : " + data.info.TotalTimes + " 次  </h5>");
                            jQuery('#last-check-in').append("<h5>上次登入 : " + data.info.LastCheckIn + "</h5>");
                        }
                        jQuery('#guest_name').text(data.info.FullName);
                        jQuery('#guest_stt').text(data.info.MemberCode);
                        jQuery('#guest_position').text(data.info.Position);
                        jQuery('#guest_company').text(data.info.Company);
                        jQuery('#guest_email').text(data.info.Email);
                        jQuery('#guest_phone').text(data.info.Phone);
                        jQuery('#guest_note').text(data.info.Note);
                        jQuery('#guest-pic').remove();
                        jQuery('#guest-pictrue').append(data.info.Img);
                        window.setTimeout(function () {
                            jQuery('.my-waiting').css('display', 'none');
                        }, 100);
                    } else if (data.status === 'unactive') {
                        jQuery("#txt-barcode").val('');
                        jQuery('#guest-main, #last-check-in, #barcode-error').css('display', 'none');
                        jQuery('#barcode-unactive').css('display', 'block');
                        window.setTimeout(function () {
                            jQuery('.my-waiting').css('display', 'none');
                        }, 100);
                    } else if (data.status === 'error') {
                        jQuery("#txt-barcode").val('');
                        jQuery('#guest-main, #last-check-in, #barcode-unactive').css('display', 'none');
                        jQuery('#barcode-error').css('display', 'block');
                        jQuery('#barcode-error').css('display', 'block');
                        window.setTimeout(function () {
                            jQuery('.my-waiting').css('display', 'none');
                        }, 100);
//                        jQuery('#strMessageLogin').text(data.message);
                    }
                },
                error: function (xhr) {
                    console.log(xhr.reponseText);
                    //console.log(data.status);
                }
            });
            e.preventDefault();
        });
    });
</script>
<div class="my-waiting">
    <img src="<?php echo get_img('loading_pr2.gif') ?>"  style=" width: 150px" />
</div>
<div id="main">

    <div class="row">
        <!--<img src="<?php //echo get_img('check_in_panel.jpg')         ?>" style="width: 100%; height: 200px" />-->
        <img src ="<?php echo get_img('ctcvnhcmc_logo.png') ?>"  style="width: 120px; height: 120px; float: left; padding-left: 100px"/>
        <h2 style="padding-left: 300px; line-height: 60px; font-size: 30px; color:  #ff3333; font-weight: bold;color: #0F127E">
            胡 志 明 市 台 灣 商 會            
        </h2>
        <h3 style="padding-left: 300px; font-size: 25px;  letter-spacing: 5px; color:  #ff3333; font-weight: bold; color: #0F127E ">
            <?php echo get_option('_title_text') ?>         
        </h3>
        <div style=" clear:  both"></div>
    </div>

    <div class="row" style=" border-top: 3px #FC9105 solid;">
        <div class=" col-lg-3 " style=" padding-left: 5px; margin-top: 30px; height: 385px; border-right: 1px #D1D4D6 dotted">
            <form name="check-form" id="check-form" method="post" action="">
                <!--<label>條碼</label>-->
                <input type="text" id="txt-barcode" name="txt-barcode" required style="width: 130px;  height: 33px"/>
                <input type="submit" id="btn-submit" name="btn-submitbarcode"  value="傳 送" class="btn btn-sm"/>
            </form>
        </div>
        <div class="col-lg-9"style="padding-left: 10px">

            <div class="row"  style=' margin-bottom: 10px;min-height: 50px; color: #666;  border-bottom: 2px #666 dotted; float: left' >
                <div  style="float: left; margin-bottom: 1px; width: 50%">
                    <h2 style="font-weight:bold;  color: #FC9105; margin: 10px auto 7px" > <?php _e('Welcome'); ?> </h2>
                    <div id="last-check-in"> </div>
                </div>
                <div style="padding-top: 10px; float: right; width: 50%">
                    <img src="<?php echo get_img('digiwin_logo.png'); ?>"/> </br>
                    <label style="font-size: 25px; font-weight: bold; padding-left: 10px;color: #FC9105"><?php _e('Digiwin'); ?></label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12" id="barcode-error">條 碼 不 正 確 ! </div>
            <div class="col-lg-12" id="barcode-unactive">您 的 帳 號 還 沒 啟 用 ! </div>
            <div id="guest-main">
                <div style="float: left">
                    <div id="guest-pictrue"> </div>
                </div>

                <div id="info"  style="padding-left: 70px; float:  left ; font-size: 15px; width:40%;"> 
                    <div class="guest-info guest-name">
                        <div><label>姓名 :</label></div>
                        <div><label id="guest_name"></label></div>
                    </div>
                    <div class="guest-info">
                        <div><label><?php _e('Member No'); ?> :</label></div>
                        <div><label id="guest_stt"></label></div>
                    </div>
                    <div class="guest-info">
                        <div><label><?php _e('Position'); ?> :</label></div>
                        <div><label id="guest_position"></label></div>
                    </div>
                    <div class="guest-info">
                        <div><label><?php _e('Company'); ?> :</label></div>
                        <div><label id="guest_company"></label></div>
                    </div>
                    <div class="guest-info">
                        <div><label><?php _e('Email'); ?> :</label></div>
                        <div><label id="guest_email"></label></div>
                    </div>
                    <div class="guest-info">
                        <div><label><?php _e('Phone'); ?> :</label></div>
                        <div><label id="guest_phone"></label></div>
                    </div>
                    <div class="guest-info">
                        <div><label><?php _e('Note'); ?> :</label></div>
                        <div><label id="guest_note"></label></div>
                    </div>

                </div>
                <div style="clear:  both"></div>
            </div>
        </div>

    </div>

</div>

</div>

<style type="text/css">
    .my-waiting{
        display: none;
        background-color:  rgba(0, 0, 0, 0.8);
        position:  fixed;
        top: 0px;
        bottom: 0px;
        right: 0px;
        left: 0px;
        text-align:  center;
        padding-top: 300px;
        z-index: 5000;
    }
    #main{
        width: 90%;
        margin: -8px auto 0 ;
        border-left: 1px #666 solid; 
        border-right:  1px #666 solid; 
        overflow:  auto;
    }
    .row{
        width: 100%
    }
    .col-lg-3{
        width: 20%;
        float: left;
    }
    .col-lg-9{
        width: 78%;
        float: left;
    }
    #info > p{
        margin-bottom: -6px  
    }
    h5{
        margin: -5px 0 7px;
    }
    #btn-submit{
        background-color: #0B7AF8;
        color: white;
        width: 74px;
        height: 34px;
        cursor: pointer;
        border: 0px;
        border-radius: 3px;
    }

    .guest-info{
        clear: both;
        height: 25px;
        font-weight: bold;
        color: #666;
    }
    .guest-info div:first-child{
        min-width: 100px;
        float: left;
    }
    .guest-info div:nth-child(2){
        width: 73%;
    }
    .guest-info div {
        float: left;
    }
    .guest-name{
        font-size: 20px; 
        font-weight: bold;
        color:#FC9105;
        padding-bottom: 10px;

    }
    #guest-pic{
        width: 350px;
        margin-left: 10px; 
        margin-top: 5px;
        border: 1px solid #999999;
        border-radius: 3px;
    }
    #last-check-in h5 {
        font-weight: bold
    }
    #barcode-error , #barcode-unactive{
        display: none;
        font-size:  30px;
        font-weight: bold;
        color: red;
    }
    #btn-submit:hover{
        background-color: #1360EF;
    }
</style>
