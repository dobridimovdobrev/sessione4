<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Credit;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\Controller;
use App\Http\Resources\api\v1\CreditResource;
use App\Http\Resources\api\v1\CreditCollection;
use App\Http\Requests\api\v1\CreditStoreRequest;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Credit::class);
        $credits = Credit::paginate(100);
        return new CreditCollection($credits);
    }

    public function store(CreditStoreRequest $request)
    {
        $this->authorize('create', Credit::class);
        $validatedData = $request->validated();
        $credit = Credit::create($validatedData);

        return ResponseMessages::success(['message' => 'Credits added successfully', 'credit' => new CreditResource($credit)], 201);
    }

    public function show(Credit $credit)
    {
        $this->authorize('view', $credit);
        return new CreditResource($credit);
    }

    public function destroy(Credit $credit)
    {
        $this->authorize('delete', $credit);
        $credit->delete();

        return ResponseMessages::success('Credits record deleted successfully', 204);
    }
}
