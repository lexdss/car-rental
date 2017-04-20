$(document).ready(function(){
/*  var d = new Date();
    var options = {
        'day': '2-digit',
        'month': '2-digit',
        'year': 'numeric'
    };
    */
    (function() {

        var datesStr = {};

        $('#orderform-start_rent').datepicker({
            minDate: 0,
            onSelect: function(dateText, inst) {
                datesStr.start_rent = dateText;
                sendAjax();
            }
        });
        $('#orderform-end_rent').datepicker({
            minDate: 0,
            onSelect: function(dateText, inst) {
                datesStr.end_rent = dateText;
                sendAjax();
            }
        });

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
            var data = $.parseJSON(data);

            $('#discount').text(data.discount);
            $('#price').text(data.price);
        }

    })()
});