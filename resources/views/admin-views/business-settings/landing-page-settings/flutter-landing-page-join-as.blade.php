@extends('layouts.admin.app')

@section('title',translate('messages.flutter_web_landing_page'))

@section('content')

<div class="content container-fluid">
    <div class="page-header pb-0">
        <div class="d-flex flex-wrap justify-content-between">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="{{ asset('assets/admin/img/flutter.png')}}" class="w--15" alt="">
                </span>
                <span>
                    {{ translate('messages.flutter_web_landing_page') }}
                </span>
            </h1>
            <div class="text--primary-2 py-1 d-flex flex-wrap align-items-center" type="button" data-toggle="modal" data-target="#how-it-works">
                <strong class="mr-2">{{translate('See_how_it_works!')}}</strong>
                <div>
                    <i class="tio-info-outined"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-4 mt-2">
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
            @include('admin-views.business-settings.landing-page-settings.top-menu-links.flutter-landing-page-links')
        </div>
    </div>
    @php($join_seller_title=\App\Models\DataSetting::withoutGlobalScope('translate')->where('type','flutter_landing_page')->where('key','join_seller_title')->first())
    @php($join_seller_sub_title=\App\Models\DataSetting::withoutGlobalScope('translate')->where('type','flutter_landing_page')->where('key','join_seller_sub_title')->first())
    @php($join_seller_button_name=\App\Models\DataSetting::withoutGlobalScope('translate')->where('type','flutter_landing_page')->where('key','join_seller_button_name')->first())
    @php($join_seller_button_url=\App\Models\DataSetting::withoutGlobalScope('translate')->where('type','flutter_landing_page')->where('key','join_seller_button_url')->first())
    @php($join_seller_button_url=$join_seller_button_url?$join_seller_button_url:[])
    @php($join_delivery_man_title=\App\Models\DataSetting::withoutGlobalScope('translate')->where('type','flutter_landing_page')->where('key','join_delivery_man_title')->first())
    @php($join_delivery_man_sub_title=\App\Models\DataSetting::withoutGlobalScope('translate')->where('type','flutter_landing_page')->where('key','join_delivery_man_sub_title')->first())
    @php($join_delivery_man_button_name=\App\Models\DataSetting::withoutGlobalScope('translate')->where('type','flutter_landing_page')->where('key','join_delivery_man_button_name')->first())
    @php($join_delivery_man_button_url=\App\Models\DataSetting::withoutGlobalScope('translate')->where('type','flutter_landing_page')->where('key','join_delivery_man_button_url')->first())
    @php($join_delivery_man_button_url=$join_delivery_man_button_url?$join_delivery_man_button_url:[])
    @php($language=\App\Models\BusinessSetting::where('key','language')->first())
    @php($language = $language->value ?? null)
    @php($defaultLang = str_replace('_', '-', app()->getLocale()))
    @if($language)
        <ul class="nav nav-tabs mb-4 border-0">
            <li class="nav-item">
                <a class="nav-link lang_link active"
                href="#"
                id="default-link">{{translate('messages.default')}}</a>
            </li>
            @foreach (json_decode($language) as $lang)
                <li class="nav-item">
                    <a class="nav-link lang_link"
                        href="#"
                        id="{{ $lang }}-link">{{ \App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')' }}</a>
                </li>
            @endforeach
        </ul>
    @endif
    <div class="tab-content">
        <div class="tab-pane fade show active">

            <form action="{{ route('admin.business-settings.flutter-landing-page-settings', 'join-seller') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h5 class="card-title mb-3 mt-3">
                    <span class="card-header-icon mr-2"><i class="tio-settings-outlined"></i></span> <span>{{translate('Join_as_a_Seller_Section')}}</span>
                </h5>
                <div class="card">
                    <div class="card-body">
                        @if ($language)
                            <div class="row g-3 lang_form default-form">
                                <div class="col-sm-6">
                                    <label for="join_seller_title" class="form-label">{{translate('Title')}} ({{ translate('messages.default') }})<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('Write_the_title_within_20_characters') }}">
                                                <img src="{{ asset('assets/admin/img/info-circle.svg')}}" alt="">
                                            </span></label>
                                    <input type="text"  id="join_seller_title" maxlength="20" name="join_seller_title[]" class="form-control" value="{{$join_seller_title?->getRawOriginal('value')??''}}" placeholder="{{translate('messages.title_here...')}}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="join_seller_sub_title" class="form-label">{{translate('Sub Title')}} ({{ translate('messages.default') }})<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('Write_the_title_within_60_characters') }}">
                                                <img src="{{ asset('assets/admin/img/info-circle.svg')}}" alt="">
                                            </span></label>
                                    <input id="join_seller_sub_title" type="text"  maxlength="60" name="join_seller_sub_title[]" class="form-control" value="{{$join_seller_sub_title?->getRawOriginal('value')??''}}" placeholder="{{translate('messages.sub_title_here...')}}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="join_seller_button_name" class="form-label">{{translate('Button Name')}} ({{ translate('messages.default') }})<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('Write_the_title_within_15_characters') }}">
                                                <img src="{{ asset('assets/admin/img/info-circle.svg')}}" alt="">
                                            </span></label>
                                    <input id="join_seller_button_name" type="text"  maxlength="15" name="join_seller_button_name[]" class="form-control" value="{{$join_seller_button_name?->getRawOriginal('value')??''}}" placeholder="{{translate('messages.button_name_here...')}}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="join_seller_button_url" class="form-label">{{translate('Button URL')}}<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('The_website_page_where_people_will_register_as_sellers.') }}">
                                                <img src="{{ asset('assets/admin/img/info-circle.svg')}}" alt="">
                                            </span></label>
                                    <input id="join_seller_button_url" type="url" name="join_seller_button_url" class="form-control" value="{{$join_seller_button_url['value']??''}}" placeholder="{{translate('Ex: https://www.apple.com/app-store/')}}">
                                </div>
                            </div>
                            <input type="hidden" name="lang[]" value="default">
                                @foreach(json_decode($language) as $lang)
                                <?php
                                if(isset($join_seller_title->translations)&&count($join_seller_title->translations)){
                                        $join_seller_title_translate = [];
                                        foreach($join_seller_title->translations as $t)
                                        {
                                            if($t->locale == $lang && $t->key=='join_seller_title'){
                                                $join_seller_title_translate[$lang]['value'] = $t->value;
                                            }
                                        }

                                    }
                                if(isset($join_seller_sub_title->translations)&&count($join_seller_sub_title->translations)){
                                        $join_seller_sub_title_translate = [];
                                        foreach($join_seller_sub_title->translations as $t)
                                        {
                                            if($t->locale == $lang && $t->key=='join_seller_sub_title'){
                                                $join_seller_sub_title_translate[$lang]['value'] = $t->value;
                                            }
                                        }

                                    }
                                if(isset($join_seller_button_name->translations)&&count($join_seller_button_name->translations)){
                                        $join_seller_button_name_translate = [];
                                        foreach($join_seller_button_name->translations as $t)
                                        {
                                            if($t->locale == $lang && $t->key=='join_seller_button_name'){
                                                $join_seller_button_name_translate[$lang]['value'] = $t->value;
                                            }
                                        }

                                    }
                                    ?>
                                    <div class="row g-3 d-none lang_form" id="{{$lang}}-form">
                                        <div class="col-sm-6">
                                            <label for="join_seller_title{{$lang}}" class="form-label">{{translate('Title')}} ({{strtoupper($lang)}})<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('Write_the_title_within_20_characters') }}">
                                                <img src="{{ asset('assets/admin/img/info-circle.svg')}}" alt="">
                                            </span></label>
                                    <input type="text"  id="join_seller_title{{$lang}}" maxlength="20" name="join_seller_title[]" class="form-control" value="{{ $join_seller_title_translate[$lang]['value']?? '' }}" placeholder="{{translate('messages.title_here...')}}">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="join_seller_sub_title{{$lang}}" class="form-label">{{translate('Sub Title')}} ({{strtoupper($lang)}})<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('Write_the_title_within_60_characters') }}">
                                                <img src="{{ asset('assets/admin/img/info-circle.svg')}}" alt="">
                                            </span></label>
                                    <input id="join_seller_sub_title{{$lang}}" type="text"  maxlength="60" name="join_seller_sub_title[]" class="form-control" value="{{ $join_seller_sub_title_translate[$lang]['value']?? '' }}" placeholder="{{translate('messages.sub_title_here...')}}">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="join_seller_button_name{{$lang}}" class="form-label">{{translate('Button Name')}} ({{strtoupper($lang)}})<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('Write_the_title_within_15_characters') }}">
                                                <img src="{{ asset('assets/admin/img/info-circle.svg')}}" alt="">
                                            </span></label>
                                    <input id="join_seller_button_name{{$lang}}" type="text"  maxlength="15" name="join_seller_button_name[]" class="form-control" value="{{ $join_seller_button_name_translate[$lang]['value']?? '' }}" placeholder="{{translate('messages.button_name_here...')}}">
                                        </div>
                                        <div class="col-sm-6">
                                            <label id="join_seller_button_url" class="form-label">{{translate('Button URL')}}<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('The_website_page_where_people_will_register_as_sellers.') }}">
                                                <img src="{{ asset('assets/admin/img/info-circle.svg')}}" alt="">
                                            </span></label>
                                    <input type="url"  id="join_seller_button_url" class="form-control" value="{{$join_seller_button_url['value']??''}}" placeholder="{{translate('Ex: https://www.apple.com/app-store/')}}" readonly>
                                        </div>
                                    </div>
                                    <input type="hidden" name="lang[]" value="{{$lang}}">
                                @endforeach
                            @else
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <label for="join_seller_title" class="form-label">{{translate('Title')}}<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('Write_the_title_within_20_characters') }}">
                                                <img src="{{ asset('assets/admin/img/info-circle.svg')}}" alt="">
                                            </span></label>
                                    <input type="text" id="join_seller_title"  maxlength="20" name="join_seller_title[]" class="form-control" placeholder="{{translate('messages.title_here...')}}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="join_seller_sub_title" class="form-label">{{translate('Sub Title')}}<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('Write_the_title_within_60_characters') }}">
                                                <img src="{{ asset('assets/admin/img/info-circle.svg')}}" alt="">
                                            </span></label>
                                    <input type="text" id="join_seller_sub_title" value="join_seller_sub_title" maxlength="60" name="join_seller_sub_title[]" class="form-control" placeholder="{{translate('messages.sub_title_here...')}}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="join_seller_button_name" class="form-label">{{translate('Button Name')}}<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('Write_the_title_within_15_characters') }}">
                                                <img src="{{ asset('assets/admin/img/info-circle.svg')}}" alt="">
                                            </span></label>
                                    <input id="join_seller_button_name" type="text"  maxlength="15" name="join_seller_button_name[]" class="form-control" placeholder="{{translate('messages.button_name_here...')}}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="url" class="form-label">{{translate('Button URL')}}<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('The_website_page_where_people_will_register_as_sellers.') }}">
                                                <img src="{{ asset('assets/admin/img/info-circle.svg')}}" alt="">
                                            </span></label>
                                    <input type="url" id="url" class="form-control" placeholder="{{translate('Ex: https://www.apple.com/app-store/')}}" readonly>
                                    </div>
                                </div>
                                <input type="hidden" name="lang[]" value="default">
                            @endif
                        <div class="btn--container justify-content-end mt-3">
                            <button type="reset" class="btn btn--reset">{{translate('Reset')}}</button>
                            <button type="submit"   class="btn btn--primary mb-2">{{translate('Save')}}</button>
                        </div>
                    </div>
                </div>
            </form>

            <form action="{{ route('admin.business-settings.flutter-landing-page-settings', 'join-delivery') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h5 class="card-title mb-3 mt-3">
                    <span class="card-header-icon mr-2"><i class="tio-settings-outlined"></i></span> <span>{{translate('Join_as_a_Deliveryman_Section')}}</span>
                </h5>
                <div class="card">
                    <div class="card-body">

                        @if ($language)
                            <div class="row g-3 lang_form default-form">
                                <div class="col-sm-6">
                                    <label for="join_delivery_man_title" class="form-label">{{translate('Title')}} ({{ translate('messages.default') }})<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('Write_the_title_within_20_characters') }}">
                                                <img src="{{ asset('assets/admin/img/info-circle.svg')}}" alt="">
                                            </span></label>
                                    <input type="text" id="join_delivery_man_title" maxlength="20" name="join_delivery_man_title[]" class="form-control" value="{{$join_delivery_man_title?->getRawOriginal('value')??''}}" placeholder="{{translate('messages.title_here...')}}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="join_delivery_man_sub_title" class="form-label">{{translate('Sub Title')}} ({{ translate('messages.default') }})<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('Write_the_title_within_60_characters') }}">
                                                <img src="{{ asset('assets/admin/img/info-circle.svg')}}" alt="">
                                            </span></label>
                                    <input id="join_delivery_man_sub_title" type="text"  maxlength="60" name="join_delivery_man_sub_title[]" class="form-control" value="{{$join_delivery_man_sub_title?->getRawOriginal('value')??''}}" placeholder="{{translate('messages.sub_title_here...')}}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="join_delivery_man_button_name" class="form-label">{{translate('Button Name')}} ({{ translate('messages.default') }})<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('Write_the_title_within_15_characters') }}">
                                                <img src="{{ asset('assets/admin/img/info-circle.svg')}}" alt="">
                                            </span></label>
                                    <input id="join_delivery_man_button_name" type="text"  maxlength="15" name="join_delivery_man_button_name[]" class="form-control" value="{{$join_delivery_man_button_name?->getRawOriginal('value')??''}}" placeholder="{{translate('messages.button_name_here...')}}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="join_delivery_man_button_url" class="form-label">{{translate('Button URL')}}<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('The_website_page_where_people_will_register_as_deliveryman.') }}">
                                                <img src="{{ asset('assets/admin/img/info-circle.svg')}}" alt="">
                                            </span></label>
                                    <input id="join_delivery_man_button_url" type="url" name="join_delivery_man_button_url" class="form-control" value="{{$join_delivery_man_button_url['value']??''}}" placeholder="{{translate('Ex: https://www.apple.com/app-store/')}}">
                                </div>
                            </div>
                            <input type="hidden" name="lang[]" value="default">
                                @foreach(json_decode($language) as $lang)
                                <?php
                                if(isset($join_delivery_man_title->translations)&&count($join_delivery_man_title->translations)){
                                        $join_delivery_man_title_translate = [];
                                        foreach($join_delivery_man_title->translations as $t)
                                        {
                                            if($t->locale == $lang && $t->key=='join_delivery_man_title'){
                                                $join_delivery_man_title_translate[$lang]['value'] = $t->value;
                                            }
                                        }

                                    }
                                if(isset($join_delivery_man_sub_title->translations)&&count($join_delivery_man_sub_title->translations)){
                                        $join_delivery_man_sub_title_translate = [];
                                        foreach($join_delivery_man_sub_title->translations as $t)
                                        {
                                            if($t->locale == $lang && $t->key=='join_delivery_man_sub_title'){
                                                $join_delivery_man_sub_title_translate[$lang]['value'] = $t->value;
                                            }
                                        }

                                    }
                                if(isset($join_delivery_man_button_name->translations)&&count($join_delivery_man_button_name->translations)){
                                        $join_delivery_man_button_name_translate = [];
                                        foreach($join_delivery_man_button_name->translations as $t)
                                        {
                                            if($t->locale == $lang && $t->key=='join_delivery_man_button_name'){
                                                $join_delivery_man_button_name_translate[$lang]['value'] = $t->value;
                                            }
                                        }

                                    }
                                    ?>
                                    <div class="row g-3 d-none lang_form" id="{{$lang}}-form1">
                                        <div class="col-sm-6">
                                            <label for="join_delivery_man_title{{$lang}}" class="form-label">{{translate('Title')}} ({{strtoupper($lang)}})<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('Write_the_title_within_20_characters') }}">
                                                <img src="{{ asset('assets/admin/img/info-circle.svg')}}" alt="">
                                            </span></label>
                                    <input type="text" id="join_delivery_man_title{{$lang}}" maxlength="20" name="join_delivery_man_title[]" class="form-control" value="{{ $join_delivery_man_title_translate[$lang]['value']?? '' }}" placeholder="{{translate('messages.title_here...')}}">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="join_delivery_man_sub_title{{$lang}}" class="form-label">{{translate('Sub Title')}} ({{strtoupper($lang)}})<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('Write_the_title_within_60_characters') }}">
                                                <img src="{{ asset('assets/admin/img/info-circle.svg')}}" alt="">
                                            </span></label>
                                    <input type="text" id="join_delivery_man_sub_title{{$lang}}" maxlength="60" name="join_delivery_man_sub_title[]" class="form-control" value="{{ $join_delivery_man_sub_title_translate[$lang]['value']?? '' }}" placeholder="{{translate('messages.sub_title_here...')}}">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="join_delivery_man_button_name{{$lang}}" class="form-label">{{translate('Button Name')}} ({{strtoupper($lang)}})<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('Write_the_title_within_15_characters') }}">
                                                <img src="{{ asset('assets/admin/img/info-circle.svg')}}" alt="">
                                            </span></label>
                                    <input type="text"  id="join_delivery_man_button_name{{$lang}}" maxlength="15" name="join_delivery_man_button_name[]" class="form-control" value="{{ $join_delivery_man_button_name_translate[$lang]['value']?? '' }}" placeholder="{{translate('messages.button_name_here...')}}">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="join_delivery_man_button_url" class="form-label">{{translate('Button URL')}}<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('The_website_page_where_people_will_register_as_deliveryman.') }}">
                                                <img src="{{ asset('assets/admin/img/info-circle.svg')}}" alt="">
                                            </span></label>
                                    <input type="url" id="join_delivery_man_button_url" class="form-control" value="{{$join_delivery_man_button_url['value']??''}}" placeholder="{{translate('Ex: https://www.apple.com/app-store/')}}" readonly>
                                        </div>
                                    </div>
                                    <input type="hidden" name="lang[]" value="{{$lang}}">
                                @endforeach
                            @else
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <label for="join_delivery_man_title" class="form-label">{{translate('Title')}}<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('Write_the_title_within_20_characters') }}">
                                                <img src="{{ asset('assets/admin/img/info-circle.svg')}}" alt="">
                                            </span></label>
                                    <input id="join_delivery_man_title" type="text"  maxlength="20" name="join_delivery_man_title[]" class="form-control" placeholder="{{translate('messages.title_here...')}}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="join_delivery_man_sub_title" class="form-label">{{translate('Sub Title')}}<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('Write_the_title_within_60_characters') }}">
                                                <img src="{{ asset('assets/admin/img/info-circle.svg')}}" alt="">
                                            </span></label>
                                    <input id="join_delivery_man_sub_title" type="text"  maxlength="60" name="join_delivery_man_sub_title[]" class="form-control" placeholder="{{translate('messages.sub_title_here...')}}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="join_delivery_man_button_name" class="form-label">{{translate('Button Name')}}<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('Write_the_title_within_15_characters') }}">
                                                <img src="{{ asset('assets/admin/img/info-circle.svg')}}" alt="">
                                            </span></label>
                                    <input id="join_delivery_man_button_name" type="text"  maxlength="15" name="join_delivery_man_button_name[]" class="form-control" placeholder="{{translate('messages.button_name_here...')}}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="url" class="form-label">{{translate('Button URL')}}<span class="form-label-secondary" data-toggle="tooltip" data-placement="right" data-original-title="{{ translate('The_website_page_where_people_will_register_as_deliveryman.') }}">
                                                <img src="{{ asset('assets/admin/img/info-circle.svg')}}" alt="">
                                            </span></label>
                                    <input id="url" type="url" class="form-control" placeholder="{{translate('Ex: https://www.apple.com/app-store/')}}" readonly>
                                    </div>
                                </div>
                                <input type="hidden" name="lang[]" value="default">
                            @endif
                        <div class="btn--container justify-content-end mt-3">
                            <button type="reset" class="btn btn--reset">{{translate('Reset')}}</button>
                            <button type="submit"   class="btn btn--primary mb-2">{{translate('Save')}}</button>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>

    <!-- How it Works -->
    @include('admin-views.business-settings.landing-page-settings.partial.how-it-work-flutter')
</div>

@endsection

