<?php
namespace app\commands;
use app\bases\BaseCmdController;
use app\daos\ShowMsg;
/**
 * 显示信息对应的Controller
 * @author xiawei
 */
class ShowMsgController extends BaseCmdController {
    /**
     * 增加注册信息
     */
    public function actionAddRegCount() {
        $tableName = ShowMsg::TABLE_NAME;
        $addNum = rand(1, 10);
        $updateTime = time();
        $sql = "update {$tableName} set reg_count=reg_count+{$addNum},update_time={$updateTime}";
        ShowMsg::instance()->db()->createCommand($sql)->execute();
    }
}