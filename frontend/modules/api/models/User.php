<?php

namespace frontend\modules\api\models;

use Yii;

class User extends \common\models\User
{
    public function fields()
    {
        return ['id', 'username', 'email', 'access_token', 'access_token_expired_at'];
    }

    public function extraFields()
    {
        return [];
    }
}
