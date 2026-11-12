@php
    $urutan = ["pending", "processing", "shipped", "completed"];
    $labelStep = [
        "pending"    => "Menunggu Pembayaran",
        "processing" => "Diproses",
        "shipped"    => "Dikirim",
        "completed"  => "Selesai",
    ];
    $idxSekarang = array_search($order->status, $urutan);
    $dibatalkan = $order->status === "cancelled";
@endphp

@if ($dibatalkan)
    <div style="background:#fee2e2;color:#991b1b;border-radius:12px;padding:12px 16px;font-size:14px;font-weight:600;">
        Pesanan ini telah dibatalkan.
    </div>
@else
    <div style="display:flex;align-items:center;gap:4px;flex-wrap:wrap;margin:6px 0 4px;">
        @foreach ($urutan as $i => $step)
            @php $aktif = $idxSekarang !== false && $i <= $idxSekarang; @endphp
            <div style="display:flex;align-items:center;gap:6px;">
                <span style="width:26px;height:26px;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;background:{{ $aktif ? "#0a7d9c" : "#e5e7eb" }};color:{{ $aktif ? "#fff" : "#6b7280" }};">{{ $i + 1 }}</span>
                <span style="font-size:13px;font-weight:600;color:{{ $aktif ? "#0a3d4c" : "#9ca3af" }};">{{ $labelStep[$step] }}</span>
            </div>
            @if (!$loop->last)
                <span style="flex:1;min-width:16px;height:2px;background:{{ ($idxSekarang !== false && $i < $idxSekarang) ? "#0a7d9c" : "#e5e7eb" }};"></span>
            @endif
        @endforeach
    </div>
@endif
