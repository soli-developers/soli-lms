@extends('layouts.app')
@section('content')
<section class="content">
    <div class="container-fluid">
        <section class="content-header">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('success') }}.
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="container-fluid ">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Liste des {{ __('pkg_rh/'.$type.'.plural')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <a href={{ route($type.'.create')}} type="button" class="btn btn-info float-right">
                            <i class="fas fa-plus"></i> Ajouter un {{ __('pkg_rh/'.$type.'.singular')}}
                        </a>
                    </div>
                </div>
            </div>
        </section>
        
        <div class="card">
            <div class="card-header col-md-12" id="tableForm">
                <div class="input-group input-group-sm float-sm-right col-md-3 p-0">
                    <input type="text" name="table_search" id="table_search" class="form-control float-right" placeholder="Recherche">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Numéro de téléphone</th>
                            <th>{{$type == 'Formateur' ? 'Spécialité' : 'Groupe' }} </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personnes as $personne)
                            <tr>
                                <td>{{$personne->nom}}</td>
                                <td>{{$personne->prenom}}</td>
                                <td>{{$personne->tele_num}}</td>
                                <td>{{$type == 'Formateur' ? $personne->specialite->nom : $personne->groupe->nom}}</td>
                                <td class="text-center">
                                    <a href={{ route($type.'.show', $personne->id) }} class='btn btn-default btn-sm'>
                                        <i class="far fa-eye"></i>
                                    </a>
                                    <a href={{ route($type.'.edit', $personne->id) }} class="btn btn-sm btn-default"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form action={{ route($type.'.delete', $personne->id) }} method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>                                
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="d-md-flex justify-content-between align-items-center p-2">
                <div class="d-flex align-items-center mb-2 ml-2 mt-2">
                    <form action="{{ route($type.'.import') }}" method="post" class="mt-2" enctype="multipart/form-data"
                        id="importForm">
                        @csrf
                        <label for="upload" class="btn btn-default btn-sm font-weight-normal">
                            <i class="fas fa-file-download"></i>
                            {{ __('app.import') }}
                        </label>
                        <input type="file" id="upload" name="file" style="display:none;" onchange="submitForm()" />
                    </form>
                    <form class="">
                        <a href="{{ route($type.'.export') }}" class="btn btn-default btn-sm mt-0 mx-2">
                            <i class="fas fa-file-export"></i>
                            {{ __('app.export') }}</a>
                    </form>
                </div>
            
                <ul class="pagination  m-0 float-right">
                    {{ $personnes->onEachSide(1)->links() }}
                </ul>
            </div>
            
        </div>
    </div>
</section>
@endsection