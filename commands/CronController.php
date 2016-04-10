<?php
namespace app\commands;
use app\bases\BaseCmdController;
/**
 * 修改Cron文件的Controller
 * @author xiawei
 */
class CronController extends BaseCmdController {
    private $php = '/usr/local/php/bin/php';
    private $config = array(
        'cron' => array(
            'run' => '* * * * *',
        ),
        'show-msg' => array(
            'add-reg-count' => '*/3 * * * *',
        )
    );
    
    public function actionRun() {
        $cronStr = '';
        $basePath = \Yii::$app->basePath;
        foreach ($this->config as $controller => $actions) {
            foreach ($actions as $actionName => $runTime) {
                $cronStr .= "{$runTime} {$this->php} {$basePath}/yii {$controller}/{$actionName}\n";
            }
        }
        file_put_contents('/var/spool/cron/root', $cronStr);
    }
}