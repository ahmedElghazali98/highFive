@extends('admin.layout.master_layout')
@section('title')
   {{__('site.control_panel')}}
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
										<a href="{{ route('admin.entryDocument.index') }}" class="m-nav__link">
											<span class="m-nav__link-text">{{__('text.entry_documents')}}</span>
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
	{{__('text.entry_documents')}}
</h3>
</div>
</div>
</div>
	<div class="m-portlet__body">
    <div class="form-group m-form__group row">
			<div class="col-md-3">
				<!--<input type="text" name="user_name_seach"  class="form-control user_name_seach" placeholder="	{{__('text.email')}}
                ">-->
		</div>

	</div>
	<div id="table-container">
        @include('admin.entry_documents.table-data')

	</div>

	</div>
</div>
</div>
</div>
</div>
</div>

@include('admin.entry_documents.sub.add')
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




/************************************************************************************************************* */
//                                      search item
/************************************************************************************************************* */
$('.item_name_seach').on('input',function(e){
    console.log(3);
    name =  $('.item_name_seach').val();
    $('#addNewpageForm #loading').show();
    $.ajax({
            url : '/admin/items/search',
            type: "post",
            dataType: "JSON",
            data:{name:name},
             success: function (data) {

                if (data["status"] == true) {
            $("#tbody_entry_documetn").append("<tr class='m-datatable__row'><td>"

                + data['data']['name_ar'] +
                "<input type='hidden' name='id_items[]' value='"
                +data['data']['id']   +
                "'></td><td><input type='text' name='quantity[]'  class='form-control quantity' placeholder='الكمية'></td>"+
                "<td><input type='text' name='price[]'  class='form-control price' placeholder='الكمية'></td>"+
                "<td> <a href='javascript:void(0)'  class='btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air deleteItems'> <i class='fa fa-trash'></i> </a></td></tr>");
            $('#addNewpageForm #loading').hide();
                }
                else{
                    $('#addNewpageForm #loading').hide();

                }
        }


});

});

/************************************************************************************************************* */
//                                      delete Items
/************************************************************************************************************* */
$(document).on('click','.deleteItems',function(e){

    var that = this;
    $(that).closest('tr').remove();


});






</script>

<script>
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4'
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
//                                      clear fileds
/************************************************************************************************************* */
function clearFileds(){
    $(".document").val('');
    $(".supplier_id").val('-1');
    $(".tag_search").val('');
    $('.rowIdUpdate').val(0);
    $('.tag_search').val('');
    $('.tag_search_dropdown').css('display','none');

}



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
</script>


<script type="text/javascript">
    $(document).ready(function () {
/************************************************************************************************************* */
//                                      open model Add
/************************************************************************************************************* */        $(document).on('click', '.btnAddCustomer', function () {
    $(document).on('click', '.btnAddCustomer', function () {
        clearFileds();
         $('.modal-title').html('{{__('text.add_new')}}');
     });

     $("#tbody_entry_documetn").empty();
            $('.modal-title').html('{{__('text.add_new')}}');
        });

/************************************************************************************************************* */
//                                      Edit
/************************************************************************************************************* */

        $(document).on('click', '.updateDetails', function () {
            $("#tbody_entry_documetn").empty();
            $('#addNewpageForm #loading').show();
			$('.rowIdUpdate').val(0);
            var id = $(this).data('id');
            $('.rowIdUpdate').val(id);
            $.ajax({
                url: "/admin/entryDocument/edit",
                type: "get",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data){
                    $('#addNewpageForm #loading').hide();

					if(data['status'] == true){
                        $.each(data['item'], function(i, item) {
                            var that =this;
                            $.each(data['categoty'], function(i, item) {
                            if(that.category_id == this.id){

                            $("#tbody_entry_documetn").append("<tr class='m-datatable__row'><td>"
                                 + this.name_ar +"<input type='hidden' name='id_items[]' value='"+
                                 this.id   +  "'></td>" +
                                 "<td><input type='text' name='quantity[]'  class='form-control quantity' placeholder='الكمية' value=' "+that.quantity + "'></td>"+

                                 "<td><input type='text' name='price[]'  class='form-control price' placeholder='الكمية' value='"+that.price  +"'></td>"+

                                 "<td> <a href='javascript:void(0)'  class='btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air deleteItems'> <i class='fa fa-trash'></i> </a></td></tr>");

                            }

                        });
                        });
                        $(".document").val(data['data']['document']);
                       // $(".date").val(data['data']['date']);
                       $('#datepicker').datepicker("setDate",  new Date (data['data']['date']) );
                        $('.supplier_id').val(data['data']['supplier_id']).prop('selected', true);




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



$('.tag_search').on('input',function (e) {
    e.preventDefault();
    if(e.keyCode == 13) {
        return false;
    }
        const value = $(this).val();
        $('#addNewpageForm .tag_id').val('');

        if(value.length==0){
            $('.tag_search_dropdown').html('');
            $('.tag_search_dropdown').css('display','none');
        }
        else{
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: "/admin/items/search",
                data: {
                    value:value
                },
                success: function (response) {
                    $('.tag_search_dropdown').html(response);
                   // $(".tag_search_dropdown").append('<li class="addNewTag"><span class="text-danger"> <b>{{__('lang.add_new')}}:</b> '+value+'</span></li>')
                    $('.tag_search_dropdown').css('display','block');
                }
            });
    }
});


$(document).on('click','.tag_search_dropdown li',function(){
    // var barcode=$(this).children('span').attr("barcode");
    const id = $(this).attr('data-id');
    $('.tag_search_dropdown').css('display','none');
    $('#addNewpageForm #loading').show();


        $('#addNewpageForm .tag_search').val($(this).text());

        $.ajax({
        type: "get",
        url: "/admin/items/"+id,
        success: function (data) {

            if (data["status"] == true) {
                $("#tbody_entry_documetn").append("<tr class='m-datatable__row'><td>"

                    + data['data']['name_ar'] +
                    "<input type='hidden' name='id_items[]' value='"
                    +data['data']['id']   +
                    "'></td><td><input type='text' name='quantity[]'  class='form-control quantity' placeholder='الكمية'></td>"+
                    "<td><input type='text' name='price[]'  class='form-control price' placeholder='الكمية'></td>"+
                    "<td> <a href='javascript:void(0)'  class='btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air deleteItems'> <i class='fa fa-trash'></i> </a></td></tr>");
                $('#addNewpageForm #loading').hide();
                    }

          //  console.log(response);
           // $("#tags").tagsinput('add',{id:response.data.id,title:response.data['title_'+window.locale]});
            $(".tag_search").val('');
        },
        complete:function(){
            $('#addNewpageForm #loading').hide();
            $('.tag_search_dropdown').css('display','none');

        }
    });



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
                    url: "/admin/entryDocument/add",
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
                    url: "/admin/entryDocument/update",
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
                            $("#add_page").modal("hide");
                        } else {
                            swal({
                                title: "",
                                text: data["data"],
                                type: "error",
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
                url: "/admin/entryDocument/delete",
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
