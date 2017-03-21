<?php

namespace common\models;

use Yii;
use common\libs\Tree;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property integer $pid
 * @property string $name
 * @property string $url
 * @property string $icon_style
 * @property integer $display
 * @property integer $sort
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'display', 'sort'], 'integer'],
            [['name', 'icon_style'], 'string', 'max' => 50],
            [['url'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => 'Pid',
            'name' => 'Name',
            'url' => 'Url',
            'icon_style' => 'Icon Style',
            'display' => 'Display',
            'sort' => 'Sort',
        ];
    }

    public static  function getMenu(){
        $menus = static::find()->where(['display' => 1])->asArray()->all();
        $treeObj = new Tree($menus);
        return $treeObj->getTreeArray();
    }

}