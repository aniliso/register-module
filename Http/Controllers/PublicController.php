<?php

namespace Modules\Register\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Register\Entities\File;
use Modules\Register\Entities\Form;
use Modules\Register\Exceptions\FormSessionException;
use Modules\Register\Http\Requests\Step1Request;
use Modules\Register\Http\Requests\Step2Request;
use Modules\Register\Http\Requests\Step3Request;
use Modules\Register\Http\Requests\Step4Request;
use Modules\Register\Http\Requests\Step5Request;
use Modules\Register\Jobs\FormEmail;
use Modules\Register\Jobs\FormPersonalEmail;
use Modules\Register\Services\CollateralService;
use Themelogy\MobileService\Exceptions\ValidateCodeException;
use Themelogy\MobileService\MobileService;

class PublicController extends BasePublicController
{
    /**
     * @var MobileService
     */
    private $mobileService;

    public function __construct(MobileService $mobileService)
    {
        parent::__construct();
        $this->mobileService = $mobileService;
    }

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
        try {
            $this->returnStep1($request);

            $form = $request->session()->get('form');

            $this->seo()->setTitle('Teminat Türü - Taşıt Tanıma Sistemi Başvuru Formu')
                ->setDescription('Teminat Türü - Taşıt Tanıma Sistemi Başvuru Formu');

            return view('register::step-2', compact('form'));
        } catch (FormSessionException $exception) {
            return redirect()->route('register.form.step-1')->withErrors($exception->getMessage());
        }
    }

    public function postStep2(Step2Request $request)
    {
        try {
            $this->returnStep1($request);

            $form = $request->session()->get('form');
            $form->fill($request->all());

            if ($request->get('collateral_id') !== setting('register::credit-card')) {
                $form->credit_card = null;
            }

            $request->session()->put('form', $form);

            return redirect()->route('register.form.step-3');
        } catch (FormSessionException $exception) {
            return redirect()->route('register.form.step-1')->withErrors($exception->getMessage());
        }
    }

    public function step3(Request $request)
    {
        try {
            $this->returnStep1($request);

            $form = $request->session()->get('form');

            $this->seo()->setTitle('Teminat/Tüketim - Taşıt Tanıma Sistemi Başvuru Formu')
                ->setDescription('Teminat/Tüketim - Taşıt Tanıma Sistemi Başvuru Formu');

            return view('register::step-3', compact('form'));
        } catch (FormSessionException $exception) {
            return redirect()->route('register.form.step-1')->withErrors($exception->getMessage());
        }
    }

    public function postStep3(Step3Request $request)
    {
        try {
            $this->returnStep1($request);

            $form = $request->session()->get('form');

            $collateral = new CollateralService($form);
            $rate = $collateral->findRangeRate();
            $form->discount_rate = $rate['percent'];

            $form->fill($request->all());
            $request->session()->put('form', $form);

            return redirect()->route('register.form.step-4');
        } catch (FormSessionException $exception) {
            return redirect()->route('register.form.step-1')->withErrors($exception->getMessage());
        }
    }

    public function step4(Request $request)
    {
        try {
            $this->returnStep1($request);

            $form = $request->session()->get('form');
            $form_files = $request->session()->get('form_files');

            $this->seo()->setTitle('Başvuru Belgeleri - Taşıt Tanıma Sistemi Başvuru Formu')
                ->setDescription('Başvuru Belgeleri - Taşıt Tanıma Sistemi Başvuru Formu');

            return view('register::step-4', compact('form', 'form_files'));

        } catch (FormSessionException $exception) {
            return redirect()->route('register.form.step-1')->withErrors($exception->getMessage());
        }
    }

    public function step5(Request $request)
    {
        try {
            $this->returnStep1($request);

            $form = $request->session()->get('form');

            $form_files = $request->session()->get('form_files');

            if ($form->collateral_id) {
                $collateral = new CollateralService($form);
                $rate = $collateral->findRangeRate();
            } else {
                throw new \Exception("Teminat Türü Seçmediniz");
            }

            $this->seo()->setTitle('Başvuruyu Tamamla - Taşıt Tanıma Sistemi Başvuru Formu')
                ->setDescription('Başvuruyu Tamamla - Taşıt Tanıma Sistemi Başvuru Formu');

            return view('register::step-5', compact('form', 'form_files', 'rate'));
        } catch (FormSessionException $exception) {
            return redirect()->route('register.form.step-1')->withErrors($exception->getMessage());
        } catch (\Exception $exception) {
            return redirect()->route('register.form.step-1')->withErrors($exception->getMessage());
        }
    }

    public function postStep5(Step5Request $request)
    {
        try {
            $this->returnStep1($request);

            $form = $request->session()->get('form');

            $form->fill($request->all());
            $request->session()->put('form', $form);

            return redirect()->route('register.form.verification');
        } catch (FormSessionException $exception) {
            return redirect()->route('register.form.step-1')->withErrors($exception->getMessage());
        } catch (\Exception $exception) {
            return redirect()->route('register.form.step-5')->withErrors($exception->getMessage());
        }
    }

    public function verification(Request $request)
    {
        try {
            $this->returnStep1($request);
//            $this->mobileService->checkAuth();

            $this->seo()->setTitle('Doğrulama Kodu - Taşıt Tanıma Sistemi Başvuru Formu')
                ->setDescription('Doğrulama Kodu - Taşıt Tanıma Sistemi Başvuru Formu');

            return view('register::verification');
        } catch (FormSessionException $exception) {
            return redirect()->route('register.form.step-1')->withErrors($exception->getMessage(), 'exception');
        } catch (\Exception $exception) {
            return redirect()->route('register.form.step-1')->withErrors($exception->getMessage(), 'exception');
        }
    }

    public function postCode(Request $request)
    {
        try {
            $this->returnStep1($request);
            $form = $request->session()->get('form');

            if (!$this->mobileService->getVerificationCode($form->present()->mobile_phone)) {
                $this->mobileService->sendVerificationCode($form->present()->mobile_phone);
                $message = "Doğrulama kodu mesajı başarıyla gönderildi.";
            } else {
                $message = "Doğrulama kodu mesajınızı henüz doğrulamadınız. Lütfen kısa mesajınızın gelmesini bekleyiniz";
            }
            return response()->json(['success' => true, 'message' => $message]);

        } catch (FormSessionException $exception) {
            return redirect()->route('register.form.step-1')->withErrors($exception->getMessage());
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => 'Doğrulama kodu gönderilirken bir hata oluştu. Tekrar deneyiniz.', Response::HTTP_BAD_REQUEST]);
        }
    }

    public function postValidate(Request $request)
    {
        try {
            $this->returnStep1($request);
            $form = $request->session()->get('form');
            $code = $request->get('verificationCode');
            if($this->mobileService->validateVerificationCode($form->present()->mobile_phone, $code)) {
                $formComplete = $request->session()->get('form');
                $formComplete->save();

                $form_files = $request->session()->get('form_files');

                if ($form_files) {
                    $formComplete->files()->saveMany($form_files->all());
                }

                FormPersonalEmail::dispatch($formComplete);
                FormEmail::dispatch($formComplete);

                $request->session()->remove('form');
                $request->session()->remove('form_files');
            }
            return response()->json([
                'success' => true,
                'message' => 'true'
            ]);

        } catch (FormSessionException $e) {
            return redirect()->route('register.form.step-1')->withErrors($e->getMessage());
        } catch (ValidateCodeException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
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
            $this->returnStep1($request);

            $fileName = $request->get('name');

            \File::delete(public_path('assets/register/') . $fileName);

            $form = $request->session()->get('form_files');

            $key = $form->search(function ($item) use ($fileName) {
                return $item->name == $fileName;
            });

            $form->pull($key);

            return response()->json(['success' => 'You have successfully deleted file.']);
        } catch (FormSessionException $exception) {
            return redirect()->route('register.form.step-1')->withErrors($exception->getMessage());
        } catch (\Exception $exception) {
            return redirect()->route('register.form.step-1')->withErrors($exception->getMessage());
        }
    }

    public function files(Request $request)
    {
        try {
            $this->returnStep1($request);

            $form = $request->session()->get('form_files');
            return response()->json($form);
        } catch (FormSessionException $exception) {
            return redirect()->route('register.form.step-1')->withErrors($exception->getMessage());
        } catch (\Exception $exception) {
            return redirect()->route('register.form.step-1')->withErrors($exception->getMessage());
        }
    }

    public function upload(Step4Request $request)
    {
        try {
            $this->returnStep1($request);

            $fileName = time() . '_' . $request->file->getClientOriginalName();
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

            return response()->json(['success' => 'You have successfully upload file.']);
        } catch (FormSessionException $exception) {
            return redirect()->route('register.form.step-1')->withErrors($exception->getMessage());
        } catch (\Exception $exception) {
            return redirect()->route('register.form.step-1')->withErrors($exception->getMessage());
        }
    }

    public function rates(Request $request)
    {
        if (empty($request->session()->get('form'))) {
            return redirect()->route('register.form.step-1');
        }

        $monthly_consumption = $request->get('monthly_consumption');
        $form = $request->session()->get('form');

        $collateral = new CollateralService($form);
        $form->monthly_consumption = $monthly_consumption;
        $rate = $collateral->findRangeRate();

        $discounted_price = number_format(($rate['percent'] / 100) * $monthly_consumption, 2);

        return response()->json(['success' => 'Success', 'percent' => $rate['percent'], 'price' => $discounted_price]);
    }

    private function returnStep1(Request $request)
    {
        if (empty($request->session()->get('form'))) {
            throw new FormSessionException("Form bilgileri sağlanamadı");
        }
        return true;
    }
}
