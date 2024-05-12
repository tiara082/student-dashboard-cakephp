<?php
/**
 * @var \App\View\AppView $this
 */

$this->layout = 'CakeLte.login';
?>

<div class="card">
    <div class="card-body register-card-body">
        <p class="login-box-msg"><?= __('Daftar Akun Baru') ?></p>

        <?= $this->Form->create() ?>

        <?= $this->Form->control('name', [
            'label' => false,
            'placeholder' => __('Nama Lengkap'),
            'append' => '<i class="fas fa-user"></i>',
        ]) ?>

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

        <?= $this->Form->control('nis', [
            'label' => false,
            'placeholder' => __('NIS'),
            'append' => '<i class="fas fa-id-card"></i>',
        ]) ?>

        <?= $this->Form->control('address', [
            'label' => false,
            'placeholder' => __('Alamat'),
            'append' => '<i class="fas fa-map-marker"></i>',
        ]) ?>

        <?= $this->Form->control('birth_date', [
            'label' => false,
            'placeholder' => __('Tanggal Lahir'),
            'type' => 'date',
        ]) ?>

        <?= $this->Form->control('gender', [
            'label' => false,
            'options' => ['male' => 'Laki-laki', 'female' => 'Perempuan'],
            'empty' => __('Pilih Jenis Kelamin'),
            'append' => '<i class="fas fa-venus-mars"></i>',
            'class' => 'form-control', 
        ]) ?>

        <?= $this->Form->control('level', [
            'type' => 'hidden',
            'value' => 'user',
        ]) ?>

<div class="row justify-content-center pt-3">
            <div class="col-4">
                <?= $this->Form->control(__('Daftar'), [
                    'type' => 'submit',
                    'class' => 'btn btn-primary btn-block',
                ]) ?>
            </div>
        </div>

        <?= $this->Form->end() ?>

        <div class="social-auth-links text-center mb-3">
            Sudah memiliki akun? <?= $this->Html->link(__('  login'), ['action' => 'login']) ?>

        </div>

    </div>
</div>
