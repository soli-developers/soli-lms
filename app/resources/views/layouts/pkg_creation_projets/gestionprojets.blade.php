<li class="nav-item has-treeview">
    <a href="#"
      class="nav-link ">
      <i class="nav-icon fas fa-project-diagram"></i>
      <p>
        Gestion des briefs
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
        @can('index-ProjetController')
        <li class="nav-item">
            <a href="{{ route('projets.index') }}"
                class="nav-link {{ Request::is('projets*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-table"></i>
                <p>
                    Projets
                </p>
            </a>
        </li>
        @endcan
        <li class="nav-item">
        <a href="{{ route('realisationProjets.index') }}"
          class="nav-link  {{ Request::is('realisationProjets*') ? 'active' : '' }}">
          <i class="far fa-chart-bar nav-icon"></i>
          <p>Réalisations</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('apprenantRealisations.index') }}"
          class="nav-link  {{ Request::is('realisationProjets*') ? 'active' : '' }}">
          <i class="far fa-chart-bar nav-icon"></i>
          <p>Réalisations</p>
        </a>
      </li>
    </ul>
  </li>


