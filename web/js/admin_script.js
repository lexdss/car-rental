$(document).ready(function () {

    (function () {
        var i = 0;

        $('#add-discount').on('click', function() {
            i++;

            // Add fields
            var daysInput = $('.field-discount-days').first().clone();
            daysInput.find('input').attr('id', 'discount-days' + i);

            var discountInput = $('.field-discount-discount').first().clone();
            discountInput.find('input').attr('id', 'discount-discount' + i);

            daysInput.appendTo('#car-discount');
            discountInput.appendTo('#car-discount');

            // Add remove buttons
            if(i == 1) {
                $('.add-remove-discount').append('<button type="button" id="remove-discount" class="col-xs-offset-3">-</button>');
            }
        });

        // Remove fields
        $('body').on('click', '#remove-discount', function () {
            i--;

            if(i == 0) {
                $('#remove-discount').remove();
            }

            $('.field-discount-days:last').remove();
            $('.field-discount-discount:last').remove();
            //$('#car-discount').last().remove();

        })

    })()

});