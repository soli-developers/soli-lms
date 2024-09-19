<form action="{{ $dataToEdit ? route('Appreciation.update', $dataToEdit->id) : route('Appreciation.store') }}" method="POST">
    @csrf
    @if ($dataToEdit)
        @method('PUT')
    @endif
    <div class="card-body">
        <div class="form-group">
            <label for="nom">{{ __('app.name') }} <span
                    class="text-danger">*</span></label>
            <input name="nom" type="text" class="form-control" id="nom" placeholder="Entrez le nom"
                value="{{ $dataToEdit ? $dataToEdit->nom : old('nom') }}">
            @error('nom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="noteMin">{{ __('app.noteMin') }} <span
                    class="text-danger">*</span></label>
            <input name="noteMin" type="number" class="form-control" id="noteMin" placeholder="Entrez le note minimun"
                value="{{ $dataToEdit ? $dataToEdit->noteMin : old('noteMin') }}">
            @error('noteMin')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="noteMax">{{ __('app.noteMax') }} <span
                    class="text-danger">*</span></label>
            <input name="noteMax" type="number" class="form-control" id="noteMax" placeholder="Entrez le note maximum"
                value="{{ $dataToEdit ? $dataToEdit->noteMax : old('noteMax') }}">
            @error('noteMax')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>



        <div class="form-group">
            <label for="inputDescription">{{ __('app.description') }}</label>
            <textarea name="description" id="editor" class="form-control" rows="7" placeholder="Entrez la description">
                {{ $dataToEdit ? $dataToEdit->description : old('description') }}
            </textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="card-footer">
        <a href="{{ route('Appreciation.index') }}" class="btn btn-default">{{ __('app.cancel') }}</a>
        <button type="submit" class="btn btn-info ml-2">{{ $dataToEdit ? __('app.edit') : __('app.add') }}</button>
    </div>

</form>
<script>
    CKEDITOR.replace('editor');
</script>
