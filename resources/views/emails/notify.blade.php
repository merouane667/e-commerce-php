@component('mail::message')
# OUT OF STOCK notification from Larashop

some products in the inventory are out of stock.

check the admin panel for more information about the concerned products.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
