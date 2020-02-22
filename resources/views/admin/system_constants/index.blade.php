@extends('admin.layout.master_layout')
@section('title')
   {{__('text.control_panel')}}
@stop
@section('css')
    <style>
        #loading{
            display:none;
        }
    </style>
@endsection
@section('page-content')
{{app::setLocale(   session('locale'))}}

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
										<a href="{{ route('admin.dashboard.view') }}" class="m-nav__link">
											<span class="m-nav__link-text">{{__('text.home')}}</span>
										</a>
									</li>

									<li class="m-nav__separator">-</li>
									<li class="m-nav__item">
										<a href="{{ route('admin.system_constants.index') }}" class="m-nav__link">
											<span class="m-nav__link-text">{{__('text.system_constants')}}</span>
										</a>
									</li>
								</ul>
							</div>

		<div class="m-demo__preview  m-demo__preview--btn">

				<button type="button"  data-toggle="modal" data-target="#add_page" class="btn btn-danger m-btn m-btn--custom btnAddCustomer" style="line-height: 15px;
    			padding-bottom: 15px;"><i class="fa fa-plus"></i> {{__('text.add_new')}}</button>

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
	{{__('text.system_constants')}}
</h3>
</div>
</div>
</div>
	<div class="m-portlet__body">
    <div class="form-group m-form__group row">
			<div class="col-md-3">
				<input type="text" name="user_name_seach"  class="form-control user_name_seach" placeholder="	{{__('text.type')}}
                ">
		</div>

	</div>
	<div id="table-container">
        @include('admin.system_constants.table-data')

	</div>

	</div>
</div>
</div>
</div>
</div>
</div>

@include('admin.system_constants.sub.add')
@stop

@section('js')
<script type="text/javascript">

$('#activeValue').bootstrapSwitch('state', false, true);

function CKupdate(){
	for ( instance in CKEDITOR.instances )
		CKEDITOR.instances[instance].updateElement();
}
/************************************************************************************************************* */
//                                      search
/************************************************************************************************************* */
$('.user_name_seach').on('input',function(e){
    name =  $('.user_name_seach').val();
    if(name.length >= 3 || name == ''){
        var url = $(this).attr('href');
        getData(url,name);
    }
});
</script>

<script>
/************************************************************************************************************* */
//                                      pagination
/************************************************************************************************************* */
$(document).on('click', '.pagination a',function(event)
        {
            event.preventDefault();
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            var url = $(this).attr('href');
            getData(url);
        });

/************************************************************************************************************* */
//                                      get data
/************************************************************************************************************* */

    function getData(url,name) {
        $('#load').show();
        $.ajax({
            url : url,
            data:{name:name}
        }).done(function (data) {
            $("#table-container").empty().html(data);
            $('#load').hide();
        });
    }
/************************************************************************************************************* */
//                                      clear fileds
/************************************************************************************************************* */
function clearFileds(){
    $(".name_ar").val('');
    $(".constant_type").val('');
    $(".status").val('');
}
</script>


<script type="text/javascript">
    $(document).ready(function () {
/************************************************************************************************************* */
//                                      open model Add
/************************************************************************************************************* */        $(document).on('click', '.btnAddCustomer', function () {
		clearFileds();
            $('.modal-title').html('{{__('text.add_new')}}');
        });

/************************************************************************************************************* */
//                                      Edit
/************************************************************************************************************* */

        $(document).on('click', '.updateDetails', function () {
            $('#addNewpageForm #loading').show();
			$('#addNewpageForm').find('.rowIdUpdate').val(0);
            var id = $(this).data('id');
            $('.rowIdUpdate').val(id);
            $.ajax({
                url: "/admin/system_constants/edit",
                type: "get",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data){
                    $('#addNewpageForm #loading').hide();
					if(data['status'] == true){
                        $(".name_ar").val(data['data']['name_ar']);
                        $('#addNewpageForm').find('.constant_type').val(data['data']['type']).prop('selected', true);
                        $('.selectpicker').selectpicker('refresh')
                        if(data['data']['status'] == 1){
							$('#activeValue').bootstrapSwitch('state', true, true);
						}else{
							$('#activeValue').bootstrapSwitch('state', false, true);
						}

					}
                },
                complete: function () {
                    $('#add_page').modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    swal({title: '{{__('text.update_fail')}}', type: "error"});
                }
            });

            $('.modal-title').html('{{__('text.edit_data')}}');
            $('.btn_save_user').html('{{__('text.edit')}}');

        });

/************************************************************************************************************* */
//                                      Save && Update
/************************************************************************************************************* */
        $('.addNewpageForm').on('submit', function(e){
            $('#addNewpageForm #loading').show();
            e.preventDefault();
			var formData = new FormData(this);
            $('.loader_add_user').css('display', 'initial');
            setTimeout(function () {
                $('.btn_save_customer').removeClass('disabled');
                $('.loader_add_user').css('display', 'none');
            }, 30000);
            var id = $(".rowIdUpdate").val();
            //======================================== Save ==============================================
            if (id == 0) {
                $.ajax({
                    url: "/admin/system_constants/add",
                    type: "post",
					cache:false,
					contentType: false,
					processData: false,
                    data: formData,
                    success: function (data) {
                        $('#addNewpageForm #loading').hide();
                        if (data["status"] == true) {
                            swal({
                                title: "",
                                text: data["data"],
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "{{__('text.ok')}}",
                                cancelButtonText: "{{__('text.cancel')}}",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
                            var url = $(this).attr('href');
                            getData(url);
                         clearFileds();


                            $("#add_page").modal("hide");
                        } else {
                            var dt = '<ul>';
                                $.each(data["data"], function (key, value) {
                                    dt = dt + '<li>' + value + '</li>';
                                })
                                dt =dt+ '</ul>';

                            swal({
                                title: "",
                                text: data["data"],
                                type: "error",
                                html:dt,
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "{{__('text.ok')}}",
                                cancelButtonText: "{{__('text.cancel')}}",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });

                        }
                    }
                });
                //======================================== update ==============================================
            } else {
				$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
                $.ajax({
                    url: "/admin/system_constants/update",
                    type: "POST",
                    dataType: "JSON",
					cache:false,
					contentType: false,
					processData: false,
                    data: formData,
                    success: function (data) {
                        $('#addNewpageForm #loading').hide();
                        if (data["status"] == true) {
                            swal({
                                title: "",
                                text: data["data"],
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "{{__('text.ok')}}",
                                cancelButtonText: "{{__('text.cancel')}}",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
							var url = $(this).attr('href');
                            getData(url);
                          clearFileds();
							$('#addNewpageForm').find('.rowIdUpdate').val(0);
                            $("#add_page").modal("hide");
                        } else {
                            var dt = '<ul>';
                                $.each(data["data"], function (key, value) {
                                    dt = dt + '<li>' + value + '</li>';
                                })
                                dt =dt+ '</ul>';
                            swal({
                                title: "",
                                text: data["data"],
                                type: "error",
                                html:dt,
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "{{__('text.ok')}}",
                                cancelButtonText: "{{__('text.cencel')}}",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });

                        }
                    }
                });
            }
//	}
        });
        /****************************************************/
    });

/************************************************************************************************************* */
//                                     Delete
/************************************************************************************************************* */

    $(document).on('click','.delete',function(e){
		var id = $(this).data('id');
		Swal.fire({
				title: '{{__('text.are_you_sure')}}',
				text: "",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: '{{__('text.ok')}}',
				cancelButtonText: "{{__('text.cancel')}}",
			}).then((result) => {
				if (result.value) {
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
                url: "/admin/system_constants/delete",
                type: "post",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data){
					if(data['status'] == true){
						Swal.fire(
						'{{__('text.delete_success')}}',
						'',
						'success'
						)
						var url = $(this).attr('href');
						getData(url);
						window.history.pushState("", "", url);
					}else{
						swal({
                                title: "",
                                text: data["data"],
                                type: "error",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "{{__('text.ok')}}",
                                cancelButtonText: "{{__('text.cancel')}}",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
					}
                },
            });
				}
			})
	});
    /*************************************************************************************************************************/


</script>
@stop
