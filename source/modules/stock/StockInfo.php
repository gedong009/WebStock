<?php

namespace source\modules\stock;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\helpers\ArrayHelper;
use source\LuLu;
use source\libs\Common;
use source\libs\Constants;

class StockInfo extends \source\core\modularity\ModuleInfo
{

    public function init()
    {
        parent::init();
        
        $this->id='stock';
        $this->name = 'Stock Module';
        $this->version = '1.0';
        $this->description = 'Stock description';
    }
}
