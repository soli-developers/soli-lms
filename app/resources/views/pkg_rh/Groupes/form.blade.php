<form method="post" action="{{ $dataToEdit ? route('Groupes.update', $dataToEdit->id) : route('Groupes.store') }}">
    @csrf
    @method('POST')
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" value="{{ $dataToEdit ? $dataToEdit->nom : old('nom') }}" class="form-control"  id="nom" name="nom">
        @error('nom')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="editor" name="description" rows="3">{{ $dataToEdit ? $dataToEdit->description : old('description') }}</textarea>
        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <a type="button" class="btn btn-secondary" href={{ route('Groupes.index') }}>{{ __('app.cancel')}}</a>
    <button type="submit" class="btn btn-info">{{ $dataToEdit ? __('app.edit') : __('app.add')}}</button>
</form>
