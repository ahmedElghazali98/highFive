<div class="modal fade in" id="add_page" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content">
            <form class="addNewpageForm" id="addNewpageForm" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة مستخدم جديد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group m-form__group row">
                        <div class="col-md-6">
                            <label>{{__('text.username')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="username" class="form-control username" placeholder="{{__('text.username')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>{{__('text.fullname')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="fullname" class="form-control fullname" placeholder="{{__('text.fullname')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>{{__('text.email')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="email" name="email" class="form-control email" placeholder="{{__('text.email')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>{{__('text.password')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="password" name="password" class="form-control password" placeholder="{{__('text.password')}}">
                            </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">{{__('text.change_password')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group m-form__group row">
                        <div class="col-md-12">
                            <label>{{__('text.username')}}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="text" disabled class="form-control name" placeholder="{{__('text.username')}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>{{__('text.password')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="password" required name="password" class="form-control password" placeholder="{{__('text.password')}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>{{__('text.confirm_password')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="password" required name="confirmation_password" class="form-control confirm_password" placeholder="{{__('text.confirm_password')}}">
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



<!-- start permissions model -->

<div class="modal fade in" id="permission_users" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="changepasswordform" id="changepasswordform" action="" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('text.permissions')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="permission-body">


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

<!-- end permissions model -->


