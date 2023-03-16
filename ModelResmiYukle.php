<?php
if (isset($_FILES['resim'])) {
    //Eğer form tagına enctype="multipart/form-data" bunu eklemeseydik if e girmez direk elseye giderdi.
    echo 'Resim gönderilmiştir. <br />';
    var_dump($_FILES['resim']);
    /* Resim seçilerek gönderildiğinde EKRAN ÇIKTISI:
        Resim gönderilmiştir.
        C:\wamp64\www\test\yukle.php:5:
        array (size=5)
        'name' => string 'black.png' (length=9)
        'type' => string 'image/png' (length=9)
        'tmp_name' => string 'C:\wamp64\tmp\php2D32.tmp' (length=25)
        'error' => int 0
        'size' => int 89509
    ************************
    Resim seçilmeden gönderildiğinde EKRAN ÇIKTISI:
        Resim gönderilmiştir.
        C:\wamp64\www\test\yukle.php:5:
        array (size=5)
        'name' => string '' (length=0)
        'type' => string '' (length=0)
        'tmp_name' => string '' (length=0)
        'error' => int 4
        'size' => int 0

        ## Gene ekran çıktısı verir ancak boş değerler döner.
    */
} else
    echo 'Resim gönderilmemiştir. Lütfen resim seçiniz.';
?>