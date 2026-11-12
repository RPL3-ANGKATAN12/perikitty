@php
    $statusMap = [
        "pending"    => ["label" => "Menunggu Pembayaran", "bg" => "#fef3c7", "color" => "#92400e"],
        "processing" => ["label" => "Diproses",           "bg" => "#dbeafe", "color" => "#1e40af"],
        "shipped"    => ["label" => "Dikirim",            "bg" => "#e0e7ff", "color" => "#3730a3"],
        "completed"  => ["label" => "Selesai",            "bg" => "#d1fae5", "color" => "#065f46"],
        "cancelled"  => ["label" => "Dibatalkan",         "bg" => "#fee2e2", "color" => "#991b1b"],
    ];
    $meta = $statusMap[$order->status] ?? ["label" => $order->status, "bg" => "#e5e7eb", "color" => "#374151"];
@endphp
<span style="display:inline-block;background:{{ $meta["bg"] }};color:{{ $meta["color"] }};padding:6px 12px;border-radius:999px;font-size:12.5px;font-weight:700;">{{ $meta["label"] }}</span>
