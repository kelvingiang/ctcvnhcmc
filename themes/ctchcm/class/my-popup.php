<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<style type="text/css">

    #popup_bg{
        width: 100%;
        z-index: 300;
        padding:  auto  0;
        position:  absolute;
        top:0;
        left: 0;
        right: 0;
        bottom: 0;
        cursor:  pointer;
        background-color:  rgba(0, 0, 0, 0.8);
        display: none;
    }

    #popup_img{
        width: 50%;
        background-color:  white;
        position:  absolute;
        top:-600px;
        left: 25%;
        right: 0;
        z-index: 310;
        border-radius: 5px;
        -webkit-transition: top 1s; /* Safari */
        transition: top 1s;
    }

    #popup_show_img{
        width: 100%;
        padding-top: 10px;
        padding: 2px;
    }

    #popup_close{
        font-weight: bold;
        float: right;
        cursor:  pointer;
        color: #333;
        padding-right: 8px;
        padding-top: 3px;
        text-decoration:  none;
        color: red;
    }

    #next_pic, #back_pic {
        cursor: pointer;
        font-size: 45px;
        font-weight: bold;
        text-decoration: none;
        color: white;
        opacity: 0.3;
    }

    #next_pic{
        float: right;
    }
    #back_pic:hover,  #next_pic:hover{
        opacity: 1;
    }
    #next_back{
        width: 98%;
        display: none;
        position: absolute;
        top:50%;
        left: 5px;
        opacity: 0.8;
    }
</style>

<div id="popup_img" name="popup_img">
    <a id="popup_close" onclick="javascript:close_popup();">x</a>
    <img id="popup_show_img"  name="poppu_show_img" />
    <div id="next_back">
        <a  id="next_pic"> > </a> 
        <a  id="back_pic"> < </a>
    </div>
</div>

<div id="popup_bg" name="popup_bg" onclick="javascript:close_popup();"></div>

<script type="text/javascript">
        jQuery(document).ready(function() {

            // CLICK VO HINH TRONG POST WP alignnone CLASS MAC DINH CUA WP 
            jQuery('.alignnone').click(function() {
                var screen_center = (jQuery(window).height() - jQuery(this).outerHeight()) / 15 + jQuery(window).scrollTop();
                var imgSrc = jQuery(this).attr('src'); // link hinh
                var WH = jQuery('body').height(); // chieu cao cua toan man hinh
                jQuery('#popup_bg').css({"display": "block", "height": WH});
                jQuery('#popup_img').css({"top": screen_center, "display": "block"});
                jQuery('#popup_show_img').attr('src', imgSrc);
            });

            // REMOUSE VAO HINH SE SHOW DIV NEXT VA BACK 
            jQuery("#popup_img").mouseover(function() {
                jQuery("#next_back").css('display', 'block');
            }).mouseleave(function() {
                jQuery("#next_back").css('display', 'none');
            });
        })

        // DONG PHAN SHOW HINH LON
        function close_popup() {
            jQuery('#popup_bg').css('display', 'none'); // CLOSE CAI NEN XAM
            jQuery('#popup_img').css({'top': '-6000px'}); // HINH DC CHAY LEN TREN 
//            window.setTimeout(  jQuery('#popup_img').css('display','none') , 50000 );
//            jQuery('#popup_img').css()
        }

        // GET TAT CA CAC HINH TRONG BAI POST 
        function get_imgList() {
            var my_array = new Array();
            jQuery(".title-content").find('img').each(function() {
                my_array.push(jQuery(this).attr('src'));
            });
//            console.log(my_array);
            return my_array;

        }

        var my_array = get_imgList();
        var index = 0;

        var backIndex = function(index, length) {
            if (index <= 0) {
                return length - 1; // cycle backwards to the last image
            } else {
                return index - 1;
            }
        };

        var nextIndex = function(index, length) {
            return ((index + 1) % length);
        };

        jQuery('#next_pic').click(function() {
            index = nextIndex(index, my_array.length);
            console.log(my_array[index]);
            jQuery('#popup_show_img').attr('src', my_array[index]);
        });

        jQuery('#back_pic').click(function() {
            index = backIndex(index, my_array.length);
            jQuery('#popup_show_img').attr('src', my_array[index]);
        });

        /** initialize the image on load to the first one */
        // jQuery('#popup_show_img').attr('src', my_array[index]);

</script>