<?php

namespace App\Http\Controllers;

use App\Benefit;
use Illuminate\Http\Request;

class BenefitController extends Controller
{
    public function destroy($id){
        Benefit::findOrFail($id)->delete();

        return redirect(route('admin.subscriptions.index'));
    }
}
