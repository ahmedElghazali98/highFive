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
                            <label>{{__('text.from')}}<span class="required">*</span></label>
                            <select name="from_store_id" class="form-control from_store_id selectpicker" id="from_store_id"
                            data-show-subtext="true" data-live-search="true">
                                <option value="">{{__('text.name_store')}}</option>
                                @foreach($data['storesSelect'] as $s)
                                    <option value="{{$s->id}}">
                                        {{$s->name_ar}}
                                    </option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.to')}}<span class="required">*</span></label>
                            <select name="to_store_id" class="form-control to_store_id selectpicker" id="to_store_id"
                            data-show-subtext="true" data-live-search="true">
                                <option value="">{{__('text.name_store')}}</option>
                                @foreach($data['storesSelect'] as $s)
                                    <option value="{{$s->id}}">
                                        {{$s->name_ar}}
                                    </option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.car')}}<span class="required">*</span></label>
                            <select name="car_id" class="form-control car_id selectpicker" id="car_id"
                            data-show-subtext="true" data-live-search="true">
                                <option value="">{{__('text.car')}}</option>
                                @foreach($data['cars'] as $c)
                                    <option value="{{$c->id}}">
                                        {{$c->name_ar}} [{{$c->car_number }}]
                                    </option>
                                    @endforeach
                            </select>
                        </div>


                        <div class="col-md-6">
                            <label>{{__('text.date')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input data-date-format="dd/mm/yyyy" id="datepicker" autocomplete="off" name="date" class="form-control date" placeholder="{{__('text.date')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.employee')}}<span class="required"></span></label>
                            <select name="emp_id" class="form-control emp_id selectpicker" id="emp_id"
                            data-show-subtext="true" data-live-search="true">
                                <option value="">{{__('text.employee')}}</option>
                                @foreach($data['employees'] as $employee)
                                    <option value="{{$employee->id}}">
                                        {{$employee->name_ar}}
                                    </option>
                                    @endforeach
                            </select>
                        </div>




                    </div>

                    <!-- start tabel-->

                    <div class="form-group m-form__group row">

                        <div class="col-md-6" style="    margin-bottom: 16px;">
                            <label>{{__('text.item')}}<span class="required"></span></label>
                            <div class="form-valid">

                          <!--  <input type="text" name="item_name_seach"  autocomplete="off"  class="form-control item_name_seach" placeholder="	{{__('text.item')}}
                            ">-->

                            <input type="text" name="tag_search"  autocomplete="off"  class="form-control tag_search" placeholder="{{__('text.item')}}">

                            <ul class="search_result_order tag_search_dropdown">
                            </ul>

                            </div>
                        </div>
                        <div class="col-md-12">
                        <table class="table table-bordered" id="html_table" width="100%">
                            <thead class="m-datatable__head">
                                <tr>
                                        <th class="text-center">{{__('text.item')}}</th>
                                        <th class="text-center">{{__('text.unit')}}</th>
                                        <th class="text-center">{{__('text.quantity')}}</th>
                                        <th class="text-center">{{__('text.delete')}}</th>

                                </tr>
                            </thead>
                            <tbody class="m-datatable__body load tbody_items" id="tbody_items">


                            </tbody>


                        </table>
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

<!--                          model log tabel   -->

<div class="modal fade in" id="tabel_log" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xlg " role="document" >
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> {{ __('text.processors_log') }} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- start tabel-->

                    <div class="form-group m-form__group row">


                        <div class="col-md-12">
                        <table class="table table-bordered" id="html_table" width="100%">
                            <thead class="m-datatable__head">
                                <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">{{__('text.from')}}</th>
                                        <th class="text-center">{{__('text.to')}}</th>
                                        <th class="text-center">{{__('text.car')}}</th>
                                        <th class="text-center">{{__('text.employee')}}</th>

                                        <th class="text-center">{{__('text.item')}}</th>
                                        <th class="text-center">{{__('text.quantity')}}</th>

                                        <th class="text-center">{{__('text.user')}}</th>
                                        <th class="text-center">{{__('text.date')}}</th>


                                </tr>
                            </thead>
                            <tbody class="m-datatable__body load tbody_items" id="tbody_log">


                            </tbody>


                        </table>
                        </div>

                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary  " data-dismiss="modal">{{__('text.hide')}}</button>
                </div>
                <div id="loading">
                    <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
            </form>
        </div>
    </div>
</div>




