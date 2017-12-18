<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller
{
    Public function _initialize()
    {
        if (!isset($_SESSION['admin_user'])) {
            $this->redirect('Login/index');
        }
    }
}
