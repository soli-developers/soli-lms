
<div class="card-body table-responsive p-0">
    <table class="table table-striped text-nowrap">
        <thead>
            <tr>
                <th>{{ __('app.name') }}</th>
                <th>{{ __('app.description') }}</th>
                <th>{{ __('app.link') }}</th>
                <th>{{ __('app.link1') }}</th>
                <th class="text-center">{{ __('app.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($formationData as $formation)
                <tr>
                    <td>{{ $formation->nom }}_{{ $formation->created_at }}</td>
                    <td>{{ $formation->description }}</td>
                    <td>{{ $formation->lien }}</td>
                    <td>{{ $formation->lien1 }}</td>
                    <td class="text-center">
                        <a href="{{ route('formations.show', $formation->id) }}" class="btn btn-default btn-sm">
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('formations.edit', $formation->id) }}" class="btn btn-sm btn-default">
                            <i class="fas fa-pen-square"></i>
                        </a>
                        <form action="{{ route('formations.destroy', $formation->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- <div class="d-md-flex justify-content-between align-items-center p-2">
    <ul class="pagination m-0 float-right">
{{ $formationData->appends(['search' => request()->query('search')])->links() }}
    </ul>
</div> -->
