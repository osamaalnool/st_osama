<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $orders = Order::where('payment_status', 'تحت المعالجة')->orderby('id','desc')-> paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    public function orderDone()
    {
        $orders = Order::where('payment_status', 'مكتمل')->orderby('id', 'desc')->paginate(10);
        return view('admin.order.orderDone', compact('orders'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->payment_status = $request->payment_status;
        $order->save();
        return redirect()->back()->with('status', 'تمت التعديل بنجاح');
    }

    
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->back()->with('status', 'تم  حذف  الطلب بنجاح ');
    }
}
