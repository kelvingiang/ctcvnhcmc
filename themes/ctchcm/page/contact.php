<?php
/*
  Template Name:  Contact Us
 */
?>
<?php get_header(); ?>
<div id="popup_box"> 
    <div id="popup_content">
        <!-- OUR PopupBox DIV-->
        <h3><?php _e('Your Message Send Success'); ?></h3>
        <br>
        <p><?php _e('Thanks You'); ?> </p>
        <!--  <a id="popupBoxClose">Close</a>  -->
    </div>
</div>
<?php
if ($_POST) {
    $arr_error = array();

    if ($_SESSION['check_post'] != $_POST['check_post']) {
        $_SESSION['check_post'] = $_POST['check_post'];
        if (empty($_POST['con_company']))
            $arr_error['con_company'] = __('err_company');
        if (empty($_POST['con_contact']))
            $arr_error['con_contact'] = __('err_contact');
        if (empty($_POST['con_cell']))
            $arr_error['con_cell'] = __('err_phone');
        if (empty($_POST['con_email'])) {
            $arr_error['con_email'] = __('err_email');
        } else {
            if (!filter_var($_POST['con_email'], FILTER_VALIDATE_EMAIL) === TRUE) {
                $arr_error['con_email'] = __('err_sure_email');
            }
        }
        if(empty($_POST['con_subject']))
            $arr_error['con_subject'] = __('err_subject');
        if (empty($_POST['con_content']))
            $arr_error['con_content'] = __('err_content');

        if ($_POST['txt_captcha'] != $_POST['hidden_captcha']) {
            $arr_error['con_captcha'] = __("err_captcha");
        }


        if (empty($arr_error)) {
            $to = "taiwancouncilhcm@gmail.com";
            $subject = $_POST['con_subject'];
            $message = '<p style="font-weight: bold;font-size: 14px;float: left;margin-right: 5px;">' . __('Company') . '   </p> <p> :' . $_POST['con_company'] . '</p><br>';
            $message .='<p style="font-weight: bold;font-size: 14px;float: left;margin-right: 5px">' . __('Contact') . '  </p><p> :' . $_POST['con_contact'] . '</p><br>';
            $message .='<p style="font-weight: bold;font-size: 14px;float: left;margin-right: 5px">' . __('Cell') . '  </p><p> :' . $_POST['con_cell'] . '</p><br>';
            $message .='<p style="font-weight: bold;font-size: 14px;float: left;margin-right: 5px">' . __('Fax') . '  </p> <p> :' . $_POST['con_fax'] . '</p><br>';
            $message .='<p style="font-weight: bold;font-size: 14px;float: left;margin-right: 5px">' . __('Phone') . ' </p> <p> :' . $_POST['con_phone'] . '</p><br>';
            $message .='<p style="font-weight: bold;font-size: 14px;float: left;margin-right: 5px">' . __('Address') . '</p><p> :' . $_POST['con_address'] . '</p><br>';
            $message .='<p style="font-weight: bold;font-size: 14px;float: left;margin-right: 5px">' . __('Email') . ' </p><p> : ' . $_POST['con_email'] . '</p><br>';
            $message .='<p style="font-weight: bold;font-size: 14px;float: left;margin-right: 5px">' . __('Content') . '</p><p> :' . $_POST['con_content'] . '</p><br>';
// kieu data show trong mail
            add_filter('wp_mail_content_type', create_function('', 'return "text/html"; '));
            if (wp_mail($to, $subject, $message)) {
                ?>
                <script type="text/javascript">
                //                                     alert('send sucess');
                    loadPopupBox();

                    function loadPopupBox() {    // To Load the Popupbox
                        jQuery('#popup_box').fadeIn('slow');
                        setTimeout("unloadPopupBox('done')", 2000);
                    }

                    var unloadPopupBox = function(value) {    // TO Unload the Popupbox
                        jQuery('#popup_box').fadeOut("slow");
                        //  window.open("http://localhost/isana/contact-us/")
                        if (value === 'done') {
                            window.location = location.href;
                        }
                    };
                </script>
                <?php
            }
        } else {
            $company = $_POST['con_company'];
            $contact = $_POST['con_contact'];
            $cell = $_POST['con_cell'];
            $phone = $_POST['con_phone'];
            $fax = $_POST['con_fax'];
            $address = $_POST['con_address'];
            $email = $_POST['con_email'];
            $subject = $_POST['con_subject'];
            $content = $_POST['con_content'];
        }
    } else {
        //  echo 'ko co session';
    }
}
?>




<div class="row" style="padding-right: 10px">
    <div class="col-lg-3 sidebar-left">
        <?php get_sidebar() ?>
    </div>
    <div class="col-lg-9 col-sm-12">

        <div class="title-bg">
            <div class="title-text-before"></div>
            <div class="title-text"><lable> <?php _e('Contact Us'); ?>  </lable></div>
            <div class="title-text-after"></div>
        </div>
        <div class="title-content">
            <ul ul class="mem_item">
                <li>
                    <label class="mem_item_title"><?php _e('Address'); ?></label> :
                    <label class="mem_item_content"><?php echo get_option('website_address') ?></label>
                </li>
                <li>
                    <label class="mem_item_title"><?php _e('Cell'); ?>（Tel ) </label> :
                    <label class="mem_item_content"><?php echo get_option('website_phone') ?></label>
                </li>
                <li>
                    <label class="mem_item_title"><?php _e('Fax'); ?>（Fax )</label> :
                    <label class="mem_item_content"><?php echo get_option('website_fax') ?></label>
                </li>
                <li>
                    <label class="mem_item_title"> <?php _e('Email') ?>（Email ) </label> :
                    <label class="mem_item_content"><?php echo get_option('website_email') ?></label>
                </li>
            </ul>


            <div style="width: 95%; margin: 30px auto 15px;  background-color:  #ffffff; border:  1px  #999999 solid; border-radius: 4px">

                <form id="f-contact" name="f-contact" action=""  method="post">
                    <input type="hidden" id="check_post" name="check_post" value="<?php echo time() ?>">
                    <h2 class="orther_post"> <?php _e('Contact Info'); ?></h2>
                    <ul ul class="mem_item">
                        <li>
                            <label class="mem_item_title"> <?php _e('Company'); ?> <span>*</span></label> :
                            <label class="mem_item_content"><input id="con_company" name="con_company"  type="text"   value="<?php echo $company ?>" required></label>
                            <label class="mem_item_error"><?php echo $arr_error['con_company']; ?></label>
                        </li>
                        <li>
                            <label class="mem_item_title"><?php _e('Contact'); ?> <span>*</span> </label> :
                            <label class="mem_item_content"><input id="con_contact " name="con_contact"  type="text" value="<?php echo $contact ?>" required ></label>
                            <label class="mem_item_error"><?php echo $arr_error['con_contact']; ?></label>
                        </li>
                        <li>
                            <label class="mem_item_title"><?php _e('Cell'); ?> <span>*</span> </label> :
                            <label class="mem_item_content"><input id="con_cell" name="con_cell" type="text" value="<?php echo $cell; ?>"  class="type_phone_more" required ></label>
                            <label class="mem_item_error"><?php echo $arr_error['con_cell']; ?></label>
                        </li>
                        <li>
                            <label class="mem_item_title"><?php _e('Phone'); ?> </label> :
                            <label class="mem_item_content"><input id="con_phone" name="con_phone"  type="text" value="<?php echo $phone; ?>" class="type_phone_more" ></label>
                            <label class="mem_item_error"></label>
                        </li>
                        <li>
                            <label class="mem_item_title"> <?php _e('Fax'); ?></label> :
                            <label class="mem_item_content"><input id="con_fax" name="con_fax"  type="text" value="<?php echo $fax; ?>" class="type_phone_more"></label>
                            <label class="mem_item_error"></label>
                        </li>
                        <li>
                            <label class="mem_item_title"> <?php _e('Address'); ?></label> :
                            <label class="mem_item_content"><input id="con_address" name="con_address"  type="text" value="<?php echo $address; ?>"  ></label>
                            <label class="mem_item_error"></label>
                        </li>
                        <li>
                            <label class="mem_item_title"><?php _e('Email'); ?><span> * </span> </label> :
                            <label class="mem_item_content"><input id="con_email" name="con_email"  type="text" value="<?php echo $email; ?>" class="type_email" required></label>
                            <label class="mem_item_error" id="error_email"><?php echo $arr_error['con_email']; ?></label>
                        </li>
                        <li>
                            <label class="mem_item_title"><?php _e('subject'); ?><span> * </span></label> :
                            <label class="mem_item_content"><input id="con_subject" name="con_subject"  type="text" value="<?php echo $subject ?>" required   ></label>
                            <label class="mem_item_error"><?php echo $arr_error['con_subject']; ?></label>
                        </li>
                        <li>
                            <label class="mem_item_title noidung"><?php _e('Email Contant'); ?><span> * </span></label> 
                            <label class="mem_item_content">
                                <textarea style="margin-left: 5px" id="con_contact" name="con_content"  id="con_content" cols ="30" rows="5" required><?php echo $content; ?></textarea>
                            </label>
                            <label class="mem_item_error"><?php echo $arr_error['con_content']; ?></label>

                        </li>
                        <li style="height: 60px">

                            <label class="mem_item_title"><?php _e('captcha'); ?> <span> * </span></label> :
                            <label class="mem_item_content">
                                <img src="<?php echo HCM_URI_CLASS . 'captcha/captcha.php'; ?>" 
                                     onClick="this.src = '<?php echo HCM_URI_CLASS . 'captcha/captcha.php?reset=true&'; ?>' + Math.random();"
                                     alt="captcha" title="captcha" 
                                     style="cursor:pointer; float: left;margin: 0px 20px">
                                <input type="hidden" id="hidden_captcha" name="hidden_captcha" value="<?php echo $_SESSION['captcha']; ?>"/> 
                                <input name="txt_captcha" id="txt_captcha" type="text" 
                                       class="required input_field"  
                                       required 
                                       maxlength="5"
                                       style="width: 100px; height: 30px; margin-top: 10px;"/>  
                            </label>
                            <label class="mem_item_error"> <?php echo $arr_error['con_captcha']; ?></label>

                        </li>
                    </ul>
                    <div style="text-align: center; margin: 15px ">  
                        <input type="reset" value="<?php _e('Reset'); ?>" class="btn btn-primary"  style=" margin-right:  30px "/>
                        <input type="submit" value="<?php _e('Submit'); ?>"class="btn btn-primary" />
                        <label class="mem_item_error"></label>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="col-sm-12 sidebar-right">
        <div class="col-sm-6">
            <?php get_template_part('template', 'news'); ?>
        </div>
        <div class="col-sm-6">
            <?php get_template_part('template', 'event'); ?>
        </div>
        <div class="col-sm-12">
            <?php get_sidebar('right') ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
