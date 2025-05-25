@extends('Panel.master')
@section('content')
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="row layout-spacing layout-top-spacing" id="cancel-row">
                    <div class="col-lg-12">
                        <div class="widget-content searchable-container list">

                            <div class="row">
                                <div class="col-xl-8 col-lg-7 col-md-7 col-sm-5 text-sm-right text-center layout-spacing align-self-center">
                                    <!-- Modal -->
                                    <div class="modal fade" id="addContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title">جزئیات سفارش</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body" id="product-detail-content">
                                            در حال بارگذاری اطلاعات...
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
                                            <h4 style="margin-right: 0;">نام کاربر</h4>
                                        </div>
                                        <div class="user-location">
                                            <h4 style="margin-left: 0;">مقاله</h4>
                                        </div>
                                        <div class="user-location">
                                            <h4 style="margin-left: 0;">تاریخ ثبت</h4>
                                        </div>
                                        <div class="user-location">
                                            <h4 style="margin-left: 0;">وضعیت</h4>
                                        </div>
                                        <div class="user-location">
                                            <h4 style="margin-left: 0;">عملیات</h4>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($comments as $comment)

                                <div class="items" id="image-{{$comment->id}}">
                                    <div class="item-content">
                                        <div class="user-email">
                                            <p class="usr-email-addr" data-email="alan@mail.com">{{$comment->users->name}}</p>
                                        </div>
                                        <div class="user-email">
                                        <p class="usr-email-addr" data-email="alan@mail.com">{{$comment->blog->title}}</p>
                                        </div>
                                        <div class="user-email">
                                            <p class="usr-email-addr" data-email="alan@mail.com">{{ \Morilog\Jalali\Jalalian::fromDateTime($comment->creted_at)->format('%Y/%m/%d') }}</p>
                                        </div>
                                        <div class="user-email">
                                        <button 
                                            data-id="{{ $comment->id }}" 
                                            data-approved="{{ $comment->approved ? '1' : '0' }}" 
                                            type="button" 
                                            class="btn-comment btn {{ $comment->approved ? 'btn-success' : 'btn-primary' }}">
                                            {{ $comment->approved ? 'تأیید شده' : 'تأیید' }}
                                        </button>
                                        </div>
                                        <div class="action-btn">
                                        <button data-id="{{$comment->id}}" class="btn btn-info btn-show-details view-comment" title="نمایش کامنت">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                                 stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-eye">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
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
    $(document).ready(function () {

$(document).on('click', '.view-comment', function () {
    var id = $(this).data('id');
    $.ajax({
        url: '{{ route("Panel.blogs.commentModal") }}',
        type: 'GET',
        data: { id: id },
        success: function (data) {
            $('#product-detail-content').html(data);
            $('#addContactModal').modal('show');
        },
        error: function () {
            $('#product-detail-content').html('<div class="alert alert-danger">خطا در بارگذاری نظر کاربر .</div>');
        }
    });
});

$('.btn-comment').on('click', function (e) {
    e.preventDefault();

    let button = $(this);
    let id = button.data('id');
    let approved = button.data('approved');

    $.ajax({
        type: "POST",
        url: "{{ route('Panel.blogs.updateStatus', ['id' => ':id']) }}".replace(':id', id),
        data: {
            _token: '{{ csrf_token() }}',
            approved: approved == 1 ? 0 : 1
        },
        success: function (response) {
            if (response.success) {
                // تغییر ظاهر دکمه بر اساس وضعیت جدید
                if (approved == 1) {
                    button
                        .removeClass('btn-success')
                        .addClass('btn-primary')
                        .text('تأیید');
                    button.data('approved', 0);
                } else {
                    button
                        .removeClass('btn-primary')
                        .addClass('btn-success')
                        .text('تأیید شده');
                    button.data('approved', 1);
                }
            }
        },
        error: function (xhr) {
            alert('خطا در تغییر وضعیت: ' + xhr.statusText);
        }
    });
});


    });
</script>
        @endsection
@endsection
