<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BarangRequest;
use App\Http\Resources\BarangResource;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        // GET DATA BARANG
        $posts = Barang::latest()->paginate(10);
        return new BarangResource(true, 'List Data Barang', $posts);
    }

    public function store(BarangRequest $request)
    {
        $barang = Barang::create($request->validated());
        return new BarangResource(true, 'Data Barang Berhasil Ditambahkan!', $barang);
    }

    public function show(Barang $barang)
    {
        return new BarangResource(true, 'Detail Data Barang', $barang);
    }

    public function update(BarangRequest $request, Barang $barang)
    {
        $barang->update($request->validated());

        return new BarangResource(true, 'Data Barang Berhasil Diperbarui!', $barang);
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();

        return new BarangResource(true, 'Data Barang Berhasil Dihapus!', null);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $result = Barang::search($keyword)->get();

        if ($result->isEmpty()) {
            return new BarangResource(false, 'Tidak ada hasil pencarian', null);
        }

        return new BarangResource(true, 'Hasil Pencarian', $result);
    }


    // CEK NAMA
    public function cekNama($kata_1, $kata_2)
    {
        $array1 = str_split(strtolower($kata_1));
        $array2 = str_split(strtolower($kata_2));

        // Mengurutkan array karakter
        sort($array1);
        sort($array2);

        // Membandingkan array karakter
        return $array1 === $array2;
    }

    public function tesCekNama()
    {
        $result1 = $this->cekNama("Race", "Care");  // True
        $result2 = $this->cekNama("Robert", "Terobs");  // False

        // Menampilkan hasil
        return response()->json([
            'result1' => $result1,
            'result2' => $result2,
        ]);
    }
    // END CEK NAMA

    // CARI KATA
    public function cariKata($kalimat)
    {
        $kalimat = strtolower($kalimat);

        $counter = [];
        $maxCount = 0;
        $mostFrequentLetter = '';

        // Menghitung frekuensi setiap huruf dalam kalimat
        for ($i = 0; $i < strlen($kalimat); $i++) {
            $currentLetter = $kalimat[$i];
            if (ctype_alpha($currentLetter)) {
                if (!isset($counter[$currentLetter])) {
                    $counter[$currentLetter] = 1;
                } else {
                    $counter[$currentLetter]++;
                }

                // Memperbarui huruf terbanyak
                if ($counter[$currentLetter] > $maxCount) {
                    $maxCount = $counter[$currentLetter];
                    $mostFrequentLetter = $currentLetter;
                }
            }
        }

        return response()->json([
            'letter' => $mostFrequentLetter,
            'count' => $maxCount,
        ]);
    }

    public function tesCariKata()
    {
        $result1 = $this->cariKata("giffari");
        $result2 = $this->cariKata("gunung arjuno");

        return response()->json([
            'result1' => $result1,
            'result2' => $result2,
        ]);
    }
    // END CARI KATA

    // BUAT ARRAY 2D
    public function createArrary2D($total)
    {
        $result = [];

        for ($i = 0; $i < $total; $i++) {
            $row = [];
            for ($j = 0; $j < $total; $j++) {
                // Mengisi diagonal dengan nilai total, sisanya diisi 0
                $row[$j] = ($i == $j) ? $total : 0;
            }
            $result[] = $row;
        }

        return response()->json($result);
    }

    public function tesCreateArrary2D()
    {
        $result1 = $this->createArrary2D(4);
        $result2 = $this->createArrary2D(9);

        return response()->json([
            'result1' => $result1,
            'result2' => $result2,
        ]);
    }
    // END BUAT ARRAY 2D
}
