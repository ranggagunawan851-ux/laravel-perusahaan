@push('css')
<style>
    /* Widget Card Base */
    .widget-luxury-card {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.8) !important;
        border-radius: 1.25rem !important;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05) !important;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    /* Header Widget dengan Dark Slate & Gradient Neon */
    .widget-header-dark {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        color: #ffffff;
        padding: 1rem 1.25rem;
        font-weight: 700;
        font-size: 0.95rem;
        letter-spacing: 0.3px;
        border-bottom: 2px solid #06b6d4;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .widget-header-dark i {
        color: #06b6d4;
    }

    /* Search Box styling */
    .widget-search-input {
        border: 1.5px solid #e2e8f0;
        border-radius: 0.75rem 0 0 0.75rem !important;
        padding: 0.65rem 1rem;
        font-size: 0.875rem;
    }
    .widget-search-input:focus {
        border-color: #06b6d4 !important;
        box-shadow: none !important;
    }
    .btn-search-cyan {
        background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%);
        color: #ffffff;
        font-weight: 600;
        font-size: 0.875rem;
        border-radius: 0 0.75rem 0.75rem 0 !important;
        border: none;
        padding: 0 1.25rem;
        transition: all 0.3s ease;
    }
    .btn-search-cyan:hover {
        opacity: 0.9;
        color: #fff;
    }

    /* Category Pill Badges */
    .category-badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: rgba(6, 182, 212, 0.08);
        color: #0284c7;
        border: 1px solid rgba(6, 182, 212, 0.2);
        padding: 0.45rem 0.85rem;
        border-radius: 50rem;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.25s ease;
        margin-bottom: 0.5rem;
        margin-right: 0.25rem;
    }
    .category-badge-pill:hover {
        background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%);
        color: #ffffff;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
    }
    .category-count {
        background: rgba(15, 23, 42, 0.08);
        color: #0f172a;
        font-size: 0.7rem;
        padding: 0.1rem 0.45rem;
        border-radius: 50rem;
        transition: all 0.25s ease;
    }
    .category-badge-pill:hover .category-count {
        background: rgba(255, 255, 255, 0.25);
        color: #ffffff;
    }

    /* Popular Posts List */
    .popular-item-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 0.875rem;
        padding: 0.65rem;
        transition: all 0.3s ease;
        margin-bottom: 0.75rem;
    }
    .popular-item-card:last-child {
        margin-bottom: 0;
    }
    .popular-item-card:hover {
        background: #ffffff;
        border-color: rgba(6, 182, 212, 0.4);
        transform: translateX(4px);
        box-shadow: 0 6px 15px rgba(15, 23, 42, 0.06);
    }
    .popular-thumb {
        width: 100%;
        height: 65px;
        object-fit: cover;
        border-radius: 0.6rem;
    }
    .popular-title {
        color: #0f172a;
        font-weight: 600;
        font-size: 0.85rem;
        line-height: 1.35;
        text-decoration: none;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.2s ease;
    }
    .popular-item-card:hover .popular-title {
        color: #0284c7;
    }
</style>
@endpush

<div class="col-lg-4" data-aos="fade-left">

    <!-- 1. SEARCH WIDGET -->
    <div class="card widget-luxury-card mb-4">
        <div class="widget-header-dark">
            <i class="fa-solid fa-magnifying-glass"></i> Search
        </div>
        <div class="card-body p-3">
            <form action="{{ route('search') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input class="form-control widget-search-input" type="text" name="keyword" placeholder="Search articles..." required />
                    <button class="btn btn-search-cyan d-flex align-items-center justify-content-center" id="button-search" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 2. CATEGORIES WIDGET -->
    <div class="card widget-luxury-card mb-4">
        <div class="widget-header-dark">
            <i class="fa-solid fa-folder-open"></i> Categories
        </div>
        <div class="card-body p-3">
            <div class="d-flex flex-wrap">
                @foreach ($categories as $item)
                    <a href="{{ url('category/'.$item->slug) }}" class="category-badge-pill">
                        <span>{{ $item->name }}</span>
                        <span class="category-count">{{ $item->articles_count }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- 3. POPULAR POSTS WIDGET -->
    <div class="card widget-luxury-card mb-4">
        <div class="widget-header-dark">
            <i class="fa-solid fa-fire"></i> Popular Posts
        </div>
        <div class="card-body p-3">
            @foreach ($populer_posts as $item)
                <div class="popular-item-card">
                    <div class="row g-2 align-items-center">
                        <div class="col-4">
                            <a href="{{ url('p/'.$item->slug) }}">
                                <img src="{{ asset('storage/back/'.$item->img) }}" alt="{{ $item->title }}" class="popular-thumb">
                            </a>
                        </div>
                        <div class="col-8">
                            <a href="{{ url('p/'.$item->slug) }}" class="popular-title">
                                {{ $item->title }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>