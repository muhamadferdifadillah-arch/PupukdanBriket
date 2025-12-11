@extends('layouts.app')

@section('title', 'Tentang Kami - ManfaatinOnline')

@section('content')
<style>
    .hero-section {
        background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%);
        color: white;
        padding: 4rem 2rem;
        text-align: center;
    }

    .hero-section h1 {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .hero-section p {
        font-size: 1.2rem;
        max-width: 700px;
        margin: 0 auto;
    }

    .container-custom {
        max-width: 1200px;
        margin: 0 auto;
        padding: 4rem 2rem;
    }

    .section {
        margin-bottom: 4rem;
    }

    .section h2 {
        font-size: 2.5rem;
        color: #16a34a;
        margin-bottom: 2rem;
        text-align: center;
    }

    .about-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 3rem;
        margin-top: 3rem;
    }

    .about-card {
        background: #f9fafb;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .about-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 12px rgba(0,0,0,0.15);
    }

    .about-card h3 {
        color: #16a34a;
        font-size: 1.5rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .icon {
        width: 40px;
        height: 40px;
        background: #16a34a;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    .values-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .value-item {
        text-align: center;
        padding: 2rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .value-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #16a34a, #22c55e);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 2rem;
    }

    .stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .stat-item {
        text-align: center;
        padding: 2rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .stat-number {
        font-size: 3rem;
        font-weight: bold;
        color: #16a34a;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: #666;
        font-size: 1.1rem;
    }

    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 2rem;
        }

        .section h2 {
            font-size: 1.8rem;
        }
    }
</style>

<section class="hero-section">
    <h1>Tentang Kami</h1>
    <p>Bersama membangun masa depan yang lebih hijau dan berkelanjutan melalui pengolaan limbah menjadi bernilai</p>
</section>

<div class="container-custom">
    <section class="section">
        <h2>Siapa Kami</h2>
        <div class="about-content">
            <div class="about-card">
                <h3><span class="icon">🎯</span> Misi Kami</h3>
                <p>Menyediakan solusi pupuk organik berkualitas tinggi yang ramah lingkungan untuk mendukung pertanian berkelanjutan dan menjaga kelestarian bumi untuk generasi mendatang.</p>
            </div>
            <div class="about-card">
                <h3><span class="icon">👁️</span> Visi Kami</h3>
                <p>Menjadi perusahaan terdepan dalam penyediaan produk pertanian organik di Indonesia, menciptakan ekosistem pertanian yang sehat dan produktif.</p>
            </div>
            <div class="about-card">
                <h3><span class="icon">🌍</span> Komitmen Kami</h3>
                <p>Berkomitmen penuh terhadap keberlanjutan lingkungan dengan menyediakan produk 100% organik, mengurangi jejak karbon, dan mendukung petani lokal.</p>
            </div>
        </div>
    </section>

    <section class="section">
        <h2>Nilai-Nilai Kami</h2>
        <div class="values-grid">
            <div class="value-item">
                <div class="value-icon">🌱</div>
                <h3>Organik</h3>
                <p>100% bahan alami tanpa kimia berbahaya</p>
            </div>
            <div class="value-item">
                <div class="value-icon">✨</div>
                <h3>Kualitas</h3>
                <p>Standar kualitas tertinggi untuk hasil terbaik</p>
            </div>
            <div class="value-item">
                <div class="value-icon">🤝</div>
                <h3>Kepercayaan</h3>
                <p>Membangun hubungan jangka panjang dengan pelanggan</p>
            </div>
            <div class="value-item">
                <div class="value-icon">♻️</div>
                <h3>Berkelanjutan</h3>
                <p>Peduli terhadap masa depan lingkungan</p>
            </div>
        </div>
    </section>

    <section class="section">
        <h2>Pencapaian Kami</h2>
        <div class="stats">
            <div class="stat-item">
                <div class="stat-number">5+</div>
                <div class="stat-label">Tahun Pengalaman</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">10K+</div>
                <div class="stat-label">Pelanggan Puas</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">50+</div>
                <div class="stat-label">Produk Berkualitas</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">100%</div>
                <div class="stat-label">Organik Alami</div>
            </div>
        </div>
    </section>

    <section class="section">
        <h2>Mengapa Memilih Kami?</h2>
        <div class="about-content">
            <div class="about-card">
                <h3><span class="icon">🚚</span> Pengiriman Gratis</h3>
                <p>Gratis ongkir untuk pembelian di atas $50. Produk sampai dengan aman dan tepat waktu.</p>
            </div>
            <div class="about-card">
                <h3><span class="icon">🔒</span> Terjamin Kualitas</h3>
                <p>Semua produk telah tersertifikasi organik dan melalui quality control ketat.</p>
            </div>
            <div class="about-card">
                <h3><span class="icon">💬</span> Support 24/7</h3>
                <p>Tim customer service kami siap membantu Anda kapan saja.</p>
            </div>
        </div>
    </section>
</div>
@endsection