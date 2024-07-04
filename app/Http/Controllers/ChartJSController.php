<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChartJSController extends Controller
{
    /*** Fungsi untuk membuat grafik ***/
    public function viewReport()
    {
        // Mengelompokkan transaksi berdasarkan KATEGORI DAN BULAN
        $reportByCategory = Transaction::select(DB::raw('MONTH(date) as month'), 'category_id', DB::raw('COUNT(*) as count'))
            ->whereYear('date', date('Y'))
            ->groupBy('category_id', DB::raw('MONTH(date)'))
            ->get();
        $categories = DB::table('tb_category')->pluck('category', 'category_id');

        // Mengelompokkan transaksi berdasarkan WALLET DAN BULAN
        $reportByWallet = Transaction::select(DB::raw('MONTH(date) as month'), 'wallet_id', DB::raw('COUNT(*) as count'))
            ->whereYear('date', date('Y'))
            ->groupBy('wallet_id', DB::raw('MONTH(date)'))
            ->get();
        $wallets = DB::table('tb_wallet')
            ->where('status', 1)
            ->pluck('name', 'wallet_id');

        // Menyiapkan data transaksi
        $months = $reportByCategory->pluck('month')->merge($reportByWallet->pluck('month'))->unique()->sort();
        $labelsByCategory = $months->map(function ($month) {
            return Carbon::create()->month($month)->format('F');
        });
        $labelsByWallet = $months->map(function ($month) {
            return Carbon::create()->month($month)->format('F');
        });

        // Menyiapkan data untuk grafik per kategori
        $datasetsByCategory = [];
        foreach ($categories as $category_id => $category) {
            $data = [];
            foreach ($months as $month) {
                $data[] = $reportByCategory->where('month', $month)
                    ->where('category_id', $category_id)
                    ->value('count') ?? 0;
            }
            $datasetsByCategory[] = [
                'label' => $category,
                'data' => $data,
                'backgroundColor' => $this->predefinedColor($category_id, true),
                'borderColor' => $this->predefinedColor($category_id, false),
                'borderWidth' => 1,
            ];
        }

        // Menyiapkan data untuk grafik per wallet
        $datasetsByWallet = [];
        foreach ($wallets as $wallet_id => $wallet) {
            $data = [];
            foreach ($months as $month) {
                $data[] = $reportByWallet->where('month', $month)
                    ->where('wallet_id', $wallet_id)
                    ->value('count') ?? 0;
            }
            $datasetsByWallet[] = [
                'label' => $wallet,
                'data' => $data,
                'backgroundColor' => $this->definedColor($wallet_id, true),
                'borderColor' => $this->definedColor($wallet_id, false),
                'borderWidth' => 1,
            ];
        }

        // dd($datasetsByCategory, $datasetsByWallet);
        return view('viewReport', compact('labelsByCategory', 'datasetsByCategory', 'labelsByWallet', 'datasetsByWallet'));
    }

    /*** Fungsi untuk menghasilkan warna acak untuk Kategori ***/
    private function predefinedColor($category_id, $isBackground)
    {
        $colors = [
            1 => ['rgba(255, 159, 64, 0.2)', 'rgba(255, 159, 64, 1)'], // Orange
            2 => ['rgba(128, 128, 0, 0.2)', 'rgba(128, 128, 0, 1)'], // Olive
            3 => ['rgba(153, 102, 255, 0.2)', 'rgba(153, 102, 255, 1)'], // Purple
            4 => ['rgba(255, 99, 132, 0.2)', 'rgba(255, 99, 132, 1)'], // Red
            5 => ['rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 1)'], // Blue
            6 => ['rgba(255, 206, 86, 0.2)', 'rgba(255, 206, 86, 1)'], // Yellow
        ];

        // Jika wallet_id melebihi warna yang telah ditentukan, putarlah warna tersebut
        $colorKey = ($category_id - 1) % count($colors) + 1;
        return $isBackground ? $colors[$colorKey][0] : $colors[$colorKey][1];
    }

    /*** Fungsi untuk menghasilkan warna acak untuk Wallet ***/
    private function definedColor($wallet_id, $isBackground)
    {
        $colors = [
            1 => ['rgba(0, 128, 128, 0.2)', 'rgba(0, 128, 128, 1)'], // Teal
            2 => ['rgba(128, 0, 0, 0.2)', 'rgba(128, 0, 0, 1)'], // Maroon
            3 => ['rgba(255, 206, 86, 0.2)', 'rgba(255, 206, 86, 1)'], // Yellow
            4 => ['rgba(153, 102, 255, 0.2)', 'rgba(153, 102, 255, 1)'], // Purple
        ];

        $colorKey = ($wallet_id - 1) % count($colors) + 1;
        return $isBackground ? $colors[$colorKey][0] : $colors[$colorKey][1];
    }
}
