<!-- Button trigger modal -->
<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tourismItemModal{{ $item->id }}">
    <i class="fas fa-eye"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="tourismItemModal{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="tourismItemModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="tourismItemModalLabel{{ $item->id }}">Tourism Item Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td><strong>Name:</strong></td>
                                    <td>{{ $item->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Type:</strong></td>
                                    <td>
                                        <span class="badge badge-secondary">
                                            {{ $item->getTypeDisplayName() }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Location:</strong></td>
                                    <td>{{ $item->location ?? 'Not specified' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Duration:</strong></td>
                                    <td>{{ $item->duration ?? 'Not specified' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Price (USD):</strong></td>
                                    <td class="text-success font-weight-bold">${{ number_format($item->price_usd, 2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Price (LKR):</strong></td>
                                    <td class="text-success font-weight-bold">Rs
                                        {{ number_format($item->price_lkr, 2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Requires Transport:</strong></td>
                                    <td>
                                        <span
                                            class="badge badge-{{ $item->requires_transport ? 'warning' : 'secondary' }}">
                                            {{ $item->requires_transport ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        <span
                                            class="badge badge-{{ $item->status == 'active' ? 'success' : 'danger' }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @if($item->description)
                                    <tr>
                                        <td><strong>Description:</strong></td>
                                        <td>{{ $item->description }}</td>
                                    </tr>
                                @endif
                                @if($item->features && count($item->features) > 0)
                                    <tr>
                                        <td><strong>Features:</strong></td>
                                        <td>
                                            @foreach($item->features as $feature)
                                                <span class="badge badge-primary mr-1">{{ $feature }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td><strong>Created:</strong></td>
                                    <td>{{ $item->created_at->format('M d, Y h:i A') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Last Updated:</strong></td>
                                    <td>{{ $item->updated_at->format('M d, Y h:i A') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="{{ route('admin.tourism-items.edit', $item->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>
</div>
