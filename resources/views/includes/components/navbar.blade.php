<section class="header-part sticky-top">
    <div class="container">
        <div class="header-content">
            <a href="{{ route("dashboard") }}"><div class="text-white fs-1 fw-bolder">Constructor<span style="color: var(--primary)">.L</span></div></a>
            <div class="header-top-select">
                <div class="flex-shrink-0 dropdown pe-3">
                    <a href="#" class="d-block text-white text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('img/user.png') }}" class="rounded-circle me-1" alt="user" width="30" height="30"> {{auth()->user()->name}}
                    </a>
                    <ul class="dropdown-menu text-small shadow p-0" aria-labelledby="dropdownUser2">
                        <li><a class="dropdown-item" href="/">Obra</a></li>
                        <li><a class="dropdown-item" href="/quote">Cotacao</a></li>
                        <li><a class="dropdown-item" href="#">Item 1</a></li>
                        <li><a class="dropdown-item" href="#">Item 2</a></li>
                        <hr class="m-0" hidden />
                        <li id="droplogout" hidden><a class="dropdown-item" href="{{route('logout')}}">Sair</a></li>
                    </ul>
                </div>
                <a href="{{ route('logout') }}" class="btn btn-danger" id="logout"><i class="bi-box-arrow-right"></i> Sair</a>
            </div>
            
        </div>
    </div>
</section>

<menu class="mobile-menu">
    <a href="/"><i class="bi bi-house-door"></i><span>Obra</span></a>
    <a href="/quote"><i class="bi bi-house-door"></i><span>Cotacao</span></a>
    <a href="#"><i class="bi bi-house-door"></i><span>Item2</span></a>
    <a href="#"><i class="bi bi-house-door"></i><span>Item3</span></a>
</menu>