<?php

namespace Modules\Washer\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Washer\Entities\Washer;
use Modules\Washer\Http\Requests\CreateWasherRequest;
use Modules\Washer\Http\Requests\UpdateWasherRequest;
use Modules\Washer\Repositories\WasherRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class WasherController extends AdminBaseController
{
    /**
     * @var WasherRepository
     */
    private $washer;

    public function __construct(WasherRepository $washer)
    {
        parent::__construct();

        $this->washer = $washer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$washers = $this->washer->all();

        return view('washer::admin.washers.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('washer::admin.washers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateWasherRequest $request
     * @return Response
     */
    public function store(CreateWasherRequest $request)
    {
        $this->washer->create($request->all());

        return redirect()->route('admin.washer.washer.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('washer::washers.title.washers')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Washer $washer
     * @return Response
     */
    public function edit(Washer $washer)
    {
        return view('washer::admin.washers.edit', compact('washer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Washer $washer
     * @param  UpdateWasherRequest $request
     * @return Response
     */
    public function update(Washer $washer, UpdateWasherRequest $request)
    {
        $this->washer->update($washer, $request->all());

        return redirect()->route('admin.washer.washer.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('washer::washers.title.washers')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Washer $washer
     * @return Response
     */
    public function destroy(Washer $washer)
    {
        $this->washer->destroy($washer);

        return redirect()->route('admin.washer.washer.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('washer::washers.title.washers')]));
    }
}
