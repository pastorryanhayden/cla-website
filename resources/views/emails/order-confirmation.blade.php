@component('mail::message')
### Christian Law Association
# Order Confirmation
Order Number: {{$order->id}}

Hi {{$order->customer->name}},
Thank you so much for ordering books from us. We know you are excited about getting your books. We'll send you an email as soon as they are shipped.

For your records, here is a confirmation of what you ordered:

## Shipping Address
{{$order->customer->name}} <br>
{{$order->customer->email}} <br>
{{$order->customer->address1}}<br>
@if($order->customer->address2)
{{$order->customer->address2}}<br>
@endif
{{$order->customer->city}}, {{$order->customer->state}} {{$order->customer->zip}}

## Items
<table style="width:100%; margin-bottom: 32px;">
    <tr>
        <th style="width:25%; vertical-align: top; text-align: left; border-bottom: 1px solid #ddd; padding: 8px;">Item</th>
        <th style="width:25%; vertical-align: top; text-align: left; border-bottom: 1px solid #ddd; padding: 8px;">Author</th>
        <th style="width:25%; vertical-align: top; text-align: left; border-bottom: 1px solid #ddd; padding: 8px;">Quantity</th>
        <th style="width:25%; vertical-align: top; text-align: left; border-bottom: 1px solid #ddd; padding: 8px;">Price</th>

    </tr>
    @foreach($order->items as $item)
    <tr>
        <td style="width:25%; vertical-align: top; text-align: left; border-bottom: 1px solid #ddd; padding: 8px;">{{$item->title}}</td>
        <td style="width:25%; vertical-align: top; text-align: left; border-bottom: 1px solid #ddd; padding: 8px;">{{$item->author}}</td>
        <td style="width:25%; vertical-align: top; text-align: center; border-bottom: 1px solid #ddd; padding: 8px;">{{$item->quantity}}</td>
        <td style="width:25%; vertical-align: top; text-align: left; border-bottom: 1px solid #ddd; padding: 8px;">${{$item->cost}}</td>
    </tr>
    @endforeach
    <tr>
        <td style="width:25%; vertical-align: top; text-align: left; padding: 8px;"></td>
        <td style="width:25%; vertical-align: top; text-align: left; padding: 8px;"></td>
        <td style="width:25%; vertical-align: top; text-align: right; padding: 8px;">Total</td>
        <td style="width:25%; vertical-align: top; text-align: left; padding: 8px;">${{$order->items->sum('cost')}}</td>
    </tr>
</table>



Thanks,<br>
Christian Law Association
@endcomponent