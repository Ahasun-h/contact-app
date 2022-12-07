<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactGroup;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $contactGroups = ContactGroup::all();

        return response()->json([
            'status' => true,
            'contacts' => $contactGroups
        ]);
    }
}
