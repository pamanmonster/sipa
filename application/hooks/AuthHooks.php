<?php

class AuthHooks {
    protected $CI;

    public function __construct() {
      $this->CI =& get_instance();
      $this->CI->load->library('ion_auth');
      $this->CI->load->model("MenuModel");
    }

    public function checkUserLogin() {
        $route = $this->CI->router->fetch_class() . '/' . $this->CI->router->fetch_method();
        $public = [
            'landing/index', 'auth/login', 'omi/index', 'auth/forgot_password', 'signinMarket/index', 'signupMarket/index', 'resetPassword/index',
            'shopCart/index', 'favorit/index', 'productCategory/index', 'detailProduct/index', 'paymentMethod/index', 'reviewOrder/index',
            'orderReceived/index', 'trackOrder/index', 'historyOrder/index', 'profileInfo/index', 'transactionDetail/index', 'changePassword/index',
            'detailProduct/detail'
        ];
        if(in_array($route, $public)) return;
        // Pengguna tidak login, alihkan ke halaman login
        if (!$this->CI->ion_auth->logged_in()) {
            // Jika pengguna belum login, alihkan ke halaman login atau tindakan lainnya
            redirect('auth/login');
        }

    }
}