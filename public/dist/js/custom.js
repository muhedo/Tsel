//Custom jS DataTable
$(function () {
  $("#example1").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,

  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
  });
});

//Custom jS DataTable
$(function () {
  $("#dashboard").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
    "buttons": ["excel", "print", "colvis"]
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  $('#example2').DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
  });
});

// Alert Toastr
function showMessage(e_title = "Judul", e_text = "BErhasil", e_icon = "success", e_button = "OK") {
  swal({
    title: e_title,
    text: e_text,
    icon: e_icon,
    button: e_button,
  });
}

// Edit Cluster
function edit_cluster(id_cluster, nama, kat) {
  $(".modal-title").html("Edit Data Cluster")
  $("#nm_cluster").val(nama);
  $("#kat_cluster").val(kat);
  $("#id_cluster").val(id_cluster);

}

// Clear Cluster
function clear_cluster() {
  $(".modal-title").html("Tambah Data Cluster")
  $("#nm_cluster").val("");
  $("#kat_cluster").val("");
  $("#id_cluster").val("");
}

// Edit Kota
function edit_kota(id_cluster, id_kota, nm_kota) {
  $("#id_kota").val(id_kota);
  $("#nm_kota").val(nm_kota);
  $("#id_cluster").val(id_cluster);
  //$("#id_cluster > option[value=" + id_cluster + "]").prop("selected", true);
}

// Clear Kota 
function clear_kota(id_cluster, id_kota, nm_kota) {
  $("#id_cluster").val(id_cluster);
  $("#nm_kota").val(nm_kota);
  $("#id_kota").val(id_kota);
}

// Edit Kecamatan
function edit_kecamatan(id_kota, id_kecamatan, nama) {
  $(".modal-title").html("Edit Data")
  $("#nm_kecamatan").val(nama);
  $("#id_kecamatan").val(id_kecamatan);
  $("#id_kota").val(id_kota);
}

// Clear Kecamatan
function clear_kecamatan(id_kota, id_kecamatan, nama) {
  $("#id_kota").val(id_kota);
  $("#nm_kecamatan").val(nama);
  $("#id_kecamatan").val(id_kecamatan);
}

// Edit Product
function edit_product(id_product, nama) {
  $("#nm_product").val(nama);
  $("#id_product").val(id_product);
}

// Clear Product
function clear_product(id_product, nama) {
  $("#nm_product").val(nama);
  $("#id_product").val(id_product);
}

//Edit Dls
function edit_dls(id_dls, bulan) {
  $("#bulan").val(bulan);
  $("#id_dls").val(id_dls);
}

//Clear Dls
function clear_dls(id_dls, bulan) {
  $("#bulan").val(bulan);
  $("#id_dls").val(id_dls);
}

//Edit Revenue
function edit_target(id_revenue, id_product, jml_target, jml_rev, YoY1, YtD1, YtD) {
  $("#id_revenue").val(id_revenue);
  $("#jml_target").val(jml_target);
  $("#jml_revenue").val(jml_rev);
  $("#YoY1").val(YoY1);
  $("#YtD1").val(YtD1);
  $("#YtD").val(YtD);
  $("#list_product").hide();
  $("#form_rev").append('<input id="e_id_product" type="hidden" name="id_product" value="' + id_product + '">');
}

//Clear Revenue
function clear_target() {
  $("#id_revenue").val("");
  $("#jml_target").val("");
  $("#jml_revenue").val("");
  $("#list_product").show();
  $("#e_id_product").remove();
}

// Edit User
function edit_user(id, nama, email, password) {
  $("#id").val(id);
  $("#name").val(nama);
  $("#email").val(email);
  $("#old_password").val(password);
}

// Clear User
function clear_user(id, nama, email, password) {
  $("#id").val(id);
  $("#name").val(nama);
  $("#email").val(email);
  $("#password").val(password);
}

// Format Number .
function number_format(x) {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function confirmDelete(e) {
  const url = $(e).attr('href');
  swal({
    title: "Apakah Anda Yakin Ingin Menghapus ?",
    text: "Data Akan Dihapus !!!",
    icon: "warning",
    buttons: ["Kembali", "Oke"],
  }).then(function (value) {
    if (value) {
      window.location = url;
    }
  });
  return false;
}


function showPreload() {
  $(".preload").css("display", "flex");
  $("#loader").css("display", "block");
  $("#logo").css("display", "block");
}