<!-- Main Content -->
  <div class="main-content">
    <section class="section">
      <div class="section-header mb-3">
        <h1>Ganti Password</h1>
        <div class="section-header-breadcrumb">
        </div>
      </div>
      <div class="section-body">
        <p class="section-lead m-4">
        </p>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body text-center">
                <a href="#" class="btn btn-primary larger" data-toggle="modal" data-target="#changeModal">
                  <span>Ganti Password Akun</span>
                </a>
              </div>
            </div>
          </div>
        </div>
    </section>
  </div>
  <!-- Modal Change Pw -->
  <div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ganti Password?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form name='changepw' method='post' action="" enctype="multipart/form-data">
            <div class="form-group">
              <input type="password" class="form-control" id="password" name="password" aria-describedby="emailHelp" placeholder="Masukkan Password" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="simpan" class="btn btn-primary larger">Simpan</button>
        </div>
      </div>
      </form>
      <?php
      if (isset($_POST['simpan'])) {
        if (!empty($_POST['password'])) {
          $password = md5($_POST['password']);
          $sql = "update user set PASSWORD='" . $password . "' where NAMA like '" . $_SESSION['user'] . "'";
          $query = mysqli_query($conn, $sql);
          if ($query) {
            echo '<script>alert("Password Telah Berhasil Diganti");</script>';
          }
        } else {
          echo '<script>alert("Password Tidak Boleh Kosong")</script>';
        }
      }
      ?>
    </div>
  </div>