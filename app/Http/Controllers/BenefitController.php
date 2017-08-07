<?php

namespace App\Http\Controllers;

use App\Benefit;
use Illuminate\Http\Request;

class BenefitController extends Controller
{
    public function destroy($id)
    {
        $benefit = Benefit::findOrFail($id);
        $benefit->delete();
        if( $benefit->trashed()) {
            return redirect(route('admin.subscriptions.index'));
        }
    }
}
