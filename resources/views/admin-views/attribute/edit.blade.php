@extends('layouts.admin.app')

@section('title',translate('messages.Update Attribute'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="{{ asset('assets/admin/img/edit.png')}}" class="w--26" alt="">
                </span>
                <span>
                    {{translate('messages.attribute_update')}}
                </span>
            </h1>
        </div>
        <!-- End Page Header -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.attribute.update',[$attribute['id']])}}" method="post">
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
                            <div class="lang_form" id="default-form">
                                <div class="form-group">
                                    <label class="input-label" for="default_title">{{translate('messages.name')}} ({{translate('messages.default')}})
                                        <span class="form-label-secondary text-danger"
                                        data-toggle="tooltip" data-placement="right"
                                        data-original-title="{{ translate('messages.Required.')}}"> *
                                        </span>
                                    </label>
                                    <input type="text" name="name[]" id="default_title" class="form-control" placeholder="{{translate('messages.updated_attribute')}}" value="{{$attribute?->getRawOriginal('name')}}">
                                </div>
                                <input type="hidden" name="lang[]" value="default">
                            </div>
                            @foreach($language as $lang)
                                <?php
                                    if(count($attribute['translations'])){
                                        $translate = [];
                                        foreach($attribute['translations'] as $t)
                                        {
                                            if($t->locale == $lang && $t->key=="name"){
                                                $translate[$lang]['name'] = $t->value;
                                            }
                                        }
                                    }
                                ?>
                                <div class="d-none lang_form" id="{{$lang}}-form">
                                    <div class="form-group">
                                        <label class="input-label" for="{{$lang}}_title">{{translate('messages.name')}} ({{strtoupper($lang)}})</label>
                                        <input type="text" name="name[]" id="{{$lang}}_title" class="form-control" placeholder="{{translate('messages.updated_attribute')}}" value="{{$translate[$lang]['name']??''}}">
                                    </div>
                                    <input type="hidden" name="lang[]" value="{{$lang}}">
                                </div>
                            @endforeach
                        @else
                        <div id="default-form">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('messages.name')}} ({{ translate('messages.default') }})</label>
                                <input type="text" name="name[]" class="form-control" placeholder="{{translate('messages.updated_attribute')}}" value="{{$attribute['name']}}" maxlength="100">
                            </div>
                            <input type="hidden" name="lang[]" value="default">
                        </div>
                        @endif
                    <div class="btn--container justify-content-end">
                        <button type="reset" class="btn btn--reset">{{translate('messages.reset')}}</button>
                        <button type="submit" class="btn btn--primary">{{translate('messages.update')}}</button>
                    </div>
                </form>
            </div>
            <!-- End Table -->
        </div>
    </div>

@endsection

@push('script_2')
<script>
    "use strict";

    $(".lang_link").click(function(e){
        e.preventDefault();
        $(".lang_link").removeClass('active');
        $(".lang_form").addClass('d-none');
        $(this).addClass('active');

        let form_id = this.id;
        let lang = form_id.substring(0, form_id.length - 5);
        console.log(lang);
        $("#"+lang+"-form").removeClass('d-none');
    })
</script>
@endpush
