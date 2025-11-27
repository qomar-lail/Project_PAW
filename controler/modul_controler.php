<?php
include 'model/modul_model.php';
function modul_index() {
    $data = get_all_modul();
    include 'view/user/modul_view.php';
}
modul_index();