<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<div class="row">
    
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                
                <h3>Rp.<?= number_format($hari_ini) ?></h3>
                <p>Penjualan Hari ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-success">
            <div class="inner">
                <h3>Rp.<?= number_format($bulan_ini) ?></h3>
                <p>Penjualan Bulan ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-warning">
            <div class="inner">
                
                <h3><?= $transaksi ?></h3>
                <p>Transaksi Hari ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-danger">
            <div class="inner">
                
                <h3><?= $produk ?></h3>
                <p>Produk</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
        </div>
    </div>

</div>

<div class="col-lg-6">
<div class="card">

<?php
    $nama_now = date('M');
    $nama_1 = date('M', strtotime("-1 Months"));
    $nama_2 = date('M', strtotime("-2 Months"));
    $nama_3 = date('M', strtotime("-3 Months"));
    $nama_4 = date('M', strtotime("-4 Months"));
    $nama_5 = date('M', strtotime("-5 Months"));

    $tanggal = date("Y-m", strtotime("-1 Months"));
    $this->db->select('sum(total_harga) as total')->from('penjualan')->where("DATE_FORMAT(penjualan_tanggal,'%Y-%m')", $tanggal);
    $bulan_1= $this->db->get()->row()->total;

    $tanggal = date("Y-m", strtotime("-2 Months"));
    $this->db->select('sum(total_harga) as total')->from('penjualan')->where("DATE_FORMAT(penjualan_tanggal,'%Y-%m')", $tanggal);
    $bulan_2= $this->db->get()->row()->total;

    $tanggal = date("Y-m", strtotime("-3 Months"));
    $this->db->select('sum(total_harga) as total')->from('penjualan')->where("DATE_FORMAT(penjualan_tanggal,'%Y-%m')", $tanggal);
    $bulan_3= $this->db->get()->row()->total;

    $tanggal = date("Y-m", strtotime("-4 Months"));
    $this->db->select('sum(total_harga) as total')->from('penjualan')->where("DATE_FORMAT(penjualan_tanggal,'%Y-%m')", $tanggal);
    $bulan_4= $this->db->get()->row()->total;

    $tanggal = date("Y-m", strtotime("-5 Months"));
    $this->db->select('sum(total_harga) as total')->from('penjualan')->where("DATE_FORMAT(penjualan_tanggal,'%Y-%m')", $tanggal);
    $bulan_5= $this->db->get()->row()->total;
    
    if($bulan_1==NULL){$bulan_1=0;}
    if($bulan_2==NULL){$bulan_2=0;}
    if($bulan_3==NULL){$bulan_3=0;}
    if($bulan_4==NULL){$bulan_4=0;}
    if($bulan_5==NULL){$bulan_5=0;}
?>

<canvas id="myChart" style="width:100%;max-width:600px"></canvas>
<script>
        const xValues = ["<?= $nama_5 ?>", "<?= $nama_4 ?>", "<?= $nama_3 ?>", "<?= $nama_2 ?>", "<?= $nama_1 ?>" , "<?= $nama_now ?>"];
        const yValues = [<?= $bulan_5 ?>, <?= $bulan_4 ?>, <?= $bulan_3 ?>, <?= $bulan_2 ?>, <?= $bulan_1 ?>, <?= $bulan_ini ?>];
        const barColors = ["red", "green","blue","orange","brown","yellow"];

        new Chart("myChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: barColors,
            data: yValues
            }]
        },
        options: {
            legend: {display: false},
            title: {
            display: true,
            text: "Penjualan 5 Bulan Terakhir"
            }
        }
        });
</script>
</div>
</div>