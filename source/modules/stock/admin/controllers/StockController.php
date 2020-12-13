<?php

namespace source\modules\stock\admin\controllers;

use source\core\data\ActiveDataProvider;
use source\modules\stock\models\DailyData;
use source\modules\stock\models\DailyMacd;
use source\modules\stock\models\DailyMacdApex;
use source\modules\stock\models\DailyMacdDeviate;
use source\modules\stock\models\DailyMacdQuery;
use source\modules\stock\models\SearchDailyMacdDeviate;
use source\modules\stock\models\SearchDailyMacdDeviateBuy;
use yii\db\Query;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\helpers\ArrayHelper;
use source\LuLu;
use source\libs\Common;
use source\libs\Constants;
use yii;

class StockController extends \source\core\back\BackController
{
//    public function actionIndex(){
//        (new Query())
//            ->from(["d" => DailyData::tableName()])
//            ->where(['d.sCode' => $code])
//            ->orderBy("d.tDateTime asc")
//            ->all();
//    }

    public function actionIndex(){

        $searchModel = new SearchDailyMacdDeviateBuy();
        $query = $searchModel->search();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
//             'pagination' => [
//                  'pageSize' => 2,
//              ],
            'totalCount' => 1000,
//            'sort'=>[
//                'defaultOrder' => [
//                    'tDateTime' => SORT_DESC,
//                    'iTurnoverRate' => SORT_DESC,
//                ]
//            ],
        ]);
//        $dataProvider->prepare();
//        p($dataProvider->getModels());
//        p($dataProvider->query->createCommand()->rawSql);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);

    }

    public function actionInfo($code)
    {
        $get = Yii::$app->request->get();
        $code = empty($get['code']) ? null : $get['code'];
        if (empty($code)){
            $code = "000001";
        }

        $basicInfo = (new Query())
            ->from("stock_basics")
            ->where(['code' => $code])
            ->one();


        $aData = [];
//        $data = DailyData::findAll(['sCode' => $code]);
        $data = (new Query())
            ->from(["d" => DailyData::tableName()])
            ->leftJoin(["m" => DailyMacd::tableName()], "d.tDateTime = m.tDateTime and m.sCode=d.sCode")
            ->where(['d.sCode' => $code])
            ->orderBy("d.tDateTime asc")
            ->all();
//        v($data->createCommand()->rawSql);
        foreach ($data as $value){
            $aData[] = [
                $value['iOpeningPrice'],
                $value['iClosingPrice'],
                $value['iMinimumPrice'],
                $value['iMaximumPrice'],
            ];
            $aMacd[] = $value['iBar'];
            $aDif[] = $value['iDif'];
            $aDea[] =  $value['iDea'];
            $aDate[] = $value['tDateTime'];
//            $aData[] = $value['iMinimumPrice'];
        }

//        $macd = (new Query())
//            ->from(DailyMacd::tableName())
//            ->where(['sCode' => $code])
//            ->all();
//        foreach ($macd as $value){
//            $aMacd[] = [$value['tDateTime'], $value['iBar']];
//            $aDif[] = [$value['tDateTime'], $value['iDif']];
//            $aDea[] = [$value['tDateTime'], $value['iDea']];
//            $aDate[] = $value['tDateTime'];
//        }
//        顶点
        $aBottom = [];
        $aBottomList = (new Query())
            ->from(DailyMacdApex::tableName())
            ->where(['sCode' => $code, 'iDirectionType' => 2])
            ->all();
        foreach ($aBottomList as $value){
            $aBottom[] = [
                'coord' => [
                    $value['tApexDateTime'],
                    $value['iApexDif'],
                ],
                'symbolRotate' => 180,
            ];
        }

//        背离
        $aDeviate = [];
        $aDeviateList = (new Query())
            ->from(["d" => DailyMacdDeviate::tableName()])
            ->where(['d.sCode' => $code, 'd.iDirectionType' => 2])
            ->all();
        foreach ($aDeviateList as $value){
            $aDeviate[] = [
                [
                    'coord' => [
                        $value['tBeginDateTime'], $value['iBeginDif']
                    ],
                ],
                [
                    'coord' => [
                    $value['tDeviateDateTime'], $value['iDeviateDif']
                    ],
                ],
            ];
//            $aDeviateBegin[] = [
//                'symbol' => 'arrow',
//                'symbolSize' => '20',
//                'coord' => [
//                    $value['tBeginDateTime'],
//                    -1,
//                ],
////                'symbolRotate' => 180,
//            ];
//            $aDeviateWxecuted[] = [
//                'coord' => [
//                    $value['tDeviateDateTime'],
//                    0,
//                ],
//                'itemStyle' => [
//                    'normal' => [
//                        'color' => [
//                            'x' => 0,
//                            'y' => 0,
//                            'x2' => 0,
//                            'y2' => 1,
//                            'colorStops' => [
//                                'offset' => 0,
//                                'color' => 'red',
//                            ],[
//                                'offset' => 0,
//                                'color' => 'blue',
//                            ]
//                        ],
//                    ]
//                ]
//            ];
        }

//        $aDeviate = array_merge($aDeviateBegin, $aDeviateWxecuted);
//        $aDeviate = $aDeviateBegin;
//        v(json_encode($aDeviate));
        return $this->render('info', [
            'basicInfo' => $basicInfo,
            'aData' => $aData,
            'aMacd' => $aMacd,
            'aDif' => $aDif,
            'aDea' => $aDea,
            'aDate' => $aDate,
            'aBottom' => $aBottom,
            'aDeviate' => $aDeviate,
        ]);
    }
}
