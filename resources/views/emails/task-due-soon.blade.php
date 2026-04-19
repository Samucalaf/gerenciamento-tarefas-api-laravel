@component('mail::message')
# Sua tarefa vence {{ ceil($daysLeft) <= 0 ? 'hoje' : 'em ' . ceil($daysLeft) . ' dia(s)' }}!

**{{ $task->title }}**

{{ $task->description }}

Prazo: **{{ $task->due_date->format('d/m/Y') }}**

@component('mail::button', ['url' => '/tasks/' . $task->id])
Ver tarefa
@endcomponent
@endcomponent