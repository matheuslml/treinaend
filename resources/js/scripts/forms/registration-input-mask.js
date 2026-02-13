$(function() {
    'use strict';

    var paymentValue = $('.payment_value'),
        listValue = $('.list-value');

    if (listValue.length) {
        listValue.toArray().forEach(function(field) {
            new Cleave(field, {

                numeral: true,
                numeralDecimalScale: 2,
                numeralThousandsGroupStyle: 'thousand',
                numeralDecimalMark: ',',
                delimiter: '.',
                prefix: 'R$ ',
                signBeforePrefix: true

            });
        });
    }

    //Numeral
    if (paymentValue.length) {
        new Cleave(paymentValue, {

            numeral: true,
            numeralDecimalScale: 2,
            numeralThousandsGroupStyle: 'thousand',
            numeralDecimalMark: ',',
            delimiter: '.',
            prefix: 'R$ ',
            signBeforePrefix: true

        });
    }

});
