<?php

namespace source\modules\stock\models;

use Yii;
use source\LuLu;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "{{%daily_macd_deviate}}".
 *
 * @property string $id
 * @property string $sCode
 * @property string $tBeginDateTime
 * @property string $tDeviateDateTime
 * @property integer $iDirectionType
 */
class DailyMacdDeviate extends \source\core\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%daily_macd_deviate}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sCode', 'tBeginDateTime', 'tDeviateDateTime', 'iDirectionType'], 'required'],
            [['tBeginDateTime', 'tDeviateDateTime'], 'safe'],
            [['iDirectionType'], 'integer'],
            [['sCode'], 'string', 'max' => 8]
        ];
    }
    
    public static function getAttributeLabels($attribute = null)
    {
        $items = [
            'id' => Yii::t('app', 'ID'),
            'sCode' => Yii::t('app', '股票代码'),
            'tBeginDateTime' => Yii::t('app', '开始日期'),
            'tDeviateDateTime' => Yii::t('app', '背离日期'),
            'iDirectionType' => Yii::t('app', '趋势方向'),
        ];
        return ArrayHelper::getItems($items, $attribute);
    }
    

    /**
     * @inheritdoc
     * @return DailyMacdDeviateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DailyMacdDeviateQuery(get_called_class());
    }
}
