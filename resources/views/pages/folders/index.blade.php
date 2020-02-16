@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header font-weight-bold tabbed">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#list">
                        <i class="fa fa-list"></i> Folders
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#create">
                        <i class="fa fa-plus-square"></i> Create
                    </a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active preview" id="list">
                    <table class="table-responsive-sm table table-hover mx-auto w-100">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Bookmarks</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div class="tab-pane" id="create">
                    <form action="{{route('folders.store')}}" method="post">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-sm-1 col-form-label">Name</label>

                            <div class="col-sm-11">
                                <input required type="text" id="name" name="name" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success pull-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            table('.table', '{{ route('folders.table') }}', 25, [
                {data: 'Name'},
                {data: 'Bookmarks'},
                {data: 'Created'},
                {data: 'Action'}
            ], {
                "columnDefs": [
                    {"width": "10%", "bSortable": false, "targets": -1}
                ],
                "order": [0, 'asc'],
            });
        </script>
    @endpush

@endsection

