@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold tabbed">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#list">
                                    <i class="fa fa-list"></i> Manage
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
                                List
                            </div>
                            <div class="tab-pane" id="create">
                                Create
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection