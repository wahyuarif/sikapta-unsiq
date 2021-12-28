<?php

namespace App\Service\Impl;

use App\Http\Requests\ReviewKPRequest;
use App\Http\Response\ReviewKPResponse;
use App\Model\Dosen;
use App\Model\ReviewKP;
use App\Service\ReviewKPService;
use App\Service\SessionService;
use Illuminate\Support\Facades\DB;

class ReviewKPServiceImpl implements ReviewKPService
{

    private SessionService $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionServiceImpl();
    }

    public function save(ReviewKPRequest $request)
    {
        $dosen = $this->sessionService->currentDosen();

        try {
            DB::beginTransaction();
            $reviewKP = new ReviewKP();
            $reviewKP->pengajuankp_id = $request->pengajuankp_id;
            $reviewKP->dosen_id = $dosen->nip;
            $reviewKP->review = $request->review;
            $reviewKP->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }

        $response = new ReviewKPResponse();
        $response->reviewKP = $reviewKP;

        return $response;

    }

}