<!-- TODO : Organisation de menu package -->
<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>
            Accueil
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('formations.index') }}"
        class="nav-link {{ Request::is('formations*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-clipboard-list"></i>
        <p>
            Gestion des formations
        </p>
    </a>
</li>

@include('layouts.pkg_creation_projets.gestionprojets')

@include('layouts.pkg_rh.RHMenu')

@include('layouts.pkg_suivi.pkg_suivi')

@include('layouts.pkg_competences.CompetencesMenu')
{{-- @endcan --}}
