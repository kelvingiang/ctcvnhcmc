<form name="f1" method="post" action="" enctype="multipart/form-data">
    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row" colspan="2">    <h3> 商 會 資 訊 </h3> </th>
        </tr>
        <tr>
            <th scope="row">
                <label for="txt_industry">LOGO</label>
            </th>
            <td >
<!--                <img id="logo_img" name="logo_img" src="<?php // echo  get_img(get_option('website_logo'));      ?>" style="width: 100px" />-->
                <div id="show-img" style="background-image: url('<?php echo get_img(get_option('website_logo')); ?>');"></div>  
                <?php
                if (get_current_user_id() == 1) {
                    ?>
                    <input id="img_logo" class="regular-text" name="img_logo"  type="file" style=" display: none" >
                    <a id="select_file"  name ="select_file" href ="#" class="button-primary" style=" margin-left: 20px; margin-top: 70px " onclick="javascript:openFIle();" > 選擇照片 </a>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="txt_name_cn">商會中文名稱</label>
            </th>
            <td>
                <input id="txt_name_cn" class="regular-text" required  name="txt_name_cn" value="<?php echo get_option('website_name_cn') ?>" type="text">
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="txt_name_vn">商會越文名稱</label>
            </th>
            <td>
                <input id="txt_name_vn" class="regular-text" name="txt_name_vn" value="<?php echo get_option('website_name_vn') ?>" type="text">
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="txt_address">地址</label>
            </th>
            <td>
                <input id="txt_address" class="regular-text" name="txt_address" value="<?php echo get_option('website_address') ?>" type="text">
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="txt_phone">聯絡電話</label>
            </th>
            <td>
                <input id="txt_phone" class="regular-text type_phone_more" name="txt_phone" value="<?php echo get_option('website_phone') ?>" type="text">
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="txt_fax">傳真</label>
            </th>
            <td>
                <input id="txt_fax" class="regular-text type_phone_more" name="txt_fax" value="<?php echo get_option('website_fax') ?>" type="text">
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="txt_email">E-mail</label>
            </th>
            <td>
                <input id="txt_email" class="regular-text type_email" name="txt_email" value="<?php echo get_option('website_email') ?>" type="text">
                <label id="error_email" style="color: red; font-weight: bold"></label>
            </td>
        </tr>
        </hr>
        <tr>
            <th>  <label for="txt_email">台灣商會理監事名冊標題</label></th>
            <td>
                <input id="txt_list_title" class="regular-text" name="txt_list_title" value="<?php echo get_option('website_list_title') ?>" type="text">
            </td>
        </tr>
        <tr>
            <th>  <label for="txt_email">台灣商會簡介</label></th>
            <td style="margin-left:  50px">
                <?php
                $wp_editor_ID = 'about';
                $option = array(
                    'wpautop' => FALSE,
                    'media_buttons' => true,
                    'default_editor' => '',
                    'drag_drop_upload' => false,
                    'textarea_name' => $wp_editor_ID,
                    'textarea_rows' => 20,
                    'tabindex' => '',
                    'tabfocus_elements' => ':prev,:next',
                    'editor_css' => '',
                    'editor_class' => '',
                    'teeny' => false,
                    'dfw' => false,
                    '_content_editor_dfw' => false,
                    'tinymce' => true,
                    'quicktags' => true
                        );
                $content = get_post_meta('1', '_web_about', TRUE);
                wp_editor($content, $wp_editor_ID, $option);
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2" style=" text-align: left; padding-left: 43% ">
                <input type="submit"  name="btn_submit" id="btn_submit" value="submit" class="button button-primary button-large" >
            </td>            
        </tr>
        </tbody>
    </table>
</form>
<script type="text/javascript">
                    // show hinh anh truoc khi up len
                    jQuery(function() {
                        jQuery("#img_logo").on("change", function()
                        {
                            var files = !!this.files ? this.files : [];
                            if (!files.length || !window.FileReader)
                                return; // no file selected, or no FileReader support

                            if (/^image/.test(files[0].type)) { // only image file
                                var reader = new FileReader(); // instance of the FileReader
                                reader.readAsDataURL(files[0]); // read the local file

                                reader.onloadend = function() { // set image data as background of div
                                    jQuery("#show-img").css("background-image", "url(" + this.result + ")");
                                };
                                console.log(result);
                            }
                        });
                    });

                    function openFIle() {
                        jQuery('#img_logo').click();
                        return false;
                    }

</script>