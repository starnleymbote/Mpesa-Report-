<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Returns the landing page of the system.
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Returns a view - Dally transactional view
     */
    public function dailyTransactions()
    {
        return view('daily_transaction');
    }

    /**
     * Returns a view - weekly transactional view
     */
    public function weeklyTransactions()
    {
        return view('weekly_transactions');
    }

    /**
     * Returns a view - USer Profile view
     */
    public function userProfile()
    {
        return view('profile');
    }

    public function updateProfile()
    {

       $user = Auth::user();

       
        return view('update_profile')->with('user', $user);
    }

    public function updatePassword()
    {
        return view('update_password');
    }
}
