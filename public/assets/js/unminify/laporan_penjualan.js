var laporan_penjualan = $("#laporan_penjualan").DataTable({
    responsive: true,
    scrollX: true,
    ajax: { url: readUrl, type: 'POST', cache: false },
    columnDefs: [{ searchable: false, orderable: false, targets: 0 }],
    order: [[0, "asc"]],
    columns: [{ data: null }, { data: "tanggal" }, { data: "nama_produk" }, { data: "total_bayar" }, { data: "jumlah_uang" }, { data: "diskon" }, { data: "pelanggan" }, { data: "action" }]
});

laporan_penjualan.on("order.dt search.dt", function() {
    laporan_penjualan.column(0, { search: "applied", order: "applied" }).nodes().each(function(el, val) {
        el.innerHTML = val + 1;
    });
}).draw();

function reloadTable() { laporan_penjualan.ajax.reload(null, false); }

function hapus(id) {
    Swal.fire({
        title: "Hapus", text: "Hapus data ini?", type: "warning",
        showCancelButton: true, confirmButtonText: "Ya, Hapus"
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: deleteUrl, type: "post", data: { id: id }, dataType: "json",
                success: function() {
                    reloadTable();
                    Swal.fire("Sukses", "Sukses Menghapus Data", "success");
                }
            });
        }
    });
}
