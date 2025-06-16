<x-mail::message>


<x-mail::panel>
@if ($data['application_status'] === 3)
Application for death repartiation  with application number {{ $data['application_no'] }} has been rejected on {{ $data['date'] }}.
@elseif ($data['application_status'] === 2)
Application for death repartiation with  application number {{ $data['application_no'] }} has been approved on {{ $data['date'] }}.

@endif

</x-mail::panel>



Regards,<br>
NORKA Roots Team
</x-mail::message>
