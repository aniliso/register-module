<?php

namespace Modules\Register\Http\Controllers;

use Doctrine\DBAL\Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Page\Entities\Page;
use Modules\Register\Entities\File;
use Modules\Register\Entities\Form;
use Modules\Register\Http\Requests\Step1Request;
use Modules\Register\Http\Requests\Step2Request;
use Modules\Register\Http\Requests\Step3Request;
use Modules\Register\Http\Requests\Step4Request;
use Modules\Register\Http\Requests\Step5Request;
use Modules\Register\Services\CollateralService;

class PublicController extends BasePublicController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function step1(Request $request)
    {
        $form = $request->session()->get('form');

        $this->seo()->setTitle('Başvuru Bilgileri - Taşıt Tanıma Sistemi Başvuru Formu')
            ->setDescription('Başvuru Bilgileri - Taşıt Tanıma Sistemi Başvuru Formu');

        return view('register::step-1', compact('form'));
    }

    public function postStep1(Step1Request $request)
    {
        if (empty($request->session()->get('form'))) {
            $form = new Form();
            $form = $form->fill($request->all());
            $request->session()->put('form', $form);
        } else {
            $form = $request->session()->get('form');
            $form->fill($request->all());
            $request->session()->put('form', $form);
        }

        return redirect()->route('register.form.step-2');
    }

    public function step2(Request $request)
    {
        if (empty($request->session()->get('form'))) {
            return redirect()->route('register.form.step-1');
        }

        $form = $request->session()->get('form');

        $this->seo()->setTitle('Teminat Türü - Taşıt Tanıma Sistemi Başvuru Formu')
            ->setDescription('Teminat Türü - Taşıt Tanıma Sistemi Başvuru Formu');

        return view('register::step-2', compact('form'));
    }

    public function postStep2(Step2Request $request)
    {
        $form = $request->session()->get('form');
        $form->fill($request->all());

        if($request->get('collateral_id') !== setting('register::credit-card')) {
            $form->credit_card = null;
        }

        $request->session()->put('form', $form);

        return redirect()->route('register.form.step-3');
    }

    public function step3(Request $request)
    {
        if (empty($request->session()->get('form'))) {
            return redirect()->route('register.form.step-1');
        }

        $form = $request->session()->get('form');

        $this->seo()->setTitle('Teminat/Tüketim - Taşıt Tanıma Sistemi Başvuru Formu')
            ->setDescription('Teminat/Tüketim - Taşıt Tanıma Sistemi Başvuru Formu');

        return view('register::step-3', compact('form'));
    }

    public function postStep3(Step3Request $request)
    {
        $form = $request->session()->get('form');
        $form->fill($request->all());
        $request->session()->put('form', $form);

        return redirect()->route('register.form.step-4');
    }

    public function step4(Request $request)
    {
        if (empty($request->session()->get('form'))) {
            return redirect()->route('register.form.step-1');
        }

        $form = $request->session()->get('form');
        $form_files = $request->session()->get('form_files');

        $this->seo()->setTitle('Başvuru Belgeleri - Taşıt Tanıma Sistemi Başvuru Formu')
            ->setDescription('Başvuru Belgeleri - Taşıt Tanıma Sistemi Başvuru Formu');

        return view('register::step-4', compact('form', 'form_files'));
    }

    public function step5(Request $request)
    {
        if (empty($request->session()->get('form'))) {
            return redirect()->route('register.form.step-1');
        }

        $form = $request->session()->get('form');
        $form_files = $request->session()->get('form_files');

        $collateral = new CollateralService($form);
        $rate = $collateral->findRangeRate();

        $this->seo()->setTitle('Başvuruyu Tamamla - Taşıt Tanıma Sistemi Başvuru Formu')
            ->setDescription('Başvuruyu Tamamla - Taşıt Tanıma Sistemi Başvuru Formu');

        return view('register::step-5', compact('form', 'form_files', 'rate'));
    }

    public function postStep5(Step5Request $request)
    {
        $form = $request->session()->get('form');
        $form->fill($request->all());
        $request->session()->put('form', $form);

        $formComplete = $request->session()->get('form');
        $formComplete->save();

        $form_files = $request->session()->get('form_files');
        $formComplete->files()->saveMany($form_files->all());

        $request->session()->remove('form');
        $request->session()->remove('form_files');

        return redirect()->route('register.form.finish');
    }

    public function finish()
    {

        $this->seo()->setTitle('Başvuru Tamamlandı - Taşıt Tanıma Sistemi Başvuru Formu')
            ->setDescription('Başvuru Tamamlandı - Taşıt Tanıma Sistemi Başvuru Formu');

        return view('register::finish');
    }

    public function remove(Request $request)
    {
        try {
            $fileName = $request->get('name');

            \File::delete(public_path('assets/register/').$fileName);

            $form = $request->session()->get('form_files');

            $key = $form->search(function($item) use ($fileName){
                return $item->name ==  $fileName;
            });

            $form->pull($key);

            return response()->json(['success'=>'You have successfully deleted file.']);
        } catch (\Exception $exception) {
            return response()->json(['error'=>$exception->getMessage()]);
        }
    }

    public function files(Request $request)
    {
        if (empty($request->session()->get('form'))) {
            return redirect()->route('register.form.step-1');
        }

        $form = $request->session()->get('form_files');

        return response()->json($form);
    }

    public function upload(Step4Request $request)
    {
        if (empty($request->session()->get('form'))) {
            return redirect()->route('register.form.step-1');
        }

        $fileName = time().'_'.$request->file->getClientOriginalName();
        $fileType = $request->file->getMimeType();
        $path = $request->file->move(public_path('assets/register'), $fileName);
        $fileSize = \File::size($path);

        if (empty($request->session()->get('form_files'))) {
            $files = collect();
            $file = new File([
                'name' => $fileName,
                'type' => $fileType,
                'size' => $fileSize
            ]);
            $files->push($file);
            $request->session()->put('form_files', $files);
        } else {
            $form = $request->session()->get('form_files');
            $file = new File([
                'name' => $fileName,
                'type' => $fileType,
                'size' => $fileSize
            ]);
            $form->push($file);
            $request->session()->put('form_files', $form);
        }

        return response()->json(['success'=>'You have successfully upload file.']);
    }
}