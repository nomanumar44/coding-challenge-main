<?php

namespace App\Http\Controllers;
use App\Services\RequestService;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    protected $requestService;

    public function __construct(RequestService $requestService)
    {
        $this->requestService = $requestService;
    }

    public function index(Request $request)
    {
        try {

            $data = [];
            return view('home', compact('data'));

        } catch (\Exception$error) {

            return $error->getMessage();
        }
    }
    public function getSuggesstions(Request $request)
    {
        try {
            $status = false;
            $data = '';
            $data = $this->requestService->getSuggession($request);
            $returnProductHTML = view('components.suggestion', ['suggesstions' => $data['data'], 'count' => $data['count']])->render();
            if ($returnProductHTML != '') {
                $status = true;
            }
            return response()->json(['status' => $status, 'data' => $returnProductHTML, 'count' => $data['count']]);

        } catch (\Exception$error) {

            return $error->getMessage();
        }
    }
    public function getSentRequest(Request $request)
    {
        try {
            $status = false;
            $data = '';
            $data = $this->requestService->getSentRequest($request);
            $returnProductHTML = view('components.request', ['requests' => $data['data'], 'mode' => 'sent'])->render();
            if ($returnProductHTML != '') {
                $status = true;
            }
            return response()->json(['status' => $status, 'data' => $returnProductHTML, 'count' => $data['count']]);

        } catch (\Exception$error) {

            return $error->getMessage();
        }
    }
    public function getReceiveRequest(Request $request)
    {
        try {
            $status = false;
            $data = '';
            $data = $this->requestService->getReceiveRequest($request);
            $returnProductHTML = view('components.request', ['requests' => $data['data'], 'mode' => 'receive'])->render();

            if ($returnProductHTML != '') {
                $status = true;
            }

            return response()->json(['status' => $status, 'data' => $returnProductHTML, 'count' => $data['count']]);

        } catch (\Exception$error) {

            return $error->getMessage();
        }
    }
    public function getConnected(Request $request)
    {
        try {
            $status = false;
            $data = '';
            $data = $this->requestService->getConnectedRequest($request);
            $returnProductHTML = view('components.connection', ['connections' => $data['data']])->render();

            if ($returnProductHTML != '') {
                $status = true;
            }

            return response()->json(['status' => $status, 'data' => $returnProductHTML, 'count' => $data['count']]);

        } catch (\Exception$error) {

            return $error->getMessage();
        }
    }
    public function getCommon(Request $request)
    {
        try {
            $status = false;
            $data = '';
            $data = $this->requestService->common_connection(null, $request->id);
            $returnProductHTML = view('components.connection_in_common', ['commons' => $data])->render();

            if ($returnProductHTML != '') {
                $status = true;
            }

            return response()->json(['status' => $status, 'data' => $returnProductHTML]);

        } catch (\Exception$error) {

            return $error->getMessage();
        }
    }

    public function sendRequest(Request $request)
    {
        try {

            $message = '';
            $status = false;
            $connection = $this->requestService->connectionRequest($request);
            if ($connection) {
                $message = 'Connection Request Sent!';
                $status = true;
            } else {
                $message = 'Something went Wrong!';
            }
            return response()->json(['status' => $status, 'message' => $message]);

        } catch (\Exception$error) {

            return $error->getMessage();
        }
    }
    public function withdrawRequest(Request $request)
    {
        try {

            $message = '';
            $status = false;
            $withdraw = $this->requestService->withdrawRequest($request);
            if ($withdraw) {
                $message = 'Request Withdraw!';
                $status = true;
            } else {
                $message = 'Something went Wrong!';
            }
            return response()->json(['status' => $status, 'message' => $message]);

        } catch (\Exception$error) {

            return $error->getMessage();
        }
    }
    public function acceptRequest(Request $request)
    {
        try {

            $message = '';
            $status = false;
            $withdraw = $this->requestService->acceptRequest($request);
            if ($withdraw) {
                $message = 'Request Accepted!';
                $status = true;
            } else {
                $message = 'Something went Wrong!';
            }
            return response()->json(['status' => $status, 'message' => $message]);

        } catch (\Exception$error) {

            return $error->getMessage();
        }
    }
    public function cancelRequest(Request $request)
    {
        try {

            $message = '';
            $status = false;
            $cancelled = $this->requestService->cancelRequest($request);
            if ($cancelled) {
                $message = 'Request Cancelled!';
                $status = true;
            } else {
                $message = 'Something went Wrong!';
            }
            return response()->json(['status' => $status, 'message' => $message]);

        } catch (\Exception$error) {

            return $error->getMessage();
        }
    }

}
