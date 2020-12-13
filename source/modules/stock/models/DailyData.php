<?php

namespace source\modules\stock\models;

use Yii;
use source\LuLu;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "{{%daily_data}}".
 *
 * @property string $id
 * @property string $sCode
 * @property string $tDateTime
 * @property string $iOpeningPrice
 * @property string $iClosingPrice
 * @property string $iTodayPrice
 * @property string $iPriceChangeRatio
 * @property string $iMinimumPrice
 * @property string $iMaximumPrice
 * @property integer $iVol
 * @property string $iTurnover
 * @property string $iTurnoverRate
 */
class DailyData extends \source\core\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%daily_data}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sCode', 'tDateTime'], 'required'],
            [['tDateTime'], 'safe'],
            [['iOpeningPrice', 'iClosingPrice', 'iTodayPrice', 'iPriceChangeRatio', 'iMinimumPrice', 'iMaximumPrice', 'iTurnover', 'iTurnoverRate'], 'number'],
            [['iVol'], 'integer'],
            [['sCode'], 'string', 'max' => 6]
        ];
    }
    
    public static function getAttributeLabels($attribute = null)
    {
        $items = [
            'id' => Yii::t('app', 'ID'),
            'sCode' => Yii::t('app', 'S Code'),
            'tDateTime' => Yii::t('app', '日期'),
            'iOpeningPrice' => Yii::t('app', '开盘价'),
            'iClosingPrice' => Yii::t('app', '收盘价'),
            'iTodayPrice' => Yii::t('app', '涨幅(%)'),
            'iPriceChangeRatio' => Yii::t('app', '涨幅'),
            'iMinimumPrice' => Yii::t('app', '最低价'),
            'iMaximumPrice' => Yii::t('app', '最高价'),
            'iVol' => Yii::t('app', '总手'),
            'iTurnover' => Yii::t('app', '交易额'),
            'iTurnoverRate' => Yii::t('app', '换手率(%)'),
        ];
        return ArrayHelper::getItems($items, $attribute);
    }
    

    /**
     * @inheritdoc
     * @return DailyDataQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DailyDataQuery(get_called_class());
    }
}
