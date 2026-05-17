var url;
var produk = $("#produk").DataTable({
    responsive: true,
    scrollX: true,
    ajax: { url: readUrl, type: 'POST', cache: false },
    columnDefs: [{ searchable: false, orderable: false, targets: 0 }],
    order: [[0, "asc"]],
    columns: [{ data: null }, { data: "barcode" }, { data: "nama" }, { data: "satuan" }, { data: "kategori" }, { data: "harga" }, { data: "stok" }, { data: "action" }]
});

produk.on("order.dt search.dt", function() {
    produk.column(0, { search: "applied", order: "applied" }).nodes().each(function(el, val) {
        el.innerHTML = val + 1;
    });
}).draw();

function reloadTable() { produk.ajax.reload(null, false); }

function add() {
    url = "add";
    $("#form")[0].reset();
    $("#satuan").val(null).trigger("change");
    $("#kategori").val(null).trigger("change");
    $(".modal-title").html("Add Data");
    $('.modal button[type="submit"]').html("Add");
}

function edit(id) {
    $.ajax({
        url: getProdukUrl, type: "post", data: { id: id }, dataType: "json",
        success: function(res) {
            $('[name="id"]').val(res.id);
            $('[name="barcode"]').val(res.barcode);
            $('[name="nama_produk"]').val(res.nama_produk);
            $("#satuan").empty().append("<option value='" + res.satuan_id + "'>" + res.satuan + "</option>").trigger("change");
            $("#kategori").empty().append("<option value='" + res.kategori_id + "'>" + res.kategori + "</option>").trigger("change");
            $('[name="harga"]').val(res.harga);
            $('[name="stok"]').val(res.stok);
            $("#modal").modal("show");
            $(".modal-title").html("Edit Data");
            $('.modal button[type="submit"]').html("Edit");
            url = "edit";
        }
    });
}

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

$("#form").validate({
    errorElement: "span",
    errorPlacement: function(err, el) { err.addClass("invalid-feedback"); el.closest(".form-group").append(err); },
    submitHandler: function(form, e) {
        e.preventDefault();
        var ajaxUrl = url === "edit" ? editUrl : addUrl;
        $.ajax({
            url: ajaxUrl, type: "post", data: $(form).serialize(), dataType: "json",
            success: function() {
                $("#modal").modal("hide");
                reloadTable();
                Swal.fire("Sukses", url === "edit" ? "Sukses Mengedit Data" : "Sukses Menambahkan Data", "success");
            }
        });
        return false;
    }
});

$("#kategori").select2({ placeholder: "Kategori", ajax: { url: kategoriSearchUrl, type: "post", dataType: "json", data: function(params) { return { kategori: params.term }; }, processResults: function(data) { return { results: data }; }, cache: true } });
$("#satuan").select2({ placeholder: "Satuan", ajax: { url: satuanSearchUrl, type: "post", dataType: "json", data: function(params) { return { satuan: params.term }; }, processResults: function(data) { return { results: data }; }, cache: true } });

$("#modal").on("hidden.bs.modal", function() {
    $("#form")[0].reset();
    $("#form").validate().resetForm();
    $("#satuan").val(null).trigger("change");
    $("#kategori").val(null).trigger("change");
});
