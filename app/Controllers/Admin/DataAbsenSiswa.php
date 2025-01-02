<?php

namespace App\Controllers\Admin;

use App\Models\KelasModel;

use App\Models\SiswaModel;

use App\Controllers\BaseController;
use App\Models\KehadiranModel;
use App\Models\PresensiSiswaModel;
use CodeIgniter\I18n\Time;

class DataAbsenSiswa extends BaseController
{
   protected KelasModel $kelasModel;

   protected SiswaModel $siswaModel;

   protected KehadiranModel $kehadiranModel;

   protected PresensiSiswaModel $presensiSiswa;

   protected string $currentDate;

   public function __construct()
   {
      $this->currentDate = Time::today()->toDateString();

      $this->siswaModel = new SiswaModel();

      $this->kehadiranModel = new KehadiranModel();

      $this->kelasModel = new KelasModel();

      $this->presensiSiswa = new PresensiSiswaModel();
   }

   public function index()
   {
      $kelas = $this->kelasModel->getDataKelas();

      $data = [
         'title' => 'Data Absen Siswa',
         'ctx' => 'absen-siswa',
         'kelas' => $kelas
      ];

      return view('admin/absen/absen-siswa', $data);
   }

   public function ambilDataSiswa()
   {
      $kelas = $this->request->getVar('kelas');
      $idKelas = $this->request->getVar('id_kelas');
      $tanggal = $this->request->getVar('tanggal');

      $lewat = Time::parse($tanggal)->isAfter(Time::today());

      $result = $this->presensiSiswa->getPresensiByKelasTanggal($idKelas, $tanggal);

      $data = [
         'kelas' => $kelas,
         'data' => $result,
         'listKehadiran' => $this->kehadiranModel->getAllKehadiran(),
         'lewat' => $lewat
      ];

      return view('admin/absen/list-absen-siswa', $data);
   }

   public function ambilKehadiran()
   {
      $idPresensi = $this->request->getVar('id_presensi');
      $idSiswa = $this->request->getVar('id_siswa');

      $data = [
         'presensi' => $this->presensiSiswa->getPresensiById($idPresensi),
         'listKehadiran' => $this->kehadiranModel->getAllKehadiran(),
         'data' => $this->siswaModel->getSiswaById($idSiswa)
      ];

      return view('admin/absen/ubah-kehadiran-modal', $data);
   }

   public function ubahKehadiran()
   {
      $idKehadiran = $this->request->getVar('id_kehadiran');
      $idSiswa = $this->request->getVar('id_siswa');
      $idKelas = $this->request->getVar('id_kelas');
      $tanggal = $this->request->getVar('tanggal');
      $jamMasuk = $this->request->getVar('jam_masuk');
      $jamKeluar = $this->request->getVar('jam_keluar');
      $keterangan = $this->request->getVar('keterangan');

      $cek = $this->presensiSiswa->cekAbsen($idSiswa, $tanggal);

      $result = $this->presensiSiswa->updatePresensi(
         $cek == false ? NULL : $cek,
         $idSiswa,
         $idKelas,
         $tanggal,
         $idKehadiran,
         $jamMasuk ?? NULL,
         $jamKeluar ?? NULL,
         $keterangan
      );

      $response['nama_siswa'] = $this->siswaModel->getSiswaById($idSiswa)['nama_siswa'];

      if ($result) {
         $response['status'] = TRUE;
      } else {
         $response['status'] = FALSE;
      }

      return $this->response->setJSON($response);
   }

   public function sendNotification()
   {
      $siswaData = $this->siswaModel->getAllSiswa();
      $idKehadiran = $this->request->getVar('id_kehadiran');
      $idSiswa = $this->request->getVar('id_siswa');
      $idKelas = $this->request->getVar('id_kelas');
      $tanggal = date('Y/m/d');
      $dataToSend = [];
      $option = [];

      if ($siswaData) {
         $option = [];
     
         foreach ($siswaData as $siswa) {
            $presensi = $this->presensiSiswa->getPresensiBySiswaDanTanggal($siswa['id_siswa'], $tanggal);
            $idKehadiran = !empty($presensi) ? $presensi['id_kehadiran'] : '4'; 
            switch ($idKehadiran) {
                case '1':
                    $keterangan = 'Hadir';
                    break;
                case '2':
                    $keterangan = 'Izin';
                    break;
                case '3':
                    $keterangan = 'Sakit';
                    break;
                default:
                    $keterangan = 'Absen/Tanpa Keterangan';
             }

             if (!empty($siswa['nama_siswa']) && !empty($siswa['no_hp'])) {
                  $pesan = "Yth. Wali Bapak/Ibu Wali Siswa, " . $siswa['nama_siswa'] . ".\n\n" .
                  "Kami informasikan bahwa Putra/Putri anda: \n\n" .
                  "Nama Siswa : " . $siswa['nama_siswa'] . "\n" .
                  "Tanggal         : " . $tanggal . "\n" .
                  "Status           : " . $keterangan . "\n\n" .
                  "Terimakasih atas perhatian dan kerjasamanya.\n\n" .
                  "Hormat kami,\n" .
                  "SD Negeri Kedensari 1";
                 $option[] = [
                     'target' => $siswa['no_hp'],
                     'delay' => '5',
                     'message' => $pesan
                 ];
             } else {
                 echo "Data siswa tidak lengkap untuk ID: " . $siswa['id_siswa'] . "<br>";
             }
         }
     
         if (!empty($option)) {
             $dataToSend['data'] = json_encode($option, JSON_UNESCAPED_UNICODE);
         } else {
             echo "Tidak ada data pesan yang dikirim.";
         }
     } else {
         echo "Tidak ada data siswa ditemukan.";
     }
     
        
      $curl = curl_init();

      curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.fonnte.com/send',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $dataToSend,
      CURLOPT_HTTPHEADER => array(
      'Authorization: ' . getenv('TOKEN_FONTEE') 
      ),
      ));

      $response = curl_exec($curl);
      curl_close($curl);
      echo $response;

      return redirect()->to('admin/absen-siswa')->with('success', 'Notifications sent successfully!'); 
   }
   
}
