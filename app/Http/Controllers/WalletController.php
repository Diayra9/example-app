<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /*** Fungsi untuk menyimpan wallet dari form blade ***/
    public function saveWallet(Request $request)
    {
        $input = $request->input();

        $wallet = new Wallet();
        $wallet->name =  $request->name;
        $wallet->saldo =  $request->saldo;
        $wallet->description =  $request->description;
        $wallet->status =  $request->status;
        $wallet->save();

        return redirect('list-wallet');
    }

    /*** Fungsi untuk membaca list wallet dari form blade ***/
    public function listWallet(Request $request)
    {
        $wallets = Wallet::get();

        return view('list-wallet', compact('wallets'));
    }

    /*** Fungsi untuk menghapus list wallet dari form blade ***/
    public function deleteWallet(Request $request, $id)
    {
        $wallet = Wallet::find($id);
        // dd($wallet);
        $wallet->delete();

        return redirect('list-wallet');
    }

    /*** Fungsi untuk mengedit list wallet dari form blade ***/
    public function editWallet(Request $request, $id)
    {
        $wallet = Wallet::find($id);

        return view('edit-wallet', compact('wallet'));
    }

    /*** Fungsi untuk mengupdate wallet dari form blade ***/
    public function updateWallet(Request $request, $id)
    {
        $input = $request->input();

        $wallet = Wallet::find($id);
        $wallet->name =  $request->name;
        $wallet->saldo =  $request->saldo;
        $wallet->description =  $request->description;
        $wallet->status =  $request->status;
        $wallet->save();

        return redirect('list-wallet');
    }
}
