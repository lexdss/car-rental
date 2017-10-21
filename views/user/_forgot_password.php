<?php
/**
 * Modal window for recovery password
 */
use yii\widgets\Pjax;

?>

<div class="modal fade" id="forgot-password-modal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-center">Восстановление пароля</h4>
            </div>
            <div class="modal-body">

                <?php Pjax::begin(['enablePushState' => false]); ?>
                    <?= $this->render('@app/views/user/_forgot_password_body') ?>
                <?php Pjax::end(); ?>

           </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
