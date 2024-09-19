@extends('layouts.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <section class="content-header">
                <div class="container-fluid ">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Details de {{$type}}</h1>
                        </div>
                        <div class="col-sm-6">
                            <a href={{ route($type.'.create') }} type="button" class="btn btn-info float-right">
                                <i class="fas fa-plus"></i> Ajouter un {{$type}}
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            
            <div class="card">
                <div class="card-body">
                    <h3>Informations de {{$type}}</h3>
                    <br>
                    <br>
                    <p><strong>Nom: </strong> {{$personne->nom}}</p>
                    <p><strong>Prénom: </strong> {{$personne->prenom}}</p>
                    <p><strong>Numéro de {{$type}}: </strong> {{$personne->tele_num}}</p>
                    <p><strong>{{$type == 'Formateur' ? 'Spécialité' : 'Groupe' }} </strong>{{$type == 'Formateur' ? $personne->specialite->nom : $personne->niveauScolaire->nom}}</p>
                    <p><strong>Ville: </strong> {{$personne->ville->nom}}</p>
                    <p><strong>Groupe: </strong> {{$personne->groupe->nom}}</p>
                    <p><strong>CIN: </strong> {{$personne->cin}}</p>
                    <p><strong>Date de naissance: </strong> {{$personne->date_naissance}}</p>
                    @if ($type == "Apprenant") <p><strong>Niveau scolaire: </strong> {{$personne->niveauScolaire->nom}}</p> @endif
                </div>
                <div class="card-footer">
                    <a class="btn btn-secondary" href={{ route($type.'.index') }}>Annuler</a>
                    <a class="btn btn-info" href={{ route($type.'.edit', $personne->id ) }}>Modifier</a>
                </div>
            </div>
        </div>
    </section>
@endsection