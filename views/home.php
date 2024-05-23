<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-4 mb-4">
        <div class="card shadow h-100" style="border-right: 30px solid #dc3545;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-danger text-uppercase mb-1">
                            Persediaan Kerupuk Mentah</div>

                        <table class="table table-borderless table-sm text-gray-800 font-weight-bold">
                            <tbody>
                                <?php

                                $rowMTH = mysqli_fetch_assoc($resultMTH);

                                $qtyMTH = isset($rowMTH['saldo_qty']) ? $rowMTH['saldo_qty'] : 0;
                                $hargaMTH = isset($rowMTH['saldo_harga']) ? $rowMTH['saldo_harga'] : 0;
                                $totalMTH = isset($rowMTH['saldo_total']) ? $rowMTH['saldo_total'] : 0;

                                ?>
                                <tr>
                                    <th scope="row" class="col-3">Kuantitas</th>
                                    <td>: <?= $qtyMTH; ?> Kg</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-3">Harga</th>
                                    <td>: Rp <?= number_format($hargaMTH, 0, ',', '.'); ?> /Kg</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-3">Saldo</th>
                                    <td>: Rp <?= number_format($totalMTH, 0, ',', '.'); ?></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-4 mb-4">
        <div class="card shadow h-100" style="border-right: 30px solid #4e73e3;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                            Persediaan Kerupuk Matang</div>

                        <table class="table table-borderless table-sm text-gray-800 font-weight-bold">
                            <tbody>
                                <?php

                                $rowMTG = mysqli_fetch_assoc($resultMTG);

                                $qtyMTG = isset($rowMTG['saldo_qty']) ? $rowMTG['saldo_qty'] : 0;
                                $hargaMTG = isset($rowMTG['saldo_harga']) ? $rowMTG['saldo_harga'] : 0;
                                $totalMTG = isset($rowMTG['saldo_total']) ? $rowMTG['saldo_total'] : 0;

                                ?>
                                <tr>
                                    <th scope="row" class="col-3">Kuantitas</th>
                                    <td>: <?= $qtyMTG; ?> Kg</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-3">Harga</th>
                                    <td>: Rp <?= number_format($hargaMTG, 0, ',', '.'); ?> /Kg</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-3">Saldo</th>
                                    <td>: Rp <?= number_format($totalMTG, 0, ',', '.'); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-4 col-md-4 mb-4">
        <div class="card shadow h-100" style="border-right: 30px solid #ffc107;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                            Laba Usaha</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">
                            <?php
                            $labaRugi = isset($_SESSION['laba-rugi']) ? $_SESSION['laba-rugi'] : 0;

                            if ($labaRugi < 0) {
                                echo '(Rp ' . abs(number_format($labaRugi, 0, ',', '.')) . ')';
                            } else {
                                echo 'Rp ' . number_format($labaRugi, 0, ',', '.');
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<!-- Area Chart -->
<div class="card shadow mb-4">
    <!-- Card Body -->
    <div class="card-body text-center overflow-auto pt-0">
        <div class="chart-area" style="overflow: auto; height: 400px;">
            <canvas id="chart-penjualan" style="width: 100%; height: 100%;"></canvas>
        </div>
    </div>
</div>

<script>
    const dataMTH = <?php echo $mth; ?>;
    const dataMTG = <?php echo $mtg; ?>;

    const today = new Date();
    const date = today.getDate();
    const year = today.getFullYear();

    const monthNames = [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember",
    ];

    let rangeDateLabels = [];
    for (let i = 1; i <= date; i++) {
        rangeDateLabels.push(i + " " + monthNames[today.getMonth()]);
    }

    const dataDemo = {
        labels: rangeDateLabels,
        datasets: [{
                label: "Kerupuk Mentah",
                lineTension: 0.3,
                backgroundColor: "rgba(231, 74, 59, 0.2)",
                borderColor: "rgba(231, 74, 59, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(231, 74, 59, 1)",
                pointBorderColor: "rgba(231, 74, 59, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(231, 74, 59, 1)",
                pointHoverBorderColor: "rgba(231, 74, 59, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: dataMTH,
            },
            {
                label: "Kerupuk Matang",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.2)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: dataMTG,
            },
        ],
    };

    // Area Chart Example
    const ctx = document.getElementById("chart-penjualan");
    let myLineChart = new Chart(ctx, {
        type: "line",
        data: dataDemo,
        options: {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: true,
                position: "top",
            },
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 10,
                    bottom: 0,
                },
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: "Tanggal",
                        // fontColor: "#1cc88a",
                        fontSize: 16,
                        fontWeight: "bold",
                    },
                    // time: {
                    // 	unit: "date",
                    // },
                    gridLines: {
                        display: true,
                        drawBorder: true,
                    },
                    // ticks: {
                    // 	maxTicksLimit: 7,
                    // },
                }, ],

                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: "Kuantitas (Kg)",
                        // fontColor: "#1cc88a",
                        fontSize: 16,
                        fontWeight: "bold",
                    },
                    ticks: {
                        // maxTicksLimit: 5,
                        padding: 10,
                        callback: function(value, index, values) {
                            return value + "/kg";
                        },
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2],
                    },
                }, ],
            },
            title: {
                display: true,
                text: "Penjualan Kerupuk " + year,
                fontSize: 20,
                fontColor: "#333",
                position: "top",
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 8,
                titleAlign: "center",
                titleFontColor: "#6e707e",
                titleFontSize: 14,
                borderColor: "#dddfeb",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: "index",
                caretPadding: 10,
                callbacks: {
                    label: (tooltipItem, chart) => {
                        let datasetLabel =
                            chart.datasets[tooltipItem.datasetIndex].label || "";
                        return datasetLabel + " : " + tooltipItem.yLabel + "/Kg";
                    },
                },
            },
        },
    });
</script>
