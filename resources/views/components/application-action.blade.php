<div class="card shadow-sm border-0">
    <div class="card-body">
        <form id="application-action-form" method="POST" action="{{ route('application.process', encrypt($application->id)) }}">
            @csrf

            <!-- Remark Field -->
            <div class="mb-3">
                <label for="remarks" class="form-label">Remarks <span class="text-danger">*</span></label>
                <textarea id="remarks" name="remarks" class="form-control" rows="4" placeholder="Enter remarks here..." required>{{ old('remarks', $remarks ?? '') }}</textarea>
                @error('remarks')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Approve and Reject Buttons -->
            <div class="d-flex justify-content-end">
                <button type="submit" name="action" value="approve" class="btn btn-success me-2 confirm-action" data-message="Are you sure you want to approve this application?">
                    Approve
                </button>
                <button type="submit" name="action" value="reject" class="btn btn-danger confirm-action" data-message="Are you sure you want to reject this application?">
                    Reject
                </button>
            </div>
        </form>
    </div>
</div>

@push('custom-scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add confirmation dialog for Approve/Reject buttons
        const confirmButtons = document.querySelectorAll('.confirm-action');
        confirmButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                const message = this.getAttribute('data-message');
                if (!confirm(message)) {
                    event.preventDefault(); // Prevent form submission if user cancels
                }
            });
        });

        // Client-side validation for the remarks field
        const form = document.getElementById('application-action-form'); // Use the form's ID
        form.addEventListener('submit', function (event) {
            const remarksField = document.getElementById('remarks');
            if (remarksField.value.trim() === '') {
                alert('Remarks field is required.');
                remarksField.focus();
                event.preventDefault(); // Prevent form submission
            }
        });
    });
</script>
@endpush