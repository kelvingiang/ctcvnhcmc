jQuery(document).ready(function() {

//    // SAN PHAM CHAY O DUOI TRANG INDEX
// menu
//    jQuery('nav.primary-menu ul.sf-menu').superfish();

// tab
//    jQuery(function() {
//        jQuery("#tabs").tabs();
//    });
//    jQuery('.selectmenu').selectmenu({
//    });
    //        yearRange: '1900:' + new Date().getFullYear(),
//    jQuery('.MyDate').datepicker({
//        dateFormat: 'dd-mm-yy',
//        changeMonth: true,
//        changeYear: true,
//        yearRange: '1920 : 2000',
//    });
//    
//    jQuery('.MyDateNoYear').datepicker({
//        dateFormat: 'dd-mm',
//        changeMonth: true,
//        changeYear: false
//    });
    //   / gioi han ly tu nhap vao   THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
    jQuery('.type_phone_more').keypress(function(event) {
        return isPhone(event, this);
    });
    function isPhone(evt, element) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (
                //(charCode != 45 || jQuery(element).val().indexOf('-') != -1) && // “-” CHECK MINUS, AND ONLY ONE.
                        (charCode != 45) && // “-” CHECK MINUS, AND MORE.
                        (charCode != 46 || jQuery(element).val().indexOf('.') != -1) && // “.” CHECK DOT, AND ONLY ONE.
                        (charCode != 8) && // “.” CHECK DOT, AND ONLY ONE.
                        (charCode < 48 || charCode > 57))
            return false;
        return true;
    }


    jQuery('.type-number').keypress(function(event) {
        return isOnlyNumber(event, this);
    });
    function isOnlyNumber(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    jQuery('.type_email').focusout(function(e) {
        var email = document.getElementById('con_email');
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!filter.test(email.value)) {
            jQuery('#error_email').text('請填寫正確E-mail地址 ! ');
            email.focus;
        } else {
            jQuery('#error_email').text('');
        }
    });

    jQuery('.type_web').focusout(function(e) {
        var web = document.getElementById('txt_web');
        var filter = /^(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!filter.test(web.value)) {
            jQuery('#error_web').text('請 輸 入 正 確 網 站 地 址 ! ');
            web.focus;
        } else {
            jQuery('#error_web').text('');
        }
    });


    // waiting function
    function showwaiting() {
        jQuery('#waiting-img').css('display', 'block');
    }

    function hidewaiting() {
        jQuery('#waiting-img').css('display', 'none');
    }

    // back to top
    jQuery(function() {
        jQuery(window).scroll(function() {
            if (jQuery(this).scrollTop() > 100) {
                jQuery('#back-top').fadeIn('fast');
            } else {
                jQuery('#back-top').fadeOut(1500);
            }
        });
        // scroll body to 0px on click
        jQuery('#back-top img').click(function() {

            jQuery('body,html').stop(false, false).animate({
                scrollTop: 0
            }, 1000);
            return false;
        });
    });
    function fnpopup() {
        //   var error = '<?php echo $e_error ?>';
        //   var post ='<?php echo $e_branch ?>';
        //   if(error==='' && post !==''){
        jQuery('#div-popup').fadeIn('slow');
        jQuery('#div-alertInfo').css('top', '150px');
        setTimeout(closePopup, 5000);
        // }
    }
    function closePopup() {
        jQuery('#div-popup').fadeOut('slow');
        jQuery('#div-alertInfo').css('top', '0px');
        jQuery('#div-alertInfo').css('opacity', '0');
        //  window.location.reload();
        //  window.location='<?php echo home_url('events') ?>';
    }


    function fnOpenNormalDialog() {
        jQuery("#dialog-confirm").html("Confirm Dialog Box");
        // Define the Dialog and its properties.
        jQuery("#dialog-confirm").dialog({
            resizable: false,
            modal: true,
            title: "Modal",
            height: 250,
            width: 400,
            buttons: {
                "Yes": function() {
                    jQuery(this).dialog('close');
                    callback(true);
                },
                "No": function() {
                    jQuery(this).dialog('close');
                    callback(false);
                }
            }
        });
    }

//<![CDATA[

// Set cookie
    function setCookie(name, value, expires, path, domain, secure) {
        document.cookie = name + "=" + escape(value) +
                ((expires == null) ? "" : "; expires=" + expires.toGMTString()) +
                ((path == null) ? "" : "; path=" + path) +
                ((domain == null) ? "" : "; domain=" + domain) +
                ((secure == null) ? "" : "; secure");
    }

    // Read cookie
    function getCookie(name) {
        var cname = name + "=";
        var dc = document.cookie;
        if (dc.length > 0) {
            begin = dc.indexOf(cname);
            if (begin != -1) {
                begin += cname.length;
                end = dc.indexOf(";", begin);
                if (end == -1)
                    end = dc.length;
                return unescape(dc.substring(begin, end));
            }
        }
        return null;
    }

    //delete cookie
    function eraseCookie(name, path, domain) {
        if (getCookie(name)) {
            document.cookie = name + "=" +
                    ((path == null) ? "" : "; path=" + path) +
                    ((domain == null) ? "" : "; domain=" + domain) +
                    "; expires=Thu, 01-Jan-70 00:00:01 GMT";
        }
    }

//]]>


    // back to top
    jQuery(function() {
        jQuery(window).scroll(function() {
            if (jQuery(this).scrollTop() > 100) {
                jQuery('#back-top').fadeIn('fast');
            } else {
                jQuery('#back-top').fadeOut(1500);
            }
        });
        // scroll body to 0px on click
        jQuery('#back-top img').click(function() {

            jQuery('body,html').stop(false, false).animate({
                scrollTop: 0
            }, 1000);
            return false;
        });
    });





//    function loadPopupBox() {    // To Load the Popupbox
//        alert(2);
//        jQuery('#popup_box').fadeIn("slow");
//        setTimeout("unloadPopupBox('done')", 2000);
//    }
//
//
//    var unloadPopupBox = function(value) {    // TO Unload the Popupbox
//        jQuery('#popup_box').fadeOut("slow");
//        //  window.open("http://localhost/isana/contact-us/")
//        if (value === 'done') {
//            window.location = location.href;
//        }
//    };
});

