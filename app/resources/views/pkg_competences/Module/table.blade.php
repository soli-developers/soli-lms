<div class="card-body table-responsive p-0">
    <table class="table table-striped text-nowrap">
        <thead>
            <tr>
                <th>{{ __('N°') }}</th>
                <th>{{ __('Nom') }}</th>
                <th>{{ __('Description') }}</th>

                <th class="text-center">{{ __('app.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ModuleData as $Module)
                <tr>
                    <td>{!! Str::limit($Module->N, 20) !!}</td>
                    <td>{!! Str::limit($Module->nom, 20) !!}</td>
                    <td>{!! Str::limit($Module->description, 70) !!}</td>

                    <td class="text-center">
                        @can('show-ModuleController')
                            <a href="{{ route('Module.show', $Module) }}" class="btn btn-default btn-sm">
                                <i class="far fa-eye"></i>
                            </a>
                        @endcan
                        @can('edit-ModuleController')
                            <a href="{{ route('Module.edit', $Module) }}" class="btn btn-sm btn-default">
                                <i class="fas fa-pen-square"></i>
                            </a>
                        @endcan
                        @can('destroy-ModuleController')
                            <form action="{{ route('Module.delete', $Module) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce module ?')">
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
        @can('import-ModuleController')
            <form action="{{ route('Module.import') }}" method="post" class="mt-2" enctype="multipart/form-data"
                id="importForm">
                @csrf
                <label for="upload" class="btn btn-default btn-sm font-weight-normal">
                    <i class="fas fa-file-download"></i>
                    {{ __('app.import') }}
                </label>
                <input type="file" id="upload" name="file" style="display:none;"  onchange="submitForm()"/>
            </form>
        @endcan
        @can('export-ModuleController')
                <a href="{{ route('Module.export') }}" class="btn btn-default btn-sm mt-0 mx-2">
                    <i class="fas fa-file-export"></i>
                    {{ __('app.export') }}</a>
        @endcan
    </div>

    <ul class="pagination  m-0 float-right">
        {{ $ModuleData->onEachSide(1)->links() }}
    </ul>
</div>


<script>
    function submitForm() {
        document.getElementById("importForm").submit();
    }
</script>
