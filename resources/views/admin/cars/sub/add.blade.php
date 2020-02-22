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
                    <div class="form-group m-form__group row">

                        <div class="col-md-6">
                            <label>{{__('text.name')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text"  name="name_ar"  class="form-control name_ar" placeholder="{{__('text.name_ar')}}">
                            </div>
                        </div>


                        <div class="col-md-6">
                            <label>{{__('text.car_type')}}<span class="required"></span></label>
                            <select name="type_id" class="form-control type_id selectpicker" id="type_id"
                            data-show-subtext="true" data-live-search="true">
                                <option value="">{{__('text.car_type')}}</option>
                                @foreach($data['car_type'] as $s)
                                    <option value="{{$s->id}}">
                                        {{$s->name_ar}}
                                    </option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.car_color')}}<span class="required"></span></label>
                            <select name="color_id" class="form-control color_id selectpicker" id="color_id"
                            data-show-subtext="true" data-live-search="true">
                                <option value="">{{__('text.car_color')}}</option>
                                @foreach($data['car_colors'] as $s)
                                    <option value="{{$s->id}}">
                                        {{$s->name_ar}}
                                    </option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.car_number')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text"  name="car_number"  class="form-control car_number" placeholder="{{__('text.car_number')}}">
                            </div>
                        </div>



                        <div class="col-md-6">
                            <label>{{__('text.car_driver')}}<span class="required">*</span></label>
                            <select name="driver_id" class="form-control driver_id selectpicker" id="driver_id"
                            data-show-subtext="true" data-live-search="true">
                                <option value="">{{__('text.car_driver')}}</option>
                                @foreach($data['employees'] as $employee)
                                    <option value="{{$employee->id}}">
                                        {{$employee->name_ar}}
                                    </option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-md-6" >
                            <label>{{__('text.car_manufacturing_year')}}<span class="required"></span></label>
                            <div class="form-valid">

                            <input type="text" name="manufacturing_year"    class="form-control manufacturing_year" placeholder="{{__('text.car_manufacturing_year')}}
                            ">
                            </div>
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


