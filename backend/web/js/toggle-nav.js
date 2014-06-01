/**
 * Created with JetBrains PhpStorm.
 * User: miller
 * Date: 5/12/14
 * Time: 5:57 PM
 * To change this template use File | Settings | File Templates.
 */
$(document).ready(function () {
    $('[data-toggle=offcanvas]').click(function () {
        $('.row-offcanvas').toggleClass('active')
    });
});