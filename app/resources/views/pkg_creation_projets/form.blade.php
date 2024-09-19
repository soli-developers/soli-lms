@extends('layouts.app')

@section('content')
<style>
    .step {
        display: none;
    }
</style>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ $dataToEdit ? __('app.edit') : __('app.add') }}  {{ __('pkg_creation_projets/Projet.singular') }}</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="bs-stepper">
                            <div id="livrable-form">
                                <form action="{{ $dataToEdit ? route('projets.update', $dataToEdit->id) : route('projets.store') }}" method="POST">
                                    @csrf
                                    @if ($dataToEdit)
                                        @method('PUT')
                                    @endif
                                    <div class="bs-stepper-content">
                                        <div class="step" id="step1">
                                            <div id="description-part"  role="tabpanel"
                                                 aria-labelledby="description-part-trigger">
                                                <div class="form-group">
                                                    <label for="titre">{{ __('app.title') }}</label>
                                                    <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre" name="titre"
                                                           value="{{ old('titre') ?? ($dataToEdit ? $dataToEdit->titre : '') }}">
                                                    @error('titre')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">{{ __('pkg_creation_projets/Projet.description') }}</label>
                                                    <textarea class="form-control @error('description') is-invalid @enderror ckeditor-textarea" id="description"
                                                              name="description" rows="3">{{ old('description') ?? ($dataToEdit ? $dataToEdit->description : '') }}</textarea>
                                                    @error('description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="travailAFaire">{{ __('pkg_creation_projets/Projet.travailAFaire') }}</label>
                                                    <textarea class="form-control @error('travailAFaire') is-invalid @enderror ckeditor-textarea" id="travailAFaire"
                                                              name="travailAFaire"
                                                              rows="3">{{ old('travailAFaire') ?? ($dataToEdit ? $dataToEdit->travailAFaire : '') }}</textarea>
                                                    @error('travailAFaire')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="critereDeTravail">{{ __('pkg_creation_projets/Projet.critereDeTravail') }}</label>
                                                    <textarea class="form-control @error('critereDeTravail') is-invalid @enderror ckeditor-textarea" id="critereDeTravail"
                                                              name="critereDeTravail"
                                                              rows="3">{{ old('critereDeTravail') ?? ($dataToEdit ? $dataToEdit->critereDeTravail : '') }}</textarea>
                                                    @error('critereDeTravail')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="dateDebut">{{ __('pkg_creation_projets/Projet.datedebut') }}</label>
                                                    <input type="date" class="form-control @error('dateDebut') is-invalid @enderror" id="dateDebut"
                                                           name="dateDebut" value="{{ old('dateDebut') ?? ($dataToEdit ? $dateDebutFormatted : date('Y-m-d')) }}">
                                                    @error('dateDebut')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="dateFin">{{ __('pkg_creation_projets/Projet.datefin') }}</label>
                                                    <input type="date" class="form-control @error('dateFin') is-invalid @enderror" id="dateFin"
                                                           name="dateFin" value="{{ old('dateFin') ?? ($dataToEdit ? $dateFinFormatted : date('Y-m-d')) }}">
                                                    @error('dateFin')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group" id="livrables-container">
                                                    <label for="livrable">{{ __('app.name') }}   {{ __('pkg_creation_projets/Livrable.singular') }}</label>
                                                    @if(isset($dataToEdit->livrables))
                                                        @foreach($dataToEdit->livrables as $livrable)
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control @error('livrable.*') is-invalid @enderror" name="livrable[]" placeholder="Nom de livrable" value="{{ $livrable->titre }}">
                                                                <div class="input-group-append ">
                                                                    <select class="form-control @error('livrable_nature.*') is-invalid @enderror" name="livrable_nature[]">
                                                                        @foreach($livrableNatures as $nature)
                                                                            <option value="{{ $nature->id }}" @if($livrable->nature_livrable_id == $nature->id) selected @endif>
                                                                                {{ $nature->nom }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('livrable_nature.*')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="livrable_description">{{ __('pkg_creation_projets/Projet.description') }}</label>
                                                                <textarea class="form-control @error('livrable_description.*') is-invalid @enderror ckeditor-textarea" id="livrable_description" name="livrable_description[]" rows="3">{{ $livrable->description }}</textarea>
                                                                @error('livrable_description.*')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="livrable_link">{{ __('pkg_creation_projets/Projet.link') }}  {{ __('pkg_creation_projets/Livrable.singular') }}</label>
                                                                <input type="text" class="form-control @error('livrable_link.*') is-invalid @enderror" id="livrable_link" name="livrable_link[]" value="{{ $livrable->lien }}">
                                                                @error('livrable_link.*')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control @error('livrable.*') is-invalid @enderror" name="livrable[]" placeholder="Nom de livrable" value="Presentation">
                                                            <div class="input-group-append">
                                                                <select class="form-control @error('livrable_nature.*') is-invalid @enderror" name="livrable_nature[]">
                                                                    @foreach($livrableNatures as $nature)
                                                                        <option value="{{ $nature->id }}">{{ $nature->nom }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('livrable_nature.*')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="livrable_description">{{ __('pkg_creation_projets/Projet.description') }} {{ __('pkg_creation_projets/Livrable.singular') }}</label>
                                                            <textarea class="form-control @error('livrable_description.*') is-invalid @enderror ckeditor-textarea" id="livrable_description" name="livrable_description[]" rows="3"></textarea>
                                                            @error('livrable_description.*')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="livrable_link">{{ __('pkg_creation_projets/Projet.link') }}  {{ __('pkg_creation_projets/Livrable.singular') }}</label>
                                                            <input type="text" class="form-control @error('livrable_link.*') is-invalid @enderror" id="livrable_link" name="livrable_link[]" value="">
                                                            @error('livrable_link.*')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    @endif
                                                </div>
                                                <button type="button" class="btn btn-primary mb-3"
                                                        onclick="addLivraison()">{{ __('app.add') }}   {{ __('pkg_creation_projets/Livrable.singular') }}
                                                </button>
                                                <div class="form-group" id="ressources-container">
                                                    <label for="ressource">{{ __('app.name') }}  {{ __('pkg_creation_projets/Resource.singular') }}</label>
                                                    @if(isset($dataToEdit->resources))
                                                        @foreach($dataToEdit->resources as $resource)
                                                            <div class="ressource mb-3">
                                                                <input type="text" class="form-control @error('ressource_nom.*') is-invalid @enderror" name="ressource_nom[]" placeholder="Nom  ressource" value="{{ $resource->nom }}">
                                                                @error('ressource_nom.*')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                                <div class="form-group">
                                                                    <label for="ressource_description">{{ __('app.add') }}  {{ __('app.add') }}</label>
                                                                    <textarea class="form-control @error('ressource_description.*') is-invalid @enderror ckeditor-textarea" id="ressource_description" name="ressource_description[]" rows="3">{{ $resource->description }}</textarea>
                                                                    @error('ressource_description.*')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="ressource_link">{{ __('pkg_creation_projets/Projet.link') }}  {{ __('pkg_creation_projets/Resource.singular') }}</label>
                                                                    <input type="text" class="form-control @error('ressource_lien.*') is-invalid @enderror" id="ressource_link" name="ressource_lien[]" value="{{ $resource->lien }}">
                                                                    @error('ressource_lien.*')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="ressource mb-3">
                                                            <input type="text" class="form-control @error('ressource_nom.*') is-invalid @enderror" name="ressource_nom[]" placeholder="Nom  ressource">
                                                            @error('ressource_nom.*')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                            <div class="form-group">
                                                                <label for="ressource_description">{{ __('pkg_creation_projets/Projet.description') }}  {{ __('pkg_creation_projets/Resource.singular') }}</label>
                                                                <textarea class="form-control @error('ressource_description.*') is-invalid @enderror ckeditor-textarea" id="ressource_description" name="ressource_description[]" rows="3"></textarea>
                                                                @error('ressource_description.*')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="ressource_link">{{ __('pkg_creation_projets/Projet.link') }}  {{ __('pkg_creation_projets/Resource.singular') }}</label>
                                                                <input type="text" class="form-control @error('ressource_lien.*') is-invalid @enderror" id="ressource_link" name="ressource_lien[]">
                                                                @error('ressource_lien.*')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <button type="button" class="btn btn-primary mb-3" onclick="addRessource()">{{ __('app.add') }}  {{ __('pkg_creation_projets/Resource.singular') }}</button>

                                            </div>
                                        </div>

                                        <div class="step" id="step2" style="display:none;">
                                            <div id="competence-part" role="tabpanel" aria-labelledby="projet-part-trigger">
                                                <div class="form-group">
                                                    <h2>{{ __('pkg_competences/competence.plural') }}</h2>
                                                    <p> {{ __('app.select') }}    @php
                                                        // Generate the title using the title function
                                                        use App\helpers\TranslationHelper;
                                                        $lang = Config::get('app.locale');
                                                        $translatedName = TranslationHelper::getTitle(  __('pkg_competences/competence.plural'), $lang);
                                                        echo $translatedName;

                                                    @endphp     .</p>
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th>{{ __('pkg_competences/competence.plural') }}</th>
                                                            <th>{{ __('pkg_competences/technologie.plural') }}</th>
                                                            <th>{{ __('pkg_competences/appreciation.plural') }}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($competences as $competence)
                                                            <tr>
                                                                <td>
                                                                    <label>
                                                                        <input type="checkbox" class="mr-2" name="competences[]" id="competence_{{ $competence->id }}" value="{{ $competence->id }}" @if(isset($dataToEdit) && isset($dataToEdit->transfertCompetences)) @foreach($dataToEdit->transfertCompetences as $transfertCompetence) @if($transfertCompetence->competence_id == $competence->id) checked @endif @endforeach @endif>
                                                                        <i class="fas fa-{{ $competence->icon }}"></i>
                                                                        {{ $competence->nom }}
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <select name="technologie_ids[{{ $competence->id }}][]" id="technologie_{{ $competence->id }}" multiple>
                                                                        @foreach($technologies as $technology)
                                                                            <option value="{{ $technology->id }}"
                                                                                    @if(isset($dataToEdit) && isset($dataToEdit->transfertCompetences))
                                                                                        @foreach($dataToEdit->transfertCompetences as $transfertCompetence)
                                                                                            @if($transfertCompetence->competence_id == $competence->id && $transfertCompetence->technologies->contains($technology->id))
                                                                                                selected
                                                                                            @endif
                                                                                        @endforeach
                                                                                    @endif
                                                                            >
                                                                                {{ $technology->nom }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select name="competence_{{ $competence->id }}_appreciation">
                                                                        @foreach($appreciations as $appreciation)
                                                                            <option value="{{ $appreciation->id }}"
                                                                                    @if(isset($dataToEdit) && isset($dataToEdit->transfertCompetences))
                                                                                        @foreach($dataToEdit->transfertCompetences as $transfertCompetence)
                                                                                            @if($transfertCompetence->competence_id == $competence->id && $transfertCompetence->appreciation_id == $appreciation->id)
                                                                                                selected
                                                                                            @endif
                                                                                        @endforeach
                                                                                    @endif>
                                                                                {{ $appreciation->nom }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="step" id="step3" style="display:none;">
                                            <div id="affectation-part"  role="tabpanel"
                                                 aria-labelledby="affectation-part-trigger">
                                                <div class="d-flex flex-column mt-3 form-check">
                                                    <input type="checkbox" id="checkAll" class="form-check-input"
                                                           id="flexCheckIndeterminate">
                                                    <label class="form-check-label"
                                                           for="flexCheckIndeterminate">{{ __('app.checkall') }}<br>
                                                        <div class="row">
                                                            @foreach($apprenants as $apprenant)
                                                                <div class="col-sm-4 mb-2">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                               name="apprenants[]"
                                                                               value="{{ $apprenant->id }}"
                                                                               @if(isset($dataToEdit) && isset($dataToEdit->realisationProjets) && in_array($apprenant->id, $dataToEdit->realisationProjets->pluck('personne.id')->toArray())) checked @endif>
                                                                        <label class="form-check-label" for="{{ $apprenant->id }}">
                                                                            {{ $apprenant->nom }} {{ $apprenant->prenom }} ({{ $apprenant->type }})
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </label>
                                                </div>
                                                @error('apprenants')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <button type="button" id="prevBtn" class="btn btn-secondary" onclick="nextPrev(-1, event)">{{ __('app.Previous') }}</button>
                                        <button type="button" id="nextBtn" class="btn btn-primary" onclick="nextPrev(1, event)">{{ __('app.Next') }}</button>
                                        <button type="submit" id="submitBtn" class="btn btn-primary" style="display:none;">{{ __('app.Submit') }} </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var currentStep = 0;
    showStep(currentStep);

    function showStep(n) {
        var steps = document.getElementsByClassName("step");
        var totalSteps = steps.length;
        for (var i = 0; i < steps.length; i++) {
            steps[i].style.display = "none";
        }
        steps[n].style.display = "block";

        // Always show the Previous button, but change its function on the first step
        document.getElementById("prevBtn").style.display = "inline";
        if (n === 0) {
            document.getElementById("prevBtn").innerHTML = "{{ __('app.cancel') }}"; // or "Go Back", etc.
        } else {
            document.getElementById("prevBtn").innerHTML = "{{ __('app.back') }}";
        }

        // Adjust the Next/Submit button visibility
        if (n == totalSteps - 1) {
            document.getElementById("nextBtn").style.display = "none";
            document.getElementById("submitBtn").style.display = "inline";
        } else {
            document.getElementById("nextBtn").style.display = "inline";
            document.getElementById("submitBtn").style.display = "none";
        }
    }

    function nextPrev(n, event) {
        event.preventDefault(); // Prevent default form submission initially
        var steps = document.getElementsByClassName("step");
        var totalSteps = steps.length;

        // Validation check
        if (n == 1 && !validateForm()) return false;

        // Hide current step
        steps[currentStep].style.display = "none";

        // Decrement currentStep
        currentStep += n;

        // Redirect if trying to go back from the first step
        if (currentStep < 0) {
            window.location.href = '/projets'; // Change '/your-specific-route' to your desired URL
            return; // Stop further execution
        }

        // Check if it is the last step, then submit form
        if (currentStep >= totalSteps) {
            document.getElementById("regForm").submit(); // Submit the form
            return false;
        }

        // Otherwise, show the next step
        showStep(currentStep);
    }

    function validateForm() {
        // validation code here
        return true;
    }
</script>

<!-- Inclure le script -->
<script>
    function addLivraison() {
        // Create a new div to contain all inputs for a new livraison
        var livraisonDiv = document.createElement("div");
        livraisonDiv.classList.add("form-group", "livraison");

        // Create input for Nom de livrable
        var nomLabel = document.createElement("label");
        nomLabel.textContent = "Nom de livrable";

        var nomInput = document.createElement("input");
        nomInput.type = "text";
        nomInput.className = "form-control";
        nomInput.name = "livrable[]";
        nomInput.placeholder = "Nom de livrable";

        // Create select for livrable nature
        var natureLabel = document.createElement("label");
        natureLabel.textContent = "Nature  livrable";

        var natureSelect = document.createElement("select");
        natureSelect.className = "form-control";
        natureSelect.name = "livrable_nature[]";

        // Add options to the select
        @foreach($livrableNatures as $nature)
            var option = document.createElement("option");
            option.value = "{{ $nature->id }}";
            option.text = "{{ $nature->nom }}";
            natureSelect.appendChild(option);
        @endforeach

        var lienLabel = document.createElement("label");
        lienLabel.textContent = "Lien du livrable";

        var lienInput = document.createElement("input");
        lienInput.type = "url";
        lienInput.className = "form-control";
        lienInput.name = "livrable_link[]";
        lienInput.placeholder = "Lien du livrable";

        // Create textarea for livrable description
        var descriptionLabel = document.createElement("label");
        descriptionLabel.textContent = "Description  livrable";

        var descriptionTextarea = document.createElement("textarea");
        descriptionTextarea.classList.add("form-control", "livrableDescription", "ckeditor-textarea");
        descriptionTextarea.name = "livrable_description[]";
        descriptionTextarea.rows = "3";
        descriptionTextarea.placeholder = "Description  livrable";

        // Append all inputs to the livraisonDiv
        livraisonDiv.appendChild(nomLabel);
        livraisonDiv.appendChild(nomInput);

        livraisonDiv.appendChild(natureLabel);
        livraisonDiv.appendChild(natureSelect);
        livraisonDiv.appendChild(lienLabel);
        livraisonDiv.appendChild(lienInput);
        livraisonDiv.appendChild(descriptionLabel);
        livraisonDiv.appendChild(descriptionTextarea);

        // Append the livraisonDiv to the container
        document.getElementById("livrables-container").appendChild(livraisonDiv);
        ClassicEditor
            .create(descriptionTextarea)
            .catch(error => {
                console.error(error);
            });
    }
</script>
<script>
    function addRessource() {
        // Create a new div to contain all inputs for a new resource
        var ressourceDiv = document.createElement("div");
        ressourceDiv.classList.add("ressource");

        // Create label for resource name
        var nomLabel = document.createElement("label");
        nomLabel.textContent = "Nom  ressource";

        // Create input for resource name
        var nomInput = document.createElement("input");
        nomInput.type = "text";
        nomInput.className = "form-control";
        nomInput.name = "ressource_nom[]";
        nomInput.placeholder = "Nom  ressource";

        // Create label for resource link
        var lienLabel = document.createElement("label");
        lienLabel.textContent = "Lien  ressource";

        // Create input for resource link
        var lienInput = document.createElement("input");
        lienInput.type = "text";
        lienInput.className = "form-control";
        lienInput.name = "ressource_lien[]";
        lienInput.placeholder = "Lien  ressource";

        // Create label for resource description
        var descriptionLabel = document.createElement("label");
        descriptionLabel.textContent = "Description  ressource";

        // Create textarea for resource description
        var descriptionTextarea = document.createElement("textarea");
        descriptionTextarea.classList.add("form-control", "ckeditor-textarea");
        descriptionTextarea.name = "ressource_description[]";
        descriptionTextarea.rows = "3";
        descriptionTextarea.placeholder = "Description  ressource";

        // Append labels and inputs to the ressourceDiv
        ressourceDiv.appendChild(nomLabel);
        ressourceDiv.appendChild(nomInput);
        ressourceDiv.appendChild(lienLabel);
        ressourceDiv.appendChild(lienInput);
        ressourceDiv.appendChild(descriptionLabel);
        ressourceDiv.appendChild(descriptionTextarea);

        // Append the ressourceDiv to the container
        document.getElementById("ressources-container").appendChild(ressourceDiv);

        // Initialize CKEditor for the newly created textarea
        ClassicEditor
            .create(descriptionTextarea)
            .catch(error => {
                console.error(error);
            });
    }
</script>






<!-- Place the following <script> and <textarea> tags your HTML's <body> -->

<script>
    document.getElementById('checkAll').addEventListener('change', function () {
        var checkboxes = document.querySelectorAll('.form-check-input');  // Select all checkboxes
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = this.checked;  // Set checked state based on "checkAll"
        }
    });

</script>
<script>
    // Wait for the DOM content to be loaded
    document.addEventListener('DOMContentLoaded', function () {
        // Get the div element with id "step1"
        var step1Div = document.getElementById('step1');
        // Get all textarea elements within the div
        var textareas = step1Div.querySelectorAll('textarea');

        // Loop through each textarea and initialize CKEditor
        textareas.forEach(function (textarea) {
            ClassicEditor
                .create(textarea)
                .catch(error => {
                    console.error(error);
                });
                
        });
    });
    
</script>
@endsection
