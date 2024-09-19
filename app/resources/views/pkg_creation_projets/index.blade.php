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
                    <h1>
                        @php
                        // Generate the title using the title function
                        use App\helpers\TranslationHelper;
                        $lang = Config::get('app.locale');
                        $translatedName = TranslationHelper::getTitle(__('pkg_creation_projets/projet.plural'), $lang);
                        echo $translatedName;

                    @endphp                    </h1>

                </div>

                <div class="col-sm-6">
                    <div class="float-sm-right">
                        @can('create-ProjetController')
                            <a href="{{ route('projets.create') }}" class="btn btn-info">
                                <i class="fas fa-plus"></i>
                                {{ __('app.add') }} {{ __('GestionProjets/projet.singular') }}
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Boîte par défaut -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-4 form-group mb-2">
                                        <label for="competenceFilter">{{ __('pkg_competences/competence.plural') }}:</label>
                                        <select class="form-control"id="competenceFilter">
                                            <option value="">Toutes</option>
                                            @foreach($competences as $competence)
                                                <option value="{{ $competence->id }}">{{ $competence->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group mb-2">
                                        <label for="table_search">{{ __('app.rechercher') }}</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="table_search" id="table_search" class="form-control" placeholder="Recherche">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-outline-secondary">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
@include('pkg_creation_projets.table')
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <input type="hidden" id='page' value="1">
    </section>
@endsection

