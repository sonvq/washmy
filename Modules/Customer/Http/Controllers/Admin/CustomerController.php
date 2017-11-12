<?php

namespace Modules\Customer\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Customer\Entities\Customer;
use Modules\Customer\Http\Requests\CreateCustomerRequest;
use Modules\Customer\Http\Requests\UpdateCustomerRequest;
use Modules\Customer\Repositories\CustomerRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CustomerController extends AdminBaseController
{
    /**
     * @var CustomerRepository
     */
    private $customer;

    public function __construct(CustomerRepository $customer)
    {
        parent::__construct();

        $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$customers = $this->customer->all();

        return view('customer::admin.customers.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('customer::admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCustomerRequest $request
     * @return Response
     */
    public function store(CreateCustomerRequest $request)
    {
        $this->customer->create($request->all());

        return redirect()->route('admin.customer.customer.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('customer::customers.title.customers')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Customer $customer
     * @return Response
     */
    public function edit(Customer $customer)
    {
        return view('customer::admin.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Customer $customer
     * @param  UpdateCustomerRequest $request
     * @return Response
     */
    public function update(Customer $customer, UpdateCustomerRequest $request)
    {
        $this->customer->update($customer, $request->all());

        return redirect()->route('admin.customer.customer.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('customer::customers.title.customers')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Customer $customer
     * @return Response
     */
    public function destroy(Customer $customer)
    {
        $this->customer->destroy($customer);

        return redirect()->route('admin.customer.customer.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('customer::customers.title.customers')]));
    }
}
