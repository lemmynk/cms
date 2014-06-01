<?php
/**
 * Created by miller 
 * Date: 5/15/14
 * Time: 3:41 PM
 */

namespace backend\components;

use yii\filters\AccessRule;

class AdminAccessRule extends AccessRule
{
    /**
 * @param User $user the user object
 * @return boolean whether the rule applies to the role
 */
    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            return true;
        }
        foreach ($this->roles as $role) {
            if ($role === '?' && $user->getIsGuest()) {
                return true;
            } elseif ($role === '@' && !$user->getIsGuest()) {
                return true;
            } elseif (!$user->getIsGuest()) {
                // user is not guest, let's check his role (or do something else)
                if ($role === $user->identity->getRoleName()) {
                    return true;
                }
            }
        }
        return false;
    }
}