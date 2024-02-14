$(document).ready(function () {
  var title_excel = $(".title_excel").text();
  var archive_name = $(".archive_name").text();
  $(".dt-buttons").append(
    '<a href="#" class="btn btn-danger" id="export_excel"><span><i class="fas fa-file-pdf"></i></span></a>'
  );
});
