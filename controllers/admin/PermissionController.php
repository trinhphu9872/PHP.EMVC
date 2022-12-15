<?php
class PermissionController extends Controller
{
    private  $defaultLink = "Location: http://192.168.2.67/PHP.EMVC/Admin/productadmin";
    private  $permissionE;
    public function __construct()
    {
        require_once 'vendor/Model.php';
        require_once 'models/admin/PermissionModel.php';
        $this->folder = "admin";
        if (!isset($_SESSION['admin'])) {
            header($this->defaultLink);
        }
    }

    public function index()
    {
        // $data = $this->categoryE->getAll();
        $data = [];

        $this->render('permission', $data, 'Permission Roles', 'admin');
    }
}
