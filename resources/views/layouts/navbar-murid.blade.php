<style>
    .zl-navbar {
        position: sticky;
        top: 0;
        z-index: 1050;
        background: rgba(255,255,255,.96);
        border-bottom: 1px solid #e9eef5;
        box-shadow: 0 5px 24px rgba(22,42,70,.07);
        backdrop-filter: blur(14px);
    }

    .zl-navbar .zl-inner {
        max-width: 1180px;
        min-height: 72px;
        margin: auto;
        padding: 0 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
    }

    .zl-brand {
        display: flex;
        align-items: center;
        gap: 11px;
        text-decoration: none;
        color: #142033;
        flex-shrink: 0;
    }

    .zl-brand:hover { color: #0d6efd; }

    .zl-logo {
        width: 43px;
        height: 43px;
        object-fit: contain;
        border-radius: 11px;
    }

    .zl-brand-text {
        line-height: 1.05;
    }

    .zl-brand-text strong {
        display: block;
        font-size: 17px;
        font-weight: 850;
        letter-spacing: .2px;
    }

    .zl-brand-text span {
        display: block;
        margin-top: 4px;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 2px;
        color: #718096;
    }

    .zl-menu {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        margin-left: auto;
    }

    .zl-menu a {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 10px 13px;
        border-radius: 10px;
        color: #667085;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        transition: .2s ease;
    }

    .zl-menu a:hover {
        color: #0d6efd;
        background: #f1f6ff;
    }

    .zl-menu a.active {
        color: #0d6efd;
        background: #edf5ff;
    }

    .zl-menu a.active::after {
        content: "";
        position: absolute;
        left: 50%;
        bottom: -1px;
        width: 25px;
        height: 3px;
        border-radius: 10px;
        transform: translateX(-50%);
        background: #0d6efd;
    }

    .zl-menu a.disabled {
        cursor: default;
        color: #98a2b3;
        background: transparent;
    }

    .zl-menu a.disabled:hover {
        color: #98a2b3;
        background: transparent;
    }

    .zl-coming {
        font-size: 8px;
        padding: 2px 5px;
        border-radius: 5px;
        background: #f1f3f5;
        color: #98a2b3;
        font-weight: 800;
    }

    .zl-account {
        position: relative;
        flex-shrink: 0;
    }

    .zl-account-button {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 5px 7px 5px 5px;
        border: 1px solid #e1e7ef;
        border-radius: 13px;
        background: #fff;
        color: #344054;
        cursor: pointer;
        transition: .2s ease;
    }

    .zl-account-button:hover {
        border-color: #b9d4fa;
        box-shadow: 0 5px 18px rgba(13,110,253,.09);
    }

    .zl-avatar {
        width: 35px;
        height: 35px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg,#0d6efd,#0dcaf0);
        color: #fff;
        font-size: 13px;
        font-weight: 800;
    }

    .zl-account-info {
        max-width: 105px;
        text-align: left;
        line-height: 1.1;
    }

    .zl-account-name {
        display: block;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-size: 11px;
        font-weight: 800;
    }

    .zl-account-role {
        display: block;
        margin-top: 3px;
        font-size: 9px;
        color: #8b98a9;
    }

    .zl-account-button > i {
        color: #98a2b3;
        font-size: 11px;
    }

    .zl-dropdown {
        position: absolute;
        top: calc(100% + 9px);
        right: 0;
        width: 215px;
        padding: 8px;
        border: 1px solid #e4eaf1;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 15px 40px rgba(31,45,61,.13);
        opacity: 0;
        visibility: hidden;
        transform: translateY(-5px);
        transition: .18s ease;
    }

    .zl-account.open .zl-dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .zl-dropdown-head {
        padding: 10px 11px;
        margin-bottom: 5px;
        border-radius: 10px;
        background: #f7faff;
    }

    .zl-dropdown-head strong {
        display: block;
        font-size: 12px;
        color: #182235;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .zl-dropdown-head span {
        display: block;
        margin-top: 3px;
        font-size: 10px;
        color: #8b98a9;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .zl-dropdown a,
    .zl-dropdown button {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 10px 11px;
        border: 0;
        border-radius: 9px;
        background: transparent;
        color: #475467;
        text-decoration: none;
        font-size: 12px;
        font-weight: 650;
        text-align: left;
        cursor: pointer;
    }

    .zl-dropdown a:hover,
    .zl-dropdown button:hover {
        background: #f1f6ff;
        color: #0d6efd;
    }

    .zl-dropdown .zl-logout:hover {
        background: #fff1f2;
        color: #dc3545;
    }

    .zl-mobile-toggle {
        display: none;
        width: 40px;
        height: 40px;
        border: 1px solid #e1e7ef;
        border-radius: 10px;
        background: #fff;
        color: #344054;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    @media (max-width: 950px) {
        .zl-menu { gap: 0; }
        .zl-menu a { padding: 9px 9px; }
        .zl-account-info { display: none; }
    }

    @media (max-width: 760px) {
        .zl-navbar .zl-inner {
            min-height: 64px;
        }

        .zl-mobile-toggle {
            display: flex;
        }

        .zl-menu {
            position: absolute;
            left: 12px;
            right: 12px;
            top: calc(100% + 8px);
            display: none;
            padding: 9px;
            flex-direction: column;
            align-items: stretch;
            background: #fff;
            border: 1px solid #e4eaf1;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(31,45,61,.12);
        }

        .zl-menu.show {
            display: flex;
        }

        .zl-menu a {
            width: 100%;
            justify-content: flex-start;
        }

        .zl-menu a.active::after {
            display: none;
        }

        .zl-brand-text span {
            display: none;
        }
    }
</style>

<nav class="zl-navbar">
    <div class="zl-inner">

        <a href="{{ route('murid.dashboard') }}" class="zl-brand">
            <img
                src="{{ asset('images/zavier-logo.png') }}"
                alt="ZAVIER Learning Center"
                class="zl-logo"
            >

            <div class="zl-brand-text">
                <strong>ZAVIER</strong>
                <span>LEARNING CENTER</span>
            </div>
        </a>

        <button type="button" class="zl-mobile-toggle" id="zlMobileToggle">
            <i class="bi bi-list"></i>
        </button>

        <div class="zl-menu" id="zlMenu">

            <a
                href="{{ route('murid.dashboard') }}"
                class="{{ request()->routeIs('murid.dashboard') ? 'active' : '' }}"
            >
                <i class="bi bi-grid-1x2-fill"></i>
                Dashboard
            </a>

            <a
                href="{{ route('murid.paket-soal') }}"
                class="{{ request()->routeIs('murid.paket-soal', 'murid.ujian') ? 'active' : '' }}"
            >
                <i class="bi bi-journal-text"></i>
                Paket Soal
            </a>

            <a
                href="{{ route('murid.riwayat') }}"
                class="{{ request()->routeIs('murid.riwayat', 'murid.hasil', 'murid.hasil.terakhir') ? 'active' : '' }}"
            >
                <i class="bi bi-clock-history"></i>
                Riwayat
            </a>

            <a href="javascript:void(0)" class="disabled">
                <i class="bi bi-trophy-fill"></i>
                Ranking
                <span class="zl-coming">SEGERA</span>
            </a>

        </div>

        <div class="zl-account" id="zlAccount">

            <button type="button" class="zl-account-button" id="zlAccountButton">

                <span class="zl-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </span>

                <span class="zl-account-info">
                    <span class="zl-account-name">
                        {{ auth()->user()->name }}
                    </span>

                    <span class="zl-account-role">
                        Murid
                    </span>
                </span>

                <i class="bi bi-chevron-down"></i>

            </button>

            <div class="zl-dropdown">

                <div class="zl-dropdown-head">
                    <strong>{{ auth()->user()->name }}</strong>
                    <span>{{ auth()->user()->email }}</span>
                </div>

                <a href="{{ route('profile.edit') }}">
                    <i class="bi bi-person-circle"></i>
                    Profil Saya
                </a>

                <a href="{{ route('murid.riwayat') }}">
                    <i class="bi bi-clock-history"></i>
                    Riwayat Ujian
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="zl-logout">
                        <i class="bi bi-box-arrow-right"></i>
                        Keluar
                    </button>
                </form>

            </div>

        </div>

    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const account = document.getElementById('zlAccount');
    const accountButton = document.getElementById('zlAccountButton');
    const mobileToggle = document.getElementById('zlMobileToggle');
    const menu = document.getElementById('zlMenu');

    if (account && accountButton) {
        accountButton.addEventListener('click', function (event) {
            event.stopPropagation();
            account.classList.toggle('open');
        });
    }

    document.addEventListener('click', function (event) {
        if (account && !account.contains(event.target)) {
            account.classList.remove('open');
        }
    });

    if (mobileToggle && menu) {
        mobileToggle.addEventListener('click', function () {
            menu.classList.toggle('show');

            const icon = mobileToggle.querySelector('i');

            if (menu.classList.contains('show')) {
                icon.className = 'bi bi-x-lg';
            } else {
                icon.className = 'bi bi-list';
            }
        });
    }

});
</script>
