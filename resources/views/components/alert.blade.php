@props(["type" => "info", "message" => null])

@php
    $map = [
        "success" => ["bg" => "#ecfdf5", "border" => "#a7f3d0", "color" => "#047857", "icon" => "OK"],
        "error"   => ["bg" => "#fef2f2", "border" => "#fecaca", "color" => "#b91c1c", "icon" => "!"],
        "info"    => ["bg" => "#eff6ff", "border" => "#bfdbfe", "color" => "#1d4ed8", "icon" => "i"],
    ];
    $s = $map[$type] ?? $map["info"];
@endphp

@if ($message)
    <div
        class="alert alert-{{ $type }}"
        style="max-width:1200px;margin:20px auto 0;padding:14px 20px;border-radius:14px;font-weight:500;font-size:14px;background:{{ $s["bg"] }};color:{{ $s["color"] }};border:1px solid {{ $s["border"] }};display:flex;align-items:center;gap:10px;"
        role="alert"
    >
        <span style="display:inline-flex;align-items:center;justify-content:center;width:22px;height:22px;border-radius:50%;background:{{ $s["color"] }};color:#fff;font-size:11px;font-weight:800;flex-shrink:0;">
            {{ $s["icon"] }}
        </span>
        <span style="flex:1;">{{ $message }}</span>
    </div>
@endif
