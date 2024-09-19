<!DOCTYPE html>
<html lang="fr">
<?php include_once "../../layouts/heade.php" ?>

<body class="sidebar-mini" style="height: auto;">

  <div class="wrapper">
    <!-- Navigation -->
    <?php include_once "../../layouts/nav.php" ?>
    <!-- Barre latérale -->
    <?php include_once "../../layouts/aside.php" ?>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <h1>Suivi de réalisation des projets</h1>
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
                <div class="col-md-3">
                  <select class="form-control-sm form-control" id="learner">
                    <option value="">Projets</option>
                    <option value="CNMH">CNMH</option>
                    <option value="SoliLMS">SoliLMS</option>
                    <option value="Prototype">Prototype</option>
                    <option value="Lab standard">Lab standard</option>
                    <option value="Lab autorisation">Lab autorisation</option>
                    <option value="CRUD REACTJS">CRUD REACTJS</option>
                    <option value="TODO list Kotlin">TODO list Kotlin</option>
                  </select>
                </div>
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 30%">Projet</th>
                      <th>Participants</th>
                      <th>Etat de réalisation</th>
                      <th>Début de réalisation</th>
                      <th>Fin de réalisation</th>
                      <!-- <th style="width: 40px">Label</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>CNMH</td>
                      <td>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          <span class="">Participants</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <span class="dropdown-item" href="#">Reda Grain</span>
                          <span class="dropdown-item" href="#">Adnan L'harrak</span>
                          <span class="dropdown-item" href="#">Yasmine Daifane</span>
                          <span class="dropdown-item" href="#">Safaa Faiz</span>
                        </div>
                      </td>
                      <td><span class="badge bg-info">Terminé</span></td>
                      <td>2024-06-05</td>
                      <td>2024-06-05</td>
                    </tr>
                    <tr>
                      <td>SoliLMS</td>
                      <td>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          <span class="">Participants</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <span class="dropdown-item" href="#">Amine lamchatab</span>
                          <span class="dropdown-item" href="#">Soufiane Boukhar</span>
                          <span class="dropdown-item" href="#">imrane Sarsri</span>
                        </div>
                      </td>
                      <td><span class="badge bg-success">En cours</span></td>
                      <td>2024-06-25</td>
                      <td>2024-06-28</td>
                    </tr>
                    <tr>
                      <td>Prototype</td>
                      <td>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          <span class="">Participants</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <span class="dropdown-item" href="#">Reda Grain</span>
                          <span class="dropdown-item" href="#">Adnan L'harrak</span>
                          <span class="dropdown-item" href="#">Yasmine Daifane</span>
                          <span class="dropdown-item" href="#">Safaa Faiz</span>
                        </div>
                      </td>
                      <td><span class="badge bg-secondary">En attente</span></td>
                      <td>2024-05-05</td>
                      <td>2024-06-20</td>
                    </tr>
                    <tr>
                      <td>CRUD Kotlin</td>
                      <td>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          <span class="">Participants</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <span class="dropdown-item" href="#">Reda Grain</span>
                          <span class="dropdown-item" href="#">Adnan L'harrak</span>
                          <span class="dropdown-item" href="#">Yasmine Daifane</span>
                          <span class="dropdown-item" href="#">Safaa Faiz</span>
                        </div>
                      </td>
                      <td><span class="badge bg-danger">Annulé</span></td>
                      <td>2024-05-05</td>
                      <td>2024-06-20</td>
                    </tr>
                    <tr>
                      <td>Lab standard</td>
                      <td>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          <span class="">Participants</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <span class="dropdown-item" href="#">Reda Grain</span>
                          <span class="dropdown-item" href="#">Adnan L'harrak</span>
                          <span class="dropdown-item" href="#">Yasmine Daifane</span>
                          <span class="dropdown-item" href="#">Safaa Faiz</span>
                        </div>
                      </td>
                      <td><span class="badge bg-info">Terminé</span></td>
                      <td>2024-12-05</td>
                      <td>2024-01-05</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              <div class="d-flex justify-content-end align-items-right p-2">
                <div class="mr-5">
                  <ul class="pagination m-0 float-right ">
                    <li class="page-item"><a class="page-link text-info" href="#">«</a></li>
                    <li class="page-item"><a class="page-link active bg-info" href="#">1</a></li>
                    <li class="page-item"><a class="page-link text-info" href="#">2</a></li>
                    <li class="page-item"><a class="page-link text-info" href="#">»</a></li>
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
<?php include_once "../../layouts/script-link.php"; ?>
<?php include_once "../../layouts/footer.php"; ?>

</html>