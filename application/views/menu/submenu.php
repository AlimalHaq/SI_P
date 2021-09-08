<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg">
            <?php
            $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $uri_segments = explode('/', $uri_path);

            $urlLast = end($uri_segments);
            echo $urlLast;
            ?>
            <?= $this->session->flashdata('message'); ?>

            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <!-- Modal Add SubMenu -->
            <div class="card shadow mb-4" id="AddSubMenu">
                <div class="card-header">
                    <h5 class="modal-title font-weight-bold" id="newSubMenuModalLabel">Add New Sub Menu</h5>
                </div>
                <?php $format = htmlspecialchars("<iframe width='100%' height='315' src='alamatwebsite'></iframe> "); ?>
                <form action="<?= base_url('menu/submenu'); ?>" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="mb-3 row">
                                <label for="title" class="col-sm-2 col-form-label">Judul sub menu</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Sub Menu title" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="mb-3 row">
                                <label for="menu_id" class="col-sm-2 col-form-label">Pilih menu</label>
                                <div class="col-sm-10">
                                    <select name="menu_id" id="menu_id" class="form-control" required>
                                        <option value="">Select Menu</option>
                                        <?php foreach ($menu as $m) : ?>
                                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check" id="myCheck">
                                <input type="checkbox" class="form-check-input" value="1" name="link_ext" id="link_ext" onclick="myFunction()">
                                <label class="form-check-label" for="link_ext">
                                    External Link?
                                </label>
                            </div>
                            <div class="mb-3 row">
                                <label for="url" class="col-sm-2 col-form-label">Alamat sub menu</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="url" name="url" placeholder="Sub Menu url">
                                    <small id="urlExtLink" class="text-danger" style="display: none;">*isi Alamat sub menu url harus menggunakan format berdasarkan Menu yang dipilih seperti Menu/extlink Contoh "report/extlink"!</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="display: none;" id="urlExtLinkNote">
                            <div class="mb-3 row">
                                <label for="urlExt" class="col-sm-2 col-form-label">Konten external link</label>
                                <div class="col-sm-10">
                                    <textarea name="urlExt" id="urlExt" class="form-control" rows="5" placeholder="Teks"></textarea>
                                    <small class="text-danger">*untuk menyematkan website gunakan format seperti ini : <b> <?= $format; ?>.</b> Untuk melihat detail klik icon source code(<i class="fa fa-code"></i>) </small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="mb-3 row">
                                <label for="icon" class="col-sm-2 col-form-label">Icon sub menu</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="icon" name="icon" placeholder="Sub Menu icon" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-grop">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" value="1" name="is_active" id="is_active" checked>
                                <label class="form-check-label" for="is_active">
                                    Active?
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                        <button type="button" id="cancel" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
            <div id="btnAdd">
                <a href="" id="BtnAddSubMenu" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Add New Submenu</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover" id="dataTables" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Url</th>
                            <th scope="col">Url External</th>
                            <th scope="col">Icon</th>
                            <th scope="col">Active</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($subMenu as $sm) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $sm['title']; ?></td>
                                <td><?= $sm['menu']; ?></td>
                                <td><?= $sm['url']; ?></td>
                                <?php $link = substr($sm['url_ext'], 0, 50); ?>
                                <td><?= htmlspecialchars($link); ?>...</td>
                                <td><?= $sm['icon']; ?></td>
                                <td><?= $sm['is_active']; ?></td>
                                <td>
                                    <a href="" class="badge badge-info" data-toggle="modal" data-target="#editModal<?= $sm['id']; ?>">Edit</a>
                                    <a href="" class="badge badge-danger" data-toggle="modal" data-target="#delModal<?= $sm['id']; ?>">Delete</a>
                                </td>
                            </tr>
                            <!-- Edit Modal-->
                            <div class="modal fade" id="editModal<?= $sm['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editMenuModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editMenuModalLabel">Edit Sub Menu</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="<?= base_url('menu/submenuUpdt/') . $sm['id']; ?>" method="post">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <div class="mb-3 row">
                                                        <label for="title" class="col-sm-2 col-form-label">Judul sub menu</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="title" value="<?= $sm['title'] ?>" name="title" placeholder="Sub Menu title">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="mb-3 row">
                                                        <label for="menu_id" class="col-sm-2 col-form-label">Pilih menu</label>
                                                        <div class="col-sm-10">
                                                            <select name="menu_id" id="menu_id" class="form-control">
                                                                <option value="">Select Menu</option>
                                                                <?php foreach ($menu as $m) : ?>
                                                                    <?php $pilih = ($m['menu'] == $sm['menu']) ? "selected" : ""; ?>
                                                                    <option value="<?= $m['id']; ?>" <?= $pilih; ?>><?= $m['menu']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-check" id="myCheck">
                                                        <input type="checkbox" class="form-check-input" value="1" name="link_ext" id="link_extEdt<?= $i; ?>" onclick="myFunctionEdit<?= $i; ?>()" <?= $sm['url_ext'] != '' ? 'checked' : ''; ?>>
                                                        <label class="form-check-label" for="link_extEdt<?= $i; ?>">
                                                            External Link?
                                                        </label>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="url" class="col-sm-2 col-form-label">Alamat sub menu</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="url" value="<?= $sm['url'] ?>" name="url" placeholder="Sub Menu url">
                                                            <small id="urlExtLinkEdt<?= $i; ?>" style="display: <?= $sm['url_ext'] != '' ? 'block' : 'none'; ?>;" class="text-danger">isi sub menu url harus menggunakan format berdasarkan Menu yang dipilih seperti Menu/extlink Contoh "report/extlink"!</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="urlExtEdt<?= $i; ?>" style="display: <?= $sm['url_ext'] != '' ? 'block' : 'none'; ?>;">
                                                    <div class="mb-3 row">
                                                        <label for="urlExt" class="col-sm-2 col-form-label">Konten external link</label>
                                                        <div class="col-sm-10">
                                                            <textarea name="urlExt" class="form-control" id="Editor<?= $i; ?>" placeholder="Teks dan Format <?= $format; ?>"><?= $sm['url_ext'] ?></textarea>
                                                            <small id="urlExtLinkNoteEdt<?= $i; ?>" class="text-danger">*untuk menyematkan website gunakan format seperti ini :<?= $format; ?>. Untuk melihat detail klik icon source code(<i class="fa fa-code"></i>)</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="mb-3 row">
                                                        <label for="icon" class="col-sm-2 col-form-label">Icon sub menu</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="icon" value="<?= $sm['icon'] ?>" name="icon" placeholder="Sub Menu icon" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-grop">
                                                    <div class="form-check">
                                                        <?php $pilih = ($sm['is_active'] == 1) ? "checked" : ""; ?>
                                                        <input type="checkbox" class="form-check-input" value="1" name="is_active" id="is_active" <?= $pilih; ?>>
                                                        <label class="form-check-label" for="is_active">
                                                            Active?
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <script>
                                tinymce.init({
                                    selector: '#Editor<?= $i; ?>',
                                    height: 500,
                                    forced_root_block: "",
                                    force_br_newlines: true,
                                    force_p_newlines: false,
                                    plugins: [
                                        'autolink lists link image charmap print preview hr anchor pagebreak',
                                        'searchreplace wordcount visualblocks visualchars code fullscreen',
                                        'insertdatetime nonbreaking save table contextmenu directionality',
                                        'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
                                    ],
                                    // toolbar1: 'undo redo | insert | styleselect table | bold italic | hr alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media ',
                                    toolbar2: 'print preview | forecolor backcolor emoticons | fontselect | fontsizeselect | codesample code fullscreen',
                                });

                                function myFunctionEdit<?= $i; ?>() {
                                    var checkBox = document.getElementById("link_extEdt<?= $i; ?>");
                                    var form = document.getElementById("urlExtEdt<?= $i; ?>");
                                    if (checkBox.checked == true) {
                                        $(form).fadeIn(1000);
                                        $("#urlExtLinkEdt<?= $i; ?>").fadeIn(1000);
                                        $("#urlExtLinkNoteEdt<?= $i; ?>").fadeIn(1000);
                                        // form.style.display = "block";
                                    } else {
                                        $(form).fadeOut(1000);
                                        $("#urlExtLinkEdt<?= $i; ?>").fadeOut(1000);
                                        $("#urlExtLinkNoteEdt<?= $i; ?>").fadeOut(1000);
                                        // form.style.display = "none";
                                    }
                                }
                            </script>
                            <!-- Delete Modal-->
                            <div class="modal fade" id="delModal<?= $sm['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">Are you sure want to delete this "<?= $sm['title']; ?>" ?</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                                            <a class="btn btn-primary" href="<?= base_url('menu/submenuDelete/') . $sm['id']; ?>">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                            $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script>
    $("#AddSubMenu").hide();
    $("#btnAdd").on("click", "#BtnAddSubMenu", function() {
        $("#AddSubMenu").fadeIn(800);
    });
    $("#AddSubMenu").on("click", "#cancel", function() {
        $("#AddSubMenu").fadeOut(500);
    });

    function myFunction() {
        var checkBox = document.getElementById("link_ext");
        // var form = document.getElementById("urlExt");
        if (checkBox.checked == true) {
            // $(form).fadeIn(1000);
            $("#urlExtLink").fadeIn(1000);
            $("#urlExtLinkNote").fadeIn(1000);
            // form.style.display = "block";
        } else {
            // $(form).fadeOut(1000);
            $("#urlExtLink").fadeOut(1000);
            $("#urlExtLinkNote").fadeOut(1000);
            // form.style.display = "none";
        }
    }
</script>