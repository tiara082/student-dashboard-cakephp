<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Student[]|\Cake\Collection\CollectionInterface $students
 */
use Carbon\Carbon;
Carbon::setLocale('id');

?>


<div class="row">
    <!-- Small boxes -->
    <div class="col-lg-4 col-md-6 col-12">
        <div class="small-box bg-success d-flex align-items-center">
            <div class="icon">
                <i class="fas fa-female"></i> 
            </div>
            <div class="inner">
                <h3><?php echo $femaleStudents; ?></h3>
                <p>Siswa Perempuan</p>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-md-6 col-12">
        <div class="small-box bg-warning d-flex align-items-center">
            <div class="icon">
                <i class="fas fa-user"></i> 
            </div>
            <div class="inner">
                <h3><?php echo $totalStudents; ?></h3>
                <p>Total Siswa</p>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-md-6 col-12">
        <div class="small-box bg-danger d-flex align-items-center">
            <div class="icon">
                <i class="fas fa-male"></i> 
            </div>
            <div class="inner">
                <h3><?php echo $maleStudents; ?></h3>
                <p>Siswa Laki-laki</p>
            </div>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

<div class="card card-primary card-outline">
    <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-center">
        <h2 class="card-title mb-0" style="font-size: 24px;">
            <i class="fas fa-user-graduate mr-2"></i> 
            <?= __('Tabel Siswa') ?>
        </h2>
        <div class="d-flex ml-auto">
            <?= $this->Paginator->limitControl([], null, [
                'label' => false,
                'class' => 'form-control form-control-sm',
                'type' => 'hidden',
                'templates' => ['inputContainer' => '{{content}}']
            ]); ?>
            <!-- Tombol Untuk Membuka Modal Tambah Siswa -->
            <button type="button" class="btn btn-primary btn-sm ml-2" data-toggle="modal" data-target="#modalAddStudent">
                Tambah Siswa
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive">
        <table id="example2" class="table table-hover text-nowrap">
            <!-- Table Header -->
            <thead class="text-center">
                <tr>
                    <th>ID</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>NIS</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through Students -->
                <?php foreach ($students as $student) : ?>
                    <tr>
                        <td><?= $this->Number->format($student->id) ?></td>
                        <td><?= h($student->name) ?></td>
                        <td><?= h($student->username) ?></td>
                        <td><?= h($student->nis) ?></td>
                        <td><?= Carbon::createFromFormat('d/m/y', $student->birth_date)->translatedFormat('j F Y'); ?></td> <!-- Format tanggal sesuai jenis kelamin -->
                        <td><?= h($student->gender) === 'male' ? 'Laki-laki' : 'Perempuan'; ?></td> <!-- Ubah jenis kelamin -->
                        <td><?= h($student->address) ?></td>
                        <td>
                            <button type="button" class="btn btn-xs btn-outline-primary" data-toggle="modal" data-target="#modalViewStudent<?= $student->id ?>">
                                View
                            </button>

                            <!-- Edit Action -->
                            <button type="button" class="btn btn-xs btn-outline-primary" data-toggle="modal" data-target="#modalEditStudent<?= $student->id ?>">
                                Edit
                            </button>

                            <!-- Delete Action -->
                            <button type="button" class="btn btn-xs btn-outline-danger" data-toggle="modal" data-target="#deleteModal<?= $student->id ?>">
                                Delete
                            </button>
                
                     </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- Modal Tambah Siswa -->
<div class="modal fade" id="modalAddStudent" tabindex="-1" role="dialog" aria-labelledby="modalAddStudentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddStudentLabel">Tambah Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Tambah Siswa -->
                <?= $this->Form->create(null, ['url' => ['action' => 'add']]) ?>

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
            'append' => '<i class="far fa-calendar-alt"></i>',
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


            </div>
            <div class="modal-footer">
            <?= $this->Form->button(__('Tambah'), ['class' => 'btn btn-primary']) ?>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
             <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal View Siswa -->
<?php foreach ($students as $student) : ?>
    <div class="modal fade" id="modalViewStudent<?= $student->id ?>" tabindex="-1" role="dialog" aria-labelledby="modalViewStudentLabel<?= $student->id ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalViewStudentLabel<?= $student->id ?>">Detail Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
<div class="card card-primary card-outline">
<div class="card-body box-profile">
<div class="text-center">
<img class="profile-user-img img-fluid img-circle" src="<?php echo $student->gender === 'female' ? 'https://randomuser.me/api/portraits/women/44.jpg' : 'https://randomuser.me/api/portraits/men/75.jpg'; ?>" alt="User profile picture">
</div>
<h3 class="profile-username text-center"><?= h($student->name) ?></h3>
<p class="text-muted text-center"><?= h($student->level) ?></p>
<div class="card-body p-0">
<ul class="list-group list-group-unbordered mb-3">
    <li class="list-group-item">
        <b><?= __('Nama Lengkap') ?></b> <span class="float-right"><?= h($student->name) ?></span>
    </li>
    <li class="list-group-item">
        <b><?= __('Username') ?></b> <span class="float-right"><?= h($student->username) ?></span>
    </li>
    <li class="list-group-item">
        <b><?= __('NIS') ?></b> <span class="float-right"><?= h($student->nis) ?></span>
    </li>
    <li class="list-group-item">
        <b><?= __('Jenis Kelamin') ?></b> <span class="float-right"><?= h($student->gender) === 'male' ? 'Laki-laki' : 'Perempuan'; ?></span>
    </li>
    <li class="list-group-item">
        <b><?= __('Level') ?></b> <span class="float-right"><?= h($student->level) ?></span>
    </li>
    <li class="list-group-item">
        <b><?= __('ID') ?></b> <span class="float-right"><?= $this->Number->format($student->id) ?></span>
    </li>
    <li class="list-group-item">
        <b><?= __('Tanggal Lahir') ?></b> <span class="float-right"><?= Carbon::createFromFormat('d/m/y', $student->birth_date)->translatedFormat('j F Y'); ?></span>
    </li>
    <li class="list-group-item">
    <b><?= __('Ditambahkan') ?></b> <span class="float-right"><?= Carbon::parse($student->created)->translatedFormat('j F Y H:i'); ?></span>
    </li>
</ul>


</div>
            </div>
</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Edit Siswa -->
<?php foreach ($students as $student) : ?>
    <div class="modal fade" id="modalEditStudent<?= $student->id ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditStudentLabel<?= $student->id ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditStudentLabel<?= $student->id ?>">Edit Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Edit Siswa -->
                    <?= $this->Form->create($student, ['url' => ['action' => 'edit', $student->id]]) ?>

                    <?= $this->Form->control('name', [
            'placeholder' => __('Nama Lengkap'),
            'label' => __('Nama Lengkap'),
            'append' => '<i class="fas fa-user"></i>',
        ]) ?>

        <?= $this->Form->control('username', [
            'placeholder' => __('Username'),
            'label' => __('Username'),
            'append' => '<i class="fas fa-user"></i>',
        ]) ?>

        <?= $this->Form->control('password', [
            'placeholder' => __('Password'),
            'label' => __('Password'),
            'append' => '<i class="fas fa-lock"></i>',
        ]) ?>

        <?= $this->Form->control('nis', [
            'placeholder' => __('NIS'),
            'label' => __('NIS'),
            'append' => '<i class="fas fa-id-card"></i>',
        ]) ?>

        <?= $this->Form->control('address', [
            'placeholder' => __('Alamat'),
            'label' => __('Alamat'),
            'append' => '<i class="fas fa-map-marker"></i>',
        ]) ?>

        <?= $this->Form->control('birth_date', [
            'placeholder' => __('Tanggal Lahir'),
            'label' => __('Tanggal Lahir'),
            'append' => '<i class="far fa-calendar-alt"></i>',
            'type' => 'date',
        ]) ?>

        <?= $this->Form->control('gender', [
 'label' => __('Jenis Kelamin'),
            'options' => ['male' => 'Laki-laki', 'female' => 'Perempuan'],
            'empty' => __('Pilih Jenis Kelamin'),
            'append' => '<i class="fas fa-venus-mars"></i>',
            'class' => 'form-control', 
        ]) ?>

        <?= $this->Form->control('level', [
            'type' => 'hidden',
            'value' => 'user',
        ]) ?>
                </div>
                <div class="modal-footer">
                    <?= $this->Form->button(__('Simpan'), ['class' => 'btn btn-primary']) ?>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php foreach ($students as $student) : ?>
    <!-- Modal konfirmasi penghapusan -->
    <div class="modal fade" id="deleteModal<?= $student->id ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $student->id ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel<?= $student->id ?>">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   Apakah kamu yakin ingin menghapus data Siswa ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <?= $this->Form->postLink(
                        'Hapus',
                        ['action' => 'delete', $student->id],
                        ['class' => 'btn btn-danger']
                    ) ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
