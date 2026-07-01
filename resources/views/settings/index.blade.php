<x-app-layout>
    <div class="mb-4">
        <h2 class="fw-bold mb-1">Application Settings</h2>
        <p class="text-secondary small mb-0">Configure score allocation rules, upload branding logos, and customize corporate dashboard styles.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger rounded-4 border-0 shadow-sm p-4 mb-4">
            <h6 class="fw-bold mb-2">Please correct the following:</h6>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card glass-card border-0 p-4 mb-4">
        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row g-4">
                <!-- Point System Settings -->
                <div class="col-12 col-md-6">
                    <h5 class="fw-bold text-primary mb-3">1. Performance Point Allocation</h5>
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label small fw-semibold">Walk-in Visit Score</label>
                            <input type="number" name="walk_in_score" class="form-control text-center fw-bold" value="{{ old('walk_in_score', $settings['walk_in_score']) }}" required min="0">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-semibold">Registration Score</label>
                            <input type="number" name="registration_score" class="form-control text-center fw-bold" value="{{ old('registration_score', $settings['registration_score']) }}" required min="0">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-semibold">Admission Score</label>
                            <input type="number" name="admission_score" class="form-control text-center fw-bold" value="{{ old('admission_score', $settings['admission_score']) }}" required min="0">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-semibold">Full Payment Score</label>
                            <input type="number" name="payment_score" class="form-control text-center fw-bold" value="{{ old('payment_score', $settings['payment_score']) }}" required min="0">
                        </div>
                    </div>
                    <p class="text-secondary small mt-3">Points are computed automatically when an executive records status transitions on student enquiries.</p>
                </div>

                <!-- Branding Settings -->
                <div class="col-12 col-md-6">
                    <h5 class="fw-bold text-primary mb-3">2. Corporate Branding & Design</h5>
                    <div class="row g-3">
                        <div class="col-4 text-center">
                            <label class="form-label small fw-semibold">Primary Color</label>
                            <input type="color" name="brand_color_primary" class="form-control form-control-color w-100 p-1" value="{{ old('brand_color_primary', $settings['brand_color_primary']) }}" required>
                            <div class="font-monospace small mt-1 text-uppercase">{{ $settings['brand_color_primary'] }}</div>
                        </div>
                        <div class="col-4 text-center">
                            <label class="form-label small fw-semibold">Secondary</label>
                            <input type="color" name="brand_color_secondary" class="form-control form-control-color w-100 p-1" value="{{ old('brand_color_secondary', $settings['brand_color_secondary']) }}" required>
                            <div class="font-monospace small mt-1 text-uppercase">{{ $settings['brand_color_secondary'] }}</div>
                        </div>
                        <div class="col-4 text-center">
                            <label class="form-label small fw-semibold">Accent</label>
                            <input type="color" name="brand_color_accent" class="form-control form-control-color w-100 p-1" value="{{ old('brand_color_accent', $settings['brand_color_accent']) }}" required>
                            <div class="font-monospace small mt-1 text-uppercase">{{ $settings['brand_color_accent'] }}</div>
                        </div>
                    </div>
                    
                    <hr class="text-secondary opacity-25 my-4">
                    
                    <!-- Logo Setting -->
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Upload Brand Logo</label>
                        <input type="file" name="logo" class="form-control">
                        @if($settings['logo'])
                            <div class="mt-2 p-2 bg-light border rounded d-inline-block">
                                <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Brand Logo" height="40" class="rounded">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-12 d-flex justify-content-end gap-2 border-top pt-4">
                    <button type="submit" class="btn btn-primary btn-rounded px-4 py-2.5 fw-semibold"><i class="bi bi-save me-1"></i> Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
