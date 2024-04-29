<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\WithdrawRequestDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class WithdrawController extends Controller
{
    public function index(WithdrawRequestDataTable $dataTable)
    {
        return $dataTable->render('admin.withdraw.index');
    }

    public function show(string $id)
    {
        $request = WithdrawRequest::query()->findOrFail($id);

        return view('admin.withdraw.show', compact('request'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => ['required', 'in:pending,paid,declined']
        ]);

        try {
            $validator->validate();
        } catch (ValidationException $e) {
            $error = $e->validator->errors()->first();
            return redirect()->back()->with(['message' => $error, 'alert-type' => 'error']);
        }

        $withdraw = WithdrawRequest::query()->findOrFail($id);

        $withdraw->status = $request->status;

        $withdraw->save();

        if ($request->status === 'paid') {
            $user_id = Vendor::find($withdraw->vendor_id)->user->id;
            $user = User::find($user_id);
            $user->wallet->withdraw($withdraw->total_amount);
        }

        return redirect()->route('admin.withdraw.index')
            ->with(['message' => 'Updated successfully!']);
    }
}
