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
              <h1>Les réalisations</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Contenu principal -->
      <section class="content">
        <div class="container-fluid">
          <div class="col-12">
            <!-- Boîte par défaut -->
            <div class="card">
              <!-- Card from second design -->

              <div class="card-header col-md-12">
              <h3 class="card-title">Tableau des réalisations</h3>

              </div>
              <div class="card-body">
              <div class=" p-0 mb-3">
                  <form>
                    <div class="form-row">
                      <div class="col-md-2">
                        <select class="form-control-sm form-control" id="skill">
                          <option value="">Competences</option>
                          <option value="C1">Maquetter une application mobile</option>
                          <option value="C2">Manipuler une base de données - perfectionnement</option>
                          <option value="C3">Développer la partie back-end d’une application web ou web mobile -
                            perfectionnement</option>
                          <option value="C4">Collaborer à la gestion d’un projet informatique et à l’organisation de
                            l’environnement de développement - perfectionnement</option>
                          <option value="C5">Développer une application mobile native, avec Android et React Native
                          </option>
                          <option value="C6">Préparer et exécuter les plans de tests d’une application</option>
                          <option value="C7">Préparer et exécuter le déploiement d’une application web et mobile -
                            perfectionnement</option>
                        </select>
                      </div>
                      <div class="col-md-2">
                        <select class="form-control-sm form-control" id="project">
                          <option value="">Projets</option>
                          <option value="Lab-Markdown">Lab-Markdown</option>
                          <option value="Lab-Github">Lab-Github</option>
                          <option value="lab-présentation">lab-présentation</option>
                          <option value="Lab-debug-laravel">Lab-debug-laravel</option>
                          <option value="Lab-crud-basic">Lab-crud-basic</option>
                          <option value="Lab-crud-standard">Lab-crud-standard</option>
                          <option value="Lab-authentification basic">Lab-authentification basic</option>
                          <option value="Lab-starter">Lab-starter</option>
                          <option value="Lab-authentification-standard">Lab-authentification-standard</option>
                          <option value="Lab-autorisation-basic">Lab-autorisation-basic</option>
                          <option value="Lab-autorisation-standard">Lab-autorisation-standard</option>
                          <option value="Lab-deploiement">Lab-deploiement</option>
                          <option value="Prototype">Prototype</option>
                        </select>
                      </div>
                      <div class="col-md-2">
                        <select class="form-control-sm form-control" id="etat">
                          <option value="">États</option>
                          <option value="à faire">à faire</option>
                          <option value="en cours">en cours</option>
                          <option value="en pause">en pause</option>
                          <option value="terminé">terminé</option>
                        </select>
                      </div>
                      <div class="col-md-3">
                        <select class="form-control-sm form-control" id="learner">
                          <option value="">Apprenants</option>
                          <option value="sarsri imrane">Sarsri Imrane</option>
                          <option value="Grain Reda">Grain Reda</option>
                          <option value="Bouik Hussein">Bouik Hussein</option>
                          <option value="Assaid Amina">Assaid Amina</option>
                          <option value="zaani hamza">Zaani Hamza</option>
                          <option value="FAIZ SAFAA">Faiz Safaa</option>
                          <option value="El ajoumi Mohammed aymane">El Ajoumi Mohammed Aymane</option>
                          <option value="Lharrak Adnan">Lharrak Adnan</option>
                          <option value="YASMINE DAIFANE">Yasmine Daifane</option>
                          <option value="BEN NASAR ADNAN">Ben Nasar Adnan</option>
                          <option value="Achaou Hamid">Achaou Hamid</option>
                          <option value="Betroji Jalil">Betroji Jalil</option>
                          <option value="lamchatab amine">Lamchatab Amine</option>
                          <option value="Boukhar Soufiane">Boukhar Soufiane</option>
                        </select>
                      </div>
                    </div>
                  </form>
                </div>
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Brief</th>
                      <th>Apprenants</th>
                      <th>Etat de réalisation</th>
                      <th>Etat de validation</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="nom-brief">Lab-Markdown</td>
                      <td class="apprenants">Hussein </td>
                      <td class="etat">
                        <span class="badge badge-success">Terminer</span>
                      </td>
                      <td class="etat">
                        <span class="badge badge-success">Validé</span>
                      </td>
                      <td class='actions'>
                        <a href="./valider.php" class="btn btn-success btn-sm">
                          <i class="fas fa-check"></i> Valider
                        </a>
                      </td>

                      <td >
                                            <a href="./show.php" class="btn btn-default btn-sm">
                                                <i class="far fa-eye"></i>
                                            </a>
    
                                      
                                    </td>
                    </tr>
                    <tr>
                      <td class="nom-brief">lab-crud-standard</td>
                      <td class="apprenants">Sohaibe</td>
                      <td class="etat">
                        <span class="badge badge-info">En cours</span>
                      </td>
                      <td class="etat">
                        <span class="badge badge-secondary">-</span>
                      </td>

                      <td class='actions'>
                        <a href="./valider.php" class="btn btn-success btn-sm">
                          <i class="fas fa-check"></i> Valider
                        </a>
                      </td>
                      <td >
                                            <a href="./show.php" class="btn btn-default btn-sm">
                                                <i class="far fa-eye"></i>
                                            </a>
    
                                      
                                    </td>
                    </tr>
                    <tr>
                      <td class="nom-brief">lab-rapport</td>
                      <td class="apprenants">Oussama</td>
                      <td class="etat">
                        <span class="badge badge-warning">En pause </span>
                      </td>
                      <td class="etat">
                        <span class="badge badge-secondary">-</span>
                      </td>

                      <td class='actions'>
                        <a href="./valider.php" class="btn btn-success btn-sm">
                          <i class="fas fa-check"></i> Valider
                        </a>
                      </td>
                      <td >
                                            <a href="./show.php" class="btn btn-default btn-sm">
                                                <i class="far fa-eye"></i>
                                            </a>
    
                                      
                                    </td>
                    </tr>
                    <tr>
                      <td class="nom-brief">lab-autorisation</td>
                      <td class="apprenants">saif</td>
                      <td class="etat">
                        <span class="badge badge-secondary">A faire</span>
                      </td>
                      <td class="etat">
                        <span class="badge badge-secondary">-</span>
                      </td>
                      <td class='actions'>
                        <a href="./valider.php" class="btn btn-success btn-sm">
                          <i class="fas fa-check"></i> Valider
                        </a>
                      </td>

                      <td >
                                            <a href="./show.php" class="btn btn-default btn-sm">
                                                <i class="far fa-eye"></i>
                                            </a>
    
                                      
                                    </td>
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <div class="d-flex justify-content-between align-items-center p-2">
                <div class="d-flex align-items-center mb-2">
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="fas fa-download"></i> IMPORT
                  </button>
                  <button type="button" class="btn btn-default btn-sm mt-0 mx-2">
                    <i class="fas fa-upload"></i> EXPORT
                  </button>
                </div>
                <div class="mr-5">
                  <ul class="pagination  m-0 float-right">
                    <li class="page-item"><a class="page-link" href="#">«</a></li>
                    <li class="page-item"><a class="page-link active" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">»</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- /.card-footer-->
          </div>
          <!-- /.card -->
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