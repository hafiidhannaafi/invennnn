<?php
namespace App\Http\Controllers;

use index;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\JenisBarang;
use App\Models\Barang;
use App\Models\DataJenisAset;
use App\Models\DataAsalPerolehan;
use App\Models\Peminjaman;
use App\Models\Satuan;
use App\Models\DetailPeminjaman;


class HomeController extends Controller
{
    

    public function index()
    {
        $dataasalperolehan = DataAsalPerolehan::all();
         $datajenisaset = DataJenisAset::all();
         $jenisbarang = JenisBarang::all();
         $datasatuan = Satuan::all();
         $inputbarang = Barang::all();
         $detailpeminjaman = DetailPeminjaman::all();
        $peminjaman = Peminjaman::all();
        $role=Auth::user()->roles_id;
        
        // return $inputbarang;
        if($role=='1')
        {
            $jumlah = Barang::count();
            $asetbergerak = Barang::where('jenis_asets_id' , 1)->count();
            $asettidakbergerak = Barang::where('jenis_asets_id' , 2)->count();
            $asetperlengkapan = Barang::where('jenis_asets_id' , 4)->count();
            $asetperalatan = Barang::where('jenis_asets_id' , 3)->count();
             $pengajuan= DetailPeminjaman::where('status_konfirmasis_id' , 1)->count();
              $disetujui= DetailPeminjaman::where('status_konfirmasis_id' , 2 && 'status_peminjamans_id' , 2 )->count();
              $dikembalikan= DetailPeminjaman::where('status_konfirmasis_id' , 2 && 'status_peminjamans_id' , 3 )->count();
              $ditolak= DetailPeminjaman::where('status_konfirmasis_id' , 3)->count();
               $dibatalkan= DetailPeminjaman::where('status_konfirmasis_id' , 5)->count();
              $peminjaman =Peminjaman::count();
            return view('admin',[
             "title" => "perlengkapan",
             "jenisbarang" => $jenisbarang,
             "jenisaset" => $datajenisaset,
             "dataasalperolehan" => $dataasalperolehan,
             "datasatuan" =>$datasatuan,
             "inputbarang"=> $inputbarang,
            "detailpeminjaman"=> $detailpeminjaman,
             "peminjaman"=> $peminjaman,
              "pengajuan"=>$pengajuan,
              "disetujui"=>$disetujui,
              "dikembalikan"=> $dikembalikan,
              "ditolak"=>$ditolak,
             "dibatalkan" =>$dibatalkan,
             "jumlah" => $jumlah,
             "asetbergerak" => $asetbergerak,
             "asettidakbergerak" => $asettidakbergerak,
             "asetperlengkapan" => $asetperlengkapan,
             "asetperalatan" => $asetperalatan
         ]);
        }

        if($role=='2')
        {
            return view('kepalaunit',[
             "title" => "perlengkapan",
             "jenisbarang" => $jenisbarang,
             "jenisaset" => $datajenisaset,
             "dataasalperolehan" => $dataasalperolehan,
             "datasatuan" =>$datasatuan,
             "inputbarang"=> $inputbarang
         ]);
        }

        if($role=='3')
        {
            return view('staff',[
             "title" => "perlengkapan",
             "jenisbarang" => $jenisbarang,
             "jenisaset" => $datajenisaset,
             "dataasalperolehan" => $dataasalperolehan,
             "datasatuan" =>$datasatuan,
             "inputbarang"=> $inputbarang
         ]);
        }
        else
        {
            return view('dashboard',[
             "title" => "perlengkapan",
             "jenisbarang" => $jenisbarang,
             "jenisaset" => $datajenisaset,
             "dataasalperolehan" => $dataasalperolehan,
             "datasatuan" =>$datasatuan,
             "inputbarang"=> $inputbarang
         ]);
        }
    }
}