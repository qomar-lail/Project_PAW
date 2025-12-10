<?php
require_once __DIR__ . "/../../../Model/admin/crud/crud_modul_model_admin.php";

function crud_modul_handle($action, &$error){
    if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $error = crud_modul_create();
    }

    if ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = (int)($_GET['id'] ?? 0);
        $error = crud_modul_update($id);
    }

    if ($action === 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = (int)($_POST['id'] ?? 0);
        crud_modul_delete($id);
    }
}
