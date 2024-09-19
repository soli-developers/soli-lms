<div class="card-body table-responsive p-0">
    <table class="table table-striped text-nowrap">
        <thead>
            <tr>
                <th>{{ __('Nom') }}</th>
                <th>{{ __('Description') }}</th>

                <th class="text-center">{{ __('app.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($CategorieTechnologieData as $CategorieTechnologie)
                <tr>
                    <td>{!! Str::limit($CategorieTechnologie->nom, 20) !!}</td>
                    <td>{!! Str::limit($CategorieTechnologie->description, 80) !!}</td>

                    <td class="text-center">
                        @can('show-CategorieTechnologieController')
                            <a href="{{ route('CategorieTechnologie.show', $CategorieTechnologie) }}" class="btn btn-default btn-sm">
                                <i class="far fa-eye"></i>
                            </a>
                        @endcan
                        @can('edit-CategorieTechnologieController')
                            <a href="{{ route('CategorieTechnologie.edit', $CategorieTechnologie) }}" class="btn btn-sm btn-default">
                                <i class="fas fa-pen-square"></i>
                            </a>
                        @endcan
                        @can('destroy-CategorieTechnologieController')
                            <form action="{{ route('CategorieTechnologie.delete', $CategorieTechnologie) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce Categorie Technologie ?')">
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

<div class="d-md-flex justify-content-between align-items-center p-2">
    <div class="d-flex align-items-center mb-2 ml-2 mt-2">
        @can('import-CategorieTechnologieController')
            <form action="{{ route('CategorieTechnologie.import') }}" method="post" class="mt-2" enctype="multipart/form-data"
                id="importForm">
                @csrf
                <label for="upload" class="btn btn-default btn-sm font-weight-normal">
                    <i class="fas fa-file-download"></i>
                    {{ __('app.import') }}
                </label>
                <input type="file" id="upload" name="file" style="display:none;"  onchange="submitForm()"/>
            </form>
        @endcan
        @can('export-CategorieTechnologieController')
                <a href="{{ route('CategorieTechnologie.export') }}" class="btn btn-default btn-sm mt-0 mx-2">
                    <i class="fas fa-file-export"></i>
                    {{ __('app.export') }}</a>
        @endcan
    </div>

    <ul class="pagination  m-0 float-right">
        {{ $CategorieTechnologieData->onEachSide(1)->links() }}
    </ul>
</div>

<script>
    function submitForm() {
        document.getElementById("importForm").submit();
    }
</script>
