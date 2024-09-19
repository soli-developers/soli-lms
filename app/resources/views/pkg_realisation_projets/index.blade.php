@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('success') }}.
            </div>
        @endif
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                      Les réalisations
                        {{-- @php
                            // Generate the title using the title function
                            use App\helpers\TranslationHelper;
                            $lang = Config::get('app.locale');
                            $translatedName = TranslationHelper::getTitle(__('GestionProjets/projet.singular'), $lang);
                            echo $translatedName;

                        @endphp --}}
                    </h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="col-12">
            <!-- Default box -->
            <div class="card">
                <div class="card-header col-md-12">
                    <h3 class="card-title">Tableau des {{ __('pkg_realisation_projets/Realisation.plural') }}</h3>
                </div>
                <div class="card-body">
                    <div class="p-0 mb-3">
<div id="filterForm">
    <div class="form-row">
        <!-- Skills Dropdown -->
        <div class="col-md-2">
            <select class="form-control-sm form-control" id="skill">
                <option value="">Competences</option>
                @foreach($Competences as $Competence)
                    <option value="{{ $Competence->id }}">{{ $Competence->nom }}</option>
                @endforeach
            </select>
        </div>
        <!-- Projects Dropdown -->
        <div class="col-md-2">
            <select class="form-control-sm form-control" id="project">
                <option value="">Projets</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->titre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Learners Dropdown -->
        <div class="col-md-3">
            <select class="form-control-sm form-control" id="learner">
                <option value="">Apprenants</option>
                @foreach($Personnes as $Personne)
                    <option value="{{ $Personne->id }}">{{ $Personne->prenom }}{{ $Personne->nom }}</option>
                @endforeach
            </select>
        </div>

        <!-- Etat Dropdown -->
        <div class="col-md-3">
            <select class="form-control-sm form-control" id="etat">
                <option value="">Etat</option>
                @foreach($EtatRealisationProjet as $EtatRealisation)
                    <option value="{{ $EtatRealisation->id }}">{{ $EtatRealisation->etat }}</option>
                @endforeach
            </select>
        </div>        <button type="button" class="btn btn-primary" id="btnFilter">Filter</button>

    </div>
                        </div>
                    </div>
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                            <th> {{ __('GestionProjets/projet.singular') }}</th>
                                <th>Apprenants</th>
                                <th>{{ __('pkg_realisation_projets/EtatRealisationProjet.singular') }}</th>
                                <th>Etat de validation</th>
                                <th class="text-center">{{ __('app.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($realisationProjets as $project)
                                <tr>
                                    <td class="nom-brief">{{ $project->projet->titre }}</td>
                                    <td class="etat">{{ $project->Personne->nom }}</td>
                                    <td class="etat">@if($project->EtatRealisationProjet->etat == 'Cancelled')
                                     <span class="badge badge-danger">A faire</span>
                                        @elseif($project->EtatRealisationProjet->etat == 'Pending')
                                      <span class="badge badge-secondary">En pause</span>
                                    @elseif($project->EtatRealisationProjet->etat == 'In Progress')
                                      <span class="badge badge-info">En cours</span>
                                    @elseif($project->EtatRealisationProjet->etat == 'Completed')
                                     <span class="badge badge-success">Terminer</span>
                                    @endif</td>
                                    <td >
                                    @if($project->validation)
                                    <span class="badge badge-success">Validé</span>
                                    @else
                                    <span class="badge badge-secondary">-</span>
                                   @endif
                                     </td>
                                    </td>
                                    <td class='actions'>
                                        <a href="{{ route('validations.validate', ['realisation_id' => $project->id]) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> Valider
                                        </a>
                                        <a href="{{ route('validations.detail', ['realisation_id' => $project->id]) }}" class="btn btn-default btn-sm">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </td>
                                    <td >



                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="d-flex justify-content-between align-items-center p-2">
                    <div class="d-flex align-items-center mb-2">
                        <button type="button" class="btn btn-default btn-sm">
                            <i class="fas fa-download"></i> IMPORT
                        </button>
                        <button type="button" class="btn btn-default btn-sm mt-0 mx-2">
                            <i class="fas fa-upload"></i> EXPORT
                        </button>
                    </div>
                    <div class="mr-5">
                    <ul class="pagination  m-0 float-right">
                        <li>{{ $realisationProjets->onEachSide(2)->links() }}</li>

                    </ul>

                    </div>
                </div>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </div>
</div>
</section>
<!-- /.content -->


@endsection
