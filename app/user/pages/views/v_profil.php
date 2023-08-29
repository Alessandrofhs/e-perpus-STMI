<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Quicksand', sans-serif; font-weight: bold;">
            Profil Saya
            <small>
                <script type='text/javascript'>
                    var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
                    var date = new Date();
                    var day = date.getDate();
                    var month = date.getMonth();
                    var thisDay = date.getDay(),
                        thisDay = myDays[thisDay];
                    var yy = date.getYear();
                    var year = (yy < 1000) ? yy + 1900 : yy;
                    document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                    //
                </script>
            </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Profil Saya</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title" style="font-family: 'Quicksand', sans-serif; font-weight: bold;">Edit
                            Profil Saya</h3>
                    </div>
                    <!-- /.box-header -->
                    <form action="pages/function/Profile.php?aksi=edit" method="POST" enctype="multipart/form-data">
                        <?php
                        include "../../config/koneksi.php";

                        $id_user = $_SESSION['id_user'];
                        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'");
                        $row = mysqli_fetch_assoc($query);
                        ?>
                        <div class="box-body">
                            <input name="IdUser" type="hidden" value="<?= $row['id_user']; ?>">
                            <div class="form-group">
                                <label>Kode Anggota <small style="color: red;">* Tidak dapat dirubah</small></label>
                                <input type="text" class="form-control" value="<?= $row['kode_user']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label>NIM <small style="color: red;">* Wajib diisi</small></label>
                                <input type="text" class="form-control" value="<?= $row['nim']; ?>" name="nim" required>
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap <small style="color: red;">* Wajib diisi</small></label>
                                <input type="text" class="form-control" value="<?= $row['fullname']; ?>" name="Fullname"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Nama Pengguna <small style="color: red;">* Wajib diisi</small></label>
                                <input type="text" class="form-control" value="<?= $row['username']; ?>" name="Username"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Kata Sandi <small style="color: red;">* Wajib diisi</small></label>
                                <input type="text" class="form-control" value="<?= $row['password']; ?>" name="Password"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Program Studi <small style="color: red;">* Wajib diisi</small></label>
                                <select class="form-control" name="prodi">
                                    <?php
                                    if ($row['prodi'] == null) {
                                        echo "<option selected disabled>Silahkan pilih prodi dari [" . $row['fullname'] . "]</option>";
                                    } else {
                                        echo "<option selected value='" . $row['prodi'] . "'>" . $row['prodi'] . " ( Dipilih Sebelumnya )</option>";
                                    }
                                    ?>
                                    <option disabled>------------------------------------------</option>
                                    <option value="Sistem Informasi Industri Otomotif">
                                        Sistem Informasi Industri Otomotif
                                    </option>
                                    <option value="Teknik Rekayasa Otomotif">Teknik Rekayasa Otomotif
                                    </option>
                                    <option value="Teknik Industri Otomotif">Teknik Industri Otomotif
                                    </option>
                                    <option value="Administrasi
                                Bisnis Otomotif">Administrasi
                                        Bisnis Otomotif</option>
                                    <option value="Teknik Kimia Polimer">Teknik Kimia Polimer</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Alamat Lengkap <small style="color: red;">* Wajib diisi</small></label>
                                <textarea class="form-control" style="height: 80px; resize: none;" name="Alamat"
                                    required><?= $row['alamat']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Foto Profil</label>
                                <input type="file" name="ProfilePicture">
                                <p class="help-block">Upload a new profile picture.</p>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-block btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title" style="font-family: 'Quicksand', sans-serif; font-weight: bold;">Profil
                            Saya</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- Profile Picture -->
                        <?php
                        $profilePicture = $row['profile_picture']; // Get the profile picture from the $row
                        if (!empty($profilePicture)) {
                            // If profile picture is available, show it
                            echo '<img src="../../assets/dist/img' . $profilePicture . '" style="width: 125px; height: 125px; display: block; margin-left: auto; margin-right: auto; margin-top: -5px; margin-bottom: 15px; border-radius: 50%;" alt="Profile Picture">';
                        } else {
                            // If no profile picture, show default avatar
                            echo '<img src="../../assets/dist/img/avatar01.png" style="width: 125px; height: 125px; display: block; margin-left: auto; margin-right: auto; margin-top: -5px; margin-bottom: 15px; border-radius: 50%;" alt="Default Avatar">';
                        }
                        ?>
                        <!-- End of Profile Picture -->

                        <!-- Profile Information -->
                        <p style="font-weight: bold;">Kode Anggota : <?= $row['kode_user']; ?></p>
                        <p style="font-weight: bold;">NIM : <?= $row['nim']; ?></p>
                        <p style="font-weight: bold;">Nama Lengkap : <?= $row['fullname']; ?></p>
                        <p style="font-weight: bold;">Nama Pengguna : <?= $row['username']; ?></p>
                        <p style="font-weight: bold;">Kata Sandi : <?= $row['password']; ?></p>
                        <p style="font-weight: bold;">Program Studi : <?= $row['prodi']; ?></p>
                        <p style="font-weight: bold;">Alamat Lengkap : <?= $row['alamat']; ?></p>
                        <!-- End of Profile Information -->
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- jQuery 3 -->
<script src="../../assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../../assets/dist/js/sweetalert.min.js"></script>
<!-- Pesan Berhasil Edit -->
<script>
    <?php
    if (isset($_SESSION['berhasil']) && $_SESSION['berhasil'] <> '') {
        echo "swal({
            icon: 'success',
            title: 'Berhasil',
            text: '$_SESSION[berhasil]'
        })";
    }
    $_SESSION['berhasil'] = '';
    ?>
</script>
<!-- Pesan Gagal Edit -->
<script>
    <?php
    if (isset($_SESSION['gagal']) && $_SESSION['gagal'] <> '') {
        echo "swal({
                icon: 'error',
                title: 'Gagal',
                text: '$_SESSION[gagal]'
                })";
    }
    $_SESSION['gagal'] = '';
    ?>
</script>
<!-- Swal Hapus Data -->
<script>
    $('.btn-del').on('click', function (e) {
        e.preventDefault();
        const href = $(this).attr('href')

        swal({
            icon: 'warning',
            title: 'Peringatan',
            text: 'Apakah anda yakin ingin menghapus data administrator ini ?',
            buttons: true,
            dangerMode: true,
            buttons: ['Tidak, Batalkan !', 'Iya, Hapus']
        })
            .then((willDelete) => {
                if (willDelete) {
                    document.location.href = href;
                } else {
                    swal({
                        icon: 'error',
                        title: 'Dibatalkan',
                        text: 'Data administrator tersebut tetap aman !'
                    })
                }
            });
    })
</script>