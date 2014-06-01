/**
 * Created with JetBrains PhpStorm.
 * User: miller
 * Date: 5/6/14
 * Time: 5:00 PM
 * To change this template use File | Settings | File Templates.
 */
yii.allowAction = function ($e) {
    var message = $e.data('confirm');
    return message === undefined || yii.confirm(message, $e);
};
yii.confirm = function (message, $e) {
    bootbox.confirm(message, function (confirmed) {
        if (confirmed) {
            yii.handleAction($e);
        }
    });
    // confirm will always return false on the first call
    // to cancel click handler
    return false;
}