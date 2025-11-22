<?php

namespace App\Http\Controllers;

use App\Models\CertificateRequest;
use App\Models\CertificateType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = CertificateRequest::where('user_id', Auth::id())
            ->with('certificateType')
            ->latest()
            ->get();

        return view('certificates.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $certificateTypes = CertificateType::where('is_active', true)->get();

        return view('certificates.create', compact('certificateTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'certificate_type_id' => 'required|exists:certificate_types,id',
            'purpose' => 'required|string|max:500',
            'notes' => 'nullable|string|max:1000',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        CertificateRequest::create($validated);

        return redirect()->route('certificates.index')
            ->with('success', 'Certificate request submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(CertificateRequest $certificate)
    {
        if ($certificate->user_id !== Auth::id()) {
            abort(403);
        }

        return view('certificates.show', compact('certificate'));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
