/*global $ */

$(function (){
    "use strict";

    $('.go-btn').click(function () {
        location.href = '/' + $('.name').html() + '-create';
    });
});
