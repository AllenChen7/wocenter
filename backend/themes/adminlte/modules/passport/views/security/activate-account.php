<?php

use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\web\View;
use wocenter\backend\modules\passport\models\PassportForm;

/**
 * @var yii\web\View $this
 * @var \yii\bootstrap\ActiveForm $form
 * @var \wocenter\backend\modules\passport\models\SecurityForm $model
 */

$this->title = Yii::t('wocenter/app', 'Activate Account');
?>

<?php
$form = ActiveForm::begin([
    'id' => 'activate-account-form',
//    'enableClientValidation' => true
]);
?>

<?= $form->field($model, 'email')->textInput(['placeholder' => Yii::t('wocenter/app', 'Register Email')])->label(false) ?>

<?php
if (PassportForm::getUseCaptcha()) {
    echo $form->field($model, 'captcha')->widget(Captcha::className(), [
        'captchaAction' => PassportForm::CAPTCHA_ACTION,
        'template' => '<div class="input-group">{input}<div class="input-group-addon">{image}</div></div>',
        'options' => [
            'class' => 'form-control',
            'placeholder' => $model->getAttributeLabel('captcha')
        ],
        'imageOptions' => [
            'id' => 'verifycode-image',
            'title' => Yii::t('wocenter/app', 'Change another one'),
            'height' => '20px',
            'width' => '100px',
            'alt' => $model->getAttributeLabel('captcha'),
            'style' => 'cursor:pointer',
        ]
    ])->label(false);
}
?>

<div class="form-group">
    <?= Html::submitButton(Yii::t('wocenter/app', 'Activate Account'), ['class' => 'btn btn-primary btn-block btn-lg', 'name' => 'submit-button']) ?>
</div>

<?php ActiveForm::end(); ?>

<div class="social-auth-links text-center">
    <p>- OR -</p>
    <div class="form-group">
        <?= Html::a(Yii::t('wocenter/app', 'Login Now'), ['/passport/common/login'], ['class' => 'btn btn-success btn-block', 'name' => 'login-button']) ?>
        <?= Html::a(Yii::t('wocenter/app', 'Signup Now'), ['/passport/common/signup'], ['class' => 'btn btn-danger btn-block', 'name' => 'signup-button']) ?>
    </div>
    <p><?= Yii::t('wocenter/app', "We've been doing better for you!"); ?></p>
</div>

<?php $this->registerJs(<<<JS
$("#{$form->id}").find("input").get(1).focus();
JS
, View::POS_END); ?>