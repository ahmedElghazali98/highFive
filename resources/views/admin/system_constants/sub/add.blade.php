<div class="modal fade in" id="add_page" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="addNewpageForm" id="addNewpageForm" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> {{ __('text.add_new') }} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group m-form__group row">

                        <!--add input  Based  on lang-->
                        @foreach($data['languages'] as $language)

                        <div class="col-md-6">
                            <label>{{__('text.name')}}{{__('text.'.$language->value3)}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="name_{{$language->value2}}" class="form-control name_{{$language->value2}}" placeholder="{{__('text.name')}}{{__('text.'.$language->value3)}}">
                            </div>
                        </div>

                        @endforeach


                            <div class="col-md-6">
                                <label>{{__('system_constants.constant')}}  <span class="required">*</span></label>
                                <select name="constant_type" class="form-control constant_type selectpicker"
                                data-show-subtext="true" data-live-search="true"
                                id="constant_type">
                                    <option value="">الثابت</option>
                                    @foreach($data['system_constants_select'] as $system_constant)
                                        <option value="{{$system_constant->value2}}">
                                            {{$system_constant->name_ar}}
                                        </option>
                                        @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group m-form__group row">
                            <div class="col-md-6">
                                <label> {{__('text.status')}} <span class="required"></span></label>
                                <div class="form-valid">
                                    <input type="checkbox" value="on" name="activeValue" id="activeValue"
                                     data-on-color="success" class="make-switch status activeValue"
                                     data-size="normal" data-on-text="{{__('text.active')}}"
                                     data-off-text="{{__('text.inactive')}}">
                                </div>
                            </div>

                        </div>



                    <div class="form-group m-form__group row">

                        <div class="col-md-6">

                        </div>
                    </div>
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


