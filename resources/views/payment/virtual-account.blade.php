@extends('layouts.booking')
@section('title', 'Pembayaran Virtual Account - Landeuh Village Riverside')
@section('content')
<style>
.va-page{background:#F8EDD8;min-height:100vh;position:relative}
.pay-header{background:rgba(255,255,255,0.7);backdrop-filter:blur(10px);border-bottom:1px solid rgba(0,0,0,0.08);padding:0.75rem 1.5rem;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:50}
.pay-logo{display:flex;align-items:center;gap:1rem}
.pay-logo img{height:40px}
.pay-logo .divider{width:1px;height:30px;background:#ccc}
.pay-logo h2{font-size:0.95rem;font-weight:700;color:#333}
.pay-steps{display:flex;align-items:center;gap:0.5rem;font-size:0.85rem;font-weight:600}
.pay-steps .num{width:24px;height:24px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:700;color:#fff}
.pay-steps .num.done{background:#3a523a}
.pay-steps .num.active{background:#3a523a}
.pay-steps .line{width:40px;height:2px;background:#3a523a}
.pay-back{display:flex;align-items:center;gap:0.5rem;font-weight:700;font-size:0.95rem;cursor:pointer;color:#333;margin:1.5rem 0 1rem}
.pay-timer-bar{background:#4a7736;color:#fff;padding:0.75rem 1.25rem;border-radius:0.5rem;font-size:0.92rem;font-weight:600;margin-bottom:0.85rem;display:flex;align-items:center;justify-content:space-between}
.pay-timer-bar .timer{background:transparent;color:#c6f16d;padding:0;border-radius:0;font-weight:800;font-size:1.15rem;font-family:inherit;letter-spacing:0.04em}
.pay-alert-bar{background:#ea9e37;color:#fff;padding:0.75rem 1.2rem;border-radius:0.5rem;font-size:0.88rem;margin-bottom:1.25rem;font-weight:500}
.va-card{background:#f1e5cc;border-radius:0.75rem;border:1px solid #dfd4be;margin-bottom:1rem;padding:1.5rem}
.va-card-confirm{background:#f1e5cc;border-radius:0.75rem;border:1px solid #dfd4be;margin-bottom:1rem;padding:1.5rem}
.va-title{font-size:1.15rem;font-weight:800;color:#333;margin-bottom:1.5rem;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid #dfd4be;padding-bottom:1rem}
.va-input-group{display:flex;flex-direction:column;gap:0.5rem;margin-bottom:0.5rem}
.va-input-group label{font-size:0.85rem;font-weight:700;color:#444}
.va-input-wrapper{position:relative;display:flex;align-items:center}
.va-input{width:100%;padding:0.8rem 1rem;border:1px solid #dfd4be;border-radius:0.5rem;font-size:0.95rem;outline:none;background:#fff;font-weight:600;color:#333}
.va-copy-btn{position:absolute;right:0.5rem;top:50%;transform:translateY(-50%);background:transparent;border:none;color:#3a523a;cursor:pointer;padding:0.5rem;display:flex;align-items:center;justify-content:center}
.va-btn-bayar{width:100%;background:#284b25;color:#fff;border:none;padding:0.75rem;border-radius:0.4rem;font-size:0.95rem;font-weight:700;cursor:pointer;transition:0.2s;text-align:center}
.va-btn-bayar:hover{background:#1e391c}
.va-btn-outline{width:100%;background:transparent;color:#334d2f;border:1.5px solid #334d2f;padding:0.75rem;border-radius:0.4rem;font-size:0.95rem;font-weight:700;cursor:pointer;transition:0.2s;text-align:center}
.va-btn-outline:hover{background:#334d2f;color:#fff}
.inst-item{border-bottom:1px solid #dfd4be}
.inst-item:last-child{border-bottom:none}
.inst-header{display:flex;justify-content:space-between;align-items:center;padding:1.2rem 0;cursor:pointer;font-weight:700;font-size:0.95rem;color:#333}
.inst-header .chevron{transition:transform 0.3s}
.inst-item.open .chevron{transform:rotate(180deg)}
.inst-content{display:none;padding:0 0 1.2rem 0;font-size:0.85rem;color:#444;line-height:1.6}
.inst-item.open .inst-content{display:block}
.inst-content ol{padding-left:1.2rem;margin-bottom:0}
.inst-content ol li{margin-bottom:0.4rem}
.sidebar-card-cream{background:#f1e5cc;border-radius:1rem;border:1px solid #dfd4be;padding:1.5rem;margin-bottom:1rem;box-shadow:0 10px 25px rgba(0,0,0,0.05);overflow:hidden}
.sidebar-card-cream h3{font-size:1.15rem;font-weight:800;display:flex;align-items:center;gap:0.5rem;margin-bottom:1.2rem;color:#222}
.sb-checkin{display:flex;justify-content:space-between;align-items:center;background:rgba(255,255,255,0.4);backdrop-filter:blur(5px);margin:0 -1.5rem 1rem -1.5rem;padding:1rem 1.5rem;border-bottom:1px solid #dfd4be;border-top:1px solid #dfd4be}
.sb-checkin .label{font-size:0.75rem;font-weight:700;margin-bottom:0.2rem}
.sb-checkin .label.green{color:#27ae60}
.sb-checkin .label.red{color:#c0392b}
.sb-checkin .date{font-weight:700;font-size:0.9rem;color:#333}
.sb-checkin .time{color:#888;font-size:0.65rem;margin-top:0.2rem}
.sb-bed{display:flex;align-items:center;gap:0.8rem;font-size:0.8rem;color:#444;border-bottom:1px solid #dfd4be;padding-bottom:1rem;margin-bottom:1rem;font-weight:600}
.sb-bed .divider{width:1px;height:16px;background:#c2b59b}
.sb-bed div{display:flex;align-items:center;gap:0.4rem}
.sb-fasilitas{display:grid;grid-template-columns:1fr 1fr 1fr;gap:0.5rem;font-size:0.75rem;color:#444;margin-bottom:1rem}
.sb-fasilitas .col-title{font-weight:700;color:#333;margin-bottom:0.4rem}
.sb-fasilitas ul{list-style-type:disc;margin-left:1rem}
.sb-fasilitas ul li{margin-bottom:0.2rem}
.sb-guest{display:flex;align-items:center;gap:0.5rem;font-size:0.8rem;font-weight:600;color:#444;border-bottom:1px solid #dfd4be;padding-bottom:1rem;margin-bottom:1rem}
.sb-identity{display:flex;justify-content:space-between;font-size:0.8rem;color:#333}
.sb-identity .title{font-size:0.75rem;color:#666;margin-bottom:0.5rem}
.sb-identity .row{display:flex;align-items:flex-start;gap:0.5rem;font-weight:500}
.sb-identity .details{display:flex;flex-direction:column;gap:0.15rem}
@media(max-width:768px){.pay-grid{flex-direction:column!important}}
</style>

<div class="va-page">
    <img src="{{ asset('images/assets_lain/batik.png') }}" class="absolute top-16 -left-6 w-36 opacity-20 pointer-events-none rotate-6 z-0" alt="">
    <img src="{{ asset('images/assets_lain/batik.png') }}" class="absolute top-1/2 -right-8 w-40 opacity-15 pointer-events-none -rotate-12 scale-x-[-1] z-0" alt="">
    <img src="{{ asset('images/assets_lain/batik.png') }}" class="absolute bottom-8 left-10 w-32 opacity-10 pointer-events-none rotate-45 z-0" alt="">

    <div class="pay-header">
        <div class="pay-logo">
            <img src="{{ asset('images/logo-landeuh.png') }}" alt="Logo">
            <div class="divider"></div>
            <h2 id="headerAkoJudul">{{ (isset($booking) && ($booking->corporatePackage ?? $booking->accommodation)) ? ($booking->corporatePackage->judul ?? $booking->accommodation->judul) : 'Kamar Keluarga Deluks dengan Pemandangan Sungai' }}</h2>
        </div>
        <div class="pay-steps">
            <div style="display:flex;align-items:center;gap:0.35rem"><div class="num done">1</div> Review</div>
            <div class="line"></div>
            <div style="display:flex;align-items:center;gap:0.35rem"><div class="num active">2</div> Bayar</div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-2 relative z-10">
        <div class="pay-back" onclick="window.history.back()">← Kembali</div>
        
        <div class="pay-grid" style="display:flex;gap:1.5rem;align-items:flex-start">
            {{-- LEFT --}}
            <div style="flex:1.4;">
                <div class="pay-timer-bar">
                    <span>Harga sudah kami amankan. Selesaikan pembayaran dalam</span>
                    <span class="timer" id="countdownTimer">00.30.00</span>
                </div>
                
                <div class="pay-alert-bar">
                    Cek emailmu (<strong id="userEmailSpan">{{ $booking->pemesan_email ?? 'tamu@landeuh.com' }}</strong>) sekarang untuk detail cara bayar.
                </div>
                
                <h3 style="font-size:1.15rem; font-weight:800; color:#333; margin-bottom:0.8rem;">Mohon transfer ke</h3>
                
                <div class="va-card">
                    <div class="va-title">
                        <span id="dynVaName">BCA Virtual Account</span>
                        <div style="height:36px; display:flex; align-items:center; justify-content:flex-end;">
                            <img id="dynVaLogo" src="{{ asset('images/partner-pembayaran/bca.png') }}" alt="Logo" style="height:32px; object-fit:contain;">
                        </div>
                    </div>
                    
                    <div style="display:grid; grid-template-columns:1.5fr 1fr; gap:1rem;">
                        <div class="va-input-group">
                            <label>No. Virtual Account</label>
                            <div class="va-input-wrapper">
                                <input type="text" class="va-input" id="dynVaNumber" value="756831007064407324" readonly>
                                <button type="button" class="va-copy-btn" onclick="copyText('dynVaNumber')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375H9.75" /></svg>
                                </button>
                            </div>
                        </div>
                        <div class="va-input-group">
                            <label>Nama Penerima</label>
                            <input type="text" class="va-input" id="dynNamaPenerima" value="OVY RESIYANA" readonly>
                        </div>
                    </div>
                </div>

                <div class="va-card" style="padding:1.2rem 1.5rem; margin-bottom:1.5rem;">
                    <div style="display:flex; align-items:center; justify-content:space-between; gap:1.5rem; margin-bottom:0;">
                        <label style="font-size:0.95rem; font-weight:700; color:#333; margin:0; white-space:nowrap;">Jumlah Transfer</label>
                        <div style="flex:1; max-width:380px;">
                            <input type="text" class="va-input" id="dynTransferAmount" value="{{ isset($booking) ? number_format($booking->total, 0, ',', '.') : '1.600.000' }}" readonly style="font-size:1.05rem; font-weight:700; color:#333; padding:0.65rem 1rem;">
                        </div>
                    </div>
                </div>
                
                <h3 style="font-size:1.15rem; font-weight:800; color:#333; margin-bottom:0.8rem;">Bagaimana Cara Transfer</h3>
                <div class="va-card" id="dynInstructions" style="padding: 0.5rem 1.5rem">
                    <!-- Dynamic accordion items will be injected here -->
                </div>
                
                <h3 style="font-size:1.15rem; font-weight:800; color:#333; margin-bottom:0.8rem; margin-top:2rem;">Sudah selesai bayar?</h3>
                <div class="va-card-confirm">
                    <p style="font-size:0.9rem; color:#555; margin-bottom:1.5rem;">Setelah pembayaran berhasil terverifikasi, e-ticket dan bukti pembayaran akan kami kirimkan ke email Anda.</p>
                    <button class="va-btn-outline" style="width:100%; background:#3a523a; color:#fff; cursor:pointer; font-weight:700;" onclick="cekStatusPembayaran(this)">Cek Status Pembayaran</button>
                </div>
            </div>

            {{-- RIGHT: Rincian Reservasi --}}
            <div style="flex:0.8;min-width:300px;position:sticky;top:80px">
                <div class="sidebar-card-cream">
                    <h3>
                        <iconify-icon icon="lucide:clipboard-list" class="text-xl"></iconify-icon> Rincian Reservasi
                    </h3>
                    
                    <div class="sb-checkin">
                        <div><div class="label green">Check-in</div><div class="date" id="dynCheckin">Selasa, 28 April 2026</div><div class="time">Dari 14.00</div></div>
                        <div style="text-align:center;color:#888"><div id="dynMalam" style="font-size:0.7rem;font-weight:600">1 malam</div><div style="font-size:1.2rem;margin-top:-4px">→</div></div>
                        <div style="text-align:right"><div class="label red">Check-out</div><div class="date" id="dynCheckout">Rabu, 29 April 2026</div><div class="time">Hingga 12.00</div></div>
                    </div>
                    
                    <div class="sb-bed">
                        <div id="dynBed"><iconify-icon icon="lucide:bed-double" class="text-lg"></iconify-icon> Memuat...</div>
                        <div class="divider"></div>
                        <div id="dynSmoking"><iconify-icon icon="lucide:cigarette" class="text-lg"></iconify-icon> Memuat...</div>
                    </div>
                    
                    <div class="sb-fasilitas">
                        <div>
                            <div class="col-title">Fasilitas Kamar:</div>
                            <ul id="dynFasilitas1"></ul>
                        </div>
                        <div style="padding-top:1.4rem">
                            <ul id="dynFasilitas2"></ul>
                        </div>
                        <div>
                            <div class="col-title">Makanan & Minuman:</div>
                            <ul id="dynMakanan"></ul>
                        </div>
                    </div>
                    
                    <div class="sb-guest">
                        <iconify-icon icon="lucide:user" class="text-lg"></iconify-icon> <span id="dynGuestInfo">Memuat...</span>
                    </div>
                    
                    <div class="sb-identity">
                        <div>
                            <div class="title">Identitas Pemesan:</div>
                            <div class="row">
                                <iconify-icon icon="lucide:user-check" class="text-base mt-1"></iconify-icon>
                                <div class="details">
                                    <div id="dynNama">Memuat...</div>
                                    <div id="dynHp">Memuat...</div>
                                    <div id="dynEmail">Memuat...</div>
                                </div>
                            </div>
                        </div>
                        <div style="text-align:right">
                            <div class="title">Nama Tamu:</div>
                            <div class="row" style="justify-content:flex-end">
                                <iconify-icon icon="lucide:book-user" class="text-base mt-0.5"></iconify-icon>
                                <div class="details">
                                    <div id="dynTamu">Memuat...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="{{ asset('js/akomodasi-data.js') }}"></script>
<script>
function copyText(id) {
    const el = document.getElementById(id);
    if(el) {
        navigator.clipboard.writeText(el.value).then(() => {
            alert('Berhasil disalin: ' + el.value);
        });
    }
}

function toggleInst(el) {
    el.closest('.inst-item').classList.toggle('open');
}

const VA_DATA = {
    'BCA Virtual Account': {
        logo: 'bca.png',
        name: 'BCA Virtual Account',
        account: '756831007064407324',
        instructions: [
            {
                title: 'BCA Mobile (m-BCA)',
                steps: [
                    'Buka aplikasi BCA mobile, pilih m-BCA dan masukkan kode akses Anda.',
                    'Pilih m-Transfer > BCA Virtual Account.',
                    'Masukkan nomor Virtual Account: <strong>756831007064407324</strong> lalu pilih Send.',
                    'Periksa kembali rincian pembayaran, pastikan nama penerima sesuai, lalu masukkan PIN m-BCA.',
                    'Transaksi selesai. Simpan bukti transfer Anda.'
                ]
            },
            {
                title: 'KlikBCA & ATM BCA',
                steps: [
                    'Masukkan kartu ATM BCA dan PIN Anda (atau login ke KlikBCA).',
                    'Pilih menu Transaksi Lainnya > Transfer > ke Rekening BCA Virtual Account.',
                    'Masukkan nomor Virtual Account: <strong>756831007064407324</strong>.',
                    'Periksa kembali jumlah tagihan dan konfirmasi transaksi.'
                ]
            }
        ]
    },
    'Mandiri Virtual Account': {
        logo: 'mandiri.png',
        name: 'Mandiri Virtual Account / Bill Payment',
        account: '7001299000123456',
        billerCode: '70012',
        billKey: '99000123456',
        instructions: [
            {
                title: 'Livin\' by Mandiri / ATM Mandiri',
                steps: [
                    'Buka Livin\' by Mandiri atau gunakan ATM Mandiri.',
                    'Pilih menu Bayar / Multipayment.',
                    'Masukkan Kode Perusahaan (Biller Code): <strong>70012</strong>.',
                    'Masukkan No. Pembayaran (Bill Key): <strong>99000123456</strong> atau Nomor VA: <strong>7001299000123456</strong>.',
                    'Pastikan detail tagihan sudah sesuai, lalu konfirmasi pembayaran dengan PIN Anda.'
                ]
            }
        ]
    },
    'BRI Virtual Account': {
        logo: 'bri.png',
        name: 'BRI Virtual Account (BRIVA)',
        account: '8578100706440732',
        instructions: [
            {
                title: 'BRImo (Mobile Banking BRI)',
                steps: [
                    'Buka aplikasi BRImo, lalu masuk dengan akun Anda.',
                    'Pilih menu BRIVA.',
                    'Masukkan nomor Virtual Account: <strong>8578100706440732</strong> lalu pilih Lanjutkan.',
                    'Pastikan informasi nama penerima dan nominal tagihan sesuai.',
                    'Masukkan PIN BRImo Anda untuk menyelesaikan pembayaran.'
                ]
            },
            {
                title: 'ATM BRI',
                steps: [
                    'Masukkan kartu ATM BRI dan PIN Anda.',
                    'Pilih Transaksi Lain > Pembayaran > Lainnya > BRIVA.',
                    'Masukkan nomor Virtual Account: <strong>8578100706440732</strong>.',
                    'Periksa rincian tagihan dan konfirmasi pembayaran.'
                ]
            }
        ]
    },
    'BNI Virtual Account': {
        logo: 'bni.png',
        name: 'BNI Virtual Account',
        account: '8808100706440732',
        instructions: [
            {
                title: 'BNI Mobile Banking / ATM BNI',
                steps: [
                    'Buka aplikasi BNI Mobile Banking atau masukkan kartu di ATM BNI.',
                    'Pilih menu Transfer > Virtual Account Billing.',
                    'Masukkan nomor Virtual Account BNI: <strong>8808100706440732</strong>.',
                    'Pastikan rincian tagihan sudah cocok dan masukkan Password Transaksi / PIN.',
                    'Pembayaran selesai.'
                ]
            }
        ]
    },
    'BSI Virtual Account': {
        logo: 'bsi.png',
        name: 'BSI Virtual Account',
        account: '9008100706440732',
        instructions: [
            {
                title: 'BSI Mobile',
                steps: [
                    'Buka aplikasi BSI Mobile dan login.',
                    'Pilih menu Bayar > Institusi / Virtual Account.',
                    'Masukkan nomor Virtual Account BSI: <strong>9008100706440732</strong>.',
                    'Konfirmasi nominal dan masukkan PIN BSI Anda.'
                ]
            },
            {
                title: 'ATM BSI',
                steps: [
                    'Masukkan kartu ATM BSI dan PIN Anda.',
                    'Pilih menu Pembayaran/Pembelian > Institusi.',
                    'Masukkan nomor Virtual Account BSI: <strong>9008100706440732</strong>.',
                    'Konfirmasi pembayaran dan simpan struk.'
                ]
            }
        ]
    },
    'Virtual Account Lainnya': {
        logo: 'va.png',
        name: 'Permata Virtual Account',
        account: '8778100706440732',
        instructions: [
            {
                title: 'Transfer Antar Bank (ATM / Mobile Banking)',
                steps: [
                    'Pilih menu Transfer Antar Bank pada ATM/Mobile Banking Anda.',
                    'Pilih bank tujuan: Bank Permata (Kode Bank: 013).',
                    'Masukkan nomor Virtual Account: <strong>8778100706440732</strong> sebagai rekening tujuan.',
                    'Masukkan nominal pembayaran yang sesuai dan konfirmasi transaksi.'
                ]
            }
        ]
    }
};

(function(){
    const urlParams = new URLSearchParams(window.location.search);
    const urlVa = urlParams.get('va');
    if (urlVa) sessionStorage.setItem('res_va', urlVa);
    const urlBookingNo = urlParams.get('booking_no');
    if (urlBookingNo) sessionStorage.setItem('res_booking_no', urlBookingNo);

    // Countdown timer
    let seconds=30*60;
    const el=document.getElementById('countdownTimer');
    setInterval(()=>{
        if(seconds<=0)return;
        seconds--;
        const m=String(Math.floor(seconds/60)).padStart(2,'0');
        const s=String(seconds%60).padStart(2,'0');
        el.textContent='00.'+m+'.'+s;
    },1000);
    
    // Load dynamic user data from sessionStorage
    const dNama = sessionStorage.getItem('res_nama') || 'Ari Rahman';
    const dHp = sessionStorage.getItem('res_hp') || '081512345678';
    const dEmail = sessionStorage.getItem('res_email') || 'arirahman@gmail.com';
    const dTamu = sessionStorage.getItem('res_tamu') || 'M. Akbar R.';
    const dGuest = sessionStorage.getItem('res_guest') || '4 Dewasa + 1 Anak (di atas 5 tahun) + 2 Dewasa (di atas 17 tahun)';
    const dTotal = sessionStorage.getItem('res_total') || '921.609';
    const dMalam = sessionStorage.getItem('res_malam') || '1';
    const dJudul = sessionStorage.getItem('res_judul') || 'Kamar Keluarga Deluks dengan Pemandangan Sungai';
    const dCheckin = sessionStorage.getItem('res_checkin') || 'Selasa, 28 April 2026';
    const dCheckout = sessionStorage.getItem('res_checkout') || 'Rabu, 29 April 2026';
    
    if(dJudul) document.getElementById('headerAkoJudul').textContent = dJudul;
    
    if(dNama) document.getElementById('dynNama').textContent = dNama;
    if(dHp) document.getElementById('dynHp').textContent = dHp;
    if(dEmail) {
        document.getElementById('dynEmail').textContent = dEmail;
        document.getElementById('userEmailSpan').textContent = dEmail;
    }
    if(dTamu) document.getElementById('dynTamu').textContent = dTamu;
    if(dGuest) document.getElementById('dynGuestInfo').textContent = dGuest;
    if(dTotal) {
        const amt = dTotal.replace(/IDR\s?/i, '').trim();
        document.getElementById('dynTransferAmount').value = amt;
    }
    if(dMalam) {
        const dynMalamEl = document.getElementById('dynMalam');
        if(dynMalamEl) dynMalamEl.textContent = `${dMalam} malam`;
    }
    if(dCheckin) {
        const ciEl = document.getElementById('dynCheckin');
        if(ciEl) ciEl.textContent = dCheckin;
    }
    if(dCheckout) {
        const coEl = document.getElementById('dynCheckout');
        if(coEl) coEl.textContent = dCheckout;
    }

    // Parse accommodation ID from URL or sessionStorage
    const akoId = parseInt(sessionStorage.getItem('res_akoId')) || 1;
    const akoItem = AKOMODASI_DATA.find(d => d.id === akoId) || AKOMODASI_DATA[0];
    
    if(akoItem) {
        document.getElementById('dynBed').innerHTML = `<iconify-icon icon="lucide:bed-double" class="text-lg"></iconify-icon> ${akoItem.kasur || 'Queen Bed (160x200)'}`;
        document.getElementById('dynSmoking').innerHTML = `<iconify-icon icon="${akoItem.merokok ? 'lucide:cigarette' : 'lucide:cigarette-off'}" class="text-lg"></iconify-icon> ${akoItem.merokok ? 'Boleh merokok di kamar' : 'Boleh merokok di kamar'}`;
        
        const fasLen = Math.ceil(akoItem.fasilitas.length / 2);
        document.getElementById('dynFasilitas1').innerHTML = akoItem.fasilitas.slice(0, fasLen).map(f => `<li>${f}</li>`).join('');
        document.getElementById('dynFasilitas2').innerHTML = akoItem.fasilitas.slice(fasLen).map(f => `<li>${f}</li>`).join('');
        document.getElementById('dynMakanan').innerHTML = akoItem.makanan.map(m => `<li>${m}</li>`).join('');
    }

    // Load VA Data
    const selectedVa = sessionStorage.getItem('res_va') || 'BCA Virtual Account';
    const vaInfo = VA_DATA[selectedVa] || VA_DATA['BCA Virtual Account'] || VA_DATA['BRI Virtual Account'] || VA_DATA['Virtual Account Lainnya'];

    document.getElementById('dynVaName').textContent = vaInfo.name;
    const logoEl = document.getElementById('dynVaLogo');
    logoEl.src = "{{ asset('images/partner-pembayaran') }}/" + vaInfo.logo;

    const logoSizes = {
        'BNI Virtual Account': '28px',
        'BCA Virtual Account': '28px',
        'BRI Virtual Account': '36px',
        'Mandiri Virtual Account': '45px',
        'BSI Virtual Account': '45px',
        'Virtual Account Lainnya': '40px'
    };
    logoEl.style.height = logoSizes[selectedVa] || '32px';

    document.getElementById('dynVaNumber').value = vaInfo.account;
    const dynNamaPenerimaEl = document.getElementById('dynNamaPenerima');
    if (dynNamaPenerimaEl) {
        dynNamaPenerimaEl.value = 'OVY RESIYANA';
    }
    
    // Render Instructions
    const instContainer = document.getElementById('dynInstructions');
    let instHtml = '';
    vaInfo.instructions.forEach((inst, idx) => {
        const isOpen = idx === 0 ? 'open' : '';
        instHtml += `
            <div class="inst-item ${isOpen}">
                <div class="inst-header" onclick="toggleInst(this)">
                    ${inst.title}
                    <svg class="chevron" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m6 9 6 6 6-6"/></svg>
                </div>
                <div class="inst-content">
                    <ol>
                        ${inst.steps.map(step => `<li>${step}</li>`).join('')}
                    </ol>
                </div>
            </div>
        `;
    });
    instContainer.innerHTML = instHtml;
})();

function cekStatusPembayaran(btn) {
    if (btn) {
        btn.disabled = true;
        btn.style.opacity = '0.7';
        btn.innerText = 'Memeriksa Status Pembayaran...';
    }

    const resetBtn = () => {
        if (btn) {
            btn.disabled = false;
            btn.style.opacity = '1';
            btn.innerText = 'Cek Status Pembayaran';
        }
    };

    const bookingNo = sessionStorage.getItem('res_booking_no') || '{{ $booking->no_pesanan ?? "" }}';
    const method = sessionStorage.getItem('res_payment_method') || sessionStorage.getItem('res_va') || 'Virtual Account';

    if (bookingNo) {
        fetch('/reservasi/check-payment-status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                no_pesanan: bookingNo,
                metode_pembayaran: method
            })
        })
        .then(res => res.json())
        .then(data => {
            const st = (data.status === 'success') ? 'success' : (data.status === 'failed' ? 'failed' : 'pending');
            sessionStorage.setItem('res_payment_status', st);
            window.location.href = `/reservasi/konfirmasi?booking_no=${encodeURIComponent(bookingNo)}&status=${st}`;
        })
        .catch(err => {
            sessionStorage.setItem('res_payment_status', 'pending');
            window.location.href = `/reservasi/konfirmasi?booking_no=${encodeURIComponent(bookingNo)}&status=pending`;
        });
    } else {
        window.location.href = '/reservasi/konfirmasi?status=pending';
    }
}
</script>
@endpush
@endsection
