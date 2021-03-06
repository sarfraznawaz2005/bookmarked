@extends('layouts.app')

@section('content')
    <form action="{{route('bookmarks.update', $bookmark->id)}}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header font-weight-bold">Edit Bookmark</div>
            <div class="card-body">

                <div class="form-group row">
                    <label for="url" class="col-sm-2 col-form-label">URL</label>

                    <div class="col-sm-10">
                        <input required type="url" id="url" name="url" value="{{$bookmark->url}}" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>

                    <div class="col-sm-10">
                        <input required type="text" id="title" name="title" value="{{$bookmark->title}}" class="preview form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="folder_id" class="col-sm-2 col-form-label">Folder</label>

                    <div class="col-sm-10">
                        <select required name="folder_id" id="folder_id" class="select2 tags form-control">
                            <option value="">SELECT</option>

                            @foreach($folders as $folder)
                                <option {{$bookmark->folder_id === $folder->id ? 'selected' : ''}} value="{{$folder->id}}">{{$folder->name}}</option>
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
                                      class="form-control">{{$bookmark->description}}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-2"></div>

                    <div class="col-sm-10">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="read" name="read" {{$bookmark->read === 1 ? 'checked' : ''}}>
                            <label class="form-check-label" for="read">Mark Read</label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <a href="{{route('home', '/')}}" class="btn btn-primary pull-left">Back</a>
                <button type="submit" class="btn btn-success pull-right">Save</button>
            </div>
        </div>
    </form>

    @push('js')
        <script>
            $('#url').blur(function () {
                var url = $(this).val();

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
            });
        </script>
    @endpush

@endsection

