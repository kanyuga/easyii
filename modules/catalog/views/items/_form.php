<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\easyii\widgets\Redactor;

$settings = $this->context->module->settings;
?>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]); ?>
<?= $form->field($model, 'title') ?>
<?php if($settings['itemThumb']) : ?>
    <?php if($model->thumb) : ?>
        <img src="<?= Yii::$app->request->baseUrl.$model->thumb ?>">
        <a href="/admin/catalog/items/clear-image/<?= $model->primaryKey ?>" class="text-danger confirm-delete" title="<?= Yii::t('easyii/catalog', 'Clear image')?>"><?= Yii::t('easyii/catalog', 'Clear image')?></a>
    <?php endif; ?>
    <?= $form->field($model, 'thumb')->fileInput() ?>
<?php endif; ?>
<?= $dataForm ?>
<?php if($settings['itemDescription']) : ?>
    <?= $form->field($model, 'description')->widget(Redactor::className(),[
        'options' => [
            'minHeight' => 400,
            'imageUpload' => '/admin/redactor/upload?dir=catalog',
            'fileUpload' => '/admin/redactor/upload?dir=catalog',
            'plugins' => ['fullscreen']
        ]
    ]) ?>
<?php endif; ?>
<?php if(IS_ROOT) : ?>
    <?= $form->field($model, 'slug') ?>
<?php endif; ?>
<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>