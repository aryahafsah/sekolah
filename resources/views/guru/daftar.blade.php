@extends('layouts.app')

@section('content')

<style>
/* CARD */
.guru-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 20px;
}

.guru-card {
    background: white;
    border-radius: 12px;
    padding: 10px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0,0,0,.1);
}

.foto-guru {
    width: 75%;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
    cursor: pointer;
}

/* MODAL */
.img-modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.8);
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.img-modal img {
    max-width: 90%;
    max-height: 90%;
    border-radius: 12px;
}

.close-btn {
    position: absolute;
    top: 20px;
    right: 30px;
    font-size: 40px;
    color: white;
    cursor: pointer;
}
</style>

<div class="guru-grid">
@foreach($gurus as $guru)
    <div class="guru-card">
        <img 
            src="{{ asset($guru->foto_guru) }}"
            class="foto-guru"
            onclick="showImage(this.src)"
        >
        <h4>{{ $guru->nama }}</h4>
        <p>{{ $guru->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
    </div>
@endforeach
</div>

<!-- MODAL -->
<div id="imgModal" class="img-modal" onclick="closeImage()">
    <span class="close-btn">&times;</span>
    <img id="imgPreview">
</div>

<script>
function showImage(src) {
    document.getElementById('imgPreview').src = src;
    document.getElementById('imgModal').style.display = 'flex';
}

function closeImage() {

}
</script>

@endsection
