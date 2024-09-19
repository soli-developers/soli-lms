@extends('layouts.app')
@section('title', __('app.show') . ' ' . __('pkg_competences/CategorieTechnologie.singular'))
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('app.detail') }}</h1>
                </div>
                @if($fetchedData)
                    @can('edit-CategorieTechnologieController')
                        <div class="col-sm-6">
                            <a href="{{ route('CategorieTechnologie.edit', $fetchedData->id) }}" class="btn btn-default float-right">
                                <i class="far fa-edit"></i>
                                {{ __('app.edit') }}
                            </a>
                        </div>
                    @endcan
                @endif
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @if($fetchedData)
                                <div class="col-sm-12">
                                    <label for="nom">{{ __('app.name') }}:</label>
                                    <p>{{ $fetchedData->nom }}</p>
                                </div>
                                <!-- Description Field -->
                                <div class="col-sm-12">
                                    <label for="description">{{ __('app.description') }}:</label>
                                    @if ($fetchedData->description)
                                        <p>
                                            {!! $fetchedData->description !!}
                                        </p>
                                    @else
                                        <p class="text-secondary">Aucune information disponible</p>
                                    @endif
                                </div>
                            @else
                                <p class="text-secondary">{{ __('messages.not_found') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
