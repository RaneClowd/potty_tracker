/*global $ */

$(function (){
    "use strict";

    $('.back-btn').click(function () {
        location.href = '/';
    });

    $('.select-btn').click(function () {
        var $btn = $(this),
            btns_selected = false;

        $(this).toggleClass('selected');
        btns_selected = $('.select-btn.selected').length > 0;

        $('.save-btn').prop('disabled', !btns_selected);
    });

    $('.save-btn').click(function () {
        $.ajax({
            type: "POST",
            url: '/new_entry',
            data: {
                is_poop: $('.poop-btn').hasClass('selected'),
                is_pee: $('.pee-btn').hasClass('selected')
            },
            success: function() {
                $('.select-btn').removeClass('selected');
                $('.save-btn').prop('disabled', true);
            }
        });
    });
});