
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
<div class="row">
    <!-- Pie Chart -->
    <div class="col-md-6">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Grafik Jenis Kelamin Siswa</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
        </div>
    </div>

    <!-- Bar Chart -->
    <div class="col-md-6">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Grafik Bulan Kelahiran Siswa</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <!-- Stacked Bar Chart -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Grafik Tahun Kelahiran Siswa Berdasarkan Jenis Kelamin</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
    </div>
</div>

</div>

</div>
