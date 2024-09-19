
<div class="card-body table-responsive p-0">
    <table id="example1"  class="table table-striped text-nowrap">
        <thead>
            <tr>
                <th>{{ __('pkg_creation_projets/projet.singular') }}</th>
                <th>{{ __('pkg_competences/competence.singular') }}</th>
                <th>{{ __('pkg_creation_projets/Projet.datedebut') }}</th>
                <th>{{ __('pkg_creation_projets/Projet.datefin') }}</th>
                <th class="text-center">{{ __('app.action') }}</th>
            </tr>
        </thead>
        <tbody >
               @foreach ($projetData as $projet)
                <tr>
                    <td class="text-wrap w-50">{{ $projet->titre }}</td>
                    <td class="text-wrap w-50">
                        <ul>
                            @if ($projet->transfertCompetences)
                                @foreach($projet->transfertCompetences as $transfertCompetence)
                                    <li>
                                        {{ $transfertCompetence->competence->nom ?? 'No competence' }}
                                        @if ($transfertCompetence->appreciation)
                                            <ul>
                                                <li>{{ $transfertCompetence->appreciation->nom ?? 'No appreciation' }}</li>
                                            </ul>
                                        @else
                                            <p>No appreciation available</p>
                                        @endif
                                    </li>
                                @endforeach
                            @else
                                <p>No competences available</p>
                            @endif
                        </ul>
                    </td>
                    <td>{{ $projet->dateDebut }}</td>
                    <td>{{ $projet->dateFin }}</td>

                    <td class="text-center">
                        @can('show-ProjetController')
                            <a href="{{ route('projets.show', $projet) }}" class="btn btn-default btn-sm">
                                <i class="far fa-eye"></i>
                            </a>
                        @endcan
                        @can('edit-ProjetController')
                            <a href="{{ route('projets.edit', $projet) }}" class="btn btn-sm btn-default">
                                <i class="fas fa-pen-square"></i>
                            </a>
                        @endcan
                        @can('destroy-ProjetController')
                            <form action="{{ route('projets.destroy', $projet) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>
<div class="d-md-flex justify-content-between align-items-center p-2" id="card-footer">
    <div class="d-flex align-items-center mb-2 ml-2 mt-2">

        @can('import-ProjetController')
            <form action="{{ route('projets.import') }}" method="post" class="mt-2" enctype="multipart/form-data"
                id="importForm">
                @csrf
                <label for="upload" class="btn btn-default btn-sm font-weight-normal">
                    <i class="fas fa-file-download"></i>
                    {{ __('app.import') }}
                </label>
                <input type="file" id="upload" name="file" style="display:none;" onchange="submitForm()" />
            </form>
        @endcan

        @can('export-ProjetController')
            <form class="">
                <a href="{{ route('projets.export') }}" class="btn btn-default btn-sm mt-0 mx-2">
                    <i class="fas fa-file-export"></i>
                    {{ __('app.export') }}</a>
            </form>
        @endcan
    </div>

    <ul class="pagination m-0 float-right">
        {{ $projetData->appends(['searchValue' => $searchValue, 'competenceId' => $competenceId])->onEachSide(1)->links() }}
    </ul>
</div>
