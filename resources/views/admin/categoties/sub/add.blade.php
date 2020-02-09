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
                            <label>{{__('text.category_name_ar')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="name_ar" class="form-control name_ar" placeholder="{{__('text.category_name_ar')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.category_name_en')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="name_en" class="form-control name_en" placeholder="{{__('text.category_name_en')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.manufacture_company')}}<span class="required">*</span></label>
                            <select name="manufacture_company_id" class="form-control manufacture_company_id" id="manufacture_company_id">
                                <option value="">{{__('text.manufacture_company')}}</option>
                                @foreach($data['manufacture_companies'] as $manufacture_company)
                                    <option value="{{$manufacture_company->id}}">
                                        {{$manufacture_company->name_ar}}
                                    </option>
                                    @endforeach
                            </select>
                        </div>



                        <div class="col-md-6">
                            <label>{{__('text.unit')}}<span class="required">*</span></label>
                            <select name="unit_id" class="form-control unit_id" id="unit_id">
                                <option value="">{{__('text.unit')}}</option>
                                @foreach($data['units'] as $unit)
                                    <option value="{{$unit->id}}">
                                        {{$unit->name_ar}}
                                    </option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.size')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="size" class="form-control size" placeholder="{{__('text.size')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.link_img')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="link_img" class="form-control link_img" placeholder="{{__('text.link_img')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.img')}}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="file" name="img" class="form-control img" placeholder="{{__('text.img')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.type_category')}}<span class="required">*</span></label>
                            <select name="type_category_id" class="form-control type_category_id" id="type_category_id">
                                <option value="">{{__('text.type_category')}}</option>
                                @foreach($data['type_categories'] as $type_category)
                                    <option value="{{$type_category->id}}">
                                        {{$type_category->name_ar}}
                                    </option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.safety_stocks')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="safety_stocks" class="form-control safety_stocks" placeholder="{{__('text.safety_stocks')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.pricing_price')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="pricing_price" class="form-control pricing_price" placeholder="{{__('text.pricing_price')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.final_price')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="final_price" class="form-control final_price" placeholder="{{__('text.final_price')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.wholesale_price')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="wholesale_price" class="form-control wholesale_price" placeholder="{{__('text.wholesale_price')}}">
                            </div>
                        </div>


                        <div class="col-md-6">
                            <label>{{__('text.cost_price')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="cost_price" class="form-control cost_price" placeholder="{{__('text.cost_price')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.barcode')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="barcode" class="form-control barcode" placeholder="{{__('text.barcode')}}">
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


