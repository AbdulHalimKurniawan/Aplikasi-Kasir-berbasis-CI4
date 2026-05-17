var url;
var pelanggan = $("#pelanggan").DataTable({
    responsive: true,
    scrollX: true,
    ajax: { url: readUrl, type: 'POST', cache: false },
    columnDefs: [{ searchable: false, orderable: false, targets: 0 }],
    order: [[0, "asc"]],
    columns: [
        { data: null },
        { data: "nama" },
        { data: "jenis_kelamin" },
        { data: "alamat" },
        { data: "telepon" },
        { data: "action" }
    ]
});

pelanggan.on("order.dt search.dt", function() {
    pelanggan.column(0, { search: "applied", order: "applied" }).nodes().each(function(el, val) {
        el.innerHTML = val + 1;
    });
}).draw();

function reloadTable() {
    pelanggan.ajax.reload(null, false);
}

function add() {
    url = "add";
    $("#form")[0].reset();
    $(".modal-title").html("Add Data");
    $('.modal button[type="submit"]').html("Add");
}

function edit(id) {
    $.ajax({
        url: get_pelangganUrl,
        type: "post",
        data: { id: id },
        dataType: "json",
        success: function(res) {
            $('[name="id"]').val(res.id);
            $('[name="nama"]').val(res.nama);
            $('[name="jenis_kelamin"]').val(res.jenis_kelamin);
            $('[name="alamat"]').val(res.alamat);
            $('[name="telepon"]').val(res.telepon);
            $("#modal").modal("show");
            $(".modal-title").html("Edit Data");
            $('.modal button[type="submit"]').html("Edit");
            url = "edit";
        }
    });
}

function hapus(id) {
    Swal.fire({
        title: "Hapus",
        text: "Hapus data ini?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Hapus"
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: deleteUrl,
                type: "post",
                data: { id: id },
                dataType: "json",
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
    errorPlacement: function(err, el) {
        err.addClass("invalid-feedback");
        el.closest(".form-group").append(err);
    },
    submitHandler: function(form, e) {
        e.preventDefault();
        var ajaxUrl = url === "edit" ? editUrl : addUrl;
        $.ajax({
            url: ajaxUrl,
            type: "post",
            data: $(form).serialize(),
            dataType: "json",
            success: function() {
                $("#modal").modal("hide");
                reloadTable();
                Swal.fire("Sukses", url === "edit" ? "Sukses Mengedit Data" : "Sukses Menambahkan Data", "success");
            }
        });
        return false;
    }
});

$("#modal").on("hidden.bs.modal", function() {
    $("#form")[0].reset();
    $("#form").validate().resetForm();
});
