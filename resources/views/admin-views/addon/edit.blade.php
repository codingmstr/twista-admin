@extends('layouts.admin.app')

@section('title',translate('update'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="{{ asset('assets/admin/img/edit.png')}}" class="w--20" alt="">
                </span>
                <span>
                    {{translate('messages.addon_update')}}
                </span>
            </h1>
        </div>
        <!-- End Page Header -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.addon.update',[$addon['id']])}}" method="post">
                    @csrf
                    @if($language)
                        <ul class="nav nav-tabs mb-4">
                            <li class="nav-item">
                                <a class="nav-link lang_link active"
                                   href="#"
                                   id="default-link">{{translate('messages.default')}}</a>
                            </li>
                            @foreach ($language as $lang)
                                <li class="nav-item">
                                    <a class="nav-link lang_link"
                                       href="#"
                                       id="{{ $lang }}-link">{{ \App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')' }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            @if ($language)
                                <div class="form-group lang_form" id="default-form">
                                    <label class="input-label"
                                           for="exampleFormControlInput1">{{translate('messages.name')}}
                                        ({{translate('messages.default')}})</label>
                                    <input type="text" name="name[]" class="form-control"
                                           placeholder="{{translate('messages.new_addon')}}" maxlength="191"
                                           value="{{$addon?->getRawOriginal('name')}}">
                                </div>
                                <input type="hidden" name="lang[]" value="default">
                                @foreach($language as $lang)
                                        <?php
                                        if (count($addon['translations'])) {
                                            $translate = [];
                                            foreach ($addon['translations'] as $t) {
                                                if ($t->locale == $lang && $t->key == "name") {
                                                    $translate[$lang]['name'] = $t->value;
                                                }
                                            }
                                        }
                                        ?>
                                    <div class="form-group d-none lang_form" id="{{$lang}}-form">
                                        <label class="input-label"
                                               for="exampleFormControlInput1">{{translate('messages.name')}}
                                            ({{strtoupper($lang)}})</label>
                                        <input type="text" name="name[]" class="form-control"
                                               placeholder="{{translate('messages.new_addon')}}" maxlength="191"
                                               value="{{$translate[$lang]['name']??''}}">
                                    </div>
                                    <input type="hidden" name="lang[]" value="{{$lang}}">
                                @endforeach
                            @else
                                <div class="form-group">
                                    <label class="input-label"
                                           for="exampleFormControlInput1">{{translate('messages.name')}}</label>
                                    <input type="text" name="name" class="form-control"
                                           placeholder="{{translate('messages.new_addon')}}"
                                           value="{{ $addon['name'] }}" maxlength="191">
                                </div>
                                <input type="hidden" name="lang[]" value="default">
                            @endif
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group">
                                <label class="input-label"
                                       for="exampleFormControlSelect1">{{translate('messages.store')}}<span
                                        class="input-label-secondary"></span></label>
                                <select name="store_id" id="store_id" class="form-control  js-data-example-ajax"
                                        data-placeholder="{{translate('messages.select_store')}}" required
                                        oninvalid="this.setCustomValidity('{{translate('messages.please_select_store')}}')">
                                    @if($addon->store)
                                        <option value="{{$addon->store_id}}"
                                                selected="selected">{{$addon->store->name}}</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group">
                                <label class="input-label"
                                       for="exampleFormControlInput1">{{translate('messages.price')}}</label>
                                <input type="number" min="0" max="999999999999.99" step="0.01" name="price"
                                       value="{{$addon['price']}}" class="form-control" placeholder="200" required>
                            </div>
                        </div>
                    </div>
                    <div class="btn--container justify-content-end">
                        <button type="reset" id="reset_btn"
                                class="btn btn--reset">{{translate('messages.reset')}}</button>
                        <button type="submit" class="btn btn--primary">{{translate('messages.update')}}</button>
                    </div>
                </form>
            </div>
            <!-- End Table -->
        </div>
    </div>

@endsection

@push('script_2')
    <script src="{{ asset('assets/admin')}}/js/view-pages/addon-index.js"></script>
    <script>
        "use strict";

        $('.js-data-example-ajax').select2({
            ajax: {
                url: '{{url('/')}}/admin/store/get-stores',
                data: function (params) {
                    return {
                        q: params.term, // search term
                        module_type: 'food',
                        module_id: {{Config::get('module.current_module_id')}},
                        page: params.page
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                __port: function (params, success, failure) {
                    var $request = $.ajax(params);

                    $request.then(success);
                    $request.fail(failure);

                    return $request;
                }
            }
        });

        $('#reset_btn').click(function () {
            $('#store_id').val("{{$addon->store_id}}").trigger('change');
        })
    </script>
@endpush
