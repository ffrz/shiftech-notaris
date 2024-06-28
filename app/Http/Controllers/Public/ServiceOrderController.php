<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AclResource;
use App\Models\ProductCategory;
use App\Models\ServiceOrder;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceOrderController extends Controller
{
    public function track(Request $request, $id)
    {
        $id = decrypt_id($id);
        $serviceOrder = ServiceOrder::findOrFail($id);
        return view('public.service-order.track', compact('serviceOrder'));
    }
}
