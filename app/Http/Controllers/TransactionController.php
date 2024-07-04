<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use App\Models\Wallet;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /*** Fungsi untuk memanggil wallet dan kategori ***/
    public function viewTransaction()
    {
        $categories = Category::all();
        $wallets = Wallet::where('status', 1)
            ->orderBy('name')
            ->take(5)
            ->get();

        return view('viewTransaction', compact('categories', 'wallets'));
    }

    /*** Fungsi untuk menyimpan transaction dari form blade ***/
    public function saveTransaction(Request $request)
    {
        $input = $request->input();
        $transaction = new Transaction();
        $transaction->nominal =  $request->nominal;
        $transaction->description =  $request->description;
        $transaction->date =  $request->date;
        $transaction->category_id = $request->category_id;
        $transaction->wallet_id = $request->wallet_id;
        $transaction->status =  $request->status;

        $wallet = Wallet::find($request->wallet_id);
        if ($request->status == 0) {
            // Mengurangi saldo wallet
            $wallet->saldo -= $request->nominal;
        } else {
            // Jika status "Masuk", tambahkan saldo wallet
            $wallet->saldo += $request->nominal;
        }

        $wallet->save();
        $transaction->save();
        return redirect('list-transaction');
    }

    /*** Fungsi untuk membaca list wallet dari form blade ***/
    public function listTransaction(Request $request)
    {
        // $transactions = Transaction::get();
        $query = Transaction::query();
        if ($request->has('month') && $request->month != '') {
            $query->whereMonth('date', $request->month);
        }

        $transactions = $query->orderBy('date', 'asc')->get();
        return view('list-transaction', compact('transactions'));
    }

    /*** Fungsi untuk menghapus list wallet dari form blade ***/
    public function deleteTransaction(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        $wallet = Wallet::find($transaction->wallet_id);

        //Mengubah saldo di dalam wallet
        if ($transaction->status == 0) {
            $wallet->saldo += abs($transaction->nominal);
        } else {
            $wallet->saldo -= abs($transaction->nominal);
        }

        $wallet->save();
        $transaction->delete();
        return redirect('list-transaction');
    }

    /*** Fungsi untuk mengedit list transaction dari form blade ***/
    public function editTransaction(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        $categories = Category::all();
        $wallets = Wallet::where('status', 1)
            ->orderBy('name')
            ->take(5)
            ->get();

        return view('edit-transaction', compact('transaction', 'categories', 'wallets'));
    }

    /*** Fungsi untuk mengupdate transaction dari form blade ***/
    public function updateTransaction(Request $request, $id)
    {
        $input = $request->input();
        $transaction = Transaction::find($id);

        // Untuk menyimpan data sebelum terupdate
        $originalNominal = $transaction->nominal;
        $originalStatus = $transaction->status;
        $originalWalletId = $transaction->wallet_id;

        // Untuk mengembalikan saldo wallet sebelum terupdate (Ini terjadi jika saya melalukan perubahan wallet saat mengedit)
        $originalWallet = Wallet::find($originalWalletId);
        if ($originalStatus == 0) {
            $originalWallet->saldo += abs($originalNominal); //Jika "Keluar" berarti nominal dikurangi saldo. Untuk mengembalikan saldo lama maka ditambahkan nominal transaksi.
        } else {
            $originalWallet->saldo -= abs($originalNominal);  //Jika "Masuk" berarti nominal ditambahi saldo. Untuk mengembalikan saldo lama maka dikurangi nominal transaksi.
        }
        $originalWallet->save();

        $transaction->nominal =  $request->nominal;
        $transaction->description =  $request->description;
        $transaction->date =  $request->date;
        $transaction->category_id = $request->category_id;
        $transaction->wallet_id = $request->wallet_id;
        $transaction->status =  $request->status;

        // Perbarui saldo wallet yang dituju jika wallet berubah (seperti BRI ke BCA)
        if ($originalWalletId != $request->wallet_id) {
            $newWallet = Wallet::find($request->wallet_id);
            if ($request->status == 0) {
                $newWallet->saldo -= $request->nominal; //Jika statusnya "Keluar", kurangi nominal saldo wallet yang dituju.
            } else {
                $newWallet->saldo += $request->nominal; //Jika statusnya "Masuk", tambahkan nominal saldo wallet yang dituju.
            }
            $newWallet->save();
        } else {
            // Jika wallet tidak berubah, cukup perbarui saldo
            if ($request->status == 0) {
                $originalWallet->saldo -= $request->nominal; //Jika statusnya "Keluar", kurangi nominal saldo.
            } else {
                $originalWallet->saldo += $request->nominal; //Jika statusnya "Masuk", tambahkan nominal saldo.
            }
            $originalWallet->save();
        }

        $transaction->save();
        return redirect('list-transaction');
    }
}

/*** Fungsi untuk membaca nominal wallet dari form blade
public function nominalTransaction(Request $request)
{
    $totalNominal = Transaction::sum('nominal');
    return view('nominal-transaction', compact('totalNominal'));
}  ***/
