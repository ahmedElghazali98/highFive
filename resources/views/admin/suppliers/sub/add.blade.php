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

                    <fieldset class="scheduler-border">
                        <legend class="scheduler-borderL">{{__('text.main_data')}}  </legend>
                    <div class="form-group m-form__group row">
                        <div class="col-md-4">
                            <label>{{__('text.name_ar')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="name_ar" class="form-control name_ar" placeholder="{{__('text.name')}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>{{__('text.name_en')}}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="text" name="name_en" class="form-control name_en" placeholder="{{__('text.name_en')}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>{{__('text.email')}}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="email" name="email" class="form-control email" placeholder="{{__('text.email')}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>{{__('text.mobile')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="number" name="mobile" class="form-control mobile" placeholder="{{__('text.mobile')}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>{{__('text.tel')}}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="number" name="tel" class="form-control tel" placeholder="{{__('text.tel')}}">
                            </div>
                        </div>
                    </div>
                    </fieldset>


                     <fieldset class="scheduler-border">
                        <legend class="scheduler-borderL">{{__('text.address_data')}}  </legend>
                    <div class="form-group m-form__group row">

                        <div class="col-md-4">
                            <label>{{__('text.area')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="area" class="form-control area" placeholder="{{__('text.area')}}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>{{__('customer.city')}}<span class="required">*</span></label>
                            <select name="city_id" class="form-control city_id selectpicker"
                            data-show-subtext="true" data-live-search="true"
                            id="city_id">
                                <option value="">{{__('customer.city')}}</option>
                                @foreach($data['cities'] as $city)
                                    <option value="{{$city->id}}">
                                        {{$city->name_ar}}
                                    </option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>{{__('text.full_address')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="full_address" class="form-control full_address" placeholder="{{__('text.full_address')}}">
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




<div class="modal fade in" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="changepasswordform" id="changepasswordform" action="" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('users.change_password')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group m-form__group row">
                        <div class="col-md-12">
                            <label>{{__('users.username')}}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="text" disabled class="form-control name" placeholder="{{__('users.username')}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>{{__('users.password')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="password" required name="password" class="form-control password" placeholder="{{__('users.password')}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>{{__('users.confirm_password')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="password" required name="confirmation_password" class="form-control confirm_password" placeholder="{{__('users.confirm_password')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn_save_password">{{__('text.save')}}</button>
                    <button type="button" class="btn btn-secondary  " data-dismiss="modal">{{__('text.hide')}}</button>
                </div>
                <div id="loading">
                    <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
                <input type="hidden" name="hidden" class="userIdUpdate" value="0">
            </form>
        </div>
    </div>
</div>


