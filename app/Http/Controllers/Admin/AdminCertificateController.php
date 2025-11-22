<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CertificateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CertificateRequest::with(['user', 'certificateType', 'processor']);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $requests = $query->latest()->paginate(20);

        return view('admin.certificates.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CertificateRequest $certificate)
    {
        $certificate->load(['user', 'certificateType', 'processor']);

        return view('admin.certificates.show', compact('certificate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CertificateRequest $certificate)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,approved,ready_for_pickup,released,rejected',
            'rejection_reason' => 'required_if:status,rejected|nullable|string',
        ]);

        $certificate->update([
            'status' => $validated['status'],
            'rejection_reason' => $validated['rejection_reason'] ?? null,
            'processed_by' => Auth::id(),
            'approved_at' => in_array($validated['status'], ['approved', 'ready_for_pickup', 'released']) ? now() : $certificate->approved_at,
            'released_at' => $validated['status'] === 'released' ? now() : $certificate->released_at,
        ]);

        return redirect()->route('admin.certificates.show', $certificate)
            ->with('success', 'Certificate request updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
