@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="nav-icon fas fa-table"></i>
                                {{ __('app.edit') }}
                            </h3>
                        </div>
                        <div class="card-body">
                            <!-- Afficher les champs de la formation -->
                            @include('GestionFormation.Formation.fields')
                        </div>
                        <div class="card-footer">
                            <form action="{{ route('formations.update', $dataToEdit->id) }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-link">
                                    <i class="nav-icon fas fa-table"></i> {{ __('app.edit') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
