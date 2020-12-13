<?php

namespace source\modules\stock\models;

use Yii;
use source\LuLu;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "{{%daily_macd}}".
 *
 * @property string $id
 * @property string $sCode
 * @property string $tDateTime
 * @property string $iEmaShort
 * @property string $iEmaLong
 * @property string $iDif
 * @property string $iDea
 * @property string $iBar
 */
class DailyMacd extends \source\core\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%daily_macd}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sCode', 'tDateTime', 'iEmaShort', 'iEmaLong', 'iDif', 'iDea', 'iBar'], 'required'],
            [['tDateTime'], 'safe'],
            [['iEmaShort', 'iEmaLong', 'iDif', 'iDea', 'iBar'], 'number'],
            [['sCode'], 'string', 'max' => 8]
        ];
    }
    
    public static function getAttributeLabels($attribute = null)
    {
        $items = [
            'id' => Yii::t('app', 'ID'),
            'sCode' => Yii::t('app', '股票代码'),
            'tDateTime' => Yii::t('app', '日期'),
            'iEmaShort' => Yii::t('app', 'EMA1'),
            'iEmaLong' => Yii::t('app', 'EMA2'),
            'iDif' => Yii::t('app', 'DIF'),
            'iDea' => Yii::t('app', 'DEA'),
            'iBar' => Yii::t('app', 'MACD'),
        ];
        return ArrayHelper::getItems($items, $attribute);
    }
    

    /**
     * @inheritdoc
     * @return DailyMacdQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DailyMacdQuery(get_called_class());
    }
}
