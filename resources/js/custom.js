/* custom js */

$('.select2, select').select2();
$('.tags').select2({"tags": true});

/* creates DataTables */
function table(tableSelector, url, length, columns, extraOptions, data) {

    length = length || 10;
    extraOptions = extraOptions || {};
    data = data || {};

    var options = {
        "serverSide": true,
        "processing": true,
        "responsive": true,
        "autoWidth": true,
        "ordering": true,
        "lengthChange": false,
        "pageLength": length,
        "ajax": {
            "url": url,
            "dataType": "json",
            "type": "GET",
            "data": data
        },
        "columns": columns
    };

    // merge
    options = $.extend({}, options, extraOptions);

    return $(tableSelector).DataTable(options);
}

// confirm delete
$('body').on('click', '.confirm-delete', function (e) {
    var label = $(this).data('label');
    var $form = $(this).closest('form');

    swal.fire({
        title: 'Are you sure?',
        text: label + " will be deleted!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it',
        cancelButtonText: 'No, cancel',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: true,
        reverseButtons: true,
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return new Promise(function (resolve) {
                setTimeout(function () {
                    resolve()
                }, 2000)
            })
        }
    }).then(function (result) {
        if (result.value) {
            document.querySelector('.btn.swal2-confirm').disabled = true;
            $form.submit();
        }
    });

    return false;
});