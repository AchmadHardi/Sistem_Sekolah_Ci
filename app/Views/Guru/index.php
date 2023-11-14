<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <h1 class="h3 mb-0 text-gray-800"><?= $judul; ?></h1>

    <?php if (session()->get('message')) : ?>

        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Data Guru Berhasil<strong><?= session()->getFlashdata('message'); ?></strong>
        </div>

        <script>
            $(".alert").alert();
        </script>

    <?php endif; ?>

    <div class="row">
        <div class="col-md-6 mt-3">
            <?php
            if (session()->get("err")) {
                echo "<div class='alert alert-danger' role='alert'>" . session()->get('err') . "</div>";
            }
            ?>
        </div>
    </div>

    <div class="card mt-2">
        <div class="card-header">
            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                <i class="fa fa-plus">Tambah Data</i>
            </button>

        </div>
        <div class="card-body mt-2">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nip</th>
                        <th>Nama</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($guru as $row) : ?>
                        <tr>
                            <td scope="row"><?= $i; ?></td>
                            <td><?= $row['nip']; ?></td>
                            <td><?= $row['nama']; ?></td>
                            <td>
                                <button type="button" data-toggle="modal" data-target="#modalUbah" class="btn btn-sm btn-warning btn-edit" data-id="<?= $row['id']; ?>" data-nip="<?= $row['nip']; ?>" data-nama="<?= $row['nama']; ?>"> 
                                <i class="fa fa-edit"></i>
                                </button>

                                <button type="submit" class="btn btn-sm btn-danger btn-confirm-delete" data-id="<?= $row['id']; ?>">
                                    <i class="fa fa-trash-alt"></i>
                                </button>

                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
End of Main Content
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('guru/tambah') ?>" method="post">
                    <div class="form-group mb-0">
                        <label for="Nip"></label>
                        <input type="text" name="nip" id="tambah-nip" class="form-control" placeholder="Masukkan Nip">
                    </div>
                    <div class="form-group mb-0">
                        <label for="nama"></label>
                        <input type="text" name="nama" id="tambah-nama" class="form-control" placeholder="Masukkan Nama Guru">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah Data</button>
            </div>
        </div>
        </form>
    </div>
</div>

<!-- Modal Ubah -->
<div class="modal fade" id="modalUbah">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form method="post" action="<?= base_url('guru/ubah/')?>">
                    <input type="hidden" name="id" id="ubah-id">
                    <div class="form-group mb-0">
                        <label for="nip"></label>
                        <input type="text" name="nip" id="ubah-nip" class="form-control" placeholder="Masukkan Nip">
                    </div>
                    <div class="form-group mb-0">
                        <label for="nama"></label>
                        <input type="text" name="nama" id="ubah-nama" class="form-control" placeholder="Masukkan Nama Siswa">

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" onclick="submitUbahForm()" class="btn btn-primary">Ubah Data</button>
            </div>
        </form>
    </div>
</div>


<!-- <script>
    function submitUbahForm() {
        $('#formUbah').submit();
    }
</script>
 -->


<!-- <script>
    // Menangani klik pada tombol "Edit"
    $('body').on('click', '.btn-edit', function() {
        // Mengambil nilai atribut data dari tombol yang diklik

        var nisn = $(this).data('nisn');
        var nama = $(this).data('nama');

        // Mengisi nilai ke dalam form modal

        $('#ubah_nisn').val(nisn);
        $('#ubah_nama').val(nama);

        // Menampilkan modal "Ubah"
        $('#modalUbah').modal('show');
    });
</script> -->
<!-- Include jQuery library if not already included -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    // Menangani klik pada tombol "Delete" dengan konfirmasi
    $('body').on('click', '.btn-confirm-delete', function() {
        // Mengambil nilai atribut data dari tombol yang diklik
        var id = $(this).data('id');

        // Menampilkan konfirmasi dialog
        if (confirm("Yakin ingin menghapus data Guru?")) {
            // Jika dikonfirmasi, redirect ke link hapus
            window.location.href = '/guru/hapus/' + id;
        }
    });
</script>
<script>
    // Menangani klik pada tombol "Edit"
    $(".btn-edit").click(function(){
        $('#ubah-id').val('');
        $('#ubah-nip').val('');
        $('#ubah-nama').val('');
        // Mengambil nilai atribut data dari tombol yang diklik
        var id = $(this).data('id');
        var nip = $(this).data('nip');
        var nama = $(this).data('nama');

        // Mengisi nilai ke dalam form modal Ubah
        $('#ubah-id').val(id);
        $('#ubah-nip').val(nip);
        $('#ubah-nama').val(nama);
        // Menampilkan modal "Ubah"
        // $('#modalUbah').modal('show');
    });

    // Function to submit the form for editing
    function submitUbahForm() {
        $('#formUbah').submit();
    }
</script>
