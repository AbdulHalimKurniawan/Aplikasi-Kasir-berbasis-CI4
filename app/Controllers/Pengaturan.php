<?php

namespace App\Controllers;

use App\Models\TokoModel;

class Pengaturan extends BaseController
{
    public function index()
    {
        $toko = (new TokoModel())->getToko();
        return view('pengaturan', ['toko' => $toko]);
    }

    public function setToko()
    {
        $model = new TokoModel();
        $model->update(1, [
            'nama'   => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
        ]);

        $toko = $model->getToko();
        session()->set('toko', $toko);
        return $this->response->setJSON(['status' => 'sukses']);
    }
}
