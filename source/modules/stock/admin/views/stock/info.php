<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\helpers\ArrayHelper;
use source\LuLu;
use source\libs\Common;
use source\libs\Constants;
use source\core\grid\GridView;
use source\core\widgets\ActiveForm;

/* @var $this source\core\back\BackView */


$this->title='stock';
?>

<script src="http://echarts.baidu.com/dist/echarts.js" ></script>
<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<div id="main" style="width: 100%;height:800px;"></div>

<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main'));

    // 指定图表的配置项和数据
    var option = {
        title: {
//            text: 'ECharts 入门示例'
            text: '<?= $basicInfo['name']?>'
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'line'
            }
        },
        legend: {
            data:['日K','macd', 'dif', 'dea']
        },
//        grid: {
//            left: '10%',
//            right: '10%',
//            bottom: '15%'
//        },
        grid: [{
            left: '3%',
            right: '1%',
            height: '60%'
        }, {
            left: '3%',
            right: '1%',
            top: '75%',
            height: '15%'
        }],
        xAxis: [{
            scale: true,
            boundaryGap: false,
            axisLine: {onZero: false},
            splitLine: {show: false},
            gridIndex: 0,
            data: <?= json_encode($aDate)?>
        },{
            scale: true,
            gridIndex: 1,
            data: <?= json_encode($aDate)?>
        }],
        yAxis: [{
            scale: true,
            gridIndex: 0
        },{
            scale: true,
            splitNumber: 10,
            gridIndex: 1
        }],
        dataZoom: [
        {
            type: 'inside',
            startValue: <?= count($aDate)-30*12?>,
            end: 100,
            xAxisIndex: [0, 1]
        },{
            show: true,
            type: 'slider',
            y: '95%',
            xAxisIndex: [0, 1]
        }],
        series: [
            {
                name: '日K',
                type: 'candlestick',
                xAxisIndex: 0,
                yAxisIndex: 0,
                data: <?= json_encode($aData);?>
            },
            {
                name: 'macd',
                type: 'bar',
                xAxisIndex: 1,
                yAxisIndex: 1,
                itemStyle: {
                    normal: {
                        color: function(params) {
                            var colorList;
                            if (params.data >= 0) {
                                colorList = '#ef232a';
                            } else {
                                colorList = '#14b143';
                            }
                            return colorList;
                        }
                    }
                },
                data: <?= json_encode($aMacd)?>
            },
            {
                name: 'dif',
                type: 'line',
                xAxisIndex: 1,
                yAxisIndex: 1,
                data: <?= json_encode($aDif)?>,
                markLine: {
                    data: <?= json_encode($aDeviate);?>
////                        {type: 'max', name: '最大值'},
////                        {type: 'min', name: '最小值'},
//                    ]
//                    data: <?//= json_encode($aBottom);?>
//                    data: <?//= json_encode($aDeviate);?>
                }
            },
            {
                name: 'dea',
                type: 'line',
                xAxisIndex: 1,
                yAxisIndex: 1,
                data: <?= json_encode($aDea)?>
            },
        ]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>