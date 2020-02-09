@extends('admin.layout.master_layout')
@section('title')
   {{__('site.control_panel')}}
@stop

@section('page-title')
    <div class="m-subheader-search">
        <span class="m-subheader-search__desc">
            <div class="mr-auto">
                    <h3 class="page-title"> {{__('menu.home')}}
                        <small>
                            
                        </small>
                </h3>
            </div>
        </span>
    </div>
    
@stop

@section('page-content')
<!-- BEGIN: Subheader -->
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
									
									
								</ul>
							</div>

		<div class="m-demo__preview  m-demo__preview--btn">
                
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

</div>
</div>
</div>
</div>

@include('admin.dashboard.sub.add')
@stop

@section('js')
<script>
</script>
@stop