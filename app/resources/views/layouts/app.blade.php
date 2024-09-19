<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SoliLMS') }}</title>

    <!-- TODO : à importer dans app.css -->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    {{-- @vite(['resources/css/pkg_creation_projets/pkg_creation_projets.css', 'resources/js/pkg_creation_projets/pkg_creation_projets.js']) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Main Header -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('images/man.png') }}" class="user-image img-circle elevation-2"
                            alt="User Image">
                        <!-- <span class="d-none d-md-inline"></span> -->
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-info">
                            <img src="{{ asset('images/man.png') }}" class="user-image img-circle elevation-2"
                                alt="User Image">
                            <!--  <p>

                                <small>Member since </small>
                            </p> -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                            <a href="#" class="btn btn-default btn-flat float-right"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                se déconnecter
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Main Footer -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <strong>Droits d'auteur © 2023-2024 <a href="#" class="text-info">SoliLMS</a>.</strong> Tous droits
            réservés.
        </footer>
    </div>
    <script>
        let tableForm = document.getElementById('tableForm');

        function showLoading() {
            if (tableForm) {
                let loadingDiv = document.createElement('div');
                loadingDiv.id = 'loading';
                loadingDiv.innerHTML = '<div class="spinner"></div>';
                tableForm.appendChild(loadingDiv);
            }else{
                return false;
            }
        }
        function hideLoading() {
            let loadingDiv = document.getElementById('loading');
            loadingDiv.remove();
        }


        // Add functionality for "Add Another Deliverable" button
        const addDeliverableButton = document.getElementById("addDeliverable");
        const deliverableForm = document.getElementById("deliverableForm");

        addDeliverableButton.addEventListener("click", function () {
            // Clone the existing deliverable group (including all its inputs)
            const newDeliverableGroup = deliverableForm.querySelector(".deliverable-group").cloneNode(true);

            // Clear the values of the cloned inputs to avoid pre-filled data
            newDeliverableGroup.querySelector("input").value = "";

            // Append the cloned group to the form
            deliverableForm.appendChild(newDeliverableGroup);
        });
    </script>
    <!-- Inclure le script -->

    <script>
        function addInput() {
            // Create a new input element
            var input = document.createElement("input");
            input.type = "text";
            input.className = "form-control mb-3";
            input.name = "deliverable[]"; // Using array syntax for form submission
            input.placeholder = "Nom de livrable";

            // Append the new input to the container
            document.getElementById("deliverables-container").appendChild(input);
        }
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#inputDescription'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#inputTravailafaire'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#inputcriterevalidation'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>

        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })
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
    CKEDITOR.replace('editor');
</script>
    <script>
        // Get references to elements
        const addLinkButtons = document.querySelectorAll('.add-link-btn');
        const resourceList = document.querySelector('.resource-list');
        const referenceList = document.querySelector('.reference-list');

        // Function to add a new link
        function addNewLink(event) {
            const newLinkInput = event.target.parentElement.parentElement.querySelector('.new-link-input');
            const newLinkValue = newLinkInput.value.trim();
            const targetList = event.target.parentElement.parentElement.nextElementSibling;

            if (newLinkValue) {
                const linkedItem = document.createElement('li');
                linkedItem.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');

                const linkText = document.createElement('span');
                linkText.textContent = newLinkValue;

                const removeLinkBtn = document.createElement('button');
                removeLinkBtn.classList.add('btn', 'btn-sm', 'btn-danger');
                removeLinkBtn.textContent = 'Remove';
                removeLinkBtn.addEventListener('click', function () {
                    targetList.removeChild(linkedItem);
                });

                linkedItem.appendChild(linkText);
                linkedItem.appendChild(removeLinkBtn);

                targetList.appendChild(linkedItem);

                newLinkInput.value = '';
            }
        }

        // Add event listeners to the "Add Link" buttons
        addLinkButtons.forEach(button => button.addEventListener('click', addNewLink));

        // Populate existing links based on your project data
        const existingResources = [
            { url: "https://grafikart.fr/formations/laravel", text: "https://grafikart.fr/formations/laravel" },
            { url: "https://laracasts.com/series/phpunit-testing-in-laravel", text: "https://laracasts.com/series/phpunit-testing-in-laravel" },
        ];

        const existingReferences = [
            { url: "https://www.figma.com/file/Aciw4FSMe0rRsC3x1LH3R1/biblioth%C3%A8que-website?type=design&node-id=55%3A344&mode=design&t=bXJnh73iQoHkdkdj-1", text: "https://www.figma.com/file/Aciw4FSMe0rRsC3x1LH3R1/biblioth%C3%A8que-website?type=design&node-id=55%3A344&mode=design&t=bXJnh73iQoHkdkdj-1" },
            { url: "https://m3.material.io/", text: "https://m3.material.io/" },
        ];

        // Function to populate existing links (optional)
        function populateExistingLinks(linkData, targetList) {
            linkData.forEach(link => {
                const linkedItem = document.createElement('li');
                linkedItem.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');

                const linkText = document.createElement('span');
                linkText.textContent = link.text;

                const removeLinkBtn = document.createElement('button');
                removeLinkBtn.classList.add('btn', 'btn-sm', 'btn-danger');
                removeLinkBtn.textContent = 'Remove';
                removeLinkBtn.addEventListener('click', function () {
                    targetList.removeChild(linkedItem);
                });

                linkedItem.appendChild(linkText);
                linkedItem.appendChild(removeLinkBtn);
                targetList.appendChild(linkedItem);
            });
        }

        populateExistingLinks(existingResources, resourceList);
        populateExistingLinks(existingReferences, referenceList);
    </script>

</body>

</html>
