<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bobot_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
    }

    // public function getTotalBobot()
    // {
    //     $sql = "SELECT SUM(bobot) AS Total FROM `jenis_kegiatan`";
    //     return $this->db->query($sql)->row_array();
    // }

    // Bobot di Report Harian 
    public function getBobotHarian($kegiatan)
    {
        $sql = "SELECT bobot from jenis_kegiatan WHERE id_kegiatan = '$kegiatan' ";
        return $this->db->query($sql)->row_array();
    }

    public function getBobotHarianBibit($kegiatan)
    {
        $sql = "SELECT bobot from jenis_kegiatan WHERE nm_kegiatan = '$kegiatan' ";
        return $this->db->query($sql)->row_array();
    }

    public function getBobotHarianLap($kegiatan)
    {
        $sql = "SELECT bobot from jenis_kegiatan WHERE id_kegiatan = '$kegiatan' ";
        return $this->db->query($sql)->row_array();
    }

    // Bobot Report Mingguan grafikbarkegiatankabupaten | 
    public function getHarianBahan($idkegiatan, $kabupaten)
    {
        $sql = "SELECT SUM(nilai_harianbahan) AS getHarianBahan FROM harianbahan, spkbahan WHERE harianbahan.id_spkbahan=spkbahan.id_spkbahan AND spkbahan.id_kegiatan='$idkegiatan' AND harianbahan.id_kab='$kabupaten' ";
        return $this->db->query($sql)->row_array();
    }
    public function getHarianLap($idkegiatan, $kabupaten)
    {
        $sql = "SELECT SUM(nilai_harianlapangan) AS getHarianLap FROM harianlapangan, spklapangan 
                WHERE harianlapangan.id_spklapangan=spklapangan.id_spklapangan 
                AND spklapangan.id_kegiatan='$idkegiatan' AND harianlapangan.id_kab='$kabupaten' ";
        return $this->db->query($sql)->row_array();
    }
}
