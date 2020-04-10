<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('checkout')->with([
            'discount' => $this->getNumbers()->get('discount'),
            'newSubtotal' => $this->getNumbers()->get('newSubtotal'),
            'newTax' => $this->getNumbers()->get('newTax'),
            'newTotal' => $this->getNumbers()->get('newTotal'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        $contens = Cart::content()->map(function ($item) {
            return $item->model->slug . ',' . $item->qty;
        })->values()->toJson();

        try {
            $charge = Stripe::charges()->create([
                'amount' => $this->getNumbers()->get('newTotal') / 100,
                'currency' => 'CAD',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    'contents' => $contens,
                    'quantity' => Cart::instance('default')->count(),
                    'discount'  => collect(session()->get('coupon'))->toJson()
                ]
            ]);

            // Success
            Cart::instance('default')->destroy();
            session()->forget('coupon');

            return redirect()->route('confiramtion.index')->with('success_message', 'Thanks you payment has been succes accepted');
        } catch (CardErrorException $e) {
            return back()->withErrors('Error' . $e->getMessage());
        }
    }

    private function getNumbers()
    {
        $tax = config('cart.tax') / 100;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newSubtotal = (Cart::subtotal() - $discount);
        $newTax = $newSubtotal * $tax;
        $newTotal = $newSubtotal * (1 + $tax);

        return collect([
            'tax' => $tax,
            'discount' => $discount,
            'newSubtotal' => $newSubtotal,
            'newTax' => $newTax,
            'newTotal' => $newSubtotal
        ]);
    }
}
