<form id="formationForm" action="{{ $dataToEdit ? route('formations.update', $dataToEdit->id) : route('formations.store') }}" method="POST">
    @csrf
    @if ($dataToEdit)
        @method('PUT')
    @endif
    <div class="card-body">
        <div class="form-group">
            <label for="nom">{{ __('app.name') }} <span class="text-danger">*</span></label>
            <input name="nom" type="text" class="form-control" id="nom" placeholder="Entrez le titre" value="{{ $dataToEdit ? $dataToEdit->nom : old('nom') }}">
            @error('nom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="inputDescription">{{ __('app.description') }}</label>
            <textarea name="description" id="editor" class="form-control" rows="7" placeholder="Entrez la description">{{ $dataToEdit ? $dataToEdit->description : old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="link">{{ __('app.link') }}</label>
            <input name="lien" type="url" class="form-control" id="link" placeholder="Entrez le lien" value="{{ $dataToEdit ? $dataToEdit->lien : old('lien') }}">
            @error('lien')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label for="lien1">{{ __('app.link1') }}</label>
        <input name="lien1" type="url" class="form-control" id="link1" placeholder="Entrez le lien" value="{{ $dataToEdit ? $dataToEdit->lien1 : old('lien1') }}">
        @error('lien1')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
    <div class="card-footer">
        <a href="{{ route('formations.index') }}" class="btn btn-default">{{ __('app.cancel') }}</a>
        <button type="submit" class="btn btn-info ml-2">{{ $dataToEdit ? __('app.edit') : __('app.add') }}</button>
    </div>
</form>
