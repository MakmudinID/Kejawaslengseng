$(document).ready(function () {
    // Add Row
    $('#add-row').DataTable({
        "pageLength": 10,
    });
    $('#order').dataTable2({
        "pageLength": 10,
        "columnDefs": [
            { "width": "30%", "targets": 4 }
        ]
    });
});