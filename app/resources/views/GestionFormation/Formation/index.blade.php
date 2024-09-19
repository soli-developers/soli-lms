@extends('layouts.app')

@section('content')
<div class="content-header">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('success') }}.
        </div>
    @endif
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ __('app.Gestion_des_formations') }}</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end align-items-center">
                <a href="{{ route('formations.create') }}" class="btn btn-info">
                    <i class="fas fa-plus"></i> {{ __('app.add') }} {{ __('pkg_formations/Formations.singular') }}
                </a>  
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header col-md-12">
                        <form method="GET" action="{{ route('formations.index') }}" class="p-0">
                            <div class="input-group input-group-sm float-sm-right col-md-3 p-0">
                                <input type="text" name="search" id="table_search" class="form-control float-right" placeholder="Recherche" value="{{ request()->query('search') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @include('GestionFormation.Formation.table')
                </div>
                <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center p-2">
                            <div class="d-md-flex justify-content-between align-items-center p-2">
                                <div class="d-flex align-items-center mb-2 ml-2 mt-2">
                            
                                    {{-- @can('import-ProjetController') --}}
                                        <!-- TODO : Import et export ne doit pas s'afficher dans la version mobile -->
                                        <form action="{{ route('formations.import') }}" method="post" class="mt-2" enctype="multipart/form-data"
                                            id="importForm">
                                            @csrf
                                            <label for="upload" class="btn btn-default btn-sm font-weight-normal">
                                                <i class="fas fa-file-download"></i>
                                                {{ __('app.import') }}
                                            </label>
                                            <input type="file" id="upload" name="file" style="display:none;" onchange="submitForm()" />
                                        </form>
                                    {{-- @endcan --}}
                                    {{-- @can('export-ProjetController') --}}
                                        <form class="">
                                            <a href="{{ route('formations.export') }}" class="btn btn-default btn-sm mt-0 mx-2">
                                                <i class="fas fa-file-export"></i>
                                                {{ __('app.export') }}</a>
                                        </form>
                                    {{-- @endcan --}}
                                </div>
                            </div>  
                                        <div class="mr-5">
                                            <ul class="pagination  m-0 float-right">
                                                {{$formationData->links()}}
                                                     </ul>
                                                    </div>
                                                 </div>                                                                </div>
                                            <!-- /.card-footer-->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
