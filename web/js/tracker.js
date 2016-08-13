/*global $ */

$(function (){
    "use strict";

    $('.back-btn').click(function () {
        location.href = '/';
    });

    $('.select-btn').click(function () {
        $(this).toggleClass('selected');
    });
});