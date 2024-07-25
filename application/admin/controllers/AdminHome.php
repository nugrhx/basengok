<?php
defined('BASEPATH') or exit('No direct script access allowed');

class adminHome extends AUTH_Controller
{
    public function index()
    {
        $this->load->model("adminHome_model");

        $pagedata['page']           = "home";
        $pagedata['judul']          = "Beranda";
        $pagedata['deskripsi']      = "Manage Data CRUD";

        $pagedata['j_Dtw'] = $this->adminHome_model->j_Dtw();
        $pagedata['j_Amn'] = $this->adminHome_model->j_Amn();
        $pagedata['j_Kat'] = $this->adminHome_model->j_Kat();

        $pagedata['jumlah_amenitas'] = $this->adminHome_model->jumlah_amenitas();
        $pagedata['jumlah_dtw'] = $this->adminHome_model->jumlah_dtw();

        $this->admintemplate->views('adminhome', $pagedata);
    }
}
