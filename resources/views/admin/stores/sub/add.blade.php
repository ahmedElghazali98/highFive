<div class="modal fade in" id="add_page" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document" >
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
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-borderL">{{__('text.main_data')}} </legend>
                            <div class="form-group m-form__group row form-horizontal">


                        <div class="col-md-6">
                            <label>{{__('text.name_ar')}}<span class="required">*</span></label>
                            <div class="form-valid ">
                                <input type="text" name="name_ar"  class="form-control name_ar" placeholder="{{__('text.name_ar')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.name_en')}}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="text" name="name_en"  class="form-control name_en" placeholder="{{__('text.name_en')}}">
                            </div>
                        </div>




                        <div class="col-md-6">
                            <label>{{__('text.tel')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="number" name="tel" class="form-control tel" placeholder="{{__('text.tel')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.storekeeper')}}<span class="required">*</span></label>
                            <select name="storekeeper_id" class="form-control storekeeper_id selectpicker"
                            data-show-subtext="true" data-live-search="true"
                            id="storekeeper_id">
                                <option value="">{{__('text.storekeeper')}}</option>
                                @foreach($data['employees'] as $employee)
                                    <option value="{{$employee->id}}">
                                        {{$employee->name_ar}}
                                    </option>
                                    @endforeach
                            </select>
                        </div>


                            </div>
                        </fieldset>
                    </legend>


                        <fieldset class="scheduler-border">
                            <legend class="scheduler-borderL">{{__('text.address_data')}}  </legend>
                            <div class="form-group m-form__group row">

                        <div class="col-md-6">
                            <label>{{__('text.area')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="area" class="form-control area" placeholder="{{__('text.area')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.city')}}<span class="required">*</span></label>
                            <select name="city_id" class="form-control city_id selectpicker"
                            data-show-subtext="true" data-live-search="true"
                            id="city_id">
                                <option value="">{{__('text.city')}}</option>
                                @foreach($data['cities'] as $city)
                                    <option value="{{$city->id}}">
                                        {{$city->name_ar}}
                                    </option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.full_address')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="full_address" class="form-control full_address" placeholder="{{__('text.full_address')}}">
                            </div>
                        </div>






                    </div>
                </fieldset>
            </legend>

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


