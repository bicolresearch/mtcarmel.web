/*
    Filename    : utilities.js
    Location    : public/assets/js/utilities.js
    Purpose     : Extend jquery functions
    Created     : 08/04/2019 15:24:21 by Spiderman
    Updated     : 09/11/2019 14:44:38 by Spiderman
    Changes     : 
*/

let baseURL = 'http://mountcarmel.ph';
let apiURL = 'https://api.mountcarmel.ph';
let branchID = 1;

$.fn.extend({
    baseURL: function() {
        return baseURL;
    },
    apiURL: function() {
        return apiURL;
    },
    branchID: function() {
        return branchID
    },
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
            $(this).text($(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")); 
        });
    }
});