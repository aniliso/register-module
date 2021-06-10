<?php

namespace Modules\Register\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Register\Entities\Collateral;
use Modules\Register\Http\Requests\CreateCollateralRequest;
use Modules\Register\Http\Requests\UpdateCollateralRequest;
use Modules\Register\Repositories\CollateralRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CollateralController extends AdminBaseController
{
    /**
     * @var CollateralRepository
     */
    private $collateral;

    public function __construct(CollateralRepository $collateral)
    {
        parent::__construct();

        $this->collateral = $collateral;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $collaterals = $this->collateral->all();

        return view('register::admin.collaterals.index', compact('collaterals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('register::admin.collaterals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCollateralRequest $request
     * @return Response
     */
    public function store(CreateCollateralRequest $request)
    {
        $this->collateral->create($request->all());

        return redirect()->route('admin.register.collateral.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('register::collaterals.title.collaterals')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Collateral $collateral
     * @return Response
     */
    public function edit(Collateral $collateral)
    {
        return view('register::admin.collaterals.edit', compact('collateral'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Collateral $collateral
     * @param UpdateCollateralRequest $request
     * @return Response
     */
    public function update(Collateral $collateral, UpdateCollateralRequest $request)
    {
        $this->collateral->update($collateral, $request->all());

        return redirect()->route('admin.register.collateral.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('register::collaterals.title.collaterals')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Collateral $collateral
     * @return Response
     */
    public function destroy(Collateral $collateral)
    {
        $this->collateral->destroy($collateral);

        return redirect()->route('admin.register.collateral.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('register::collaterals.title.collaterals')]));
    }
}