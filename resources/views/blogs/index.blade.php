@extends('Home.master')

@section('content')

<div class="my-5 px-0">
    <h2 class="mb-4 text-center" style="color: #59ab6e;">همه مقالات</h2>
    <div class="py-0 py-md-5 px-0">
        <div class="row mx-0">
            <div class="col-12 px-0">
                <form id="filterForm" class="px-2 px-md-3">
                    <!-- دکمه فیلتر فقط در موبایل -->
                    <div class="d-md-none mb-3">
                        <button type="button" class="btn btn-outline-dark" id="toggleFiltersBtn">
                            فیلترها
                        </button>
                    </div>

                    <!-- باکس فیلترها -->
                    <div id="filterCollapse" class="collapse d-md-flex flex-wrap align-items-center">
                        <!-- دسته‌بندی -->
                        <div class="dropdown me-2 mb-2">
                            <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                دسته‌بندی
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" data-name="category" data-value="">همه دسته‌بندی‌ها</a></li>
                                @foreach($categories as $category)
                                    <li><a class="dropdown-item" href="#" data-name="category" data-value="{{ $category->id }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="category">
                        </div>

                        <!-- فیلتر جستجو -->
                        <div class="me-2 mb-2">
                            <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-control" placeholder="جستجو..." />
                        </div>
                    </div>
                </form>

                <div id="loading" style="display: none; text-align: center; margin: 20px 0;">
                    <div class="spinner-border text-success" role="status" style="width: 4rem; height: 4rem;">
                        <span class="sr-only">در حال بارگذاری...</span>
                    </div>
                </div>

                <div class="row mx-0" id="product-container">
                    @include('blogs.partial.blog')
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
<script>
$(document).ready(function () {
    $('.dropdown-item').click(function(e) {
        let href = $(this).attr('href');
        if (!href || href === '#') {
            e.preventDefault();
            let name = $(this).data('name');
            let value = $(this).data('value');

            $('input[name="' + name + '"]').val(value);
            triggerFilter();
        }
    });

    $('#filterForm select, #filterForm input').on('change', function() {
        triggerFilter();
    });

    function triggerFilter() {
        let formData = $('#filterForm').serialize();

        $.ajax({
            url: "{{ route('blogs.index') }}",
            type: "GET",
            data: formData,
            beforeSend: function() {
                $('#product-container').hide();
                $('#loading').show();
            },
            success: function (data) {
                $('#loading').hide();
                $('#product-container').show().html(data);
                let newUrl = "{{ route('blogs.index') }}" + '?' + formData;
                window.history.pushState({path: newUrl}, '', newUrl);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('toggleFiltersBtn');
    const filtersSection = document.getElementById('filterCollapse');

    toggleBtn.addEventListener('click', function () {
        new bootstrap.Collapse(filtersSection, { toggle: true });
    });
});
</script>
@endsection

@endsection
