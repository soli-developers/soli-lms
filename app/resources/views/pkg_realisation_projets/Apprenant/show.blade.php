@extends('layouts.app')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Détails du projet</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ url('apprenantRealisations.edit') }}" class="btn btn-default float-right"><i class="far fa-edit"></i>
                        Modifier</a>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-sm-12">
                                <label for="nom">Nom :</label>
                                <p>  
                            
                                {{ $realisationProjet->Projet->titre }}

                                </p>
                            </div>

                            <!-- Champ Compétences -->
                            <div class="col-sm-12">
                                <label for="competences">Compétences :</label>
                                <p>
                                    @foreach ($Competences as $Competence)
                                    {{ $Competence}}
    
                                    @endforeach
                            

                                </p>

                                <ul>

                                </ul>
                            </div>

                            <!-- Champ Travail à faire -->
                            <div class="col-sm-12">
                                <label for="travail">Travail à faire :</label>
                                <p>
                                    {{ $realisationProjet->Projet->travailAFaire }}
                                </p>
                            </div>

                            <!-- Champ Critères de validation -->
                            <div class="col-sm-12">
                                <label for="validation">Critères de validation :</label>
                                <p>
                                {{ $realisationProjet->Projet->travailAFaire }}

                                </p>
                            </div>

                            <!-- Champ Date de début et de fin -->
                            <div class="col-sm-12">
                                <label for="date">Date :</label>
                                <p>Date de début :{{ $realisationProjet->Projet->dateDebut }}
                                </p>
                                <p>Date de fin : {{ $realisationProjet->Projet->dateFin }}</p>
                            </div>
{{-- 
                            <!-- Champ Ressources -->
                            <div class="col-sm-12">
                                <label for="resources">Ressources :</label>
                                <p><a href="https://exemple.com/ressources">https://exemple.com/ressources</a>
                                </p>
                            </div>

                            <!-- Champ Référence -->
                            <div class="col-sm-12">
                                <label for="reference">Référence :</label>
                                <p><a href="https://exemple.com/reference">https://exemple.com/reference</a></p>
                            </div> --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection