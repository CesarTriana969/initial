<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index(){
        return view('admin.subscribers.index');
    }

    public function subscribers(Request $request): JsonResponse
    {
        $search = $request->search;
        $subscribers = Subscriber::where('id', 'LIKE', '%'.$search.'%')
                ->orwhere('email', 'LIKE', '%'.$search.'%')
                ->orderBy('id', 'desc')
                ->paginate();

        return response()->json($subscribers);
    }

    public function destroy(Request $request): JsonResponse
    {
        $subscribers = json_decode($request->subscribers);
        foreach($subscribers as $subscriber){
            Subscriber::find($subscriber)->delete();
        }

        return response()->json([
            'message' => '¡Deleted successfully!.',
        ], 200);
    }
}
