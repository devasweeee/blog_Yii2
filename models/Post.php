<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $anons
 * @property string $content
 * @property integer $category_id
 * @property integer $author_id
 * @property integer $publish_activity
 * @property string $publish_date
 */
class Post extends \yii\db\ActiveRecord
{
    const PUBLISH_ACTIVITY_TRUE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'anons', 'content', 'author_id'], 'required'],
            [['anons', 'content'], 'string'],
            [['category_id', 'author_id', 'publish_activity'], 'integer'],
            [['publish_date'], 'safe'],
            [['title'], 'string', 'max' => 255],
            ['publish_activity', 'default', 'value' => self::PUBLISH_ACTIVITY_TRUE],
            ['author_id', 'in', 'range' => [Yii::$app->user->id]], 
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'anons' => 'Краткое содержание',
            'content' => 'Контент',
            'category_id' => 'Category ID',
            'author_id' => 'Author ID',
            'publish_activity' => 'Publish Activity',
            'publish_date' => 'Publish Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

}