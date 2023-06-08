<div class="main-panel">
    <div class="container">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                        <h5 class="text-white op-7 mb-2">Halo, <?= $saya_karyawan['nama']; ?>! <br> Ini kabar terbaru dari restomu</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="<?= base_url('admin/tambah_menu'); ?>" class="btn btn-white btn-border btn-round mr-2">Tambah Menu</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row mt--2">
                <div class="col-md-6">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="card-title">Ringkasan</div>
                            <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                                <div class="px-2 pb-2 pb-md-0 text-center">
                                    <div id="circles-1"></div>
                                    <h6 class="fw-bold mt-3 mb-0">Pengguna Aplikasi</h6>
                                </div>
                                <div class="px-2 pb-2 pb-md-0 text-center">
                                    <div id="circles-2"></div>
                                    <h6 class="fw-bold mt-3 mb-0">Kategori Menu</h6>
                                </div>
                                <div class="px-2 pb-2 pb-md-0 text-center">
                                    <div id="circles-3"></div>
                                    <h6 class="fw-bold mt-3 mb-0">Menu Makanan</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="card-title">Total Pendapatan & Statistik <small>*dalam seminggu</small></div>
                            <div class="row py-3">
                                <div class="col-md-4 d-flex flex-column justify-content-around">
                                    <div>
                                        <h6 class="fw-bold text-uppercase text-success op-8">Total Pendapatan</h6>
                                        <h3 class="fw-bold"><?php
                                                            $total = 0;
                                                            $disc = 0;
                                                            foreach ($penghasilan as $jmlh) :
                                                                $subtotal = $jmlh['pendapatan'];
                                                                $diskon = $jmlh['diskon'];
                                                                $total += $subtotal;
                                                                $disc += $diskon;
                                                            ?>
                                            <?php endforeach; ?>
                                            Rp <?= number_format($total - $disc, 0, ',', '.'); ?></h3>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-uppercase text-danger op-8">Total Pajak</h6>
                                        <h3 class="fw-bold"><?php
                                                            $total1 = 0;
                                                            foreach ($penghasilan as $jmlh) :
                                                                $subtotal1 = $jmlh['ppn'];
                                                                $total1 += $subtotal1;
                                                            ?>
                                            <?php endforeach; ?>
                                            Rp <?= number_format($total1, 0, ',', '.'); ?></h3>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div id="chart-container">
                                        <canvas id="totalIncomeChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card full-height">
                        <div class="card-header">
                            <div class="d-flex">
                                <div class="card-title mr-auto">Penjualan Perbarang</div>
                                <div class="card-title mr-2">Filter</div>
                                <div>
                                    <select name="filter_barang" class='form-control' id="filter_barang">
                                        <option value="now">Hari Ini</option>
                                        <option value="week">7 Hari Terakhir</option>
                                        <option value="month">Bulan Ini</option>
                                        <option value="year">Tahun Ini</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tbl_barang" class="table w-100" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Menu</th>
                                            <th>Kategori</th>
                                            <th>Terjual</th>
                                            <th>Pendapatan</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="bar-pendapatan" style="height: 400px"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card full-height">
                        <div class="card-header">
                            <div class="d-flex">
                                <div class="mr-3">
                                    <div class="card-title">
                                        Filter
                                    </div>
                                </div>
                                <div class="mr-3">
                                    <select name="bulan_pendapatan_kategori" id="bulan_pendapatan_kategori" class="form-control">
                                        <?php
                                        $bulan = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                        $i = 1;
                                        foreach ($bulan as $month) {
                                            if ('0' . $i == date('m')) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }

                                            echo "<option value='$i' $selected> $month </option>";
                                            $i++;
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div>
                                    <select name="tahun_pendapatan_kategori" id="tahun_pendapatan_kategori" class="form-control">
                                        <?php for ($i = date('Y'); $i >= 2020; $i -= 1) {
                                            echo "<option value='$i'> $i </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="bar-pendapatan-kategori" style="height: 200px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid">
            <nav class="pull-left">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Resto Kejawa
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="copyright ml-auto">
                <?= date('Y'); ?>, made with <i class="fa fa-heart heart text-danger"></i> by <a href="http://wehoot.store/">Wehoot</a>
            </div>
        </div>
    </footer>
</div>

<script>
    $(document).ready(function() {
        var table = $("#tbl_barang").DataTable({
            responsive: true,
            language: {
                emptyTable: "Data tidak ditemukan",
            },
            processing: true,
            serverSide: true,
            pageLength: 25,
            lengthMenu: [
                [10, 25, 50, 75, 100, -1],
                [10, 25, 50, 75, 100, "All"],
            ],
            order: [],
            ajax: {
                url: "<?= base_url() ?>admin/get_penjualan_barang",
                type: "POST",
                data: function(data) {
                    data.filter = $("#filter_barang").val();
                },
            },
            columns: [{
                    data: "nama_menu",
                },
                {
                    data: "kategori",
                },
                {
                    data: "terjual",
                },
                {
                    data: "pendapatan",
                },
            ],
            columnDefs: [{
                    targets: [2],
                    className: "text-center text-primary",
                },
                {
                    targets: [0],
                    orderable: false,
                    className: "text-center",
                },
                {
                    targets: [-1],
                    className: "text-right",
                },
            ],
        });

        load_pendapatan();
        load_pendapatan_kategori();

        $('#tahun_pendapatan_kategori').on('change', function() {
            load_pendapatan_kategori();
        });

        $('#filter_barang').on('change', function() {
            table.ajax.reload();
        });

        $('#bulan_pendapatan_kategori').on('change', function() {
            load_pendapatan_kategori();
        });
    });

    function load_pendapatan() {
        $.ajax({
            data: {
                tahun: ($('#tahun_pendapatan').val())
            },
            type: "POST",
            url: "<?php echo site_url('admin/fetch_pendapatan') ?>",
            cache: false,
            success: function(response) {
                //get the bar chart canvas
                var ctx = $("#bar-pendapatan");
                console.log(response);

                //bar chart data
                var data = {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    datasets: response
                };

                //options
                var options = {
                    responsive: true,
                    maintainAspectRatio: false,
                    title: {
                        display: true,
                        position: "top",
                        text: "Grafik Pendapatan",
                        fontSize: 18,
                        fontColor: "#111"
                    },
                    legend: {
                        display: true,
                        position: "bottom",
                        labels: {
                            fontColor: "#333",
                            fontSize: 16
                        }
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: (val) => {
                                    if (!val) return 0;

                                    var number_string = val.toString(),
                                        sisa = number_string.length % 3,
                                        rupiah = number_string.substr(0, sisa),
                                        ribuan = number_string.substr(sisa).match(/\d{3}/g);

                                    if (ribuan) {
                                        separator = sisa ? '.' : '';
                                        rupiah += separator + ribuan.join('.');
                                    }

                                    return (
                                        'Rp ' + rupiah
                                    );
                                },
                            },
                        }],
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                return "Rp " + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                                    return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "." + c : c;
                                });
                            }
                        }
                    }
                };

                //create bar Chart class object
                var chart1 = new Chart(ctx, {
                    type: "bar",
                    data: data,
                    options: options
                });

                chart1.update();
            }
        });
    }

    function load_pendapatan_kategori() {
        $.ajax({
            data: {
                bulan: ($('#bulan_pendapatan_kategori').val()),
                tahun: ($('#tahun_pendapatan_kategori').val())
            },
            type: "POST",
            url: "<?php echo site_url('admin/fetch_pendapatan_kategori') ?>",
            cache: false,
            success: function(response) {
                //get the bar chart canvas
                var ctx = $("#bar-pendapatan-kategori");

                //bar chart data
                var data = {
                    labels: response.labels,
                    datasets: response.datasets
                };

                //options
                var options = {
                    responsive: true,
                    maintainAspectRatio: false,
                    title: {
                        display: true,
                        position: "top",
                        text: "Grafik Pendapatan Per Kategori",
                        fontSize: 18,
                        fontColor: "#111"
                    },
                    legend: {
                        display: true,
                        position: "bottom",
                        labels: {
                            fontColor: "#333",
                            fontSize: 16
                        }
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: (val) => {
                                    if (!val) return 0;

                                    var number_string = val.toString(),
                                        sisa = number_string.length % 3,
                                        rupiah = number_string.substr(0, sisa),
                                        ribuan = number_string.substr(sisa).match(/\d{3}/g);

                                    if (ribuan) {
                                        separator = sisa ? '.' : '';
                                        rupiah += separator + ribuan.join('.');
                                    }

                                    return (
                                        'Rp ' + rupiah
                                    );
                                },
                            },
                        }],
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                return "Rp " + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                                    return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "." + c : c;
                                });
                            }
                        }
                    }
                };

                //create bar Chart class object
                var chart2 = new Chart(ctx, {
                    type: "line",
                    data: data,
                    options: options
                });

                chart2.update();
            }
        });
    }

    Circles.create({
        id: 'circles-1',
        radius: 45,
        value: <?= $jumlah_user; ?>,
        maxValue: <?= $jumlah_user; ?>,
        width: 7,
        text: <?= $jumlah_user; ?>,
        colors: ['#f1f1f1', '#FF9E27'],
        duration: 400,
        wrpClass: 'circles-wrp',
        textClass: 'circles-text',
        styleWrapper: true,
        styleText: true
    })

    Circles.create({
        id: 'circles-2',
        radius: 45,
        value: <?= $jumlah_kategori; ?>,
        maxValue: <?= $jumlah_kategori; ?>,
        width: 7,
        text: <?= $jumlah_kategori; ?>,
        colors: ['#f1f1f1', '#2BB930'],
        duration: 400,
        wrpClass: 'circles-wrp',
        textClass: 'circles-text',
        styleWrapper: true,
        styleText: true
    })

    Circles.create({
        id: 'circles-3',
        radius: 45,
        value: <?= $jumlah_menu; ?>,
        maxValue: <?= $jumlah_menu; ?>,
        width: 7,
        text: <?= $jumlah_menu; ?>,
        colors: ['#f1f1f1', '#F25961'],
        duration: 400,
        wrpClass: 'circles-wrp',
        textClass: 'circles-text',
        styleWrapper: true,
        styleText: true
    })

    var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

    var mytotalIncomeChart = new Chart(totalIncomeChart, {
        type: 'bar',
        data: {
            labels: [<?php
                        if (count($penghasilan) > 0) {
                            foreach ($penghasilan as $data) {
                                // $hasil = $data['hari'];
                                if ($data['hari'] == "Sun") {
                                    echo "\"Minggu\",";
                                } else if ($data['hari'] == "Mon") {
                                    echo "\"Senin\",";
                                } else if ($data['hari'] == "Tue") {
                                    echo "\"Selasa\",";
                                } else if ($data['hari'] == "Wed") {
                                    echo "\"Rabu\",";
                                } else if ($data['hari'] == "Thu") {
                                    echo "\"Kamis\",";
                                } else if ($data['hari'] == "Fri") {
                                    echo "\"Jum'at\",";
                                } else if ($data['hari'] == "Sat") {
                                    echo "\"Sabtu\",";
                                }
                            }
                        }
                        ?>],
            datasets: [{
                label: "Total Pendapatan",
                backgroundColor: '#ff9e27',
                borderColor: 'rgb(23, 125, 255)',
                data: [<?php
                        if (count($penghasilan) > 0) {
                            foreach ($penghasilan as $data) {
                                echo $data['pendapatan'] - $data['diskon'] . ", ";
                            }
                        }
                        ?>],
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false,
            },
            scales: {
                yAxes: [{
                    ticks: {
                        display: false //this will remove only the label
                    },
                    gridLines: {
                        drawBorder: false,
                        display: false
                    }
                }],
                xAxes: [{
                    gridLines: {
                        drawBorder: false,
                        display: false
                    }
                }]
            },
        }
    });

    $('#lineChart').sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: 'line',
        height: '70',
        width: '100%',
        lineWidth: '2',
        lineColor: '#ffa534',
        fillColor: 'rgba(255, 165, 52, .14)'
    });
</script>