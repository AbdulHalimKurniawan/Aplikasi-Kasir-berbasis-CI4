var stok_masuk = $("#stok_masuk").DataTable({
    responsive: true,
    scrollX: true,
    ajax: { url: readUrl, type: 'POST', cache: false },
    columnDefs: [{ searchable: false, orderable: false, targets: 0 }],
    order: [[0, "asc"]],
    columns: [{ data: null }, { data: "tanggal" }, { data: "barcode" }, { data: "nama_produk" }, { data: "jumlah" }, { data: "keterangan" }]
});

stok_masuk.on("order.dt search.dt", function() {
    stok_masuk.column(0, { search: "applied", order: "applied" }).nodes().each(function(el, val) {
        el.innerHTML = val + 1;
    });
}).draw();

function reloadTable() { stok_masuk.ajax.reload(null, false); }

function checkKeterangan(obj) {
    if (obj.value == "lain") { $(".supplier").hide(); $("#supplier").attr("disabled", "disabled"); $(".lain").removeClass("d-none"); }
    else { $(".lain").addClass("d-none"); $("#supplier").removeAttr("disabled"); $(".supplier").show(); }
}

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
$("#barcode").select2({ placeholder: "Barcode", ajax: { url: getBarcodeUrl, type: "post", dataType: "json", data: function(params) { return { barcode: params.term }; }, processResults: function(res) { return { results: res }; }, cache: true } });
$("#supplier").select2({ placeholder: "Supplier", ajax: { url: supplierSearchUrl, type: "post", dataType: "json", data: function(params) { return { supplier: params.term }; }, processResults: function(res) { return { results: res }; }, cache: true } });

$("#modal").on("hidden.bs.modal", function() {
    $("#form")[0].reset();
    $("#form").validate().resetForm();
    $("#barcode").val(null).trigger("change");
    $("#supplier").val(null).trigger("change");
});
$(".modal").on("show.bs.modal", function() { $("#tanggal").val(moment().format("D-MM-Y H:mm:ss")); });
