<div class="col-lg-4" data-aos="fade-left">
    <!-- Search widget-->
    <div class="card mb-4 shadow-sm">
        <div class="card-header">Search</div>
        <div class="card-body">
            <form action="{{ route('search')}}" method="POST">
                @csrf
                <div class="input-group">
                    <input class="form-control" type="text" name="keyword" placeholder="Search articles..." />
                    <button class="btn btn-primary" id="button-search" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Categories widget-->
    <div class="card mb-4 shadow-sm">
        <div class="card-header">Categories</div>
        <div class="card-body">
            <div>
                @foreach ($categories as $item)
                <span><a href="{{ url('category/'.$item->slug) }}" class="bg-primary badge text-white unstyle-categories">{{ $item->name }} ({{ $item->articles_count }})</a></span>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Populer Post-->
    <div class="card mb-4 shadow-sm">
        <div class="card-header">Populer Posts</div>
        <div class="card-body">
            @foreach ($populer_posts as $item)
                <div class="card mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ asset('storage/back/'.$item->img)}}" alt="{{ $item->title }}" class="img-fluid">
                        </div>

                        <div class="col-md-9">
                            <div class="card-body">
                                <p>
                                    <a href="{{ url('p/'.$item->slug) }}">{{ $item->title }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
