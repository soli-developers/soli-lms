<table class="table table-bordered">
    <thead>
        <tr>
            <th> {{ __('GestionProjets/projet.singular') }}</th>
            <th>{{ __('pkg_competences/competence.singular') }}</th>
            <th>{{ __('pkg_realisation_projets/EtatRealisationProjet.singular') }}</th>
            <th>{{ __('pkg_realisation_projets/EtatRealisationProjet.date_debut_realisation') }}</th>
            <th>{{ __('pkg_realisation_projets/EtatRealisationProjet.date_fin_realisation') }}</th>
            <th class="text-center">{{ __('app.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($realisationProjets as $project)
            <tr>
                <td>{{ $project->projet->titre }}</td>
                <td>
                    @foreach ($project->projet->competences as $competence)
                        <span>{{ substr($competence->nom, 0, 60) }} <span>...</span>
                    @endforeach


                </td>
                <td class="etat">
                    @if ($project->EtatRealisationProjet->etat == 'Cancelled')
                        <span class="badge badge-danger">A faire</span>
                    @elseif($project->EtatRealisationProjet->etat == 'Pending')
                        <span class="badge badge-secondary">En pause</span>
                    @elseif($project->EtatRealisationProjet->etat == 'In Progress')
                        <span class="badge badge-info">En cours</span>
                    @elseif($project->EtatRealisationProjet->etat == 'Completed')
                        <span class="badge badge-success">Terminer</span>
                    @endif
                </td>
                <td>{{ $project->date_debut_realisation }}</td>
                <td>{{ $project->date_fin_realisation }}</td>

                <td class="text-center">
                    <a href="{{ route('apprenantRealisations.show', $project->id) }}" class='btn btn-default btn-sm'>
                        <i class="far fa-eye"></i>
                    </a>
                    <a href="{{ route('apprenantRealisations.create', $project->EtatRealisationProjet->id) }}"
                        class="btn btn-default btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
                <!-- Add more columns if needed -->
            </tr>
        @endforeach
    </tbody>
</table>
<div class="d-md-flex justify-content-between align-items-center p-2" id="card-footer">
    <div class="d-flex align-items-center mb-2 ml-2 mt-2">

        {{-- @can('import-ProjetController') --}}
        <form action="{{ route('projets.import') }}" method="post" class="mt-2" enctype="multipart/form-data"
            id="importForm">
            @csrf
            <label for="upload" class="btn btn-default btn-sm font-weight-normal">
                <i class="fas fa-file-download"></i>
                {{ __('app.import') }}
            </label>
            <input type="file" id="upload" name="file" style="display:none;" onchange="submitForm()" />
        </form>
        {{-- @endcan --}}

        {{-- @can('export-ProjetController') --}}
        <form class="">
            <a href="{{ route('projets.export') }}" class="btn btn-default btn-sm mt-0 mx-2">
                <i class="fas fa-file-export"></i>
                {{ __('app.export') }}</a>
        </form>
        {{-- @endcan --}}
    </div>

    <ul class="pagination m-0 float-right">
        {{ $realisationProjets->links() }}
    </ul>
</div>
