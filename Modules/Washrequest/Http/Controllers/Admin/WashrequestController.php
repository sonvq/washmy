<?php

namespace Modules\Washrequest\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Washrequest\Entities\Washrequest;
use Modules\Washrequest\Http\Requests\CreateWashrequestRequest;
use Modules\Washrequest\Http\Requests\UpdateWashrequestRequest;
use Modules\Washrequest\Repositories\WashrequestRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class WashrequestController extends AdminBaseController
{
    /**
     * @var WashrequestRepository
     */
    private $washrequest;

    public function __construct(WashrequestRepository $washrequest)
    {
        parent::__construct();

        $this->washrequest = $washrequest;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$washrequests = $this->washrequest->all();

        return view('washrequest::admin.washrequests.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('washrequest::admin.washrequests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateWashrequestRequest $request
     * @return Response
     */
    public function store(CreateWashrequestRequest $request)
    {
        $this->washrequest->create($request->all());

        return redirect()->route('admin.washrequest.washrequest.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('washrequest::washrequests.title.washrequests')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Washrequest $washrequest
     * @return Response
     */
    public function edit(Washrequest $washrequest)
    {
        return view('washrequest::admin.washrequests.edit', compact('washrequest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Washrequest $washrequest
     * @param  UpdateWashrequestRequest $request
     * @return Response
     */
    public function update(Washrequest $washrequest, UpdateWashrequestRequest $request)
    {
        $this->washrequest->update($washrequest, $request->all());

        return redirect()->route('admin.washrequest.washrequest.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('washrequest::washrequests.title.washrequests')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Washrequest $washrequest
     * @return Response
     */
    public function destroy(Washrequest $washrequest)
    {
        $this->washrequest->destroy($washrequest);

        return redirect()->route('admin.washrequest.washrequest.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('washrequest::washrequests.title.washrequests')]));
    }
}
