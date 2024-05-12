<?php
use Carbon\Carbon;
Carbon::setLocale('id');
?>
<style>
    #dataTablesButtons {
        display: flex;
        justify-content: center; 
        height: 100vh; 
    }

  
</style>

<div id="dataTablesButtons">
    <a id="copyButton" class="btn btn-app" href="#">
        <i class="fas fa-copy"></i> Copy
    </a>
    <a id="csvButton" class="btn btn-app" href="#">
        <i class="fas fa-file-csv"></i> CSV
    </a>
    <a id="excelButton" class="btn btn-app" href="#">
        <i class="fas fa-file-excel"></i> Excel
    </a>
    <a id="pdfButton" class="btn btn-app" href="#">
        <i class="fas fa-file-pdf"></i> PDF
    </a>
    <a id="printButton" class="btn btn-app" href="#">
        <i class="fas fa-print"></i> Print
    </a>
</div>



<div class="card-body table-responsive" id="dataTableContainer">
        <table id="example3" class="table table-hover text-nowrap">
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