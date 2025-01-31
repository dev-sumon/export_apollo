<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Mail\OrderMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomePageController extends Controller
{
    public function index()
    {
        return view('frontend.home');
    }

    public function order(OrderRequest $request)
    {
        $order = new Order();
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->total_lead = $request->lead;
        $order->total_amount = total_lead_amount($request->lead, $request->extra_links);
        $order->apollo_url = $request->apollo_url;
        $order->additional_url = $request->extra_links;
        $order->additional_amount = additional_lead_amount($request->extra_links);
        $order->save();
        Mail::to('ahsanulhaque12394@gmail.com')->send(new OrderMail($order));
        session()->flash('success', "Order placed successfully");
        return redirect()->route('f.home')->withInput();
    }
}
