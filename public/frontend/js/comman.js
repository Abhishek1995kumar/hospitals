$(document).ready(function () {
    initSelect2();
    initFlatpickr();
    hidePreviousDateFlatpickr();

});


function initSelect2(selector = ".select2-init") {
    $(selector).each(function () {
        $(this).select2({
            placeholder:$(this).data("placeholder") || "Select Option",
            allowClear: true,
            width: "100%"
        });

    });

}


function initFlatpickr(selector = ".flatpickr-init") {
    $(selector).each(function () {
        flatpickr(this, {
            enableTime: $(this).data("time") === true || $(this).data("time") === "true",
            dateFormat: $(this).data("format") || "h:i K d F Y",
            time_24hr: $(this).data("24hr") === true || $(this).data("24hr") === "true",
            minuteIncrement: parseInt($(this).data("minute")) || 5,
            clickOpens: true
        });
    });
}
// initFlatpickr iske liye ye input format use hoga
// <input type="text" class="banner-input flatpickr-init" data-format="h:i K d F Y" data-time="true" data-24hr="false" data-minute="5" placeholder="Select Date & Time">


function hidePreviousDateFlatpickr(selector = ".flatpickr-init") {
    $(selector).each(function () {
        const now = new Date();
        flatpickr(this, {
            enableTime: true,
            dateFormat: $(this).data("format") || "h:iK d F Y",
            time_24hr: false,
            minuteIncrement: parseInt($(this).data("minute")) || 5,
            clickOpens: true,

            // Previous dates disable
            minDate: "today",

            // Time restriction
            onChange: function (selectedDates,dateStr,instance) {
                if (selectedDates.length) {
                    const selected = selectedDates[0];
                    const today = new Date();
                    const isToday = selected.toDateString() === today.toDateString();

                    if (isToday) {
                        instance.set( "maxTime", "19:00" );
                    } else {
                        instance.set("maxTime",null);
                    }
                }
            }
        });
    });

}

// hidePreviousDateFlatpickr iske liye ye input format use hoga
// <input type="text" class="banner-input flatpickr-init" data-time="true" data-format="h:i K d F Y" placeholder="Select Date & Time">

