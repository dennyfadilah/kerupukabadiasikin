$(document).ready(function () {
	let id = [
		"akun",
		"kerupuk-mentah",
		"kerupuk-matang",
		"penjualan",
		"biaya-operasional",
		"data-pekerja",
		"users",
		"laporan-penjualan",
		"laporan-persediaan-mth",
		"laporan-persediaan-mtg",
	];

	id.forEach(function (element) {
		if ($("#" + element).is("table")) {
			if (element == "biaya-operasional") {
				let groupColumn = 2;

				$("#biaya-operasional").DataTable({
					columnDefs: [{ visible: false, targets: groupColumn }],
					order: [[groupColumn, "asc"]],
					displayLength: 25,
					drawCallback: function (settings) {
						let api = this.api();
						let rows = api.rows({ page: "current" }).nodes();
						let last = null;

						api
							.column(groupColumn, { page: "current" })
							.data()
							.each(function (group, i) {
								if (last !== group) {
									$(rows)
										.eq(i)
										.before(
											'<tr class="group"><td colspan="5">' +
												group +
												"</td></tr>"
										);

									last = group;
								}
							});
					},
				});
			} else {
				$("#" + element).DataTable({
					responsive: true,
					scrollX: true,
				});
			}
		}
	});
});
