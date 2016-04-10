<?php
namespace app\modules\webman\controllers;
use app\utils\VerifyUtil;
use app\bases\WebController;
use yii\web\UploadedFile;
use app\utils\JsUtil;
use app\utils\OssUtil;
/**
 * 公用方法对应的Controller
 * @author xiawei
 */
class CommonController extends WebController {
    /* (non-PHPdoc)
     * @see \app\bases\WebController::aop()
     */
    protected function aop() {
        return false;
    }

    /* (non-PHPdoc)
     * @see \app\bases\WebController::op()
     */
    protected function op() {
        return false;
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    
    /**
     * 验证码
     */
    public function actionVerify() {
        $length = \Yii::$app->request->get('length', 5);
        $imageWidth = \Yii::$app->request->get('imageWidth', 200);
        $imageHeight = \Yii::$app->request->get('imageHeight', 30);
        VerifyUtil::createImg($length, $imageWidth, $imageHeight);
    }
    
    
    /**
     * 上传图片到Oss的Action
     */
    public function actionUpimg() {
        $type = \Yii::$app->request->post('type');
        $uploadedFile = UploadedFile::getInstanceByName('Filedata');
        if ($uploadedFile->size > (2 * 1024 *1024)) {
            JsUtil::jsonReturn(array('succ' => false, 'msg' => '上传文件大小不能超过2M'));
        }
        $width = 0;
        $height = 0;
        switch ($type) {
            case 'article_title_img':
                break;
        }
        if ($width != 0 && $height != 0) {
            list($imW, $imH, $imT, $attr) = getimagesize($uploadedFile->tempName);
            if ($imW != $width || $imH != $height) {
                JsUtil::jsonReturn(array('succ' => false, 'msg' => "上传文件宽度必须是{$width}px，高度必须是{$height}px。"));
            }
        }
        $newFileName = uuid_create();
        if ($fileUrl = OssUtil::uploadWebFile($uploadedFile->tempName, $newFileName.'.'.$uploadedFile->extension)) {
            JsUtil::jsonReturn(array('succ' => true, 'url' => $fileUrl));
        } else {
            JsUtil::jsonReturn(array('succ' => false, 'msg' => '上传图片到OSS失败'));
        }
    }
    
    /**
     * ckeditor上传图片
     */
    public function actionUpckimg() {
        $uploadedFile = UploadedFile::getInstanceByName('upload');
        if ($uploadedFile->size > (2 * 1024 *1024)) {
            JsUtil::alert('上传文件大小不能超过2M');
            \Yii::$app->end();
        }
        $newFileName = uuid_create();
        if ($fileUrl = OssUtil::uploadWebFile($uploadedFile->tempName, $newFileName.'.'.$uploadedFile->extension)) {
            $chefn = \Yii::$app->request->get('CKEditorFuncNum');
            $script = "window.parent.CKEDITOR.tools.callFunction({$chefn},'{$fileUrl}','图片上传成功');";
            JsUtil::runScript($script);
            \Yii::$app->end();
        } else {
            JsUtil::alert('上传图片到Oss失败');
            \Yii::$app->end();
        }
    }
}