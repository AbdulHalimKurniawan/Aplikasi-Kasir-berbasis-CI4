var laporan_stok_masuk = $("#laporan_stok_masuk").DataTable({
    responsive: true,
    scrollX: true,
    ajax: { url: laporanUrl, type: 'POST', cache: false },
    columnDefs: [{ searchable: false, orderable: false, targets: 0 }],
    order: [[0, "asc"]],
    columns: [{ data: null }, { data: "tanggal" }, { data: "barcode" }, { data: "nama_produk" }, { data: "jumlah" }, { data: "keterangan" }, { data: "supplier" }]
});

laporan_stok_masuk.on("order.dt search.dt", function() {
    laporan_stok_masuk.column(0, { search: "applied", order: "applied" }).nodes().each(function(el, val) {
        el.innerHTML = val + 1;
    });
}).draw();
