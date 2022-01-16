<?php

namespace Modules\Register\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Register\Entities\Form;
use Modules\Register\Http\Requests\CreateFormRequest;
use Modules\Register\Http\Requests\UpdateFormRequest;
use Modules\Register\Repositories\FormRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Register\Services\CollateralService;

class FormController extends AdminBaseController
{
    /**
     * @var FormRepository
     */
    private $form;

    public function __construct(FormRepository $form)
    {
        parent::__construct();

        $this->form = $form;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $forms = $this->form->all();

        return view('register::admin.forms.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('register::admin.forms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateFormRequest $request
     * @return Response
     */
    public function store(CreateFormRequest $request)
    {
        $this->form->create($request->all());

        return redirect()->route('admin.register.form.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('register::forms.title.forms')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Form $form
     * @return Response
     */
    public function edit(Form $form)
    {
        $collateral = new CollateralService($form);
        $rate = $collateral->findRangeRate();

        return view('register::admin.forms.edit', compact('form', 'rate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Form $form
     * @param  UpdateFormRequest $request
     * @return Response
     */
    public function update(Form $form, UpdateFormRequest $request)
    {
        $this->form->update($form, $request->all());

        return redirect()->route('admin.register.form.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('register::forms.title.forms')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Form $form
     * @return Response
     */
    public function destroy(Form $form)
    {
        $this->form->destroy($form);

        return redirect()->route('admin.register.form.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('register::forms.title.forms')]));
    }

    public function rates(Request $request)
    {
        $monthly_consumption = $request->get('monthly_consumption');
        $form_id = $request->get('form_id');
        $form = $this->form->find($form_id);

        $collateral = new CollateralService($form);
        $form->monthly_consumption = $monthly_consumption;
        $rate = $collateral->findRangeRate();

        if($form->discount_rate) {
            $discounted_price = number_format(($form->discount_rate / 100) * $monthly_consumption, 2);
        } else {
            $discounted_price = number_format(($rate['percent'] / 100) * $monthly_consumption, 2);
        }


        return response()->json(['success' => 'Success', 'percent' => $rate['percent'], 'price' => $discounted_price]);
    }
}