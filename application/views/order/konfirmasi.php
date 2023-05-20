<div class="main-panel">
    <div class="container mt--7">
        <div class="page-inner mt--7">
            <div class="page-header">
                <h4 class="page-title"><?= $title; ?></a></h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="<?= base_url('order/menu'); ?>">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#"><?= strtoupper($this->session->userdata('layanan')); ?></a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#"><?= $title; ?></a>
                    </li>

                </ul>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-primary bg-primary-gradient">
                        <div class="card-body">
                            <h4 class="mb-1 fw-bold">DATA PEMESAN</h4>
                            <hr>
                            <div class="table-responsive">
                                <table style="width: 100%;">
                                    <tr>
                                        <td valign="top">Nama Pemesan</td>
                                        <td valign="top">: <?= $this->session->userdata('namapemesan'); ?></td>
                                    </tr>
                                    <tr>
                                        <td valign="top">Jenis Pesanan</td>
                                        <td valign="top">: <?= ucfirst($this->session->userdata('layanan')); ?>
                                            <?php if ($this->session->userdata('status') == "sekarang") {
                                                echo ucfirst($this->session->userdata('status'));
                                            } else {
                                                if ($this->session->userdata('layanan') == "Dine In") {
                                                    echo ' - Jam ' . $this->session->userdata('waktu') . '<br>&nbsp;&nbsp; WA. ' . $this->session->userdata('nomor');
                                                } else {
                                                    echo '<br> &nbsp;&nbsp; WA. ' . $this->session->userdata('nomor') . '<br> &nbsp;&nbsp; ' . $this->session->userdata('email');
                                                }
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">Catatan Pemesan</td>
                                        <td valign="top">: <?php if ($this->session->userdata('catatan') != null) {
                                                                echo ucfirst($this->session->userdata('catatan'));
                                                            } else {
                                                                echo '-';
                                                            }  ?>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Daftar Belanja Anda</B></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('message');  ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr align="center">
                                            <th scope="col" width="10%">Line</th>
                                            <th scope="col">Nama Menu</th>
                                            <th scope="col" width="10%">Qty</th>
                                            <th scope="col" width="23%">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($this->cart->contents() as $items) : ?>
                                            <tr>
                                                <th scope="row"><?= $i++; ?></th>
                                                <td><?= $items['name']; ?></td>
                                                <td align="center"><?= $items['qty']; ?></td>
                                                <td align="right"><?= number_format($items['subtotal'], 2, ',', '.'); ?></td>
                                            </tr>
                                        <?php $i += 1;
                                        endforeach; ?>
                                        <tr>
                                            <td colspan="3" align="right"><b>Total (<?= $i - 1; ?> items)</b></td>
                                            <td align="right"><b><?= number_format($this->cart->total(), 2, ',', '.'); ?></b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" align="right"><b>PPN 10%</b></td>
                                            <td align="right"><b><?= number_format($ppn = $this->cart->total() * 10 / 100, 2, ',', '.'); ?></b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" align="right"><b>Grand Total</b></td>
                                            <td align="right"><b><?= number_format($this->cart->total() + $ppn, 2, ',', '.'); ?></b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a href="<?= base_url('order/proses') ?>" class="btn btn-primary mr-auto">Pesan Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <div class="copyright ml-auto">
            <?= date('Y'); ?>, made with <i class="fa fa-heart heart text-danger"></i> by <a href="http://www.wehoot.stpre">Wehoot</a>
        </div>
    </div>
</footer>