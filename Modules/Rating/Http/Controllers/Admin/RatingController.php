<?php

namespace Modules\Rating\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Rating\Entities\Rating;
use Modules\Rating\Http\Requests\CreateRatingRequest;
use Modules\Rating\Http\Requests\UpdateRatingRequest;
use Modules\Rating\Repositories\RatingRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class RatingController extends AdminBaseController
{
    /**
     * @var RatingRepository
     */
    private $rating;

    public function __construct(RatingRepository $rating)
    {
        parent::__construct();

        $this->rating = $rating;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$ratings = $this->rating->all();

        return view('rating::admin.ratings.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('rating::admin.ratings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateRatingRequest $request
     * @return Response
     */
    public function store(CreateRatingRequest $request)
    {
        $this->rating->create($request->all());

        return redirect()->route('admin.rating.rating.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('rating::ratings.title.ratings')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Rating $rating
     * @return Response
     */
    public function edit(Rating $rating)
    {
        return view('rating::admin.ratings.edit', compact('rating'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Rating $rating
     * @param  UpdateRatingRequest $request
     * @return Response
     */
    public function update(Rating $rating, UpdateRatingRequest $request)
    {
        $this->rating->update($rating, $request->all());

        return redirect()->route('admin.rating.rating.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('rating::ratings.title.ratings')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Rating $rating
     * @return Response
     */
    public function destroy(Rating $rating)
    {
        $this->rating->destroy($rating);

        return redirect()->route('admin.rating.rating.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('rating::ratings.title.ratings')]));
    }
}
