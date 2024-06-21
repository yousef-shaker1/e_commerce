<x-mail::message>
# تأكيد الطلب

تم عمل اوردر لمنتج : {{ $productName }} سيتم وصولة في يوم :{{ $date }} في العنوان التالي : {{ $address }}

<x-mail::button :url="''">
رؤية التفاصيل
</x-mail::button>

شكراً لك,<br>
{{ config('app.name') }}
</x-mail::message>