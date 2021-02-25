<?php
//Template Name: Page Check In Merry
//get_header();
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
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
                                jQuery('#barcode-error').css('display', 'none');
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

                            } else if (data.status === 'error') {
                                jQuery('#guest-main, #last-check-in').css('display', 'none');
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
    </head>
    <body style="margin: 0">
        <div>
            <div class="my-waiting">
                <img src="<?php echo get_img('loading_pr2.gif') ?>"  style=" width: 150px" />
            </div>
            <div id="main">
                <div style="background-color: #9b1400">
                    <div style=" display: inline-block; padding: 15px; " >
                        <img  style=" width: 7em" src ="<?php echo get_img('merry-logo.png') ?>"/>
                    </div>
                    <div style="display: inline-block; padding-left: 50px; 
                         font-size: 30px; 
                         line-height: 2;
                         padding-bottom: 10px; 
                         color: white; 
                         z-index: 10;
                         letter-spacing: 3px;
                         position: absolute;
                         top: 30px;
                         font-weight: bold ">
                        <label>
                            胡志明市台灣商會            
                        </label>
                        <br>

                        <label>
                            <?php echo get_option('_title_text') ?>         
                        </label>          
                    </div>
                    <div style=" display: inline-block; text-align: right; position: absolute; right: 10px; top: 20px">
                        <img src="<?php echo get_img('merry-1.png'); ?>"/>
                    </div>
                </div>

                <div class="row" style="margin-top: 20px">
                    <div class=" col-lg-3 " style=" padding-left: 5px; margin-top: 30px; height: 385px; border-right: 1px #ddd dotted">
                        <form name="check-form" id="check-form" method="post" action="">
                            <!--<label>條碼</label>-->
                            <input type="text" id="txt-barcode" name="txt-barcode" style=" margin-left: 5px; width: 70%;  height: 33px"/>
                            <input type="submit" id="btn-submit" name="btn-submitbarcode"  value="傳 送" class=""/>
                        </form>
                        <div style=" position:  absolute; bottom: 80px; left: 9em">
                            <img src="<?php echo get_img('merry-3.gif'); ?>"/>
                        </div>
                    </div>
                    <div class="col-lg-9"style="padding-left: 10px">

                        <div class="row"  style=' margin-bottom: 20px; padding-bottom: 20px; min-height: 50px; color: #666;  border-bottom: 2px #999 dotted; float: left' >
                            <div style="padding-top: 10px; float: left; width: 50%">
                                <img src="<?php echo get_img('digiwin_logo.png'); ?>"/> </br>
                                <label style="font-size: 30px; font-weight: bold; padding-left: 10px;color: red"><?php _e('Digiwin'); ?></label>
                            </div>
                            <div  style="float: right; margin-bottom: 1px; width: 50%">
                                <h2 style="font-size: 25px; font-weight:bold;  color: red; margin: 10px auto 7px" > <?php _e('Welcome'); ?> </h2>
                                <div id="last-check-in"> </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12" id="barcode-error">條 碼 不 正 確 ! </div>
                        <div id="guest-main">
                            <div style=" float: left; width: 30%">
                                <div id="guest-pictrue"> </div>&nbsp;
                            </div>

                            <div id="info"  style=" float: left; width: 30%"> 
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
            <div style="opacity: 0.3;  height: 123px; position: absolute; bottom: 0px; width: 100%; background-image: url('<?php echo get_img('merry-bg.png');  ?>');">&nbsp;</div>
        </div>
    </body>
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
            width: 100%;
            margin:  0px 0px ;
            padding: 0px 0px;
            overflow:  auto;
            background-color: white;
           
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
            background-color: #046613;
            color: white;
            font-weight: bold;
            width: 74px;
            height: 40px;
            cursor: pointer;
            border: 0px;
            border-radius: 3px;
            opacity: 0.8;
        }
        #btn-submit:hover{
            opacity: 1;
        }

        .guest-info{
            clear: both;
            height: 35px;
            font-weight: bold;
            color: #257c00;
            letter-spacing: 2px;
            font-size: 20px;
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
            font-size: 30px; 
            font-weight: bold;
            color:#257c00;
            padding-bottom: 10px;

        }
        #guest-pic{
            width: 350px;
            margin-left: 10px; 
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 30px;
        }
        #last-check-in h5 {
            font-weight: bold;
            margin: 10px 10px;
            color: #ccc;

        }
        #barcode-error{
            display: none;
            font-size:  30px;
            font-weight: bold;
            color: red;
        }

    </style>
</html>
