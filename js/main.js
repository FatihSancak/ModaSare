function ($) {

    "use strict";

}

$(document).ready(function (){
    $("#datepicker").datepicker({
        dateFormat: "dd/mm/yy"
    });
});

const myDatePicker = MCDatepicker.create({
    el: '#tarih_bilgisi', // input id ile eşleşmeli
    showCalendarDisplay: false, // Takvim görünümü istiyorsanız `true` yapınız
    dateFormat: 'DD-MM-YYYY', // Tarih formatı
    customClearBTN: 'Temizle', // Temizle butonu yazısı
    customOkBTN: 'Tamam', // Tamam butonu yazısı
    customCancelBTN: 'İptal Et', // İptal Et butonu yazısı
    customWeekDays: [
    'Pazartesi',
    'Salı',
    'Çarşamba',
    'Perşembe',
    'Cuma',
    'Ctesi',
    'Pazar'
    ], // Türkçe gün isimleri
    customMonths: [
    'Ocak',
    'Şubat',
    'Mart',
    'Nisan',
    'Mayıs',
    'Haziran',
    'Temmuz',
    'Ağustos',
    'Eylül',
    'Ekim',
    'Kasım',
    'Aralık'
    ] // Türkçe ay isimleri
});