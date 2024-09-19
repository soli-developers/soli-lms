<form action="{{ $dataToEdit ? route('technologies.update', $dataToEdit->id) : route('technologies.store') }}"
    method="POST">
    @csrf
    @if ($dataToEdit)
        @method('PUT')
    @endif
    <div class="card-body">
        <div class="form-group">
            <label for="nom">{{ __('app.name') }} <span class="text-danger">*</span></label>
            <input name="nom" type="text" class="form-control" id="nom" placeholder="Entrez le technologie"
                value="{{ $dataToEdit ? $dataToEdit->nom : old('nom') }}">
            @error('nom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="technologies_id">{{ __('pkg_competences/technologies.plural') }}
                <span class="text-danger">*</span></label>
            <select name="technologies_id" class="form-control" id="exampleInputProject">
                @if (isset($dataToEdit))
                    <option value="{{ $dataToEdit->id }}">{{ $dataToEdit->technologies->nom }}</option>
                @else
                    <option value="">Choisir un technologies</option>
                @endif
                @foreach ($TechnologieData as $item)
                    @if (!isset($dataToEdit) || !$dataToEdit->nom || $item->id !== $dataToEdit->competence->id)
                        <option value="{{ $item->id }}">{{ $item->nom }}</option>
                    @endif
                @endforeach
            </select>
            @error('technologies_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror

        </div>

        <div class="form-group">
            <label for="categorie_technologies_id">{{ __('pkg_competences/categorieTechnologie.plural') }}
                <span class="text-danger">*</span>
            </label>
            <select name="categorie_technologies_id" class="form-control" id="exampleInputProject">
                @if (isset($dataToEdit))
                    <option value="{{ $dataToEdit->id }}">{{ $dataToEdit->categorieTechnologie->nom }}
                    </option>
                @else
                    <option value="">Choisir un categorie technologies</option>
                @endif
                @foreach ($CategorieTechnologie as $item)
                    @if (!isset($dataToEdit) || !$dataToEdit->nom || $item->id !== $dataToEdit->categorieTechnologie->id)
                        <option value="{{ $item->id }}">{{ $item->nom }}</option>
                    @endif
                @endforeach
            </select>
            @error('categorie_technologies_id')
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
        <a href="{{ route('technologies.index') }}" class="btn btn-default">{{ __('app.cancel') }}</a>
        <button type="submit" class="btn btn-info">{{ $dataToEdit ? __('app.edit') : __('app.add') }}</button>
    </div>
</form>
