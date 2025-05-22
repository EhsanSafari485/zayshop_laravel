@extends('Panel.master')
@section('content')
@if (session('success'))
<script>
    Swal.fire({
  title: 'عملیات موفق!',
  text: '{{ session('success') }}',
  icon: 'success',
  background: '#1e1e2f',  // پس‌زمینه تیره
  color: '#f1f1f1',       // رنگ متن روشن
  confirmButtonColor: '#3085d6',  // رنگ دکمه
  confirmButtonText: 'باشه!',
});
</script>
@endif

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="row layout-spacing layout-top-spacing" id="cancel-row">
                    <div class="col-lg-12">
                        <div class="widget-content searchable-container list">

                            <div class="row">
                                <div class="col-xl-8 col-lg-7 col-md-7 col-sm-5 text-sm-right text-center layout-spacing align-self-center">
                                    {{-- <svg id="btn-add-contact" class="float-left" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                        <path d="M21 15l-5-5L5 21"></path></svg> --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" class="float-left" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" id="btn-add-contact" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-droplet">
                                       <path d="M12 2.69l6.16 6.16a7 7 0 1 1-12.32 0z"></path>
                                   </svg>
                                    <!-- Modal -->
                                    <div class="modal fade" id="addContactModal" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                                                    <div class="add-contact-box">
                                                        <div class="add-contact-content">
                                                            <form id="addContactModalTitle" method="POST" action="{{ route('Panel.product.colors.store') }}" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="contact-location">
                                                                            <label for="name">نام رنگ</label>
                                                                            <i class="flaticon-location-1"></i>
                                                                            <input type="name" id="c-location" class="form-control" name="name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="contact-location">
                                                                            <label for="color">رنگ</label>
                                                                            <i class="flaticon-location-1"></i>
                                                                            <input type="color" id="c-location" class="form-control" name='code'>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">

                                                                    <button class="btn" type="button" data-dismiss="modal"> <i class="flaticon-delete-1"></i>  نادیده گرفتن</button></button>

                                                                    <button id="btn-add" type="submit" class="btn">افزودن</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="searchable-items grid">
                                @foreach ($colors as $color)

                                <div class="items" id="image-{{$color->id}}">
                                    <div class="item-content">
                                        <div class="user-email">
                                            <p class="info-title">نام رنگ: </p>
                                            <p class="usr-email-addr" data-email="alan@mail.com">{{$color->name}}</p>
                                        </div>
                                        <div class="user-email">
                                            <div class="usr-email-addr" style="border-radius: 7px;height: 50px;width: 120px; background-color: {{$color->code}}"></div>
                                        </div>
                                        <div class="user-email">
                                            <p class="info-title">کد رنگ</p>
                                            <p class="usr-email-addr" data-email="alan@mail.com">{{$color->code}}</p>
                                        </div>
                                        <div class="action-btn">
                                            <button type="button"
                                            data-id="{{$color->id}}"
                                            class="custom-delete-btn"
                                            style="background: none; border: none; cursor: pointer;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6L17.5 20H6.5L5 6h14z"></path>
                                                <path d="M10 11v6"></path>
                                                <path d="M14 11v6"></path>
                                                <path d="M15 4V2H9v2"></path>
                                            </svg>
                                        </button>
                                     </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class=""> © کپی رایت</p>
                </div>
                <div class="footer-section f-section-2">
 <span class="copyright"> بومی سازی شده توسط : <a href="https://imanpa.ir/store/"> ایمان پاکروح </a> </span></div>
            </div>
        </div>
        <!--  END CONTENT AREA  -->









@section('jssrc')

<script>
$('#btn-add-contact').click(function() {
    $('#addContactModal').modal('show');
});
$(document).ready(function () {
    $('#addContactModalTitle').on('submit', function(e) {
    e.preventDefault();

    let form = $(this);
    let formData = new FormData(this);
    let submitButton = form.find('button[type="submit"]');
    submitButton.prop('disabled', true);
    submitButton.text('در حال ارسال...');

    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            submitButton.prop('disabled', false);
            submitButton.text('افزودن');
            if (response.success) {
                Swal.fire({
                    title: 'موفق!',
                    text: 'محصول با موفقیت اضافه شد.',
                    icon: 'success',
                    background: '#1e1e2f',
                    color: '#f1f1f1',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'باشه!'
                });

                $('#addContactModal').modal('hide');
                form[0].reset();

                // ساختن HTML آیتم جدید (توصیه می‌شود از blade component استفاده کنی!)
                response.data.forEach(item => {
                    let newItem = `
<div class="items" id="image-${item.id}">
    <div class="item-content">
        <div class="user-email">
            <p class="info-title">نام رنگ: </p>
            <p class="usr-email-addr" data-email="alan@mail.com">${item.name}</p>
        </div>
        <div class="user-email">
            <div class="usr-email-addr" style="border-radius: 7px;height: 50px;width: 120px; background-color:${item.code}"></div>
        </div>
        <div class="user-email">
            <p class="info-title">کد رنگ</p>
            <p class="usr-email-addr" data-email="alan@mail.com">${item.code}</p>
        </div>
        <div class="action-btn">
            <button type="button"
             data-id="${item.id}"
              class="custom-delete-btn"
               style="background: none; border: none; cursor: pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6L17.5 20H6.5L5 6h14z"></path>
                    <path d="M10 11v6"></path>
                    <path d="M14 11v6"></path>
                    <path d="M15 4V2H9v2"></path>
                </svg>
            </button>
        </div>
    </div>
</div>`;
$('.searchable-items.grid').append(newItem);
                });

            } else {
                Swal.fire('خطا!', 'در افزودن محصول خطایی پیش آمد.', 'error');
            }
        },
        error: function(xhr) {
            submitButton.prop('disabled', false);
            submitButton.text('افزودن');
            Swal.fire('خطا!', 'در ارسال اطلاعات خطایی رخ داد.', 'error');
        }
    });
});
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

$(document).on('click', '.custom-delete-btn', function () {
        let id = $(this).data('id');
        let deleteUrl = "/Panel/product/colors/index/" + id;

        Swal.fire({
            title: "آیا مطمئن هستید؟",
            text: "این عملیات غیرقابل بازگشت است!",
            icon: "warning",
            showCancelButton: true,
            cancelButtonColor: "#d33",
            background: '#1e1e2f',
            color: '#f1f1f1',
            confirmButtonColor: '#3085d6',
            confirmButtonText: "بله، حذف کن!",
            cancelButtonText: "لغو"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: deleteUrl,
                    type: 'POST',
                    data: {
                        "_method": "DELETE"
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'حذف شد!',
                                text: ' رنگ با موفقیت حذف شد.',
                                icon: 'success',
                                background: '#1e1e2f',
                                color: '#fff',
                                confirmButtonColor: '#007bff',
                                confirmButtonText: 'باشه'
                            });
                            $('#image-' + id).remove();
                        } else {
                            Swal.fire('خطا!', 'خطایی در حذف رنگ پیش آمد.', 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('خطا!', 'خطایی در ارسال درخواست پیش آمد.', 'error');
                    }
                });
            }
        });
    });
});

</script>
@endsection
@endsection
