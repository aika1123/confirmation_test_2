@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail">
    <div class="detail__heading">
        <h2>
            商品登録
        </h2>
    </div>
    <form class="detail__form">
        <div class="detail__form__group">
            <div class="detail__form__group-title">
                <span class="detail__form__label--item">
                    商品名
                </span>
                <span class="detail__form__label--required">
                    必須
                </span>
            </div>
            <div class="detail__form__group-content">
                <div class="detail__form__input--text">
                    <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name', $product->name ?? '')}}">
                </div>
            </div>
            <div class="register__form__error">
                @error('name')
                <p class="error-text">
                    {{ $message }}
                </p>
                @enderror
            </div>
        </div>
        <div class="detail__form__group">
            <div class="detail__form__group-title">
                <span class="detail__form__label--item">
                    値段
                </span>
                <span class="detail__form__label--required">
                    必須
                </span>
            </div>
            <div class="detail__form__group-content">
                <div class="detail__form__input--text">
                    <input type="text" name="price" placeholder="値段を入力" value="{{ old('price', $product->price ?? '')}}">
                </div>
            </div>
            <div class="register__form__error">
                @error('price')
                <p class="error-text">
                    {{ $message }}
                </p>
                @enderror
            </div>
        </div>
        <div class="detail__form__group">
            <div class="detail__form__group-title">
                <span class="detail__form__label--item">
                    商品画像
                </span>
                <span class="detail__form__label--required">
                    必須
                </span>
            </div>
            <div class="detail__form__group-content">
                <div class="detail__form__input--text">
                    <input type="file" name="image" placeholder="ファイルを選択" >
                </div>
                @if (isset($product->image))
                    <img src="{{ asset('storage/' . $product->image) }}" >
                @endif
            </div>
            <div class="register__form__error">
                @error('image')
                <p class="error-text">
                    {{ $message }}
                </p>
                @enderror
                </div>
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
                    <input type="checkbox" name="season[]" value=" {{$season->id}}" {{ is_array(old('season')) && in_array('$season->id', old('season', $product->seasons->pluck('id')->toArray())) ? 'checked' : ''}}>
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
        <div class="detail__form__group">
            <div class="detail__form__group-title">
                <span class="detail__form__label--item">
                    商品説明
                </span>
                <span class="detail__form__label--required">
                    必須
                </span>
            </div>
            <div class="detail__form__group-content">
                <div class="detail__form__input--textarea">
                    <textarea name="description" >{{ old('description', $product->description ?? '')}}</textarea>
                </div>
            </div>
            <div class="register__form__error">
                @error('description')
                <p class="error-text">
                    {{ $message }}
                </p>
                @enderror
            </div>
        </div>
        <div class="detail__form__button">
            <button class="form__button-back" type="button" onclick="location.href='{{ route('products.list')}}'">
                戻る
            </button>
            <button class="detail__form__button-submit" type="submit">
                変更保存
            </button>
        </div>
    </form>
</div>
@endsection