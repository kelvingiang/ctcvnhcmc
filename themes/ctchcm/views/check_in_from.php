<?php
if (!empty(getParams('id'))) {
    require_once (HCM_DIR_MODEL . 'check_in_model.php');
    $model = new Admin_Check_In_Model();
    $data = $model->get_item(getParams());
}
?>
<?php
//
//    $countryArr = array('081' => '日本', '062' => '印尼', '091' => '印度',
//        '673' => '汶萊', '880' => '孟加拉', '855' => '柬埔寨',
//        '852' => '香港', '856' => '寮國', '060' => '馬來西亞',
//        '063' => '菲律賓', '084' => '越南', '065' => '新加坡',
//        '066' => '泰國', '095' => '緬甸', '853' => '澳門', '001' => '關島');
?>
<?php
require_once (HCM_DIR_MODEL . 'check_in_model.php');
$model = new Admin_Check_In_Model();
$dd = $model->saveItem();
if (!empty($dd)) {
    ?>
    <div style=" background-color: #FFADAD; color: white; min-height: 50px; margin-left: -20px; margin-bottom: 50px; padding-left: 20px">
        <?php
        foreach ($dd as $val) {
            echo $val;
        }
        ?>
    </div>
<?php } ?>
<form action="" method="post" enctype="multipart/form-data" id="f-guests" name="f-guests" >
    <div class="content" style=" height: 10px; padding-top: 50px">
        <div class="cell-one "><label class="label-admin" > <?php// _e('Picture'); ?>  </label></div>    
        <div class="cell-two">
            <?php
//            if (empty($data['img'])) {
//                $guest_img = 'no-image.jpg';
//            } else {
//                $guest_img = $data['img'];
//            }
            ?>

            <!--<div id="show-img" style=" background-image: url('<?php// echo get_guests_img($guest_img); ?>');"></div>-->  

            <!--<input type="file" id="guests_img" name="guests_img" accept=".png, .jpg, .jpeg, .bmp"/>-->
             <input type='hidden' id='hidden_barcode' name='hidden_barcode' value='<?php echo $data['barcode']; ?>'/>
            <input type='hidden' id='hidden_ID' name='hidden_ID' value='<?php echo $data['ID']; ?>'/>
            <input type='hidden' id='hidden_img' name='hidden_img' value='<?php echo $data['img']; ?>'/>
        </div>
    </div>

<?php  if(getParams('action') !='add'){ ?>
    <div class="content" style=" height: 100px">
        <div class="cell-one "><label class="label-admin"> <?php _e('Barcode'); ?> </label></div>    
        <div class="cell-two">
            <a href="<?php echo get_barcode_img($data['barcode']); ?>"
               download="<?php echo $data['stt'].'-'.$data['full_name'].'-'.$data['barcode'].'.png' ?>"
               data-toggle="tooltip" 
               title="按可以下載QRCode檔案"
               >  
              <img id="img_barcode" name="img_barcode" 
                   style=" height: 80px; float: left; margin-right: 30px" 
                   src='<?php echo get_barcode_img($data['barcode']); ?>' >
            </a>
            <div style="height: 80px; line-height: 80px;">
                <label> 
                    <?php echo $data['barcode']; ?>
                </label>
            </div>    
        </div>
    </div>
<?php } ?>

    <div class="content">
        <div class="cell-one "><label class="label-admin"><?php _e('Member No'); ?>  </label></div>    
        <div class="cell-two"><input type="text" id="txt_stt" name="txt_stt" class="type-number" maxlength="4"  required value ="<?php echo $data['stt'] ?>" /></div>
    </div>
    <div class="content">
        <div class="cell-one "><label class="label-admin"> <?php _e('Full Name'); ?></label></div>    
        <div class="cell-two"><input type="text" id="txt_fullname" name="txt_fullname"   required value ="<?php echo $data['full_name'] ?>" /></div>
    </div>
    <div class="content">
        <div class="cell-one "><label class="label-admin"> <?php _e('Company'); ?> </label></div>    
        <div class="cell-two"><input type="text" id="txt_company" name="txt_company"   value ="<?php echo $data['company'] ?>" /></div>
    </div>
<!--    <div class="content">
        <div class="cell-one "><label class="label-admin"><?php
               // _e('Country');
                ?> </label></div>    
        <div class="cell-two">
            <select  id="sel_Country" name="sel_country" >
                <?php// foreach ($countryArr as $key => $val) { ?>
                    <option value='<?php// echo $key ?>' <?php//echo $data['country'] == $key ? 'selected' : '' ?>  > <?php// echo $val ?> </option>
<?php //} ?>
            </select></div>
    </div>-->
    <div class="content">
        <div class="cell-one "><label class="label-admin"><?php _e('Position') ?></label></div>    
        <div class="cell-two"><input type="text" id="txt_position" name="txt_position" value='<?php echo $data['position'] ?>' /></div>
    </div>
    <div class="content">
        <div class="cell-one "><label class="label-admin"><?php _e('Email'); ?></label></div>    
        <div class="cell-two">
            <input type="text" id="con_email" name="txt_email" class='type_email' value='<?php echo $data['email'] ?>' />
            <label style=' font-weight: bold; color: red;padding-left: 10px' id='error_email'></label>
        </div>
    </div>
    <div class="content">
        <div class="cell-one "><label class="label-admin"><?php _e('Phone'); ?> </label></div>    
        <div class="cell-two"><input type="text" id="txt_phone" name="txt_phone" class='type_phone_more'  value='<?php echo $data['phone']; ?>' /></div>
    </div>
    <div class="content">
        <div class="cell-one "><label class="label-admin"><?php _e('Note'); ?> </label></div>    
        <div class="cell-two">
            <textarea id="txt_note" name="txt_note" cols="52" rows="6"><?php echo $data['note'] ?></textarea>
        </div>
    </div>
    <div class="content" style="padding-top: 20px; text-align: right">
        <div class="cell-one "><label class="label-admin"></label></div>   
        <div class="cell-two">
            <input name="submit" id="submit" class="button button-primary" value="發 表" type="submit" style="margin-right: 10px">
        </div>
    </div>
</form>
<script type="text/javascript">
   
 jQuery(document).ready(function(){
//       jQuery('#img_barcode').mouseover(function(){alert(5)}); 
        jQuery( "#img_barcode" ).tooltip({
              show: {
                effect: "slideDown",
                delay: 250
                }
            });
       jQuery('input[type=text]').css({'width': '90%','height':'35px'});
    });


    // show hinh anh truoc khi up len
    jQuery(function() {
        jQuery("#guests_img").on("change", function()
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

</script>
