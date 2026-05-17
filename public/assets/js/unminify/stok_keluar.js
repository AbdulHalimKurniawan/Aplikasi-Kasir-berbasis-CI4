var stok_keluar = $("#stok_keluar").DataTable({
    responsive: true,
    scrollX: true,
    ajax: { url: readUrl, type: 'POST', cache: false },
    columnDefs: [{ searchable: false, orderable: false, targets: 0 }],
    order: [[0, "asc"]],
    columns: [{ data: null }, { data: "tanggal" }, { data: "barcode" }, { data: "nama_produk" }, { data: "jumlah" }, { data: "keterangan" }]
});

stok_keluar.on("order.dt search.dt", function() {
    stok_keluar.column(0, { search: "applied", order: "applied" }).nodes().each(function(el, val) {
        el.innerHTML = val + 1;
    });
}).draw();

function reloadTable() { stok_keluar.ajax.reload(null, false); }

$("#form").validate({
    errorElement: "span",
    errorPlacement: function(err, el) { err.addClass("invalid-feedback"); el.closest(".form-group").append(err); },
    submitHandler: function(form, e) {
        e.preventDefault();
        $.ajax({
            url: addUrl, type: "post", data: $(form).serialize(), dataType: "json",
            success: function() {
                $("#modal").modal("hide");
                reloadTable();
                Swal.fire("Sukses", "Sukses Menambahkan Data", "success");
            }
        });
        return false;
    }
});

$("#tanggal").datetimepicker({ format: "dd-mm-yyyy h:ii:ss" });
$("#barcode").select2({ placeholder: "Barcode", ajax: { url: getBarcodeUrl, type: "post", dataType: "json", data: function(params) { return { barcode: params.term }; }, processResults: function(res) { return { results: res }; } } });

$("#modal").on("hidden.bs.modal", function() {
    $("#form")[0].reset();
    $("#form").validate().resetForm();
    $("#barcode").val(null).trigger("change");
});
$(".modal").on("show.bs.modal", function() { $("#tanggal").val(moment().format("D-MM-Y H:mm:ss")); });
