<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\{Construction};


class ConstructionController extends Controller
{
    public function newConstructionPost(Request $request)
    {
        $submitBtnValue = $request->submit_btn;
        if($submitBtnValue == 'create') {
            $construction = new Construction();
            $construction->user_id = auth()->user()->id;
            $construction->name = $request->cname;
            $construction->type = $request->type;
            $construction->zipcode = $request->zipcode;
            $construction->address = $request->address;
            $construction->number = $request->number;
            $construction->complement = $request->complement;
            $construction->neighborhood = $request->neighborhood;
            $construction->city = $request->city;
            $construction->state = $request->state;
            $construction->responsible = $request->responsible;
            $construction->phonenumber = $request->phonenumber;

            $construction->save();
            session()->flash('success', 'Você criou uma nova obra com sucesso.');
        } else {
            $construction = Construction::where('id', $submitBtnValue)->first();
            $construction->name = $request->cname;
            $construction->type = $request->type;
            $construction->zipcode = $request->zipcode;
            $construction->address = $request->address;
            $construction->number = $request->number;
            $construction->complement = $request->complement;
            $construction->neighborhood = $request->neighborhood;
            $construction->city = $request->city;
            $construction->state = $request->state;
            $construction->responsible = $request->responsible;
            $construction->phonenumber = $request->phonenumber;

            $construction->save();
            session()->flash('success', 'Você editou a nova obra com sucesso.');
        }


        return redirect()->back();
    }

    public function removeConstruction($id)
    {
        $construction = Construction::where('id', $id)->first();
        $construction->delete();
    }

    public function fetchConstruction($id) 
    {
        $construction = Construction::where('id', $id)->first();

        return response()->json([
            'construction' => $construction,
        ]);
    }
}
