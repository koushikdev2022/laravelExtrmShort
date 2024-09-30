<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use PHPMailer\PHPMailer\phpmailerException;

class PHPMailerController extends Controller
{
    // =============== [ Email ] ===================
    public function email()
    {
        return view("email");
    }
    // ========== [ Compose Email ] ================
   
}
