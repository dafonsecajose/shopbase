@component('mail::message')


@switch($option['option'])
@case(1)
<img src="{{asset('assets/img/check/registrado.png')}}">
<h1>O pedido "{{$option['order']->reference}}" registrado com sucesso</h1>
@component('mail::table')
| Nome | Quantidade | Valor Uni.| Subtotal |
| :-----: | :-----: | :-----: | :-----: |
@php $total = 0;  @endphp
@foreach($option['order']->itens as $item)
| {{$item->product->name}} | {{$item->amount}} | {{$item->price}} | {{number_format($item->amount * $item->price,2, ',', '.')}} |
@php $total += ($item->amount * $item->price); @endphp
@endforeach
||| **Total:** | {{number_format($total, 2, ',', '.')}} |
@endcomponent
@break
@case(3)
<img src="{{asset('assets/img/check/pago.png')}}">
@component('mail::table')
| Nome | Quantidade | Valor Uni.| Subtotal |
| :-----: | :-----: | :-----: | :-----: |
@php $total = 0;  @endphp
@foreach($option['order']->itens as $item)
| {{$item->product->name}} | {{$item->amount}} | {{$item->price}} | {{number_format($item->amount * $item->price,2, ',', '.')}} |
@php $total += ($item->amount * $item->price); @endphp
@endforeach
||| **Total:** | {{number_format($total, 2, ',', '.')}} |
@endcomponent
@break
@endswitch
@endcomponent
