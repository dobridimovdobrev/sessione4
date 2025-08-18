<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Credit;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\api\v1\CreditResource;
use App\Http\Requests\api\v1\CreditStoreRequest;
use App\Http\Resources\api\v1\CreditCollection;

class CreditController extends Controller
{
    /**
     * Display the credits for the authenticated user.
     */
    public function index()
    {
        $this->authorize('viewAny', Credit::class);

        // Retrieve credits belonging only to the authenticated user
        $credits = Credit::where('user_id', Auth::id())->get();

        return new CreditCollection($credits);
    }

    /**
     * Get current user's credit balance
     */
    public function getBalance()
    {
        $credit = Credit::where('user_id', Auth::id())->first();
        
        if (!$credit) {
            return response()->json([
                'remaining_credits' => 0,
                'total_credits' => 0,
                'spent_credits' => 0,
                'message' => 'Nessun credito disponibile'
            ]);
        }

        return response()->json([
            'remaining_credits' => $credit->remaining_credits,
            'total_credits' => $credit->total_credits,
            'spent_credits' => $credit->spent_credits,
            'credit_id' => $credit->credit_id
        ]);
    }

    /**
     * Add credits to the authenticated user's account.
     */
    public function store(CreditStoreRequest $request)
    {
        $this->authorize('create', Credit::class);

        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id(); // Automatically associate with the authenticated user
        $validatedData['spent_credits'] = 0; // Initialize spent credits to zero
        $validatedData['remaining_credits'] = $validatedData['total_credits']; // Set remaining credits equal to total credits
        $credit = Credit::create($validatedData);

        return ResponseMessages::success([
            'message' => 'Credits added successfully',
            'credit' => new CreditResource($credit)
        ], 201);
    }

    /**
     * Show the details of a specific credit record.
     */
    public function show(Credit $credit)
    {
        $this->authorize('view', $credit);

        return new CreditResource($credit);
    }

    /**
     * Delete a specific credit record.
     */
    public function destroy(Credit $credit)
    {
        $this->authorize('delete', $credit);

        $credit->delete();

        return ResponseMessages::success('Credits record deleted successfully', 204);
    }
}
