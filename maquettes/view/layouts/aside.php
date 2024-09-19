<?php
$current_route = $_SERVER['REQUEST_URI'];
?>
<aside class="main-sidebar sidebar-dark-info elevation-4 position-fixed">
  <!-- Logo de la marque -->
  <a href="/view/home.php" class="brand-link">
    <img src="/view/assets/images/logo.png" class="brand-image img-circle elevation-3" alt="Image de groupe">
    <span class="brand-text font-weight-light text-center h6">Solicode LMS</span>
  </a>

  <!-- Barre latérale -->
  <div class="sidebar">
    <!-- Menu latéral -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php
        if (isset($_SESSION['email']) && $_SESSION['email'] === 'formateur@solicode.com') {
          ?>
          <li class="nav-item">
            <a href="/view/home.php"
              class="nav-link <?php echo (strpos($current_route, 'home') !== false) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Accueil
              </p>
            </a>
          </li>
         
          <li class="nav-item has-treeview">
            <a href="#"
              class="nav-link <?php echo (strpos($current_route, 'Gestion des briefs') !== false) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-project-diagram"></i>
              <p>
                Gestion des briefs
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/view/GestionBriefProjet/Formateur/GestionBriefs/index.php"
                  class="nav-link <?php echo (strpos($current_route, 'Briefs') !== false) ? 'active' : ''; ?>">
                  <i class="far fa-file-alt nav-icon"></i>
                  <p>Briefs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/view/pkg_validations/Formateur/Realisations/index.php"
                  class="nav-link <?php echo (strpos($current_route, 'Réalisations') !== false) ? 'active' : ''; ?>">
                  <i class="far fa-chart-bar nav-icon"></i>
                  <p>Réalisations</p>
                </a>
              </li>
            </ul>
          </li>

        <!-- Gestion RH -->
        <li class="nav-item has-treeview">
          <a href="#"
            class="nav-link <?php echo (strpos($current_route, 'pkg rh') !== false) ? 'active' : ''; ?>">
            <i class="fa-solid fa-people-group"></i>
            <p>
              Gestion RH
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/view/pkg_rh/Formateur/index.php"
                class="nav-link <?php echo (strpos($current_route, 'Formateur') !== false) ? 'active' : ''; ?>">
                <i class="fa-solid fa-chalkboard-user"></i>
                <p>Gestion Formateurs</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/view/pkg_rh/Apprenant/index.php"
                class="nav-link <?php echo (strpos($current_route, 'Apprenant') !== false) ? 'active' : ''; ?>">
                <i class="fa-solid fa-users"></i>
                <p>Gestion Apprenants</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/view/pkg_rh/Ville/index.php"
                class="nav-link <?php echo (strpos($current_route, 'Ville') !== false) ? 'active' : ''; ?>">
                <i class="fa-solid fa-city"></i>
                <p>Gestion Villes</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/view/pkg_rh/Groupe/index.php"
                class="nav-link <?php echo (strpos($current_route, 'Groupe') !== false) ? 'active' : ''; ?>">
                <i class="fa-solid fa-table"></i>
                <p>Gestion Groupes</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/view/pkg_rh/NiveauxScolaire/index.php"
                class="nav-link <?php echo (strpos($current_route, 'NiveauxScolaire') !== false) ? 'active' : ''; ?>">
                <i class="fa-solid fa-book"></i>
                <p>Gestion Niveaux Scolaire</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/view/pkg_rh/Specialite/index.php"
                class="nav-link <?php echo (strpos($current_route, 'Specialite') !== false) ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-th"></i>
                <p>Gestion Spécialité</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- Suivi d'avencement START -->
        <li class="nav-item has-treeview">
          <a href="#"
            class="nav-link <?php echo (strpos($current_route, "Suivi d'avencement") !== false) ? 'active' : ''; ?>">
            <i class="fa-solid fa-signal"></i>
            <p>
              Suivi d'avencement
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./pkg_suivi/Formateur/SuiveCompetences.php"
                class="nav-link <?php echo (strpos($current_route, 'Suivi des compétences') !== false) ? 'active' : ''; ?>">
                <i class="fa-solid  fa-star"></i>
                <p>Suivi des compétences</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./pkg_suivi/Formateur/SuiveProjets.php"
                class="nav-link <?php echo (strpos($current_route, 'Suivi des projets') !== false) ? 'active' : ''; ?>">
                <i class="fa-solid fa-folder-open"></i>
                <p>Suivi des projets</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Suivi d'avencement END -->

        <!-- Authorisation -->
        <li class="nav-item has-treeview">
          <a href="#"
            class="nav-link <?php echo (strpos($current_route, 'autorisation') !== false) ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-user-lock"></i>
            <p>
              Autorisations
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/view/autorisation/Autorisations/index.php"
                class="nav-link <?php echo (strpos($current_route, 'Autorisations') !== false) ? 'active' : ''; ?>">
                <i class="far fa-check-circle nav-icon"></i>
                <p>Autorisation</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{" rooute('roles.index)"}}"
                class="nav-link {{ Request::routeIs('roles.inedx') ? 'active' : '' }}">
                <i class="far fa-user-circle nav-icon"></i>
                <p>Rôle</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/view/autorisation/Controllers/index.php"
                class="nav-link <?php echo (strpos($current_route, 'Controllers') !== false) ? 'active' : ''; ?>">
                <i class="fas fa-gamepad nav-icon"></i>
                <p>Controllers</p>
              </a>
            </li>
            <li class="nav-item ">
              <a href="/view/autorisation/Actions/index.php"
                class="nav-link <?php echo (strpos($current_route, 'Actions') !== false) ? 'active' : ''; ?>">
                <i class="fas fa-cogs nav-icon"></i>
                <p>Actions</p>
              </a>
            </li>
          </ul>
        </li>
              <?php
        } elseif (isset($_SESSION['email']) && $_SESSION['email'] === 'formateur@solicode.com') {
          ?>
              <li class="nav-item">
                <a href="/view/GestionBriefProjet/Apprenant/index.php" class="nav-link listBriefFormateur">
                  <i class="fa-solid fa-list-check"></i>
                  <p>Mes Projets</p>
                </a>
              </li>

            <?php 
        }elseif(isset($_SESSION['email']) && $_SESSION['email'] === 'ResponsableFormation@solicode.com'){
          ?>
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/view/GestionCompetences/Modules/index.php" class="nav-link">
                        <i class="fas fa-table nav-icon"></i>
                        <p>Modules</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/view/GestionCompetences/Competences/index.php" class="nav-link">
                        <i class="fas fa-tasks nav-icon"></i>
                        <p>Compétence</p>
                    </a>
                </li>
            </ul>
          <?php
        }
        ?>

          </ul>
        </li>

      

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>