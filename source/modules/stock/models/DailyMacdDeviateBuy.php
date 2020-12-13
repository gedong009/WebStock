<?php

namespace source\modules\stock\models;

use Yii;
use source\LuLu;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "{{%daily_macd_deviate_buy}}".
 *
 * @property string $id
 * @property string $sCode
 * @property string $iDeviateId
 * @property string $tDateTime
 */
class DailyMacdDeviateBuy extends \source\core\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%daily_macd_deviate_buy}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sCode', 'iDeviateId', 'tDateTime'], 'required'],
            [['iDeviateId'], 'integer'],
            [['tDateTime'], 'safe'],
            [['sCode'], 'string', 'max' => 8]
        ];
    }
    
    public static function getAttributeLabels($attribute = null)
    {
        $items = [
            'id' => Yii::t('app', 'ID'),
            'sCode' => Yii::t('app', '股票代码'),
            'iDeviateId' => Yii::t('app', '背离ID'),
            'tDateTime' => Yii::t('app', '金叉时间点'),
        ];
        return ArrayHelper::getItems($items, $attribute);
    }
    
}
