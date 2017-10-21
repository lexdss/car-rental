<?php
/**
 * Modal window for set new password
 */
use yii\widgets\Pjax;

?>

<div class="modal fade" id="set-new-password-modal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-center">Установите новый пароль</h4>
            </div>
            <div class="modal-body">

                <?php Pjax::begin(['enablePushState' => false]); ?>
                    <?= $this->render('@app/views/user/_set_new_password_body', ['userNewPassword' => $userNewPassword, 'userEmail' => $userEmail]) ?>
                <?php Pjax::end(); ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>