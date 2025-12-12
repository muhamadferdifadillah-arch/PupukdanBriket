@extends('layouts.app')

@section('title', 'Tentang Kami - ManfaatinOnline')

@section('content')
    <style>
        .hero-section {
            background: linear-gradient(135deg, #10b981 0%, #34d399 50%, #6ee7b7 100%);
            position: relative;
            overflow: hidden;
            color: white;
            padding: 6rem 2rem;
            text-align: center;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.3;
        }

        .hero-section h1 {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            position: relative;
            z-index: 1;
        }

        .hero-section p {
            font-size: 1.25rem;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.8;
            opacity: 0.95;
            position: relative;
            z-index: 1;
        }

        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 5rem 2rem;
        }

        .section {
            margin-bottom: 6rem;
        }

        .section h2 {
            font-size: 2.75rem;
            color: #059669;
            margin-bottom: 1rem;
            text-align: center;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .section-subtitle {
            text-align: center;
            color: #6b7280;
            font-size: 1.1rem;
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .about-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2.5rem;
            margin-top: 3rem;
        }

        .about-card {
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .about-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #059669, #10b981);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .about-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(5, 150, 105, 0.15);
            border-color: #10b981;
        }

        .about-card:hover::before {
            transform: scaleX(1);
        }

        .about-card h3 {
            color: #059669;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .about-card p {
            color: #4b5563;
            line-height: 1.7;
            font-size: 1rem;
        }

        .icon-wrapper {
            width: 56px;
            height: 56px;
            background: linear-gradient(135d, #d1fae5, #6ee7b7);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .icon-wrapper svg {
            width: 28px;
            height: 28px;
            stroke: #059669;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .value-item {
            text-align: center;
            padding: 2.5rem 2rem;
            background: white;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .value-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(5, 150, 105, 0.12);
            border-color: #10b981;
        }

        .value-icon-wrapper {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #059669, #10b981);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 8px 20px rgba(5, 150, 105, 0.25);
        }

        .value-icon-wrapper svg {
            width: 42px;
            height: 42px;
            stroke: white;
            fill: none;
        }

        .value-item h3 {
            font-size: 1.3rem;
            color: #059669;
            margin-bottom: 0.75rem;
            font-weight: 600;
        }

        .value-item p {
            color: #6b7280;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .stat-item {
            text-align: center;
            padding: 2.5rem 2rem;
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            border-radius: 16px;
            border: 1px solid #bbf7d0;
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 30px rgba(5, 150, 105, 0.15);
        }

        .stat-number {
            font-size: 3.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #059669, #10b981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #059669;
            font-size: 1.05rem;
            font-weight: 500;
        }

        /* Team Section Styles */
        .team-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            /* FIX 3 KOLOM SEJAJAR */
            gap: 3rem;
            margin-top: 3rem;
            max-width: 1100px;
            margin-left: auto;
            margin-right: auto;
        }


        .team-member {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            transition: all 0.4s ease;
            text-align: center;
        }

        .team-member:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(16, 185, 129, 0.2);
            border-color: #10b981;
        }

        .team-photo-wrapper {
            position: relative;
            width: 100%;
            padding-top: 100%;
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            overflow: hidden;
        }

        .team-photo {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .team-photo-placeholder {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 120px;
            height: 120px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .team-photo-placeholder svg {
            width: 70px;
            height: 70px;
            stroke: #10b981;
        }

        .team-info {
            padding: 2rem 1.5rem;
        }

        .team-name {
            font-size: 1.4rem;
            color: #059669;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .team-position {
            color: #6b7280;
            font-size: 1rem;
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .team-description {
            color: #4b5563;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .team-social {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: linear-gradient(135deg, #10b981, #34d399);
            transform: scale(1.1);
        }

        .social-link svg {
            width: 20px;
            height: 20px;
            stroke: #059669;
        }

        .social-link:hover svg {
            stroke: white;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 4rem 1.5rem;
            }

            .hero-section h1 {
                font-size: 2.25rem;
            }

            .hero-section p {
                font-size: 1.05rem;
            }

            .section h2 {
                font-size: 2rem;
            }

            .container-custom {
                padding: 3rem 1.5rem;
            }

            .about-content {
                grid-template-columns: 1fr;
            }

            .team-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }

        @media (max-width: 768px) {
            .team-grid {
                grid-template-columns: 1fr;
                /* 1 kolom di HP */
            }

        }
    </style>

    <section class="hero-section">
        <h1>Tentang Kami</h1>
        <p>Bersama membangun masa depan yang lebih hijau dan berkelanjutan melalui pengolahan limbah menjadi bernilai</p>
    </section>

    <div class="container-custom">
        <section class="section">
            <h2>Siapa Kami</h2>
            <p class="section-subtitle">Kami adalah pelopor dalam industri pupuk organik yang berkomitmen untuk masa depan
                pertanian berkelanjutan</p>
            <div class="about-content">
                <div class="about-card">
                    <h3>
                        <div class="icon-wrapper">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                                <path d="M2 17l10 5 10-5"></path>
                                <path d="M2 12l10 5 10-5"></path>
                            </svg>
                        </div>
                        Misi Kami
                    </h3>
                    <p>Menyediakan solusi pupuk organik berkualitas tinggi yang ramah lingkungan untuk mendukung pertanian
                        berkelanjutan dan menjaga kelestarian bumi untuk generasi mendatang.</p>
                </div>
                <div class="about-card">
                    <h3>
                        <div class="icon-wrapper">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </div>
                        Visi Kami
                    </h3>
                    <p>Menjadi perusahaan terdepan dalam penyediaan produk pertanian organik di Indonesia, menciptakan
                        ekosistem pertanian yang sehat dan produktif.</p>
                </div>
                <div class="about-card">
                    <h3>
                        <div class="icon-wrapper">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"></path>
                                <path d="M2 12h20"></path>
                            </svg>
                        </div>
                        Komitmen Kami
                    </h3>
                    <p>Berkomitmen penuh terhadap keberlanjutan lingkungan dengan menyediakan produk 100% organik,
                        mengurangi jejak karbon, dan mendukung petani lokal.</p>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Nilai-Nilai Kami</h2>
            <p class="section-subtitle">Prinsip-prinsip yang menjadi fondasi setiap langkah kami</p>
            <div class="values-grid">
                <div class="value-item">
                    <div class="value-icon-wrapper">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                    <h3>Organik</h3>
                    <p>100% bahan alami tanpa kimia berbahaya untuk hasil panen yang sehat</p>
                </div>
                <div class="value-item">
                    <div class="value-icon-wrapper">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <h3>Kualitas</h3>
                    <p>Standar kualitas tertinggi untuk hasil terbaik yang terpercaya</p>
                </div>
                <div class="value-item">
                    <div class="value-icon-wrapper">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <h3>Kepercayaan</h3>
                    <p>Membangun hubungan jangka panjang dengan pelanggan kami</p>
                </div>
                <div class="value-item">
                    <div class="value-icon-wrapper">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M21.5 2v6h-6M2.5 22v-6h6M2 11.5a10 10 0 0 1 18.8-4.3M22 12.5a10 10 0 0 1-18.8 4.2">
                            </path>
                        </svg>
                    </div>
                    <h3>Berkelanjutan</h3>
                    <p>Peduli terhadap masa depan lingkungan dan generasi mendatang</p>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Pencapaian Kami</h2>
            <p class="section-subtitle">Angka-angka yang menunjukkan dedikasi kami</p>
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
            <p class="section-subtitle">Keunggulan yang membuat kami berbeda dari yang lain</p>
            <div class="about-content">
                <div class="about-card">
                    <h3>
                        <div class="icon-wrapper">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <rect x="1" y="3" width="15" height="13"></rect>
                                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                <circle cx="18.5" cy="18.5" r="2.5"></circle>
                            </svg>
                        </div>
                        Pengiriman Gratis
                    </h3>
                    <p>Gratis ongkir untuk pembelian di atas $50. Produk sampai dengan aman dan tepat waktu ke seluruh
                        Indonesia.</p>
                </div>
                <div class="about-card">
                    <h3>
                        <div class="icon-wrapper">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                <path d="M9 12l2 2 4-4"></path>
                            </svg>
                        </div>
                        Terjamin Kualitas
                    </h3>
                    <p>Semua produk telah tersertifikasi organik dan melalui quality control ketat untuk kepuasan Anda.</p>
                </div>
                <div class="about-card">
                    <h3>
                        <div class="icon-wrapper">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                        </div>
                        Support 24/7
                    </h3>
                    <p>Tim customer service kami siap membantu Anda kapan saja dengan respon cepat dan solusi terbaik.</p>
                </div>
            </div>
        </section>

        <section class="section">
            <h2>Tim Kami</h2>
            <p class="section-subtitle">Orang-orang berdedikasi di balik kesuksesan Manfaatin</p>

            <div class="team-grid">

                <!-- Member 1 -->
                <div class="team-member">
                    <div class="team-photo-wrapper">
                        <img src="user/images/tiara.jpg" alt="Tiara Nur Hidayah" class="team-photo">
                    </div>

                    <div class="team-info">
                        <h3 class="team-name">Tiara Nur Hidayah</h3>
                        <p class="team-position">UI/UX Designer</p>
                        <p class="team-description">Ahli membuat tampilan visual aplikasi.</p>

                        <div class="team-social">
                            <!-- WhatsApp -->
                            <a href="https://wa.me/6282390944298" target="_blank" class="social-link">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 11.1A8.9 8.9 0 1 1 11.1 2a8.9 8.9 0 0 1 8.9 9.1z"></path>
                                    <path
                                        d="M8 9c.2 1.8 1.5 3.9 4 5l1.2-.8c.3-.2.6-.2.9 0l2 1c.3.1.5.5.4.8l-.5 1.6c-.1.3-.4.6-.8.7C12.2 19.7 6 16 6 10.5c0-.8.2-1.6.4-2.3.1-.4.4-.7.7-.8l1.6-.5c.4-.1.7.1.8.4l1 2c.1.3.1.6 0 .9L8 9z">
                                    </path>
                                </svg>
                            </a>

                            <!-- Instagram -->
                            <a href="https://instagram.com/username_tiara" target="_blank" class="social-link">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="2" width="20" height="20" rx="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Member 2 -->
                <div class="team-member">
                    <div class="team-photo-wrapper">
                        <img src="user/images/ferdi12.png" alt="Muhamad Ferdi Fadillah" class="team-photo">
                    </div>

                    <div class="team-info">
                        <h3 class="team-name">Muhamad Ferdi Fadillah</h3>
                        <p class="team-position">Lead Developer & UI/UX Designer</p>
                        <p class="team-description">Ahli dalam membangun website & Membuat tampilan visual aplikasi.</p>

                        <div class="team-social">
                            <!-- WhatsApp -->
                            <a href="https://wa.me/6281396092427" target="_blank" class="social-link">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 11.1A8.9 8.9 0 1 1 11.1 2a8.9 8.9 0 0 1 8.9 9.1z"></path>
                                    <path
                                        d="M8 9c.2 1.8 1.5 3.9 4 5l1.2-.8c.3-.2.6-.2.9 0l2 1c.3.1.5.5.4.8l-.5 1.6c-.1.3-.4.6-.8.7C12.2 19.7 6 16 6 10.5c0-.8.2-1.6.4-2.3.1-.4.4-.7.7-.8l1.6-.5c.4-.1.7.1.8.4l1 2c.1.3.1.6 0 .9L8 9z">
                                    </path>
                                </svg>
                            </a>

                            <!-- Instagram -->
                            <a href="https://instagram.com/username_ferdi" target="_blank" class="social-link">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="2" width="20" height="20" rx="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Member 3 -->
                <div class="team-member">
                    <div class="team-photo-wrapper">
                        <img src="user/images/ghts.jpg" alt="Ghaitsa Zahira Sofhia" class="team-photo">
                    </div>

                    <div class="team-info">
                        <h3 class="team-name">Ghaitsa Zahira Sofhia</h3>
                        <p class="team-position">Content Curator</p>
                        <p class="team-description">Ahli dalam mengkurasi, meneliti, dan menyusun.</p>

                        <div class="team-social">
                            <!-- WhatsApp -->
                            <a href="https://wa.me/6281374817934" target="_blank" class="social-link">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 11.1A8.9 8.9 0 1 1 11.1 2a8.9 8.9 0 0 1 8.9 9.1z"></path>
                                    <path
                                        d="M8 9c.2 1.8 1.5 3.9 4 5l1.2-.8c.3-.2.6-.2.9 0l2 1c.3.1.5.5.4.8l-.5 1.6c-.1.3-.4.6-.8.7C12.2 19.7 6 16 6 10.5c0-.8.2-1.6.4-2.3.1-.4.4-.7.7-.8l1.6-.5c.4-.1.7.1.8.4l1 2c.1.3.1.6 0 .9L8 9z">
                                    </path>
                                </svg>
                            </a>

                            <!-- Instagram -->
                            <a href="https://instagram.com/username_ghaitsa" target="_blank" class="social-link">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="2" width="20" height="20" rx="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection