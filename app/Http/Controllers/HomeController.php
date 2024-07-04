<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /*** Fungsi dan Fitur. Menampilkan Data dan Grafik ***/
    public function list(Request $request)
    {
        $transactions = Transaction::orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Controller untuk Chart / Grafik
        $reportByWallet = Transaction::select(DB::raw('DAYOFWEEK(date) as day'), 'wallet_id', DB::raw('COUNT(*) as count'))
            ->whereYear('date', date('Y'))
            ->groupBy('wallet_id', DB::raw('DAYOFWEEK(date)'))
            ->get();
        $wallets = DB::table('tb_wallet')
            ->where('status', 1)
            ->pluck('name', 'wallet_id');

        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $labelsByWallet = collect($days);

        $datasetsByWallet = [];
        foreach ($wallets as $wallet_id => $wallet) {
            $data = [];
            foreach (range(1, 7) as $day) {
                $data[] = $reportByWallet->where('day', $day)
                    ->where('wallet_id', $wallet_id)
                    ->value('count') ?? 0;
            }
            $datasetsByWallet[] = [
                'label' => $wallet,
                'data' => $data,
                'backgroundColor' => $this->predefinedColor($wallet_id, true),
                'borderColor' => $this->predefinedColor($wallet_id, false),
                'borderWidth' => 1,
            ];
        }

        return view('home', compact('transactions', 'labelsByWallet', 'datasetsByWallet'));
    }

    /*** Digunakan untuk Memberi Warna pada Chart ***/
    private function predefinedColor($wallet_id, $isBackground)
    {
        $colors = [
            1 => ['rgba(255, 99, 132, 0.2)', 'rgba(255, 99, 132, 1)'], // Red
            2 => ['rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 1)'], // Blue
            3 => ['rgba(153, 102, 255, 0.2)', 'rgba(153, 102, 255, 1)'], // Purple
            4 => ['rgba(255, 159, 64, 0.2)', 'rgba(255, 159, 64, 1)'], // Orange
        ];

        // Jika wallet_id melebihi warna yang telah ditentukan, putarlah warna tersebut
        $colorKey = ($wallet_id - 1) % count($colors) + 1;
        return $isBackground ? $colors[$colorKey][0] : $colors[$colorKey][1];
    }
}
