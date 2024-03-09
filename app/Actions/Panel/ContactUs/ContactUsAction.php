<?php

namespace App\Actions\Panel\ContactUs;

use App\Actions\Panel\ContactUs\Interfaces\ContactUsInterface;
use App\Models\ContactUs;
use Illuminate\Http\JsonResponse;

// ... other imports ...

class ContactUsAction implements ContactUsInterface
{
    public function leads($request): JsonResponse
    {
        $search = $request->search;
        $leads = ContactUs::where('id', 'LIKE', '%'.$search.'%')
                ->orwhere('name', 'LIKE', '%'.$search.'%')
                ->orwhere('email', 'LIKE', '%'.$search.'%')
                ->orwhere('phone', 'LIKE', '%'.$search.'%')
                ->orwhere('message', 'LIKE', '%'.$search.'%')
                ->orderBy('id', 'desc')
                ->paginate();
        return response()->json($leads);
    }

    public function updateStatus($request, ContactUs $contact): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'status' => 'required|boolean',
            ]);

            $contact->status = $validatedData['status'];
            $contact->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error updating status: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($request): JsonResponse
    {
        $leads = json_decode($request->leads);
        
        foreach($leads as $lead){
            ContactUs::find($lead)->delete();
        }

        return response()->json([
            'message' => '¡Deleted successfully!.',
        ], 200);
    }
}
