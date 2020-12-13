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
class SearchDailyMacdDeviateBuy extends DailyMacdDeviateBuy
{
    public $sName;
    public $tBeginDateTime;
    public $tDeviateDateTime;
    public $iDirectionType;
    public $iTurnoverRate;

    public static function getAttributeLabels($attribute = null)
    {
        $params = [
            'sName' => Yii::t('app', '股票名称'),
            'tBeginDateTime' => Yii::t('app', '背离起始点'),
            'tDeviateDateTime' => Yii::t('app', '背离结束点'),
            'iDirectionType' => Yii::t('app', '背离方向'),
            'iTurnoverRate' => Yii::t('app', '换手率(%)'),
        ];
        return array_merge(parent::getAttributeLabels(), $params);
    }

    public function search($params = null){
        $query = self::findQuery()
//        $query = (new Query)
            ->select([
                'deviate_buy.id',
                'deviate_buy.sCode',
                'deviate_buy.tDateTime',
                'deviate.tBeginDateTime',
                'deviate.tDeviateDateTime',
                'deviate.iDirectionType',
                'dailyData.iTurnoverRate',
                'sName' =>'base.name'
            ])
            ->from(["deviate_buy" => DailyMacdDeviateBuy::tableName()])
            ->leftJoin(["deviate" => DailyMacdDeviate::tableName()], "deviate.id = deviate_buy.iDeviateId")
            ->leftJoin(["dailyData" => DailyData::tableName()], "dailyData.tDateTime = deviate_buy.tDateTime and dailyData.sCode = deviate_buy.sCode")
            ->leftJoin(["base" => "stock_basics"], "base.code = deviate_buy.sCode")
            ->orderBy([
                "deviate_buy.tDateTime" => SORT_DESC,
//                "deviate_buy.tDateTime" => SORT_DESC,
//                "dailyData.iTurnoverRate" => SORT_DESC,
            ]);

//        p($query->createCommand()->rawSql);
        return $query;
    }
}
