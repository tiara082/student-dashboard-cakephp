<?php
/**
 * @var \App\View\AppView $this
 */

$this->layout = 'CakeLte.login';
?>

<div class="card">
    <div class="card-body login-card-body">
    <p class="login-box-msg"><?= __('Silahkan login dengan akun yang tersedia') ?></p>


        <?= $this->Form->create() ?>

        <?= $this->Form->control('username', [
            'label' => false,
            'placeholder' => __('Username'),
            'append' => '<i class="fas fa-user"></i>',
        ]) ?>

        <?= $this->Form->control('password', [
            'label' => false,
            'placeholder' => __('Password'),
            'append' => '<i class="fas fa-lock"></i>',
        ]) ?>

        <div class="row justify-content-center pt-2">
            <div class="col-4">
                <?= $this->Form->control(__('Sign In'), ['type' => 'submit', 'class' => 'btn btn-primary btn-block', 'id' => 'loginBtn']) ?>
            </div>
        </div>

        <?= $this->Form->end() ?>

        <div class="social-auth-links text-center mb-3">
        <p class="mb-0">
           Belum memiliki akun? <?= $this->Html->link(__('Daftar'), ['action' => 'register']) ?>
        </p>         
        </div>



    </div>
</div>

