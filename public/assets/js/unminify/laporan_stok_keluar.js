var laporan_stok_keluar = $("#laporan_stok_keluar").DataTable({
    responsive: true,
    scrollX: true,
    ajax: { url: readUrl, type: 'POST', cache: false },
    columnDefs: [{ searchable: false, orderable: false, targets: 0 }],
    order: [[0, "asc"]],
    columns: [{ data: null }, { data: "tanggal" }, { data: "barcode" }, { data: "nama_produk" }, { data: "jumlah" }, { data: "keterangan" }]
});

laporan_stok_keluar.on("order.dt search.dt", function() {
    laporan_stok_keluar.column(0, { search: "applied", order: "applied" }).nodes().each(function(el, val) {
        el.innerHTML = val + 1;
    });
}).draw();
