@extends('admin.layouts.app')

@section('title', 'Kelola Testimoni')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Daftar Testimoni Pelanggan</h4>
</div>

<div class="row g-4">
    @forelse($testimonials as $testimonial)
    <div class="col-md-6">
        <div class="card h-100 {{ $testimonial->status === 'pending' ? 'border-warning' : 'border-success' }}">
            <div class="card-body d-flex flex-column">
                <div class="d-flex align-items-center mb-2">
                    <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        {{ substr($testimonial->name, 0, 1) }}
                    </div>
                    <div class="ms-2">
                        <h6 class="mb-0">{{ $testimonial->name }}</h6>
                        <small class="text-muted">{{ $testimonial->city }}</small>
                    </div>
                </div>

                <div class="mb-2">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted' }}"></i>
                    @endfor
                </div>

                <p class="text-muted flex-grow-1">{{ $testimonial->comment }}</p>

                <div class="d-flex justify-content-between align-items-center mt-auto">
                    <div>
                        <span class="badge bg-{{ $testimonial->status === 'approved' ? 'success' : 'warning' }}">
                            {{ $testimonial->status === 'approved' ? 'Disetujui' : 'Menunggu' }}
                        </span>
                        <span class="badge bg-primary ms-1">{{ $testimonial->tour->name ?? 'Tour dihapus' }}</span>
                    </div>
                    <div>
                        @if($testimonial->status === 'pending')
                            <form action="{{ route('admin.testimonials.approve', $testimonial->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-success" title="Setujui">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus testimoni ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center">
        <p>Belum ada testimoni.</p>
    </div>
    @endforelse
</div>
@endsection