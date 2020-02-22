<div class="modal fade in" id="add_page" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"  >
        <div class="modal-content" >
            <form class="addNewpageForm" id="addNewpageForm" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('text.add_new') }}  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

				<!--	 <fieldset class="scheduler-border">
                        <legend class="scheduler-borderL">{{__('text.main_data')}}  </legend>

                    <div class="form-group m-form__group row">

                        <div class="col-md-6">
                            <label>{{__('text.item')}}<span class="required"></span></label>
                        <input type="text" name="item"  autocomplete="off" disabled class="form-control item" placeholder="{{__('text.item')}}">

                        <input type="hidden" name="item_id" class="item_id" value="" >


                        </div>



                        <div class="col-md-6">
                            <label>{{__('text.stores')}}<span class="required">*</span></label>
                            <input type="text" name="store"  autocomplete="off" disabled class="form-control store" placeholder="{{__('text.store')}}">


                        </div>

                    </div>
                </fieldset>-->

                <fieldset class="scheduler-border">
                    <legend class="scheduler-borderL">{{__('text.quantity_data')}}  </legend>

                <div class="form-group m-form__group row">

                        <div class="col-md-4">
                            <label>{{__('text.quantity')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" disabled name="quantity" class="form-control quantity" placeholder="{{__('text.quantity')}}">
                            </div>
                        </div>



                        <div class="col-md-4">
                            <label>{{__('text.min_quantity')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="min_quantity" class="form-control min_quantity" placeholder="{{__('text.min_quantity')}}">
                            </div>
                        </div>


                        <div class="col-md-4">
                            <label>{{__('text.max_quantity')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="max_quantity" class="form-control max_quantity" placeholder="{{__('text.max_quantity')}}">
                            </div>
                        </div>
                    </div>

                </fieldset>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn_save_page">{{__('text.save')}}</button>
                    <button type="button" class="btn btn-secondary  " data-dismiss="modal">{{__('text.hide')}}</button>
                </div>
                <div id="loading">
                    <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
                <input type="hidden" name="hidden" class="rowIdUpdate" value="0">
            </form>
        </div>
    </div>
</div>

