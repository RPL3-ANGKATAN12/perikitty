<?php
namespace App\Http\Controllers;
use App\Models\Order;

class ProfileController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->latest()->get();
        return view('profile.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        return view('profile.show', compact('order'));
    }
}