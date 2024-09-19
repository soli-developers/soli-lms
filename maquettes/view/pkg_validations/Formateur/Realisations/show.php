<!DOCTYPE html>
<html lang="fr">
<?php include_once "../../../layouts/heade.php" ?>

<body class="sidebar-mini" style="height: auto;">

  <div class="wrapper">
    <!-- Navigation -->
    <?php include_once "../../../layouts/nav.php" ?>
    <!-- Barre latérale -->
    <?php include_once "../../../layouts/aside.php" ?>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Détails de la réalisation</h1>
            </div>
            <div class="col-sm-6">
              <a href="#" class="btn btn-default float-right">
                <i class="far fa-edit"></i>
               annuler
              </a>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Contenu principal -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="col-sm-12">
                    <label for="titre">Titre du projet:</label>
                    <p>Développement d'une application web</p>
                  </div>

                  <div class="col-sm-12">
                    <label for="description">Description du projet:</label>
                    <p>
                      Création d'une application web permettant de gérer les formations et les évaluations
                      des apprenants.
                    </p>
                  </div>

                  <div class="col-sm-12">
                    <label for="nom">Nom de l'apprenant:</label>
                    <p>Sarsri Imrane</p>
                  </div>
                  <div class="col-sm-12">
                    <label for="prenom">Prénom de l'apprenant:</label>
                    <p>Imrane</p>
                  </div>

                  <div class="col-sm-12">
                    <label for="livrables">Livrables:</label>
                    <ul class="list-group list-group-horizontal d-flex flex-row">
                      <li class="list-group-item mr-2">
                        <strong>Maquette de l'application</strong>
                        <a href="https://www.figma.com/file/XXXXXX">
                          <i class="fab fa-figma"></i> Figma
                        </a>
                      </li>
                      <li class="list-group-item mr-2">
                        <strong>Code source</strong>
                        <a href="https://github.com/XXXXXX">
                          <i class="fab fa-github"></i> Github
                        </a>
                      </li>
                    </ul>
                  </div>

                  <div class="col-sm-12 mt-4">
                    <div class="row">
                      <div class="col-md-12 mb-3">
                        <div class="card p-3">
                          <div class="row">
                            <div class="col-md-4">
                              <p><strong>Compétence</strong> Maquetter une application mobile</p>
                            </div>
                            <div class="col-md-3">
                              <p><strong>Appréciation</strong> Excellente</p>
                            </div>
                            <div class="col-md-2">
                              <p><strong>Note</strong> 18/20</p>
                            </div>
                            <div class="col-md-3">
                              <p><strong>Titre du message:</strong>  Très bon travail</p>
                              <p><strong>Description du message:</strong> La maquette est très bien réalisée et
                                répond aux exigences du cahier des charges.
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12 mb-3">
                        <div class="card p-3">
                          <div class="row">
                            <div class="col-md-4">
                              <p><strong>Compétence</strong> Manipuler une base de données - perfectionnement</p>
                            </div>
                            <div class="col-md-3">
                              <p><strong>Appréciation</strong> Bonne</p>
                            </div>
                            <div class="col-md-2">
                              <p><strong>Note</strong> 15/20</p>
                            </div>
                            <div class="col-md-3">
                              <p><strong>Titre du message:</strong>  Bon travail</p>
                              <p><strong>Description du message:</strong>  La base de données est bien conçue et
                                fonctionnelle.
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>

  </div>
</body>

<!-- get script -->
<?php include_once "../../../layouts/script-link.php"; ?>

</html>