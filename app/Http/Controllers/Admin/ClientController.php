<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller {
    public function __construct()
    {
        // $this->middleware('CheckUserStatus');
    }
    
    public function index(){
    return view('home');
}
}



