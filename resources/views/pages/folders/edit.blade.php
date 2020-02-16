@extends('layouts.app')

@section('content')
    <form action="{{route('folders.update', $folder->id)}}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header font-weight-bold">Edit Folder</div>
            <div class="card-body">

                <div class="form-group row">
                    <label for="name" class="col-sm-1 col-form-label">Name</label>
                    <div class="col-sm-11">
                        <input required type="text" id="name" value="{{$folder->name}}" name="name"
                               class="form-control">
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success pull-right">Save</button>
            </div>
        </div>
    </form>
@endsection

