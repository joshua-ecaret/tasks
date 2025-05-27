<?php
namespace App\Http\Controllers;
 
use App\DataTables\PackagesDataTable;
use App\DataTables\UsersDataTable;
 
class PackagesController extends Controller
{
    public function index(PackagesDataTable $dataTable)
    {
        return $dataTable->render('packages.index');
    }
}