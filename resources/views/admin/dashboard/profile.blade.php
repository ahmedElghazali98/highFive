@extends('admin.layout.master_layout')
@section('title')
   {{__('site.control_panel')}}
@stop

@section('page-content')
<!-- <div class="m-subheader-search">
		<span class="m-subheader-search__desc">
		<div class="mr-auto">
</div>
</span>
					</div> -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								
								<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
									<li class="m-nav__item m-nav__item--home">
										<a href="#" class="m-nav__link m-nav__link--icon">
											<i class="m-nav__link-icon la la-home"></i>
										</a>
									</li>
									<li class="m-nav__item">
										<a href="/admin/dashboard" class="m-nav__link">
											<span class="m-nav__link-text">{{__('menu.home')}}</span>
										</a>
									</li>
									
									<li class="m-nav__separator">-</li>
									<li class="m-nav__item">
										<a href="/admin/dashboard/profile" class="m-nav__link">
											<span class="m-nav__link-text">الملف الشخصي</span>
										</a>
									</li>
								</ul>
							</div>
	
	<div>

</div>
</div>
</div>

<div class="m-grid__item m-grid__item--fluid m-wrapper">
<!-- BEGIN: Subheader -->
<!-- END: Subheader -->
<div class="m-content">
<div class="row">
<div class="col-lg-12">
<!--begin::Portlet-->
<div class="m-portlet m-portlet--mobile" id="m_blockui_2_portlet">
	<div class="m-portlet__head">
<div class="m-portlet__head-caption">
<div class="m-portlet__head-title">
<h3 class="m-portlet__head-text">
الملف الشخصي
</h3>
</div>
</div>
</div>
	<div class="m-portlet__body">
    <form class="profileForm" id="profileForm" action="" method="post">
                @csrf
                    <div class="form-group m-form__group row">
                        <div class="col-md-12 mb-4">
                            <label>اسم المستخدم<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" disabled value="{{\Auth::user()->name}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label>البريد الالكتروني<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="email" disabled  value="{{\Auth::user()->email}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                             <label>كلمة المرور<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="password" name="password" value="" class="form-control password">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn_save_page">حفظ</button>
                </div>
            </form>
	</div>
</div>
</div>
</div>
</div>
</div>
@stop
@section('js')
<script>
            $('#profileForm').on('submit', function(e){
            e.preventDefault();
            var formData = new FormData(this);
                $.ajax({
                    url: '/dashboard/password',
                    dataType:'json',
                    type: 'POST',
                    cache:false,
					contentType: false,
					processData: false,
                    data: formData,
                    success: function (data) {
                        if (data["status"] == true) {
                                Swal.fire(
                                data['message'],
                                '',
                                'success'
                                );
                                $('.password').val('');
                        }else {
                            Swal.fire({
                                type: 'error',
                                title: 'عذرا',
                                text: data['message']
                            })
                        }
                    },
                });
            });
</script>
@stop