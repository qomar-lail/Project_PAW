<?php
require_once __DIR__. "/../../../Model/admin/crud/crud_sekolah_model_admin.php";


var_dump($action);
if(isset($action) && $action == "create"){
    echo "masukk sini";
    tambah_data($_SERVER["REQUEST_METHOD"]);
}
include "../Project_PAW/View/admin/sekolah_view_admin.php";


?>
