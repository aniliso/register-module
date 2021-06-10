<?php

namespace Modules\Register\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Register\Entities\File;
use Modules\Register\Http\Requests\CreateFileRequest;
use Modules\Register\Http\Requests\UpdateFileRequest;
use Modules\Register\Repositories\FileRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class FileController extends AdminBaseController
{
    /**
     * @var FileRepository
     */
    private $file;

    public function __construct(FileRepository $file)
    {
        parent::__construct();

        $this->file = $file;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$files = $this->file->all();

        return view('register::admin.files.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('register::admin.files.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateFileRequest $request
     * @return Response
     */
    public function store(CreateFileRequest $request)
    {
        $this->file->create($request->all());

        return redirect()->route('admin.register.file.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('register::files.title.files')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  File $file
     * @return Response
     */
    public function edit(File $file)
    {
        return view('register::admin.files.edit', compact('file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  File $file
     * @param  UpdateFileRequest $request
     * @return Response
     */
    public function update(File $file, UpdateFileRequest $request)
    {
        $this->file->update($file, $request->all());

        return redirect()->route('admin.register.file.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('register::files.title.files')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  File $file
     * @return Response
     */
    public function destroy(File $file)
    {
        $this->file->destroy($file);

        return redirect()->route('admin.register.file.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('register::files.title.files')]));
    }
}