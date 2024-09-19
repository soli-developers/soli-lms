<div class="card-body table-responsive p-0">
    <table class="table table-striped text-nowrap">
        <thead>
            <tr>
                <th>{{ __('pkg_competences/technologie.singular') }}</th>
                <th>{{ __('app.description') }}</th>
                <th class="text-center">{{ __('app.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($TechnologieData as $technologie)
                <tr>
                    <td>{{ $technologie->nom }}</td>
                    <td>{!! Str::limit($technologie->description, 80) !!}</td>

                    <td class="text-center">
                        @can('show-TechnologieController')
                            <a href="{{ route('technologies.show', $technologie) }}" class="btn btn-default btn-sm">
                                <i class="far fa-eye"></i>
                            </a>
                        @endcan
                        @can('edit-TechnologieController')
                            <a href="{{ route('technologies.edit', $technologie) }}" class="btn btn-sm btn-default">
                                <i class="fas fa-pen-square"></i>
                            </a>
                        @endcan
                        @can('destroy-TechnologieController')
                            <form action="{{ route('technologies.destroy', $technologie) }}" method="POST"
                                style="display: inline;">
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

<div class="d-md-flex justify-content-between align-items-center p-2">
    <div class="d-flex align-items-center mb-2 ml-2 mt-2">

        @can('import-TechnologieController')
            <form action="{{ route('technologies.import') }}" method="post" class="mt-2" enctype="multipart/form-data"
                id="importForm">
                @csrf
                <label for="upload" class="btn btn-default btn-sm font-weight-normal">
                    <i class="fas fa-file-download"></i>
                    {{ __('app.import') }}
                </label>
                <input type="file" id="upload" name="file" style="display:none;" onchange="submitForm()" />
            </form>
        @endcan
        @can('export-TechnologieController')
            <form class="">
                <a href="{{ route('technologies.export') }}" class="btn btn-default btn-sm mt-0 mx-2">
                    <i class="fas fa-file-export"></i>
                    {{ __('app.export') }}</a>
            </form>
        @endcan
    </div>

    <ul class="pagination  m-0 float-right">
        {{ $TechnologieData->onEachSide(1)->links() }}
    </ul>
</div>


<script>
    function submitForm() {
        document.getElementById("importForm").submit();
    }
</script>
