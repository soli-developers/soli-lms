@extends('layouts.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <section class="content-header">
                <div class="container-fluid ">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Details de Groupe</h1>
                        </div>
                        <div class="col-sm-6">
                            <a href={{ route('Groupes.create') }} type="button" class="btn btn-info float-right">
                                <i class="fas fa-plus"></i> Ajouter un Groupe
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <div class="card">
                <div class="card-body">
                    <h3>Informations de Groupe</h3>
                    <br>
                    <br>
                    <p><strong>Nom: </strong> {{ $Groupe->nom }}</p>
                    @if ($Groupe->description)
                        <p><strong>Description: </strong> {{ $Groupe->description }}</p>
                    @endif
                </div>
                <div class="card-footer">
                    <a class="btn btn-secondary" href={{ route('Groupes.index') }}>Annuler</a>
                    <a class="btn btn-info" href={{ route('Groupes.edit', $Groupe->id) }}>Modifier</a>
                </div>
            </div>
        </div>
    </section>
@endsection
