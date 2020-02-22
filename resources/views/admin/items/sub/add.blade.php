<div class="modal fade in" id="add_page" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xxlg " role="document" >
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
                        <legend class="scheduler-borderL">{{__('text.main_data')}}  </legend>
                    <div class="form-group m-form__group row">

                        <div class="col-md-3">
                            <label>{{__('text.category_name_ar')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="name_ar" class="form-control name_ar" placeholder="{{__('text.category_name_ar')}}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label>{{__('text.category_name_en')}}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="text" name="name_en" class="form-control name_en" placeholder="{{__('text.category_name_en')}}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label>{{__('text.manufacture_company')}}<span class="required">*</span></label>
                            <select name="manufacture_company_id" class="form-control manufacture_company_id selectpicker"
                            data-show-subtext="true" data-live-search="true"
                            id="manufacture_company_id">
                                <option value="">{{__('text.manufacture_company')}}</option>
                                @foreach($data['manufacture_companies'] as $manufacture_company)
                                    <option value="{{$manufacture_company->id}}">
                                        {{$manufacture_company->name_ar}}
                                    </option>
                                    @endforeach
                            </select>
                        </div>



                        <div class="col-md-3">
                            <label>{{__('text.unit')}}<span class="required">*</span></label>
                            <select name="unit_id" class="form-control unit_id selectpicker"
                            data-show-subtext="true" data-live-search="true"
                            id="unit_id">
                                <option value="">{{__('text.unit')}}</option>
                                @foreach($data['units'] as $unit)
                                    <option value="{{$unit->id}}">
                                        {{$unit->name_ar}}
                                    </option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>{{__('text.size')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="size" class="form-control size" placeholder="{{__('text.size')}}">
                            </div>
                        </div>



                        <div class="col-md-3" >
                            <label>{{__('text.type_category')}}<span class="required">*</span></label>
                            <select name="type_category_id"
                             class="form-control type_category_id "
                             id="type_category_id"
                             >
                                <option value="" selected>{{__('text.type_category')}}</option>
                                @foreach($data['type_categories'] as $type_category)
                                    <option value="{{$type_category->id}}">
                                        {{$type_category->name_ar}}
                                    </option>
                                    @endforeach
                            </select>
                        </div>


                        <div class="col-md-3" >
                            <label>{{__('text.tax_category')}}<span class="required">*</span></label>
                            <select name="tax_id" class="form-control tax_id selectpicker"
                             id="tax_id"
                             data-show-subtext="true" data-live-search="true"
                             >
                                <option value="" selected>{{__('text.tax_category')}}</option>
                                @foreach($data['tax_category'] as $t)
                                    <option value="{{$t->id}}">
                                        {{$t->name}}
                                    </option>
                                    @endforeach
                            </select>
                        </div>



                        <div class="col-md-3">
                            <label>{{__('text.category_product')}}<span class="required">*</span></label>
                            <select name="category_product_id" class="form-control category_product_id selectpicker"
                            data-show-subtext="true" data-live-search="true"
                            id="category_product_id">
                                <option value="" selected>{{__('text.category_product')}}</option>
                                @foreach($data['category_product'] as $c)
                                    <option value="{{$c->id}}">
                                        {{$c->name}}
                                    </option>
                                    @endforeach
                            </select>
                        </div>


                        <div class="col-md-3">
                            <label>{{__('text.minimum')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="minimum" class="form-control minimum" placeholder="{{__('text.minimum')}}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label>{{__('text.barcode')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="barcode" class="form-control barcode" placeholder="{{__('text.barcode')}}">
                            </div>
                        </div>

                    </div>

                    </fieldset>



                    <fieldset class="scheduler-border">
                        <legend class="scheduler-borderL">{{__('text.img_data')}}  </legend>
                    <div class="form-group m-form__group row">

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

                    </div>

                    </fieldset>



                    <fieldset class="scheduler-border">
                        <legend class="scheduler-borderL">{{__('text.price_data')}}  </legend>
                        <div class="form-group m-form__group row">




                        <div class="col-md-3">
                            <label>{{__('text.pricing_price')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="pricing_price" class="form-control pricing_price" placeholder="{{__('text.pricing_price')}}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label>{{__('text.final_price')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="final_price" class="form-control final_price" placeholder="{{__('text.final_price')}}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label>{{__('text.wholesale_price')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="wholesale_price" class="form-control wholesale_price" placeholder="{{__('text.wholesale_price')}}">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <label>{{__('text.cost_price')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="cost_price" class="form-control cost_price" placeholder="{{__('text.cost_price')}}">
                            </div>
                        </div>








                    </div>

                    </fieldset>

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

<!-- الموديل الخاص ب الصنف عندما يكون منتج وليس جاهز -->

<div class="modal fade in" id="add_items_of_product_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document" >
        <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> {{ __('text.add_new') }} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group m-form__group row">

                        <div class="col-md-6">
                            <label>{{__('text.item')}}<span class="required">*</span></label>
                            <div class="form-valid">

                           <!-- <input type="text" name="item_name_seach"  class="form-control item_name_seach" placeholder="	{{__('text.item')}}
                            ">-->

                            <input type="text" name="tag_search"  autocomplete="off"  class="form-control tag_search" placeholder="{{__('text.item')}}">

                            <ul class="search_result_order tag_search_dropdown">
                            </ul>

                            </div>
                        </div>

                    </div>

                    <!-- start tabel-->

                    <div class="form-group m-form__group row">
                        <table class="table table-bordered" id="html_table" width="100%">
                            <thead class="m-datatable__head">
                                <tr>
                                        <th class="text-center">{{__('text.item')}}</th>
                                        <th class="text-center">{{__('text.quantity')}}</th>
                                        <th class="text-center">{{__('text.delete')}}</th>

                                </tr>
                            </thead>
                            <tbody class="m-datatable__body load tbody_items" id="tbody_items">


                            </tbody>


                        </table>


                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn_save_page" data-dismiss="modal">{{__('text.ok')}}</button>
                    <button type="button" class="btn btn-secondary  " data-dismiss="modal">{{__('text.hide')}}</button>
                </div>
                <div id="loading">
                    <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
                <input type="hidden" name="hidden" class="rowIdUpdate" value="0">
        </div>
    </div>
</div>




