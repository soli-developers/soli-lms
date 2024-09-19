@extends('layouts.app')

@section('content')
<section class="content">
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form action="{{ route('validations.store') }}" method="POST">
        @csrf
        <input type="hidden" name="realisation_projet_id" value="{{ $realisation->id }}">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header bg-info">
                            <h3 class="card-title"> {{ __('pkg_validations/validation.plural') }} : {{ $realisation->Projet->titre }}</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nom">{{ __('app.name') }} </label> {{ $realisation->Personne->nom }}
                                </div>
                                <div class="form-group">
                                    <label for="prenom">{{ __('pkg_validations/validation.LastName') }}:</label> {{ $realisation->Personne->prenom }}
                                </div>
                                <div class="form-group">
                                    <label for="livrables">Les {{ __('pkg_creation_projets/Livrable.plural') }}:</label>
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

                                <table class="table table-bordered">
                                    <h1 style="caption-side: top; text-align: center; font-size: 1.5em; margin: 10px 0;">{{ __('pkg_validations/validation.Form') }}   {{ __('pkg_validations/validation.plural') }} {{ __('pkg_competences/competence.plural')}}
                                    </h1>
                                        <tr>
                                            <th>{{ __('pkg_competences/competence.plural') }}</th>
                                            <th>{{ __('pkg_competences/appreciation.plural') }}</th>
                                            <th>{{ __('pkg_validations/validation.Note') }}</th>
                                            <th>{{ __('app.title') }}</th>
                                            <th>{{ __('app.description') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($competences as $competence)
                                            <tr>
                                                <td>{{ $competence->competence->nom }}</td>
                                                <td>
                                                    <select name="validations[{{ $competence->id }}][appreciation_id]" class="form-control">
                                                        @foreach ($appreciations as $appreciation)
                                                            <option value="{{ $appreciation->id }}" {{ $competence->appreciation_id == $appreciation->id ? 'selected' : '' }}>{{ $appreciation->nom }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error("validations.{$competence->id}.appreciation_id")
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="number" name="validations[{{ $competence->id }}][note]" class="form-control" value="{{ isset($notesByCompetence[$competence->id]) ? $notesByCompetence[$competence->id] : old('note') }}">
                                                    @error("validations.{$competence->id}.note")
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" name="validations[{{ $competence->id }}][titre]" class="form-control" value="{{ isset($messagesByCompetence[$competence->id]) ? $messagesByCompetence[$competence->id][0]->titre : old('titre') }}" placeholder="Titre">
                                                    @error("validations.{$competence->id}.titre")
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <textarea name="validations[{{ $competence->id }}][description]" class="form-control" placeholder="Description">{{ isset($messagesByCompetence[$competence->id]) ? $messagesByCompetence[$competence->id][0]->description : old('description') }}</textarea>
                                                    @error("validations.{$competence->id}.description")
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>




                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-right m-5">
                                    <button type="submit" class="btn btn-info">{{ __('pkg_validations/validation.Validate') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection

