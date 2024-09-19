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
              <h1>Suivi d'avencement des compétences</h1>
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
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 30%">Apprenants</th>
                      <th title="Maquetter une application mobile">C1</th>
                      <th title="Manipuler une base de données">C2</th>
                      <th title="Développer la partie back-end d'une application web ou web mobile">C3</th>
                      <th title="Collaborer à la gestion d'un projet informatique et à l'organisation de l'environnement de développement">C4</th>
                      <th title="Développer une application mobile native, avec Android et React Native">C5</th>
                      <th title="Préparer et exécuter les plans de tests d'une application">C6</th>
                      <!-- <th style="width: 40px">Label</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Adnan l'harrak</td>
                      <td><span class="badge bg-warning">Insuffisant</span></td>
                      <td><span class="badge bg-info">Passable</span></td>
                      <td><span class="badge bg-info">Passable</span></td>
                      <td><span class="badge bg-secondary">Aucun</span></td>
                      <td><span class="badge bg-info">Passable</span></td>
                      <td><span class="badge bg-success">Très bien</span></td>
                    </tr>
                    <tr>
                      <td>Achaou Hamid</td>
                      <td><span class="badge bg-secondary">Aucun</span></td>
                      <td><span class="badge bg-warning">Insuffisant</span></td>
                      <td><span class="badge bg-info">Passable</span></td>
                      <td><span class="badge bg-success">Très bien</span></td>
                      <td><span class="badge bg-info">Passable</span></td>
                      <td><span class="badge bg-info">Passable</span></td>
                    </tr>
                    <tr>
                      <td>Lamchatab Amine</td>
                      <td><span class="badge bg-secondary">Aucun</span></td>
                      <td><span class="badge bg-secondary">Aucun</span></td>
                      <td><span class="badge bg-success">Très bien</span></td>
                      <td><span class="badge bg-success">Très bien</span></td>
                      <td><span class="badge bg-info">Passable</span></td>
                      <td><span class="badge bg-info">Passable</span></td>
                    </tr>
                    <tr>
                      <td>Hamza Zaani</td>
                      <td><span class="badge bg-secondary">Aucun</span></td>
                      <td><span class="badge bg-secondary">Aucun</span></td>
                      <td><span class="badge bg-secondary">Aucun</span></td>
                      <td><span class="badge bg-info">Passable</span></td>
                      <td><span class="badge bg-info">Passable</span></td>
                      <td><span class="badge bg-info">Passable</span></td>
                    </tr>

                    <tr>
                      <td>Yasmine Daifane</td>
                      <td><span class="badge bg-info">Passable</span></td>
                      <td><span class="badge bg-info">Passable</span></td>
                      <td><span class="badge bg-secondary">Aucun</span></td>
                      <td><span class="badge bg-secondary">Aucun</span></td>
                      <td><span class="badge bg-info">Passable</span></td>
                      <td><span class="badge bg-secondary">Aucun</span></td>
                    </tr>

                    <tr>
                      <td>Grain Reda</td>
                      <td><span class="badge bg-success">Très bien</span></td>
                      <td><span class="badge bg-info">Passable</span></td>
                      <td><span class="badge bg-info">Passable</span></td>
                      <td><span class="badge bg-secondary">Aucun</span></td>
                      <td><span class="badge bg-info">Passable</span></td>
                      <td><span class="badge bg-secondary">Aucun</span></td>
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