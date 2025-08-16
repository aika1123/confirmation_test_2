@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register">
    <div class="register__heading">
        <h2>
            商品登録
        </h2>
    </div>
    <form class="register__form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="register__form__group">
            <div class="register__form__group-title">
                <span class="register__form__label--item">
                    商品名
                </span>
                <span class="register__form__label--required">
                    必須
                </span>
            </div>
            <div class="register__form__group-content">
                <div class="register__form__input--text">
                    <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name')}}">
                </div>
                <div class="register__form__error">
                    @error('name')
                    <p class="error-text">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="register__form__group">
            <div class="register__form__group-title">
                <span class="register__form__label--item">
                    値段
                </span>
                <span class="register__form__label--required">
                    必須
                </span>
            </div>
            <div class="register__form__group-content">
                <div class="register__form__input--text">
                    <input type="text" name="price" placeholder="値段を入力" value="{{ old('price')}}">
                </div>
                <div class="register__form__error">
                    @error('price')
                    <p class="error-text">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="register__form__group">
            <div class="register__form__group-title">
                <span class="register__form__label--item">
                    商品画像
                </span>
                <span class="register__form__label--required">
                    必須
                </span>
            </div>
            <div class="register__form__group-content">
                <div class="register__form__input--text">
                    <input type="file" name="image"  placeholder="ファイルを選択" value="{{ old('image')}}" onchange="previewImage(event)">
                </div>
                <div class="register__form__preview" id="image-preview">
                    <img src="{{ old('image')}}" id="preview">
                </div>
                <div class="register__form__error">
                    @error('image')
                    <p class="error-text">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <script>
                    function previewImage(event){
                        const preview = document.getElementById('preview');
                        const file = event.target.files[0];

                        if(file) {
                            preview.src = URL.createObjectURL(file);
                        }
                    }
                </script>
        </div>
        <div class="register__form__group">
            <div class="register__form__group-title">
                <span class="register__form__label--item">
                    季節
                </span>
                <span class="register__form__label--required">
                    必須
                </span>
            </div>
            <div class="register__form__group-content">
                <div class="register__form__input--season">
                @foreach ($seasons as $season)
                    <input type="checkbox" name="season[]" value=" {{$season->id}}" {{ is_array(old('season')) && in_array('$season->id', old('season')) ? 'checked' : ''}}>
                    {{$season->name}}
                @endforeach
                </div>
                <div class="register__form__error">
                    @error('season')
                    <p class="error-text">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="register__form__group">
            <div class="register__form__group-title">
                <span class="register__form__label--item">
                    商品説明
                </span>
                <span class="register__form__label--required">
                    必須
                </span>
            </div>
            <div class="register__form__group-content">
                <div class="register__form__input--textarea">
                    <textarea name="description">{{ old('description')}}</textarea>
                </div>
                <div class="register__form__error">
                    @error('description')
                    <p class="error-text">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="register__form__button-back" type="button" onclick="location.href='{{ route('products.list')}}'">
                戻る
            </button>
            <button class="register__form__button-submit" type="submit">
                登録
            </button>
        </div>
    </form>
</div>
@endsection