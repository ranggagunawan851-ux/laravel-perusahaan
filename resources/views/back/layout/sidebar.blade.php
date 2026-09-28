            <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
                <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu"
                    aria-labelledby="sidebarMenuLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5> <button type="button"
                            class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="{{ url('dashboard') }}">
                                    <i class="fa-solid fa-house-flood-water-circle-arrow-right"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="{{ url('categories') }}">
                                    <i class="fa-solid fa-table-list"></i>
                                    Category
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="{{ url('article') }}">
                                    <i class="fa-regular fa-file-lines"></i>
                                    Article
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="{{ url('service') }}">
                                    <i class="fa-solid fa-heart"></i>
                                    Service
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="{{ url('portofolio') }}">
                                    <i class="fa-solid fa-pen"></i>
                                    Portofolio
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="{{ url('consultation') }}">
                                    <i class="fa-regular fa-message"></i>
                                    <span>Consultation</span>

                                    @if(isset($unreadConsultationsCount) && $unreadConsultationsCount > 0)
                                    <span class="badge rounded-pill bg-danger">
                                        {{ $unreadConsultationsCount }}
                                    </span>
                                    @endif
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="{{ url('consultation') }}">
                            <i class="fa-regular fa-message"></i>
                            Consultation
                            </a>
                            </li> --}}
                            <li class="nav-item">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                                <a class="nav-link d-flex align-items-center gap-2" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    Sign Out
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
