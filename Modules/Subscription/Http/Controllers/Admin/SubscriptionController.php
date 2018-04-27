<?php

namespace Modules\Subscription\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Subscription\Entities\Subscription;
use Modules\Subscription\Http\Requests\CreateSubscriptionRequest;
use Modules\Subscription\Http\Requests\UpdateSubscriptionRequest;
use Modules\Subscription\Repositories\SubscriptionRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class SubscriptionController extends AdminBaseController
{
    /**
     * @var SubscriptionRepository
     */
    private $subscription;

    public function __construct(SubscriptionRepository $subscription)
    {
        parent::__construct();

        $this->subscription = $subscription;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$subscriptions = $this->subscription->all();

        return view('subscription::admin.subscriptions.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('subscription::admin.subscriptions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateSubscriptionRequest $request
     * @return Response
     */
    public function store(CreateSubscriptionRequest $request)
    {
        $this->subscription->create($request->all());

        return redirect()->route('admin.subscription.subscription.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('subscription::subscriptions.title.subscriptions')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Subscription $subscription
     * @return Response
     */
    public function edit(Subscription $subscription)
    {
        return view('subscription::admin.subscriptions.edit', compact('subscription'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Subscription $subscription
     * @param  UpdateSubscriptionRequest $request
     * @return Response
     */
    public function update(Subscription $subscription, UpdateSubscriptionRequest $request)
    {
        $this->subscription->update($subscription, $request->all());

        return redirect()->route('admin.subscription.subscription.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('subscription::subscriptions.title.subscriptions')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Subscription $subscription
     * @return Response
     */
    public function destroy(Subscription $subscription)
    {
        $this->subscription->destroy($subscription);

        return redirect()->route('admin.subscription.subscription.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('subscription::subscriptions.title.subscriptions')]));
    }
}
