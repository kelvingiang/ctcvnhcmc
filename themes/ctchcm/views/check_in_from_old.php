<?php
if (!empty(getParams('id'))) {
    require_once (HCM_DIR_MODEL . 'check_in_model.php');
    $model = new Admin_Check_In_Model();
    $data = $model->get_item(getParams());
}
?>
<?php

    $countryArr = array('081' => '日本', '062' => '印尼', '091' => '印度',
        '673' => '汶萊', '880' => '孟加拉', '855' => '柬埔寨',
        '852' => '香港', '856' => '寮國', '060' => '馬來西亞',
        '063' => '菲律賓', '084' => '越南', '065' => '新加坡',
        '066' => '泰國', '095' => '緬甸', '853' => '澳門', '001' => '關島');
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
    <div class="content" style=" height: 150px; padding-top: 50px">
        <div class="cell-one "><label class="label-admin" > 照 片 </label></div>    
        <div class="cell-two">
            <?php
            if (empty($data['img'])) {
                $guest_img = 'no-image.jpg';
            } else {
                $guest_img = $data['img'];
            }
            ?>

            <div id="show-img" style=" background-image: url('<?php echo get_guests_img($guest_img); ?>');"></div>  

            <input type="file" id="guests_img" name="guests_img" accept=".png, .jpg, .jpeg, .bmp"/>
             <input type='hidden' id='hidden_barcode' name='hidden_barcode' value='<?php echo $data['barcode']; ?>'/>
            <input type='hidden' id='hidden_ID' name='hidden_ID' value='<?php echo $data['ID']; ?>'/>
            <input type='hidden' id='hidden_img' name='hidden_img' value='<?php echo $data['img']; ?>'/>
        </div>
    </div>

<?php  if(getParams('action') !='add'){ ?>
    <div class="content" style=" height: 50px">
        <div class="cell-one "><label class="label-admin"> 條 碼 </label></div>    
        <div class="cell-two">
            <img id="img_barcode" name="img_barcode" style=" height: 30px" src='<?php echo get_barcode_img($data['barcode']); ?>' ><br>
            <label> <?php echo $data['barcode']; ?></label>
        </div>
    </div>
<?php } ?>

    <div class="content">
        <div class="cell-one "><label class="label-admin"> 姓 名 </label></div>    
        <div class="cell-two"><input type="text" id="txt_fullname" name="txt_fullname"   required value ="<?php echo $data['full_name'] ?>" /></div>
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
        <div class="cell-one "><label class="label-admin"> 職 稱 </label></div>    
        <div class="cell-two"><input type="text" id="txt_position" name="txt_position" value='<?php echo $data['position'] ?>' /></div>
    </div>
    <div class="content">
        <div class="cell-one "><label class="label-admin"> 電 子 郵 件 </label></div>    
        <div class="cell-two">
            <input type="text" id="con_email" name="txt_email" class='type_email' value='<?php echo $data['email'] ?>' />
            <label style=' font-weight: bold; color: red;padding-left: 10px' id='error_email'></label>
        </div>
    </div>
    <div class="content">
        <div class="cell-one "><label class="label-admin"> 聯 絡 電 話 </label></div>    
        <div class="cell-two"><input type="text" id="txt_phone" name="txt_phone" class='type_phone_more'  value='<?php echo $data['phone']; ?>' /></div>
    </div>
    <div class="content">
        <div class="cell-one "><label class="label-admin"> 備 註</label></div>    
        <div class="cell-two">
            <textarea id="txt_note" name="txt_note" cols="41" rows="6"><?php echo $data['note'] ?></textarea>
        </div>
    </div>
    <div class="content" style="padding-top: 20px; text-align: right">
        <div class="cell-one "><label class="label-admin"></label></div>   
        <div class="cell-two">
            <input name="submit" id="submit" class="button button-primary" value="發 表" type="submit" style="margin-right: 50px">
        </div>
    </div>
</form>
<script type="text/javascript">
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
