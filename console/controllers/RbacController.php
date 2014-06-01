<?php
/**
 * Created by miller 
 * Date: 5/7/14
 * Time: 7:12 PM
 */
namespace console\controllers;

use yii\console\Controller;
use yii\rbac\PhpManager;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = new PhpManager;

        $auth->init();

        // add "author" role and give this role the "createPost" permission
        // as well as the permissions of the "reader" role
        $editor = $auth->createRole('editor', 'Editor');
        $auth->add($editor);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin', 'Administrator');
        $auth->add($admin);
        $auth->addChild($admin, $editor);

        // Assign roles to users. 10, 14 and 26 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
    }
}