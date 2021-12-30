<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Requests\ReviewKPRequest;
use App\Model\PengajuanKP;
use App\Service\Impl\ReviewKPServiceImpl;
use App\Service\Impl\SessionServiceImpl;
use App\Http\Controllers\Controller;
use App\Service\SessionService;
use App\Service\ReviewKPService;

class ReviewKPController extends Controller
{
    private SessionService $sessionService;
    private ReviewKPService $reviewKPService;

    public function __construct()
    {
        $this->sessionService = new SessionServiceImpl();
        $this->reviewKPService = new ReviewKPServiceImpl();
    }

    public function save(ReviewKPRequest $request)
    {
        try {
            $response = $this->reviewKPService->save($request);
            return back()->with("success", "Data berhasil disimpan");
        } catch (PengajuanKPException $exception) {
            return back()->with("error", $exception->getMessage())->withInput($request->all());
        }
    }

}
