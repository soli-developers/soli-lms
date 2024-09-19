@extends('layouts.app')
@section('title', __('pkg_competences/competence.singular'))

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
                            $translatedName = TranslationHelper::getTitle(__('pkg_competences/competence.plural'), $lang);
                            echo $translatedName;

                        @endphp
                    </h1>
                </div>

                <div class="col-sm-6">
                    <div class="float-sm-right">
                        @can('create-CompetenceController')
                            <a href="{{ route('competence.create') }}" class="btn btn-info">
                                <i class="fas fa-plus"></i>
                                {{ __('app.add') }} {{ __('pkg_competences/competence.singular') }}
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
                    <div class="card">
                        <div class="card-header col-md-12">
                            <div class="card-header text-center">
                                <form action="{{ route('competence.index') }}" method="GET" class="form-inline justify-content-center">
                                    <div class="form-group mb-2 me-2" style=" margin-left: 50px;">
                                        <label for="ModuleFilter" class="me-2">{{ __('pkg_competences/Module.plural') }}:</label>
                                        <select name="module" class="form-control" id="ModuleFilter">
                                            <option value="">{{ __('Modules') }}</option>
                                            @foreach ($allModules as $Module)
                                                <option value="{{ $Module->id }}" {{ request('module') == $Module->id ? 'selected' : '' }}>
                                                    {{ $Module->nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-group mb-2 me-2">
                                        <input type="text" name="table_search" id="table_search" class="form-control" placeholder="{{ __('app.rechercher') }}">
                                        <button type="submit" class="btn btn-default" id="search-button">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @include('pkg_competences.competence.table')
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id='page' value="1">
    </section>
@endsection
