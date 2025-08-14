<!-- View Inquiry Button -->
<button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#viewInquiryModal-{{ $inquiry->id }}">
    View
</button>

<!-- View Inquiry Modal -->
<div class="modal fade" id="viewInquiryModal-{{ $inquiry->id }}" tabindex="-1" role="dialog"
    aria-labelledby="viewInquiryModalLabel-{{ $inquiry->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Inquiry Details - ID #{{ $inquiry->id }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Name:</strong> {{ $inquiry->first_name }}
                        {{ $inquiry->last_name }}</li>
                    <li class="list-group-item"><strong>Email:</strong> {{ $inquiry->email }}</li>
                    <li class="list-group-item"><strong>Phone:</strong> {{ $inquiry->phone ?? '-' }}</li>
                    <li class="list-group-item"><strong>Country:</strong> {{ $inquiry->country ?? '-' }}</li>
                    <li class="list-group-item"><strong>Date:</strong> {{ $inquiry->date ?? '-' }}</li>
                    <li class="list-group-item"><strong>Group Size:</strong>
                        {{ $inquiry->group_size ? \App\Enum\GroupSize::from($inquiry->group_size)->label() : '-' }}
                    </li>
                    <li class="list-group-item"><strong>Message:</strong> {{ $inquiry->message ?? '-' }}</li>
                    <li class="list-group-item"><strong>Service:</strong> {{ $inquiry->service->name ?? '-' }}</li>
                    {{-- <li class="list-group-item"><strong>Status:</strong>
                        @if ($inquiry->status == 1)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-danger">Inactive</span>
                        @endif
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
</div>
