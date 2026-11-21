<div class="book-card">

    <h2>{{ $buku['judul'] }}</h2>

    <p>
        <strong>Penulis:</strong>
        {{ $buku['penulis'] }}
    </p>

    <p>
        <strong>Tahun:</strong>
        {{ $buku['tahun'] }}
    </p>

    <p>
        <strong>Kategori:</strong>
        {{ $buku['kategori'] }}
    </p>

    <div class="book-action">
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="book-footer">
            {{ $footer }}
        </div>
    @endisset

</div>