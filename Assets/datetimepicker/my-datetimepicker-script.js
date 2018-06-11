$(document).ready(function () {

    $.fn.datepicker.noConflict = function(){
       $.fn.datepicker = old;
       return this;
    };

    $('.datepicker').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy HH:MM:ss',
        defaultDate: new Date()
    });

    $('.datepicker').datepicker("setDate", new Date());

    $('.datetimepicker, .datetimepicker-set-data').datetimepicker({
        useCurrent: false,
        showTodayButton: true,
        format: 'YYYY-MM-DD HH:MM:ss',
        defaultDate:new Date()
    });

    $.each($('.datetimepicker-set-data'), function(index, item){
        $(this).val($(item).attr('date-settime'));
    });

});