<?php

namespace Library\WilayahIndonesia;

use Nurmanhabib\WilayahIndonesia\Sources\DatabaseSource;

class AllWilayah extends DatabaseSource
{
    public function getAllProvinsi()
    {
        $data = $this->db->table('inf_lokasi')
                    ->where('lokasi_kabupatenkota', '00')
                    ->where('lokasi_kecamatan', '00')
                    ->where('lokasi_kelurahan', '0000')
                    ->get();

        $result = array('' => 'All');

        foreach ($data as $row) {
            $result[$row->lokasi_kode] = $row->lokasi_nama;
        }

        return $result;
    }

    public function getKotaByParent($provinsi)
    {
        $provinsi   = substr($provinsi, 0, 2);

        $data = $this->db->table('inf_lokasi')
                    ->where('lokasi_propinsi', $provinsi)
                    ->where('lokasi_kabupatenkota', '!=', '00')
                    ->where('lokasi_kecamatan', '00')
                    ->where('lokasi_kelurahan', '0000')
                    ->get();

        $result = array('' => 'All');

        foreach ($data as $row) {
            $result[$row->lokasi_kode] = $row->lokasi_nama;
        }

        return $result;
    }

    public function getKecamatanByParent($provinsi, $kota)
    {
        $provinsi   = substr($provinsi, 0, 2);
        $kota       = substr($kota, 3, 2);
        
        $data = $this->db->table('inf_lokasi')
                    ->where('lokasi_propinsi', $provinsi)
                    ->where('lokasi_kabupatenkota', $kota)
                    ->where('lokasi_kecamatan', '!=', '00')
                    ->where('lokasi_kelurahan', '0000')
                    ->get();

        $result = array('' => 'All');

        foreach ($data as $row) {
            $result[$row->lokasi_kode] = $row->lokasi_nama;
        }

        return $result;
    }

    public function getDesaByParent($provinsi, $kota, $kecamatan)
    {
        $provinsi   = substr($provinsi, 0, 2);
        $kota       = substr($kota, 3, 2);
        $kecamatan  = substr($kecamatan, 6, 2);
        
        $data = $this->db->table('inf_lokasi')
                    ->where('lokasi_propinsi', $provinsi)
                    ->where('lokasi_kabupatenkota', $kota)
                    ->where('lokasi_kecamatan', $kecamatan)
                    ->where('lokasi_kelurahan', '!=', '00')
                    ->get();

        $result = array('' => 'All');

        foreach ($data as $row) {
            $result[$row->lokasi_kode] = $row->lokasi_nama;
        }

        return $result;
    }
}