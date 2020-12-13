<?php

namespace source\modules\stock\models;

use Yii;
use source\LuLu;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "{{%daily_macd_bottom}}".
 *
 * @property string $id
 * @property string $sCode
 * @property string $tBeginDateTime
 * @property string $iBeginDif
 * @property string $tApexDateTime
 * @property string $iApexDif
 * @property string $tEndDateTime
 * @property string $iEndDif
 */
class DailyMacdApex extends \source\core\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%daily_macd_apex}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sCode', 'tBeginDateTime', 'iBeginDif', 'tApexDateTime', 'iApexDif', 'tEndDateTime', 'iEndDif'], 'required'],
            [['tBeginDateTime', 'tApexDateTime', 'tEndDateTime'], 'safe'],
            [['iBeginDif', 'iApexDif', 'iEndDif'], 'number'],
            [['sCode'], 'string', 'max' => 8]
        ];
    }
    
    public static function getAttributeLabels($attribute = null)
    {
        $items = [
            'id' => Yii::t('app', 'ID'),
            'sCode' => Yii::t('app', '股票代码'),
            'tBeginDateTime' => Yii::t('app', '开始日期'),
            'iBeginDif' => Yii::t('app', '开始DIF'),
            'tApexDateTime' => Yii::t('app', '最低日期'),
            'iApexDif' => Yii::t('app', '最低DIF'),
            'tEndDateTime' => Yii::t('app', '结束日期'),
            'iEndDif' => Yii::t('app', '结束DIF'),
        ];
        return ArrayHelper::getItems($items, $attribute);
    }
    

    /**
     * @inheritdoc
     * @return DailyMacdBottomQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DailyMacdBottomQuery(get_called_class());
    }
}
