@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header font-weight-bold">{{$folder->name}}</div>
        <div class="card-body">
            <table class="table-responsive-sm table table-bordered mx-auto w-100">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    @push('js')
        <script>
            table('.table', '{{ route('folders.bookmarks.table') }}', 25, [
                {data: 'Title'},
                {data: 'Description'},
                {data: 'Created'},
                {data: 'Action'}
            ], {
                "columnDefs": [
                    {"width": "15%", "bSortable": false, "targets": -1},
                    {"width": "20%", "targets": -2}
                ],
                "order": [2, 'desc'],
                "rowCallback": function (row, data) {
                    var $read = $('<div/>').html(data.Read);

                    if ($read.text() === '1') {
                        $(row).addClass('read');
                    }
                }
            });
        </script>
    @endpush

@endsection

