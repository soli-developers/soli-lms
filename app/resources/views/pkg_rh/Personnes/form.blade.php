<form method="post" action="{{ $dataToEdit ? route($type.'.update', $dataToEdit->id) : route($type.'.store') }}">
    @csrf
    @method('POST')
    <!-- Personal Information -->
    <h4 class="mb-3 mt-3">Informations personnelles</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" value="{{ $dataToEdit ? $dataToEdit->nom : old('nom') }}" class="form-control"  id="nom" name="nom">
                @error('nom')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" value="{{ $dataToEdit ? $dataToEdit->prenom : old('prenom') }}" class="form-control"  id="prenom" name="prenom">
                @error('prenom')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="date_naissance">Date de Naissance</label>
                <input type="date" value="{{ $dataToEdit ? $dataToEdit->date_naissance : old('date_naissance') }}" class="form-control"  id="date_naissance" name="date_naissance">
                @error('date_naissance')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="nom_arab">Nom en Arabe</label>
                <input type="text" value="{{ $dataToEdit ? $dataToEdit->nom_arab : old('nom_arab') }}" class="form-control" id="nom_arab" name="nom_arab">
                @error('nom_arab')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="prenom_arab">Prénom en Arabe</label>
                <input type="text" value="{{ $dataToEdit ? $dataToEdit->prenom_arab : old('prenom_arab') }}" class="form-control"  id="prenom_arab" name="prenom_arab">
                @error('prenom_arab')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="tele_num">Numéro de Téléphone</label>
                <input type="text" value="{{ $dataToEdit ? $dataToEdit->tele_num : old('tele_num') }}" class="form-control"  id="tele_num" name="tele_num">
                @error('tele_num')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <!-- End Personal Information -->

    <!-- Contact Information -->
    <h4 class="mb-3 mt-3">Informations de contact</h4>
    <div class="row">
        @if (!$dataToEdit)
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" value="{{ $dataToEdit ? $dataToEdit->email : old('email') }}" class="form-control"  id="email" name="email">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" value="{{ $dataToEdit ? $dataToEdit->password : old('password') }}" class="form-control" id="password" name="password">
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        @endif
        <div class="col-md-6">
            <div class="form-group">
                <label for="rue">Rue</label>
                <input type="text" value="{{ $dataToEdit ? $dataToEdit->rue : old('rue') }}" class="form-control" id="rue" name="rue">
                @error('rue')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="ville_id">Ville</label>
                <select class="form-control" id="ville_id" name="ville_id">
                    <option value="default" selected disabled>Choisissez</option>
                    @foreach ($villes as $ville)
                        <option {{ ($dataToEdit && $dataToEdit->ville_id == $ville->id) || ($ville->id == old('ville_id')) ? "selected" : '' }} value={{$ville->id}}>{{$ville->nom}}</option>
                    @endforeach
                </select>
                @error('ville_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <!-- End Contact Information -->

    <!-- Other Information -->
    <h4 class="mb-3 mt-3">Autres informations</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="cin">CIN</label>
                <input type="text" value="{{ $dataToEdit ? $dataToEdit->cin : old('cin') }}" class="form-control"  id="cin" name="cin">
                @error('cin')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="groupe_id">Groupe</label>
                <select value="{{ $dataToEdit ? $dataToEdit->groupe_id : old('groupe_id') }}" class="form-control" id="groupe_id" name="groupe_id">
                    <option value="default" selected disabled>Choisissez</option>
                    @foreach ($groupes as $groupe)
                        <option {{ ($dataToEdit && $dataToEdit->groupe_id == $groupe->id) || ($groupe->id == old('groupe_id')) ? "selected" : '' }} value={{$groupe->id}}>{{$groupe->nom}}</option>
                    @endforeach
                </select>
                @error('groupe_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        @if ($type == 'Apprenant')
        <div class="col-md-6">
            <div class="form-group">
                <label for="CNE">CNE</label>
                <input type="text" value="{{ $dataToEdit ? $dataToEdit->cne : old('cne') }}" class="form-control"  id="CNE" name="cne">
                @error('cne')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="niveau_scolaire_id">Niveau scolaire</label>
                <select class="form-control" id="niveau_scolaire_id" name="niveau_scolaire_id">
                        <option value="default" selected disabled>Choisissez</option>
                    @foreach ($niveauxScolaire as $niveauScolaire)
                        <option {{ ($dataToEdit && $dataToEdit->niveau_scolaire_id == $niveauScolaire->id) || ($niveauScolaire->id == old('niveau_scolaire_id')) ? "selected" : '' }} value={{$niveauScolaire->id}}>{{$niveauScolaire->nom}}</option>
                    @endforeach
                </select>
                @error('niveau_scolaire_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        @endif
        <div class="col-md-6">
            @if ($type == 'Formateur')
            <div class="form-group">
                <label for="specialite_id">Spécialité</label>
                <select class="form-control" id="specialite_id" name="specialite_id">
                        <option value="default" selected disabled>Choisissez</option>
                    @foreach ($specialites as $specialite)
                        <option {{ ($dataToEdit && $dataToEdit->specialite_id == $specialite->id) || ($specialite->id == old('specialite_id')) ? "selected" : '' }} value={{$specialite->id}}>{{$specialite->nom}}</option>
                    @endforeach
                </select>
                @error('specialite_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            @endif
            <div class="form-group">
                <label for="lieu_naissance_id">Lieu de Naissance</label>
                <select value="{{ $dataToEdit ? $dataToEdit->lieu_naissance_id : old('lieu_naissance_id') }}" class="form-control" id="lieu_naissance_id" name="lieu_naissance_id">
                    <option value="default" selected disabled>Choisissez</option>
                    @foreach ($villes as $ville)
                        <option {{ ($dataToEdit && $dataToEdit->lieu_naissance_id == $ville->id) || ($ville->id == old('lieu_naissance_id')) ? "selected" : '' }} value={{$ville->id}}>{{$ville->nom}}</option>
                    @endforeach
                </select>
                @error('lieu_naissance_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <!-- End Other Information -->


    <a type="button" class="btn btn-secondary" href={{ route($type.'.index') }}>{{ __('app.cancel')}}</a>
    <button type="submit" class="btn btn-info">{{ $dataToEdit ? __('app.edit') : __('app.add')}}</button>
</form>
