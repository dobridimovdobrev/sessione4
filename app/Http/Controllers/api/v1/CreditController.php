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
     * Get current user's credit balance (summing all credit records)
     */
    public function getBalance()
    {
        $credits = Credit::where('user_id', Auth::id())->get();
        
        if ($credits->isEmpty()) {
            return response()->json([
                'remaining_credits' => 0,
                'total_credits' => 0,
                'spent_credits' => 0,
                'message' => 'Nessun credito disponibile'
            ]);
        }

        // Somma tutti i crediti dell'utente
        $totalCredits = $credits->sum('total_credits');
        $spentCredits = $credits->sum('spent_credits');
        $remainingCredits = $credits->sum('remaining_credits');
        
        return response()->json([
            'remaining_credits' => $remainingCredits,
            'total_credits' => $totalCredits,
            'spent_credits' => $spentCredits,
            'credit_records' => $credits->count()
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
     * Consume credits for video playback
     */
    public function consumeCredits()
    {
        $user = Auth::user();
        
        // Admin has unlimited access
        if ($user->role->role_name === 'admin') {
            return ResponseMessages::success([
                'message' => 'Admin has unlimited access',
                'can_play' => true,
                'remaining_credits' => 'unlimited'
            ], 200);
        }

        $creditCost = 20; // Cost per video
        
        // Calcola il totale dei crediti disponibili
        $credits = Credit::where('user_id', Auth::id())->get();
        $totalRemainingCredits = $credits->sum('remaining_credits');
        
        // Check if user has enough credits
        if ($credits->isEmpty() || $totalRemainingCredits < $creditCost) {
            return ResponseMessages::error([
                'message' => 'Crediti insufficienti per riprodurre il video',
                'can_play' => false,
                'remaining_credits' => $totalRemainingCredits,
                'required_credits' => $creditCost
            ], 402); // Payment Required
        }

        // Consume credits from the first record that has enough credits
        $creditToUse = $credits->first(function($credit) use ($creditCost) {
            return $credit->remaining_credits >= $creditCost;
        });
        
        // If no single record has enough credits, use the first record and update as needed
        if (!$creditToUse) {
            $creditToUse = $credits->first();
        }
        
        $creditToUse->spent_credits += $creditCost;
        $creditToUse->remaining_credits -= $creditCost;
        $creditToUse->update_date = now();
        $creditToUse->save();

        // Ricalcola il totale dei crediti rimanenti dopo il consumo
        $updatedTotalRemainingCredits = Credit::where('user_id', Auth::id())->sum('remaining_credits');
        
        return ResponseMessages::success([
            'message' => 'Crediti consumati con successo',
            'can_play' => true,
            'consumed_credits' => $creditCost,
            'remaining_credits' => $updatedTotalRemainingCredits,
            'credit_records' => $credits->count()
        ], 200);
    }

    /**
     * Check if user can play video without consuming credits
     */
    public function canPlay()
    {
        $user = Auth::user();
        
        // Admin has unlimited access
        if ($user->role->role_name === 'admin') {
            return ResponseMessages::success([
                'can_play' => true,
                'remaining_credits' => 'unlimited'
            ], 200);
        }

        $creditCost = 20;
        $credits = Credit::where('user_id', Auth::id())->get();
        $totalRemainingCredits = $credits->sum('remaining_credits');
        
        $canPlay = !$credits->isEmpty() && $totalRemainingCredits >= $creditCost;
        
        return ResponseMessages::success([
            'can_play' => $canPlay,
            'remaining_credits' => $totalRemainingCredits,
            'required_credits' => $creditCost,
            'credit_records' => $credits->count()
        ], 200);
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
