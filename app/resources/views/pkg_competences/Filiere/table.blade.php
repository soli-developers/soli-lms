<div class="card-body table-responsive p-0">
    <table class="table table-striped text-nowrap">
        <thead>
            <tr>
                <th>{{ __('Nom') }}</th>
                <th>{{ __('description') }}</th>

                <th class="text-center">{{ __('app.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($FiliereData as $Filiere)
                <tr>
                    <td>{!! Str::limit($Filiere->nom, 50) !!}</td>
                    <td>{!! Str::limit($Filiere->description, 80) !!}</td>

                    <td class="text-center">
                        @can('show-FiliereController')
                            <a href="{{ route('Filiere.show', $Filiere) }}" class="btn btn-default btn-sm">
                                <i class="far fa-eye"></i>
                            </a>
                        @endcan
                        @can('edit-FiliereController')
                            <a href="{{ route('Filiere.edit', $Filiere) }}" class="btn btn-sm btn-default">
                                <i class="fas fa-pen-square"></i>
                            </a>
                        @endcan
                        @can('destroy-FiliereController')
                            <form action="{{ route('Filiere.delete', $Filiere) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce filiere ?')">
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
        @can('import-FiliereController')
            <form action="{{ route('Filiere.import') }}" method="post" class="mt-2" enctype="multipart/form-data"
                id="importForm">
                @csrf
                <label for="upload" class="btn btn-default btn-sm font-weight-normal">
                    <i class="fas fa-file-download"></i>
                    {{ __('app.import') }}
                </label>
                <input type="file" id="upload" name="file" style="display:none;" onchange="submitForm()" />
            </form>
        @endcan
        @can('export-FiliereController')
                <a href="{{ route('Filiere.export') }}" class="btn btn-default btn-sm mt-0 mx-2">
                    <i class="fas fa-file-export"></i>
                    {{ __('app.export') }}</a>
        @endcan
    </div>

    <ul class="pagination  m-0 float-right">
        {{ $FiliereData->onEachSide(1)->links() }}
    </ul>
</div>


<script>
    function submitForm() {
        document.getElementById("importForm").submit();
    }
</script>
