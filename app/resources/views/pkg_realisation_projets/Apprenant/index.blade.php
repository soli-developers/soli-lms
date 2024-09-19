@extends('layouts.app')

@section('content')
            <!-- Content Header (Page header) -->
            <section class="content-header">
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
                        Mes projets
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
            <!-- Contenu principal -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Boîte par défaut -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Tableau des projets</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Réduire">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"
                                            title="Supprimer">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3 ">
                                        <label for="skill">Compétence :</label>
                                        <div class="col-md-3  mt-4">
                                            
                                            <select class="form-control" id="competenceFilter">
                                            @foreach($Competences as $Competence)
                                            <option value="{{ $Competence->id }}">{{ $Competence->nom }}</option>
                                        @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 mt-4">
                                            <div class="input-group">
                                                <input id="table_search" type="text" class="form-control" placeholder="nom brief projet...">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="subnit">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @include('pkg_realisation_projets.Apprenant.table')

                            </div>
                            <!-- /.card-body -->
                  
                            <!-- /.card-footer-->
                            <input type="hidden" id='page' value="1">

                        </div>
                        <!-- /.card -->
                    </div>
                </div>
        </div>
        </section>
        <!-- /.content -->
    </div>
    <script>
        document.querySelectorAll('.expand-content').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();
                item.style.display = 'none';
                item.nextElementSibling.style.display = 'inline';
            });
        });
    </script>

@endsection