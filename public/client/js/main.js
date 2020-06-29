//load datepicker
function loadDatepicker() {
    $(".js-calendar").datepicker({
        autoclose: true,
        todayHighlight: true,
        orientation: "bottom",
        format: "yyyy-mm-dd",
    });
}

loadDatepicker();