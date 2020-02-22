<div class="modal fade in" id="add_page" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog " role="document"  >
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
                    <div class="form-group m-form__group row">
                        <div class="col-md-12">
                            <label>{{__('text.name')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="name" class="form-control name" placeholder="{{__('text.name')}}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label>{{__('text.tax_category')}}<span class="required">*</span></label>
                            <select name="category_id" class="form-control category_id selectpicker"
                            data-show-subtext="true" data-live-search="true"
                            id="category_id">
                                <option value="">{{__('text.tax_category')}}</option>
                                @foreach($data['tax_categories'] as $t)
                                    <option value="{{$t->id}}">
                                        {{$t->name}}
                                    </option>
                                    @endforeach
                            </select>
                        </div>


                        <div class="col-md-12">
                            <label>{{__('text.rate')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="rate" class="form-control rate" placeholder="{{__('text.rate')}}">
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


