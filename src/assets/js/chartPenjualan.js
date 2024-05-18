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
	datasets: [
		{
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
			data: [
				200, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000,
				25000, 40000,
			],
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
			data: [
				10000, 20000, 1000, 500, 45000, 20000, 60000, 35000, 25500, 2800, 4000,
				60000,
			],
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
			xAxes: [
				{
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
				},
			],

			yAxes: [
				{
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
						callback: function (value, index, values) {
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
				},
			],
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
