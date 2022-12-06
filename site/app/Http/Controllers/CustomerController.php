<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Subscription;
use App\Models\User;
use Cassandra\Custom;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Customers/Index', [
            'customers' => Customer::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Customers/Create', [
            'subscriptions' => Subscription::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:40',
            'email' => 'required|email|unique:users,email',
            'subscription_id' => 'required|integer|exists:subscriptions,id',
        ]);

        $customer = Customer::create($validated);
        $subscription = Subscription::find($validated['subscription_id']);
        $customer->subscription()->associate($subscription);

        return redirect(route('customers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Inertia\Response
     */
    public function edit(Customer $customer)
    {
        return Inertia::render('Customers/Edit', [

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:40',
            'email' => 'required|email',
        ]);

        $customer->update($validated);

        return redirect(route('customers.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect(route('customers.index'));
    }
}
