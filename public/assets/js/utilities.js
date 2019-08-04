/*
    Filename    : utilities.js
    Location    : public/assets/js/utilities.js
    Purpose     : Extend JQuery
    Created     : 08/04/2019 15:24:21 by Spiderman
    Updated     : 
    Changes     : 
*/

$.fn.extend({
    preloader: function() {
        return this.html(
            '<div class="loader">' +
            '  <svg class="circular" viewBox="25 25 50 50">' +
            '    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>' +
            '  </svg>' +
            '</div>');
    },
    digits: function() {
        return this.each(function(){ 
            $(this).text($(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ); 
        });
    },
    check: function() {
        return this.each(function() {
            this.checked = true;
        });
    },
    uncheck: function() {
        return this.each(function() {
            this.checked = false;
        });
    }
});