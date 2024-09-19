@extends('layouts.app')

@section('title', __('app.show') . ' ' . __('pkg_creation_projets/Livrable.plural'))

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('app.detail') }}  {{ __('pkg_validations/validation.singular') }}:{{ $realisation->Projet->titre }}</h1>
                </div>
                {{-- @can('edit-LivrableController') --}}
                    <div class="col-sm-6">
                        <a href="{{ route('realisationProjets.index')}}" class="btn btn-default float-right">
                            <i class="far fa-edit"></i>
                            {{ __('app.cancel') }}
                        </a>
                    </div>
                {{-- @endcan --}}
            </div>
        </div>
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Realisation Project Title -->
                            
                         
                            <!-- Realisation Project Description -->
                            

                            <!-- Realisation Project Link -->
                       

                            <!-- Project Title -->
                            <div class="col-sm-12">
                                <label for="titre">{{ __('app.title') }}:</label>
                                <p>{{ $realisation->projet->titre }}</p>
                            </div>

                            <!-- Project Description -->
                            <div class="col-sm-12">
                                <label for="description">{{ __('app.description') }}:</label>
                                @if ($realisation->projet->description)
                                    <p>
                                        {!! $realisation->projet->description !!}
                                    </p>
                                @else
                                    <p class="text-secondary">{{ __('app.no_information_available') }}</p>
                                @endif
                            </div>
                            
                            <!-- Realisation Project Person -->
                            <div class="col-sm-12">
                                <label for="nom">{{ __('app.name') }} </label> {{ $realisation->Personne->nom }}
                            </div>
                            <div class="col-sm-12">
                                <label for="prenom">{{ __('pkg_validations/validation.LastName') }}:</label> {{ $realisation->Personne->prenom }}
                            </div>
                         
                            <!-- Livrables List -->
                            <div class="col-sm-12">
                                <label for="livrables">{{ __('pkg_creation_projets/Livrable.plural') }}:</label>
                                <ul class="list-group list-group-horizontal d-flex flex-row">
                                    @foreach ($realisation->livrableRealisations as $livrableRealisation)
                                        <li class="list-group-item mr-2">
                                            <strong>{{ $livrableRealisation->nom }}</strong>
                                            <a href="{{ $livrableRealisation->lien }}">
                                                @if (str_contains($livrableRealisation->lien, 'docs.google.com') ||
                                                    str_contains($livrableRealisation->lien, 'sheets.google.com') ||
                                                    str_contains($livrableRealisation->lien, 'slides.google.com'))
                                                    <i class="fas fa-google-drive"></i> Google Drive
                                                @elseif (str_contains($livrableRealisation->lien, 'figma.com'))
                                                    <i class="fab fa-figma"></i> Figma
                                                @else
                                                    <i class="fas fa-link"></i> Link
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Validation Information -->
                          <div class="col-sm-12 mt-4">
  
    <div class="row">
        @foreach ($competences as $competence)
            <div class="col-md-12 mb-3">
                <div class="card p-3">
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>{{ __('pkg_competences/competence.singular') }}</strong> {{ $competence->competence->nom }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>{{ __('pkg_competences/appreciation.plural') }}</strong> {{ $competence->appreciation->nom }}</p>
                        </div>
                        <div class="col-md-2">
                            <p><strong> <th>{{ __('pkg_validations/validation.Note') }}</th></strong> {{ isset($notesByCompetence[$competence->id]) ? $notesByCompetence[$competence->id] : '-' }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>{{ __('app.title') }}:</strong> {{ isset($messagesByCompetence[$competence->id]) ? $messagesByCompetence[$competence->id][0]->titre : '-' }}</p>
                            <p><strong>{{ __('app.description') }}:</strong> {{ isset($messagesByCompetence[$competence->id]) ? $messagesByCompetence[$competence->id][0]->description : '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection