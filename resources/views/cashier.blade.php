@extends('layouts.main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Kasir</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Kasir</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Card title</h5>

            <p class="card-text">
                Some quick example text to build on the card title and make up the bulk of the card's
                content.
            </p>

            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
@endsection

@push('scripts')

@endpush