<?php


namespace Modules\Register\Services;


use Modules\Register\Entities\Form;
use Modules\Register\Repositories\CollateralRepository;

class CollateralService
{
    /**
     * @var Form
     */
    private $form;
    private $collaterals;

    public function __construct(Form $form)
    {
        $this->form = $form;
        $this->collateral = app(CollateralRepository::class)->find($form->collateral_id);
    }

    private function getRates()
    {
        $rates = explode(PHP_EOL, $this->collateral->rates);
        $items = collect($rates);

        if ($items->count() > 0) {
            foreach ($items as $key => $item) {
                list($id, $file, $range, $rate) = explode(';', $item);
                list($start, $end) = explode('-', $range);

                if(str_contains($file, ',') !== false) {
                    $fileIds = explode(',', $file);
                    $files = array();
                    foreach ($fileIds as $fid) {
                        if(isset($this->collateral->files[intval($fid)-1])) {
                            $files[] = @$this->collateral->files[intval($fid)-1];
                        }
                    }
                } else {
                    $files = @$this->collateral->files[intval($file)-1];
                }

                $items[$key] = [
                    'id'      => intval($id),
                    'file'    => $files,
                    'range'   => [
                        'start' => doubleval($start),
                        'end'   => doubleval($end)
                    ],
                    'percent'   => doubleval(trim($rate))
                ];
            }
        }
        return $items;
    }

    public function findRangeRate()
    {
        $rates = $this->getRates();
        $rate = $rates->where('range.start', '<=', $this->form->collateral_amount)->where('range.end', '>=', $this->form->collateral_amount)->first();
        return $rate;
    }
}