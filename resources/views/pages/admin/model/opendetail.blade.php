
    @if($parameter == "contact")
       <p class="p-3"> {{$product->description}}</p>

    @elseif($parameter == "pin")
        <div class="mb-2">
            <strong>Address:</strong>
            <span>{{ $customer->address ?? 'N/A' }}</span>
        </div>
        <div class="mb-2">
            <strong>City:</strong>
            <span>{{ $customer->city ?? 'N/A' }}</span>
        </div>
        <div class="mb-2">
            <strong>State:</strong>
            <span>{{ $customer->state ?? 'N/A' }}</span>
        </div>
        <div class="mb-2">
            <strong>Pincode:</strong>
            <span>{{ $customer->pincode ?? 'N/A' }}</span>
        </div>
    @endif

