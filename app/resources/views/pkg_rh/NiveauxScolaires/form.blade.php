<form method="post"
    action="{{ $dataToEdit ? route('NiveauxScolaire.update', $dataToEdit->id) : route('NiveauxScolaire.store') }}">
    @csrf
    @method('POST')
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" value="{{ $dataToEdit ? $dataToEdit->nom : old('nom') }}" class="form-control" id="nom"
            name="nom">
        @error('nom')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <a type="button" class="btn btn-secondary" href={{ route('NiveauxScolaire.index') }}>{{ __('app.cancel') }}</a>
    <button type="submit" class="btn btn-info">{{ $dataToEdit ? __('app.edit') : __('app.add') }}</button>
</form>
