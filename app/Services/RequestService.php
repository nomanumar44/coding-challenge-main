<?php

namespace App\Services;

use App\Repositories\RequestRepository;

class RequestService{
    protected $requestRepository;

    public function __construct(RequestRepository $requestRepository)
    {
        $this->requestRepository = $requestRepository;
    }
    public function getSuggession($request)
    {
        return $this->requestRepository->getSuggession($request);
    }
    public function getSentRequest($request)
    {
        return $this->requestRepository->getSentRequest($request);
    }
    public function getReceiveRequest($request)
    {
        return $this->requestRepository->getReceiveRequest($request);
    }
    public function getConnectedRequest($request)
    {
        return $this->requestRepository->getConnectedRequest($request);
    }
    public function common_connection($auth_connection = null, $con)
    {
        return $this->requestRepository->common_connection($auth_connection = null, $con);
    }
    public function common($user_id)
    {
        return $this->requestRepository->common($user_id);
    }
    public function connectionRequest($request)
    {
        return $this->requestRepository->connectionRequest($request);
    }
    public function withdrawRequest($request)
    {
        return $this->requestRepository->withdrawRequest($request);
    }
    public function acceptRequest($request)
    {
        return $this->requestRepository->acceptRequest($request);
    }
    public function cancelRequest($request)
    {
        return $this->requestRepository->cancelRequest($request);
    }
}
