<?php

namespace app\models;

use yii\data\ActiveDataProvider;

use Yii;

/**
 * This is the model class for table "subscribe".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $sub_id
 *
 * @property User $user
 * @property User $sub
 */
class Subscribe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscribe';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'sub_id'], 'required'],
            [['user_id', 'sub_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['sub_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['sub_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'sub_id' => 'Sub ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSub()
    {
        return $this->hasOne(User::className(), ['id' => 'sub_id']);
    }

    public function getOpportunity($user_id, $sub_id){
        $result = Subscribe::find()->where(['user_id'=>$user_id, 'sub_id'=>$sub_id])->one();
        if ($result == null){
            return 0;
        } else {
             return $result->id;
        };
    }

    public function getAuthorsFeed($user_id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Subscribe::find()
                ->where(['user_id' => $user_id])
            ]);

        $result[] = 0;

        foreach ($dataProvider->models as $row) {
            $result[] = $row->sub_id;
        };

        return $result;
    }

}
