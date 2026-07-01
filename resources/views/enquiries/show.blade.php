<x-app-layout>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <a href="{{ route('enquiries.index') }}" class="btn btn-light btn-rounded py-2 small fw-semibold mb-2"><i class="bi bi-arrow-left me-1"></i> Back to Enquiries</a>
            <h2 class="fw-bold mb-1">{{ $enquiry->student_name }}</h2>
            <p class="text-secondary small mb-0">Enquiry No: <strong class="text-primary font-monospace">{{ $enquiry->enquiry_number }}</strong> | Course: <strong class="text-secondary">{{ $enquiry->course?->name ?? 'N/A' }}</strong></p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('enquiries.edit', $enquiry->id) }}" class="btn btn-outline-primary btn-rounded fw-semibold py-2.5">
                <i class="bi-pencil me-1"></i> Edit Details
            </a>
            @php
                $badge = 'badge-new';
                if(strtolower($enquiry->current_status) === 'walk-in') $badge = 'badge-walkin';
                elseif(strtolower($enquiry->current_status) === 'registered') $badge = 'badge-registered';
                elseif(strtolower($enquiry->current_status) === 'admitted') $badge = 'badge-admitted';
                elseif(in_array(strtolower($enquiry->current_status), ['full payment', 'full_payment'])) $badge = 'badge-payment';
                elseif(strtolower($enquiry->current_status) === 'follow-up') $badge = 'badge-followup';
                elseif(strtolower($enquiry->current_status) === 'lost') $badge = 'badge-lost';
                elseif(strtolower($enquiry->current_status) === 'cancelled') $badge = 'badge-cancelled';
            @endphp
            <span class="badge {{ $badge }} px-3 py-2 btn-rounded fs-7 d-flex align-items-center">{{ $enquiry->current_status }}</span>
        </div>
    </div>

    <div class="row g-4">
        <!-- Column 1: Profile & Log Info -->
        <div class="col-12 col-lg-8">
            <!-- Details Card -->
            <div class="card glass-card border-0 p-4 mb-4">
                <h5 class="fw-bold text-primary mb-3">Student Demographics</h5>
                <div class="row g-3">
                    <div class="col-6 col-md-4">
                        <div class="small text-secondary">Phone Number</div>
                        <div class="fw-semibold"><i class="bi bi-telephone me-1"></i>{{ $enquiry->phone_number }}</div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="small text-secondary">WhatsApp</div>
                        <div class="fw-semibold">
                            @if($enquiry->whatsapp_number)
                                <a href="https://wa.me/{{ preg_replace('/\D/', '', $enquiry->whatsapp_number) }}" target="_blank" class="text-success text-decoration-none">
                                    <i class="bi bi-whatsapp me-1"></i>{{ $enquiry->whatsapp_number }}
                                </a>
                            @else
                                N/A
                            @endif
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="small text-secondary">Parent Contact</div>
                        <div class="fw-semibold">{{ $enquiry->parent_phone ?? 'N/A' }}</div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="small text-secondary">Email</div>
                        <div class="fw-semibold text-truncate">{{ $enquiry->email ?? 'N/A' }}</div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="small text-secondary">Gender</div>
                        <div class="fw-semibold">{{ $enquiry->gender ?? 'N/A' }}</div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="small text-secondary">Location</div>
                        <div class="fw-semibold">{{ $enquiry->place ?? 'N/A' }}, {{ $enquiry->district?->name ?? 'N/A' }}, {{ $enquiry->state?->name ?? 'N/A' }}</div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="small text-secondary">Qualification</div>
                        <div class="fw-semibold">{{ $enquiry->qualification ?? 'N/A' }}</div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="small text-secondary">Branch Assigned</div>
                        <div class="fw-semibold"><i class="bi bi-building me-1"></i>{{ $enquiry->branch?->name ?? 'N/A' }}</div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="small text-secondary">Lead Source</div>
                        <div class="fw-semibold">{{ $enquiry->leadSource?->name ?? 'N/A' }}</div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="small text-secondary">Assigned Executive</div>
                        <div class="fw-semibold"><i class="bi bi-person me-1"></i>{{ $enquiry->assignedEmployee?->name ?? 'Unassigned' }}</div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="small text-secondary">Assigned Team</div>
                        <div class="fw-semibold"><i class="bi bi-people me-1"></i>{{ $enquiry->assignedTeam?->name ?? 'No Team' }}</div>
                    </div>
                </div>
            </div>

            <!-- Financials / Payment Card -->
            <div class="card glass-card border-0 p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-primary m-0">Payment Ledger</h5>
                    <button type="button" class="btn btn-outline-success btn-rounded py-1.5 px-3 small fw-semibold" data-bs-toggle="collapse" data-bs-target="#paymentFormCollapse">
                        <i class="bi bi-plus-circle me-1"></i> Record Payment
                    </button>
                </div>

                <!-- Payment Form Collapse -->
                <div class="collapse mb-4" id="paymentFormCollapse">
                    <div class="p-3 bg-light rounded-4 border dark-card">
                        <h6 class="fw-bold mb-3">Record New Payment (Admission / Fees)</h6>
                        <form action="{{ route('enquiries.payments.store', $enquiry->id) }}" method="POST">
                            @csrf
                            <div class="row g-2">
                                <div class="col-6 col-md-3">
                                    <label class="form-label small font-monospace" style="font-size: 0.7rem;">Adm. Fee *</label>
                                    <input type="number" step="0.01" name="admission_amount" id="pay_adm" class="form-control form-control-sm" required placeholder="0.00">
                                </div>
                                <div class="col-6 col-md-3">
                                    <label class="form-label small font-monospace" style="font-size: 0.7rem;">Discount</label>
                                    <input type="number" step="0.01" name="discount" id="pay_disc" class="form-control form-control-sm" value="0.00" placeholder="0.00">
                                </div>
                                <div class="col-6 col-md-3">
                                    <label class="form-label small font-monospace" style="font-size: 0.7rem;">Scholarship</label>
                                    <input type="number" step="0.01" name="scholarship" id="pay_sch" class="form-control form-control-sm" value="0.00" placeholder="0.00">
                                </div>
                                <div class="col-6 col-md-3">
                                    <label class="form-label small font-monospace" style="font-size: 0.7rem;">Paid Amount *</label>
                                    <input type="number" step="0.01" name="paid_amount" id="pay_paid" class="form-control form-control-sm" required placeholder="0.00">
                                </div>
                                <div class="col-6 col-md-3">
                                    <label class="form-label small font-monospace" style="font-size: 0.7rem;">Balance *</label>
                                    <input type="number" step="0.01" name="balance" id="pay_bal" class="form-control form-control-sm" readonly required placeholder="0.00">
                                </div>
                                <div class="col-6 col-md-3">
                                    <label class="form-label small font-monospace" style="font-size: 0.7rem;">Pay Mode *</label>
                                    <select name="payment_mode" class="form-select form-select-sm" required>
                                        <option value="UPI">UPI / GPay</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Card">Card</option>
                                        <option value="NetBanking">NetBanking</option>
                                        <option value="Cheque">Cheque</option>
                                    </select>
                                </div>
                                <div class="col-6 col-md-3">
                                    <label class="form-label small font-monospace" style="font-size: 0.7rem;">Txn Ref No</label>
                                    <input type="text" name="transaction_number" class="form-control form-control-sm" placeholder="Ref no">
                                </div>
                                <div class="col-6 col-md-3">
                                    <label class="form-label small font-monospace" style="font-size: 0.7rem;">Receipt No *</label>
                                    <input type="text" name="receipt_number" class="form-control form-control-sm" required placeholder="Receipt no">
                                </div>
                                <div class="col-12 text-end mt-3">
                                    <button type="submit" class="btn btn-success btn-sm btn-rounded px-3 py-1.5"><i class="bi bi-save me-1"></i> Save Transaction</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Payments list -->
                <div class="table-responsive">
                    <table class="table table-sm align-middle">
                        <thead>
                            <tr>
                                <th>Receipt No</th>
                                <th>Paid</th>
                                <th>Balance</th>
                                <th>Mode</th>
                                <th>Date</th>
                                <th>Collected By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($enquiry->payments as $payment)
                                <tr>
                                    <td><span class="small font-monospace fw-bold text-success">{{ $payment->receipt_number }}</span></td>
                                    <td><span class="fw-semibold">₹{{ number_format($payment->paid_amount, 2) }}</span></td>
                                    <td><span class="text-danger small">₹{{ number_format($payment->balance, 2) }}</span></td>
                                    <td><span class="badge bg-secondary py-1">{{ $payment->payment_mode }}</span></td>
                                    <td><span class="small text-secondary">{{ $payment->created_at->format('M d, Y') }}</span></td>
                                    <td><span class="small">{{ $payment->employee->name }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted small py-3">No payments recorded.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Follow ups Card -->
            <div class="card glass-card border-0 p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-primary m-0">Follow-up History</h5>
                    <button type="button" class="btn btn-outline-primary btn-rounded py-1.5 px-3 small fw-semibold" data-bs-toggle="collapse" data-bs-target="#followupFormCollapse">
                        <i class="bi bi-plus-circle me-1"></i> Log Follow-up
                    </button>
                </div>

                <!-- Followup Form Collapse -->
                <div class="collapse mb-4" id="followupFormCollapse">
                    <div class="p-3 bg-light rounded-4 border dark-card">
                        <h6 class="fw-bold mb-3">Log Contact & Schedule Next Callback</h6>
                        <form action="{{ route('enquiries.followups.store', $enquiry->id) }}" method="POST">
                            @csrf
                            <div class="row g-2">
                                <div class="col-6 col-md-3">
                                    <label class="form-label small font-monospace" style="font-size: 0.7rem;">Contact Date *</label>
                                    <input type="date" name="follow_up_date" class="form-control form-control-sm" required value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="col-6 col-md-3">
                                    <label class="form-label small font-monospace" style="font-size: 0.7rem;">Contact Time</label>
                                    <input type="time" name="follow_up_time" class="form-control form-control-sm">
                                </div>
                                <div class="col-6 col-md-3">
                                    <label class="form-label small font-monospace" style="font-size: 0.7rem;">Next Date</label>
                                    <input type="date" name="next_follow_up_date" class="form-control form-control-sm">
                                </div>
                                <div class="col-6 col-md-3">
                                    <label class="form-label small font-monospace" style="font-size: 0.7rem;">Next Time</label>
                                    <input type="time" name="next_follow_up_time" class="form-control form-control-sm">
                                </div>
                                <div class="col-12 col-md-8">
                                    <label class="form-label small font-monospace" style="font-size: 0.7rem;">Remarks *</label>
                                    <input type="text" name="remarks" class="form-control form-control-sm" required placeholder="Conversation details...">
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label small font-monospace" style="font-size: 0.7rem;">Status *</label>
                                    <select name="status" class="form-select form-select-sm" required>
                                        <option value="Completed">Completed</option>
                                        <option value="Pending">Scheduled / Pending</option>
                                        <option value="No Response">No Response</option>
                                        <option value="Postponed">Postponed</option>
                                    </select>
                                </div>
                                <div class="col-12 text-end mt-3">
                                    <button type="submit" class="btn btn-primary btn-sm btn-rounded px-3 py-1.5"><i class="bi bi-save me-1"></i> Save Follow-up</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Followups list -->
                <div class="overflow-auto" style="max-height: 280px;">
                    @forelse($enquiry->followUps as $fu)
                        <div class="p-3 border rounded-4 mb-2 bg-light dark-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="fw-bold">{{ $fu->employee->name }}</span>
                                    <span class="text-secondary small">contacted on {{ $fu->follow_up_date->format('M d, Y') }}</span>
                                </div>
                                <span class="badge bg-secondary">{{ $fu->status }}</span>
                            </div>
                            <p class="small text-muted mt-2 mb-1">“{{ $fu->remarks }}”</p>
                            @if($fu->next_follow_up_date)
                                <div class="text-primary small fw-semibold" style="font-size: 0.75rem;">
                                    <i class="bi bi-alarm me-1"></i> Next Follow-up: {{ $fu->next_follow_up_date->format('M d, Y') }} at {{ $fu->next_follow_up_time ?? 'N/A' }}
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="text-center text-muted small py-4">No follow-ups recorded yet.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Column 2: Timeline -->
        <div class="col-12 col-lg-4">
            <!-- Score Card -->
            <div class="card glass-card border-0 p-4 mb-4 text-center">
                <div class="text-secondary font-monospace small mb-1">TOTAL POINTS AWARDED</div>
                <div class="fs-1 fw-bold text-success">{{ $enquiry->total_score }}</div>
                <p class="text-muted small mt-2 m-0">Points are computed dynamically based on executive activity logging rules.</p>
            </div>

            <!-- Activity Timeline Card -->
            <div class="card glass-card border-0 p-4 h-100">
                <h5 class="fw-bold mb-3">Activity Timeline</h5>
                <div class="timeline overflow-auto" style="max-height: 500px;">
                    @forelse($enquiry->activities as $act)
                        <div class="timeline-item animate-fade-in">
                            <div class="d-flex justify-content-between align-items-start">
                                <span class="fw-semibold small text-primary">{{ $act->activity_type }}</span>
                                <span class="badge bg-success bg-opacity-10 text-success py-1">+{{ $act->score }} Points</span>
                            </div>
                            <div class="small text-secondary mt-1">Logged by: {{ $act->employee->name }}</div>
                            <div class="small text-secondary" style="font-size: 0.7rem;">{{ $act->created_at->format('M d, Y | h:i A') }}</div>
                            <p class="small text-muted mt-1 mb-0">{{ $act->remarks }}</p>
                        </div>
                    @empty
                        <div class="text-center text-muted small py-5">No activities logged yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Automatic payment balance logic
        $(document).ready(function() {
            function updateBalance() {
                const total = parseFloat($('#pay_adm').val()) || 0;
                const discount = parseFloat($('#pay_disc').val()) || 0;
                const scholarship = parseFloat($('#pay_sch').val()) || 0;
                const paid = parseFloat($('#pay_paid').val()) || 0;

                const balance = total - discount - scholarship - paid;
                $('#pay_bal').val(balance.toFixed(2));
            }

            $('#pay_adm, #pay_disc, #pay_sch, #pay_paid').on('input', updateBalance);
        });
    </script>
    @endpush
</x-app-layout>
