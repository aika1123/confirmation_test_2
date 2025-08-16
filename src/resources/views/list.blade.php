@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/list.css') }}">
@endsection


@section('content')
<div class="list">
    <div class="list_heading">
        <h2>商品一覧</h2>
        <button class="list__button-submit" type="button" onclick="location.href='{{ route('products.create')}}'">
            ＋商品を追加
        </button>
    </div>
    <form  class="list__form" action="{{route('products.list') }}" method="GET">
    @csrf
        <div class="list__form-search">
            <div class="list__form-search__inner">
                <input type="text" name="search" placeholder="商品名で検索" value="{{ request('search') }}">
            </div>
            <div class="list__form-search__button">
                <button class="list__form-search__button-submit">
                    検索
                </button>
            </div>
        </div>
        <div class="list__form-search">
            <div class="list__form-search__title">
                <span class="list__form__label--item">
                    価格順で表示
                </span>
            </div>
            <div class="list__form-search__inner">
                <select  class="list__form-search__select" name="sort">
                    <option value="">価格で並び替え</option>
                    <option value="high" {{ request('sort') == 'high' ? 'selected' : '' }}>
                        高い順で表示
                    </option>
                    <option value="low" {{ request('sort') == 'low' ? 'selected' : '' }}>
                        低い順で表示
                    </option>
                </select>
            </div>
            @if(request('sort'))
                <div class="sort-tag">
                    <span>
                        {{ $request('sort') === 'high' ? '高い順で表示' : '低い順で表示' }}
                    </span>
                    <a href="{{ route('product.list', array_filter(request()->except('sort'))) }}">×</a>
                </div>
            @endif
        </div>
    </form>
    @foreach ($products as $product)
    <a href="{{ route('products.show', $product->id)}}" class="list__card-link">
        <div class="list__card">
        <div class="list__card-image">
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image)}}" >
            @endif
        </div>
        <div class="list__card-content">
            <p class="list__card-name">
                {{$product->name}}
            </p>
            <p class="list__card-price">
                ￥{{number_format($product->price)}}
            </p>
        </div>
    </div>
    </a>
    @endforeach
    <div class="pagination">
        {{ $products->links() }}
    </div>
</div>
@endsection
