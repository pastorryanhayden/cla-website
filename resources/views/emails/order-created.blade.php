@component('mail::message')
# You have a new book order (id: {{$order->id}})

A new order has been placed. Here are the details:

## Customer
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
        <th style="width:50%; vertical-align: top; text-align: left; border-bottom: 1px solid #ddd; padding: 8px;">Author</th>
        <th style="width:25%; vertical-align: top; text-align: left; border-bottom: 1px solid #ddd; padding: 8px;">Quantity</th>
    </tr>
    @foreach($order->items as $item)
    <tr>
        <td style="width:25%; vertical-align: top; text-align: left; border-bottom: 1px solid #ddd; padding: 8px;">{{$item->title}}</td>
        <td style="width:50%; vertical-align: top; text-align: left; border-bottom: 1px solid #ddd; padding: 8px;">{{$item->author}}</td>
        <td style="width:25%; vertical-align: top; text-align: left; border-bottom: 1px solid #ddd; padding: 8px;">{{$item->quantity}}</td>
    </tr>
    @endforeach
</table>

After you've shipped the order, please go back to this email and click the button below to let the customer know that the order has been shipped.`

@component('mail::button', ['url' => 'https://cla-charge.test/complete/' . $order->id ])
Mark Order Complete
@endcomponent


@endcomponent