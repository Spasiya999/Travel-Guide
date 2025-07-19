@extends('layouts.app')

@section('content')
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            padding: 120px 0 80px;
            color: white;
        }

        .places-section {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .place-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
            margin-bottom: 30px;
            background: white;
        }

        .place-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .place-image {
            height: 280px;
            width: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .place-card:hover .place-image {
            transform: scale(1.1);
        }

        .place-card-body {
            padding: 30px;
            position: relative;
        }

        .place-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 15px;
            transition: color 0.3s ease;
        }

        .place-card:hover .place-title {
            color: #667eea;
        }

        .place-description {
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 20px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .place-status {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-active {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }

        .status-inactive {
            background: linear-gradient(135deg, #dc3545, #e83e8c);
            color: white;
        }

        .view-details-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .view-details-btn:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
            color: white;
        }

        .search-filter-section {
            background: white;
            padding: 40px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .search-input {
            border: 2px solid #e9ecef;
            border-radius: 50px;
            padding: 15px 25px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .filter-btn {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 600;
            margin: 0 5px;
            transition: all 0.3s ease;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(79, 172, 254, 0.3);
        }

        .places-grid {
            margin-top: 50px;
        }

        .section-title {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .section-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 0;
        }

        .stats-overlay {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.9), rgba(118, 75, 162, 0.9));
            padding: 40px 0;
            margin-top: 60px;
            border-radius: 20px;
        }

        .stat-item {
            text-align: center;
            color: white;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #ffd700;
        }

        .stat-label {
            font-size: 1.1rem;
            margin-top: 10px;
        }

        .no-places {
            text-align: center;
            padding: 80px 20px;
            color: #6c757d;
        }

        .no-places i {
            font-size: 4rem;
            color: #dee2e6;
            margin-bottom: 20px;
        }

        .loading-spinner {
            display: none;
            text-align: center;
            padding: 40px;
        }

        .pagination-wrapper {
            margin-top: 50px;
            display: flex;
            justify-content: center;
        }

        .page-link {
            border-radius: 10px;
            margin: 0 5px;
            border: none;
            background: #f8f9fa;
            color: #667eea;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .page-link:hover,
        .page-item.active .page-link {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 80px 0 60px;
            }

            .section-title {
                font-size: 2rem;
            }

            .place-card-body {
                padding: 20px;
            }

            .stats-overlay {
                margin-top: 40px;
            }
        }
    </style>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="section-title">Discover Amazing Places</h1>
                    <p class="section-subtitle">Explore Sri Lanka's most beautiful destinations with Pearl Island Tours</p>
                    <nav aria-label="breadcrumb" class="mt-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}" class="text-white">Home</a></li>
                            <li class="breadcrumb-item active text-warning" aria-current="page">Places</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Search and Filter Section -->
    <section class="search-filter-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="search-box">
                        <input type="text" class="form-control search-input" id="searchPlaces"
                            placeholder="Search places by name or description...">
                    </div>
                </div>
                <div class="col-lg-6 text-lg-end mt-3 mt-lg-0">
                    <button class="btn filter-btn active" data-filter="all">All Places</button>
                    <button class="btn filter-btn" data-filter="active">Active</button>
                    <button class="btn filter-btn" data-filter="inactive">Inactive</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Places Section -->
    <section class="places-section">
        <div class="container">
            <!-- Loading Spinner -->
            <div class="loading-spinner" id="loadingSpinner">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3">Loading amazing places...</p>
            </div>

            <!-- Places Grid -->
            <div class="places-grid" id="placesGrid">
                <div class="row" id="placesContainer">
                    @forelse($places ?? [] as $place)
                        <div class="col-lg-4 col-md-6 place-item" id="{{ $place->slug }}" data-status="{{ $place->status ? 'active' : 'inactive' }}">
                            <div class="card place-card">
                                <div class="position-relative">
                                    <img src="{{ $place->image ?? 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}"
                                        class="place-image" alt="{{ $place->name }}">
                                    <span class="place-status {{ $place->status ? 'status-active' : 'status-inactive' }}">
                                        {{ $place->status ? 'Available' : 'Coming Soon' }}
                                    </span>
                                </div>
                                <div class="place-card-body">
                                    <h3 class="place-title">{{ $place->name }}</h3>
                                    <p class="place-description">{!! $place->description !!}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="no-places">
                                <i class="fas fa-map-marked-alt"></i>
                                <h3>No Places Found</h3>
                                <p>We're currently updating our destinations. Check back soon for amazing places to explore!</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Stats Overlay -->
            @if(isset($places) && $places->count() > 0)
                <div class="stats-overlay">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="stat-item">
                                <div class="stat-number">{{ $places->count() }}</div>
                                <div class="stat-label">Total Places</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="stat-item">
                                <div class="stat-number">{{ $places->where('status', 1)->count() }}</div>
                                <div class="stat-label">Available Now</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="stat-item">
                                <div class="stat-number">9</div>
                                <div class="stat-label">Provinces Covered</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="stat-item">
                                <div class="stat-number">25+</div>
                                <div class="stat-label">UNESCO Sites</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Pagination -->
            @if(isset($places) && method_exists($places, 'links'))
                <div class="pagination-wrapper">
                    {{ $places->links() }}
                </div>
            @endif
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Search functionality
            const searchInput = document.getElementById('searchPlaces');
            const placesContainer = document.getElementById('placesContainer');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const filterButtons = document.querySelectorAll('.filter-btn');

            let currentFilter = 'all';

            // Search function
            function searchPlaces() {
                const searchTerm = searchInput.value.toLowerCase();
                const placeItems = document.querySelectorAll('.place-item');

                placeItems.forEach(item => {
                    const placeName = item.querySelector('.place-title').textContent.toLowerCase();
                    const placeDescription = item.querySelector('.place-description').textContent.toLowerCase();
                    const matchesSearch = placeName.includes(searchTerm) || placeDescription.includes(searchTerm);
                    const matchesFilter = currentFilter === 'all' || item.dataset.status === currentFilter;

                    if (matchesSearch && matchesFilter) {
                        item.style.display = 'block';
                        item.style.animation = 'fadeInUp 0.5s ease forwards';
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Check if no results
                const visibleItems = document.querySelectorAll('.place-item[style*="block"]');
                const noResultsMsg = document.getElementById('noResults');

                if (visibleItems.length === 0 && !noResultsMsg) {
                    const noResults = document.createElement('div');
                    noResults.id = 'noResults';
                    noResults.className = 'col-12';
                    noResults.innerHTML = `
                            <div class="no-places">
                                <i class="fas fa-search"></i>
                                <h3>No Places Found</h3>
                                <p>Try adjusting your search terms or filters to find what you're looking for.</p>
                            </div>
                        `;
                    placesContainer.appendChild(noResults);
                } else if (visibleItems.length > 0 && noResultsMsg) {
                    noResultsMsg.remove();
                }
            }

            // Filter function
            function filterPlaces(filter) {
                currentFilter = filter;

                // Update active filter button
                filterButtons.forEach(btn => {
                    btn.classList.remove('active');
                });
                document.querySelector(`[data-filter="${filter}"]`).classList.add('active');

                // Apply filter
                searchPlaces();
            }

            // Event listeners
            searchInput.addEventListener('input', function () {
                // Show loading spinner
                loadingSpinner.style.display = 'block';

                // Debounce search
                clearTimeout(this.searchTimeout);
                this.searchTimeout = setTimeout(() => {
                    searchPlaces();
                    loadingSpinner.style.display = 'none';
                }, 300);
            });

            filterButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    const filter = this.dataset.filter;
                    filterPlaces(filter);
                });
            });

            // Intersection Observer for animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function (entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animation = 'fadeInUp 0.6s ease forwards';
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            // Observe all place cards
            document.querySelectorAll('.place-item').forEach(item => {
                observer.observe(item);
            });
        });

        // Add CSS animations
        const style = document.createElement('style');
        style.textContent = `
                @keyframes fadeInUp {
                    from {
                        opacity: 0;
                        transform: translateY(30px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                .place-item {
                    opacity: 0;
                    transform: translateY(30px);
                }
            `;
        document.head.appendChild(style);
    </script>
@endsection
