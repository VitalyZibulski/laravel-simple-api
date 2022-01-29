<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return TransactionResource::collection(Transaction::with('category')->get());
    }

    public function store(Request $request)
    {
       return new TransactionResource(Transaction::create($request->validated()));
    }

    public function show(Transaction $transaction)
    {
        return new TransactionResource($transaction);
    }

    public function update(StoreTransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->validated());

        return new TransactionResource($transaction);
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return response()->noContent();
    }
}
