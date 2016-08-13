/*global $ */

$(function (){
    "use strict";

    $('.go-btn').click(function () {
        location.href = '/' + $('.name-input').val() + '-tracker';
    });
});
