<?php

namespace source\modules\stock\models;

use Yii;
use source\LuLu;
use yii\db\Query;
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
class SearchDailyMacdDeviate extends DailyMacdDeviate
{
    public $sName;
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
        $params = [
            'sName' => Yii::t('app', '股票名称'),
        ];
        return array_merge(parent::getAttributeLabels(), $params);
    }
    
    public function search($params = null){
        $query = self::findQuery()
//        $query = (new Query)
            ->select([
                'deviate.*',
                'sName' =>'base.name'
            ])
            ->from(["deviate" => DailyMacdDeviate::tableName()])
            ->leftJoin(["base" => "stock_basics"], "base.code = deviate.sCode");
//        p($query->createCommand()->rawSql);
        return $query;
    }
}
