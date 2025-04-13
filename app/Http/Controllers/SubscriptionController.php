<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\SubscriptionPlans;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $subscriptions = Subscription::with(['user', 'plan'])->get();
        return view('admin.subscriptions.index' , compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscriptionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        //
        return view('admin.subscriptions.show' , compact('subscription'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        //
    }

    public function indexPlans()
    {
        //
        $plans = SubscriptionPlans::all();
        return view('admin.subscriptions.plans-index' , compact('plans'));
    }
}
