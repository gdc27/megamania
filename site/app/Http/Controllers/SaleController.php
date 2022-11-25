<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $sales = Sale::with('employee')
            ->with('customer')
            ->with('products')
            ->withCount('products')
            ->get();

        // TODO améliorer ça
        foreach ($sales as $sale) {
            $sale->totalPrice = 0;
            foreach($sale->products as $product) {
                $sale->totalPrice += $product->price * $product->pivot->quantity;
            }
        }

        return Inertia::render('Sales/Index', [
            'sales' => Sale::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Sales/Create', [
            'employees' => Employee::all(),
            'products' => Product::all(),
            'customers' => Customer::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Inertia\Response
     */
    public function show(Sale $sale)
    {
        $sale->load(['customer', 'employee', 'products']);
        $totalPrice = 0;
        $totalQuantity = 0;
        foreach($sale->products as $product) {
            $totalPrice += $product->price * $product->pivot->quantity;
            $totalQuantity += $product->pivot->quantity;
        }

        return Inertia::render('Sales/Show', [
            'sale' => $sale,
            'total_price' => $totalPrice,
            'total_quantity' => $totalQuantity,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
