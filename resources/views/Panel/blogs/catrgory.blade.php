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
                                    <svg id="btn-add-contact" class="float-left" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-sliders">
                                   <line x1="4" y1="21" x2="4" y2="14"></line>
                                   <line x1="4" y1="10" x2="4" y2="3"></line>
                                   <line x1="12" y1="21" x2="12" y2="12"></line>
                                   <line x1="12" y1="8" x2="12" y2="3"></line>
                                   <line x1="20" y1="21" x2="20" y2="16"></line>
                                   <line x1="20" y1="12" x2="20" y2="3"></line>
                                   <line x1="1" y1="14" x2="7" y2="14"></line>
                                   <line x1="9" y1="8" x2="15" y2="8"></line>
                                   <line x1="17" y1="16" x2="23" y2="16"></line>
                               </svg>
                                    <!-- Modal -->
                                    <div class="modal fade" id="addContactModal" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                                                    <div class="add-contact-box">
                                                        <div class="add-contact-content">
                                                            <form id="addContactModalTitle" method="POST" action="{{ route('Panel.blogs.categoryStore') }}" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="contact-location">
                                                                            <label for="name">نام دسته بندی</label>
                                                                            <i class="flaticon-location-1"></i>
                                                                            <input type="name" id="c-location" class="form-control" name="name">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">

                                                                    <button class="btn" type="button" data-dismiss="modal"> <i class="flaticon-delete-1"></i>  نادیده گرفتن</button></button>
                                                                    <button type="submit" class="btn" id="btn-add">افزودن</button>

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

                            <div class="searchable-items list">
                                <div class="items items-header-section">
                                    <div class="item-content">
                                        <div class="user-email">
                                            <h4 style="margin-right: 0;">نام دسته بندی</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="addItemNew">
                                @foreach ($categories as $category)
                                <div class="items" id="image-{{$category->id}}">
                                    <div class="item-content">
                                        <div class="user-email">
                                            <p class="usr-email-addr" data-email="alan@mail.com">{{$category->name}}</p>
                                        </div>
                                        <div class="action-btn">
                                            <button type="button"
                                            data-id="{{$category->id}}"
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
            $('#btn-add-contact').click(function(e) {
                e.preventDefault();
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
                    text: 'دسته بندی با موفقیت اضافه شد.',
                    icon: 'success',
                    background: '#1e1e2f',
                    color: '#f1f1f1',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'باشه!'
                });

                $('#addContactModal').modal('hide');
                form[0].reset();

                // ساختن HTML آیتم جدید (توصیه می‌شود از blade component استفاده کنی!)
                let newItem = `
                <div class="items" id="image-${response.id}">
                    <div class="item-content">
                        <div class="user-email">
                            <p class="usr-email-addr" data-email="alan@mail.com">${response.name}</p>
                        </div>
                        <div class="action-btn">
                            <button type="button" data-id="${response.id}" class="custom-delete-btn" style="background: none; border: none; cursor: pointer;">
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

                $('.addItemNew').prepend(newItem);
            } else {
                Swal.fire('خطا!', 'در افزودن دسته بندی خطایی پیش آمد.', 'error');
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

$(document).on('click', '.custom-delete-btn', function (e) {

                e.preventDefault();
                let id = $(this).data('id');
                let deleteUrl = "/Panel/blogs/categoryDestroy/" + id;

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
                                        text: 'دسته بندی با موفقیت حذف شد.',
                                        icon: 'success',
                                        background: '#1e1e2f',
                                        color: '#fff',
                                        confirmButtonColor: '#007bff',
                                        confirmButtonText: 'باشه'
                                    });
                                    $('#image-' + id).remove();
                                } else {
                                    Swal.fire('خطا!', 'خطایی در حذف دسته بندی پیش آمد.', 'error');
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
