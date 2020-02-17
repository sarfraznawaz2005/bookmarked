@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header font-weight-bold tabbed">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#list">
                        <i class="fa fa-list"></i> Bookmarks
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
                <div class="tab-pane active" id="list">
                    <table class="table-responsive-sm table table-bordered mx-auto w-100">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Folder</th>
                            <th>Description</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div class="tab-pane" id="create">
                    <form action="{{route('bookmarks.store')}}" method="post">
                        @csrf

                        <div class="form-group row">
                            <label for="url" class="col-sm-2 col-form-label">URL</label>

                            <div class="col-sm-10">
                                <input required type="url" id="url" name="url" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>

                            <div class="col-sm-10">
                                <input required type="text" id="title" name="title" class="preview form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="folder_id" class="col-sm-2 col-form-label">Folder</label>

                            <div class="col-sm-10">
                                <select required name="folder_id" id="folder_id" class="select2 tags form-control">
                                    <option value="">SELECT</option>

                                    @foreach($folders as $folder)
                                        <option value="{{$folder->id}}">{{$folder->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>

                            <div class="col-sm-10">
                            <textarea id="description"
                                      name="description"
                                      cols="30"
                                      rows="3"
                                      class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-2"></div>

                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="read" name="read">
                                    <label class="form-check-label" for="read">Mark Read</label>
                                </div>
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
            table('.table', '{{ route('bookmarks.table') }}', 25, [
                {data: 'Title'},
                {data: 'Folder'},
                {data: 'Description'},
                {data: 'Created'},
                {data: 'Action'}
            ], {
                "columnDefs": [
                    {"width": "15%", "bSortable": false, "targets": -1},
                    {"width": "20%", "targets": -2}
                ],
                "order": [3, 'asc'],
                "rowCallback": function (row, data) {
                    var $read = $('<div/>').html(data.Read);

                    if ($read.text() === '1') {
                        $(row).addClass('read');
                    }
                }
            });

            $('#url').blur(function () {
                getTitle($(this).val());
            });

            function getTitle(url) {
                if (!url.length) {
                    return false;
                }

                $('.preview').contentPreview();

                // get page title
                $.get('{{route('bookmarks.get.title')}}', {"url": url}, function (title) {
                    $('.preview').contentPreview.remove();

                    if (title) {
                        $('#title').val(title);
                    }
                });
            }

            // via bookmarklet
            @if(trim(\request()->query('url')))
                $('[href="#create"]').tab('show');
                $('#url').val('{{urldecode(\request()->query('url'))}}');
                $('#url').blur();
            @endif

        </script>

    @endpush

@endsection

