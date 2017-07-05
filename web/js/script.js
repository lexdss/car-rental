$(document).ready(function(){

    (function() {

        var datesStr = {};

        var dates = $( "#order-start_rent, #order-end_rent" ).datepicker({
            onSelect: function( selectedDate ) {
                var option = this.id == "order-start_rent" ? "minDate" : "maxDate";
                var instance = $( this ).data( "datepicker" );
                var date = $.datepicker.parseDate(
                        instance.settings.dateFormat ||
                        $.datepicker._defaults.dateFormat,
                        selectedDate, instance.settings
                );
                dates.not( this ).datepicker( "option", option, date );
            }
        });


        var startSettings = $( "#order-start_rent" ).data("datepicker").settings;
        var endSettings = $( "#order-end_rent" ).data("datepicker").settings;

        startSettings.minDate = 0;
        endSettings.minDate = 0;

        startSettings.onClose = function (dateText) {
            datesStr.start_rent = dateText;
            sendAjax();
        };
        endSettings.onClose = function (dateText) {
            datesStr.end_rent = dateText;
            sendAjax();
        };

        function sendAjax() {
            if (datesStr['start_rent'] && datesStr['end_rent']) {
                var options = {
                    data: datesStr,
                    dataype: 'json',
                    success: function (data, status) {
                        drawOrderInfo(data);
                    },
                    error: function () {
                        alert('Error');
                    }
                };
                $.ajax(options);
            }
        }

        function drawOrderInfo(data) {
            var returnData = $.parseJSON(data);

            $('#days').text(returnData.days);
            $('#discount').text(returnData.discount);
            $('#amount').text(returnData.amount);
        }

    })()
});