<?php

function getTranslate() {
    $data = array(
        'Event' => '活動回顧',
        'News' => '新聞刊版',
        'Members' => '會員通訊錄',
        'Assembly' => '會務刊版',
        'President' => '歷屆會長',
        'Supervisor' => '本屆理監事名冊',
        'President List' => '歷屆會長芳名錄',
//        page
        'About Us' => '關於本會',
//   check-in
        'Welcome' => '歡 迎 光 臨 ',
        'Check Times' => '登入次數',
        'Check Time' => '報到時間',
        'Times' => '次 ',
        'Last Check In' => '上次登入',
        'Digiwin' => '鼎 捷 軟 件 維 護 製 作',
        'Guesst Be Present Total' =>'來 賓 出 席 總 數 ',
        'Bit' => '位',
//        member info
        'Company' => '公司名稱',
        'Contact' => '聯絡人',
        'Operating' => '經營項目',
        'Address' => '地址',
        'Cell' => '手機',
        'Phone' => '聯絡電話',
        'Fax' => '傳真',
        'Email' => 'E-mail',
        'Website' => '網站',
        'Full Name' => '姓名',
        'Member No' => '會員編號',
        'Picture' => '照片',
        'Barcode' => '條碼',
        'Term' => '屆次',
        'Position' => '職稱',
        'Note' => '備註',
        'subject' => '主旨',
        'captcha' => '驗證碼',
        'Content' => '內容',
        'Contact Us' => '聯繫本會',
        'Contact Info' => '聯繫內容',
        'Email Contant' => '意見建議',
        'Submit' => '送出資料',
        'Reset' => '重新填寫',
        //error
        'Barcode Error' => '條 碼 不 正 確 ! ',
        'err_company' => '請填寫公司名稱',
        'err_contact' => '請填寫聯絡人',
        'err_phone' => '請填寫手機號碼,',
        'err_email' => '請填寫E-mail地址',
        'err_captcha' => '驗證碼不正確',
        'err_sure_email' => '請填寫正確的E-mail地址',
        'err_subject'=> '請填寫主旨',
        'err_content' => '請填寫意見建議 內容',
        'Your Message Send Success' => '您訊息已發給成功',
        'Thanks You' => "謝謝您"
    );
    $dataNew = array(
    );

    return array_merge($data, $dataNew);
}
