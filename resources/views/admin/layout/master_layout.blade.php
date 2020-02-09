<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    <!-- begin::Head -->
    <head>
        <meta charset="utf-8" />
        <title> {{__('site.name')}} | @yield('title')</title>
        <meta name="description" content="Latest updates and statistic charts">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <script src="/admin/assets/vendors/base/jquery-1.11.0.min.js"></script>
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>

        <!--begin::Web font -->

        {{app::setLocale(   session('locale'))}}
        @if (App::getLocale()=='ar')

        <!--end::Web font -->

        <!--begin::Page Vendors Styles -->

            <link href="/admin/assets/vendors/custom/fullcalendar/fullcalendar.bundle.rtl.css" rel="stylesheet" type="text/css" />
            <link href="/admin/assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />
            <link href="/admin/assets/demo/demo6/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />
            <script>
                window.dir = 'rtl';
                window.locale='ar';
            </script>
            @elseif (App::getLocale()=='en')
            <link href="/admin/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
            <link href="/admin/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
            <link href="/admin/assets/demo/demo6/base/style.bundle.css" rel="stylesheet" type="text/css" />
            <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
            <style>
                body >*{
                    font-family: 'Cairo', sans-serif !important;
                }
            </style>
            <script>
                window.dir = 'ltr';
                window.locale='en';

            </script>


            @else
            <link href="/admin/assets/vendors/custom/fullcalendar/fullcalendar.bundle.rtl.css" rel="stylesheet" type="text/css" />
            <link href="/admin/assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />
            <link href="/admin/assets/demo/demo6/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />
            <script>
                window.dir = 'rtl';
                window.locale='ar';
            </script>

            @endif


        <!--end::Page Vendors Styles -->
        <!--begin::Base Styles -->

        <!--end::Base Styles -->
        <link rel="shortcut icon" href="/admin/assets/demo/demo6/media/img/logo/favicon.png" />

        <link href="/admin/assets/app/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="/admin/assets/app/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="/admin/assets/app/bootstrap-datepicker.standalone.min.css" rel="stylesheet" type="text/css" />
          <link href="/admin/assets/app/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" type="text/css" />
          <link href="/admin/assets/app/select2-bootstrap4.min.css" rel="stylesheet" type="text/css" />
          <link href="/admin/assets/app/bootstrap4-modal-fullscreen.min.css" rel="stylesheet" type="text/css" />
         <link href="/admin/assets/demo/demo6/select2.min.css" rel="stylesheet" type="text/css" />
         <link href="/admin/assets/app/multi-select.css" rel="stylesheet" type="text/css" />
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-typeahead.css">
         {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/css/fontawesome-iconpicker.min.css"> --}}
         <meta name="csrf-token" content="{{ csrf_token() }}">
         <style>
           .selected_app .ms-container{
                margin: 0 auto;
                width: 100%;
                background: transparent url(/admin/assets/switch.png) no-repeat 50% 50%;

            }
            .pagination {
                justify-content: center;
                margin-top: 24px;
            }
            .selected_app .ms-container .ms-selectable{
                float:right;
            }

            .selected_app .ms-container .ms-selection {
                float: left;
            }
            .selected_app .ms-optgroup{
                margin-bottom: 12px !important;
            }
            .selected_app .ms-optgroup-label{
                color: #282a3c !important;
                padding: 0px 15px 0px 15px !important;
                font-weight:bold;
            }
            .selected_app .ms-container .ms-elem-selectable,.selected_app .ms-container .ms-elem-selection{
                padding: 2px 33px !important;
                font-size: 13px !important;
            }
            .selected_app .ms-container .ms-list{
                height: 500px;
            }

            #loading{
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                position: fixed;
                display: none;
                opacity: 0.8;
                z-index: 100000;
                background-color: #fff;
                z-index: 199;
                text-align: center;
            }

            #load{
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            position: fixed;
            display: block;
            opacity: 0.8;
            z-index: 100000;
            background-color: #fff;
            z-index: 199;
            text-align: center;
        }

        #loading-image {
            position: absolute;
            top: 50%;
            z-index: 200;
            right: 50%;
            z-index: 200;
        }

        .search_order{
            position: relative;
        }
        .search_result_order{
            position: absolute;
            left: 18px;
            top: 35px;
            width: 92%;
            display: none;
            background: white;
            border-radius: 4px;
            z-index: 9;
            padding: 0;
            margin: 0;
            border: 1px solid #ccc;
        }
        .search_result_order li {
            list-style: none;
            color: #9a9a9a;
            padding: 12px 10px;
            border-bottom: 1px solid #e8e8e8;
            cursor: pointer;
        }
        .search_result_order li:hover {background-color: #f7f7f7;}
        .search_result_order li:last-child {border: none;}
        .tag.label.label-info{
            display: inline-block;
            color:white;
            background-color: darkcyan;
            padding:5px;
            margin:0;
            border-radius: 20px;
        }
        .datepicker {
            font-size: 0.875em;
            left: 0!important;
              right: 52%!important ;
        }

        .datepicker td, .datepicker th {
            width: 1.5em;
            height: 1.5em;
        }
         </style>
          @yield('css')

    </head>

    <!-- end::Head -->

    <!-- begin::Body -->
    <body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-light m-aside-left--fixed m-aside-left--offcanvas m-aside-left--minimize m-brand--minimize m-footer--push m-aside--offcanvas-default">

        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">

            @include('admin.layout.header')
            <!-- begin::Body -->
         <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

            <!-- END: Left Aside -->
            <div class="m-grid__item m-grid__item--fluid m-wrapper">

               <!-- BEGIN: Subheader -->
               @include('admin.layout.main_menu')
               @yield('page-title')
               <div class="container-fluid">
               @yield('page-content')
               </div>
               <!-- END: Subheader -->
            </div>

         </div>

          <!-- end:: Body -->
        <!-- begin::Footer -->
            <footer class="m-grid__item     m-footer ">
                <div class="m-container m-container--fluid m-container--full-height m-page__container">
                    <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                        <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
                            <span class="m-footer__copyright">

                                <a href="javascript:void(0)" class="m-link">{{__('site.hi5')}}</a> &copy; <?=date('Y')?>
                            </span>
                        </div>
                        <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
                            <ul class="m-footer__nav m-nav m-nav--inline m--pull-right">


                            </ul>
                        </div>

                    </div>
         </div>  </footer>

            <!-- end::Footer -->
        </div>

        <!-- end:: Page -->

        <div id="m_scroll_top" class="m-scroll-top">
            <i class="la la-arrow-up"></i>
        </div>

            <div id="load">
                <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>
            </div>


        <script src="/admin/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
        <script src="/admin/assets/demo/demo6/base/scripts.bundle.js" type="text/javascript"></script>
        <!--end::Base Scripts -->
        <!--begin::Page Vendors Scripts -->
        <script src="/admin/assets/vendors/custom/jquery-ui/jquery-ui.bundle.js" type="text/javascript"></script>
        <!--end::Page Vendors Scripts -->
        <!--begin::Page Snippets -->

        <script src="/admin/assets/demo/demo6/blockui.js" type="text/javascript"></script>

        <script src="/admin/assets/app/js/dashboard.js" type="text/javascript"></script>
         <script src="/admin/assets/app/js/bootstrap-datepicker.min.js?v=0.0.1" type="text/javascript"></script>
         <script type="text/javascript" src="/admin/assets/app/ckeditors/ckeditor.js"></script>
       <script src="/admin/assets/demo/demo6/select2.js" type="text/javascript"></script>
       <script src="/admin/assets/app/js/jquery.multi-select.js" type="text/javascript"></script>
       <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
       {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/js/fontawesome-iconpicker.min.js"></script> --}}
       <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
       <script type="text/javascript">
        $('#datepicker').datepicker({
            weekStart: 1,
            daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: true,
        });
        $('#datepicker').datepicker("setDate", new Date());
    </script>
       @yield('js')
        <!--Start of Tawk.to Script-->
<script type="text/javascript">

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
CKEDITOR.config.contentsLangDirection = window.dir;
$('.date-picker').datepicker({
            uiLibrary: 'bootstrap4',
            format: "yyyy-mm-dd",
            language:"ar",
            rtl:window.dir=='rtl'
        });
 $(document).ready(function() {
    $(".select2").select2({
      theme: "bootstrap4",
      placeholder: "اختر",
      autoclose: true
     });

//  $('#example1').datepicker({
//      format: "dd-mm-yyyy",
//         autoclose: true,
//         language:"ar",
//         rtl:window.rtl
//     });

//     //Alternativ way
//     $('#example2').datepicker({
//         format: "dd-mm-yyyy",
//         autoclose: true,
//         language:"ar",
//         rtl:window.rtl
//     }).on('change', function(){
//         $('.datepicker').hide();
//     });


           $('.select2').select2({
                theme: 'bootstrap4',
                //containerCssClass: ':الكل:',
                placeholder: "اختر",
                allowClear: true
            });
        });

        $("#load").hide();
        $('#loading').hide();
</script>
<!--End of Tawk.to Script-->

        <!--end::Page Snippets -->
    </body>

    <!-- end::Body -->
</html>

