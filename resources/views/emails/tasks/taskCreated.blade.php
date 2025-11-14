@extends('emails.layouts.email')

@section('content')
<h2>Nova Tarefa Criada</h2>

<p>Olá,</p>

<p>Uma nova tarefa foi criada:</p>

<table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
    <tr>
        <td style="padding: 10px; background-color: #f5f5f5; font-weight: bold; width: 30%;">Título:</td>
        <td style="padding: 10px;">{{ $task->title }}</td>
    </tr>
    <tr>
        <td style="padding: 10px; background-color: #f5f5f5; font-weight: bold;">Descrição:</td>
        <td style="padding: 10px;">{{ $task->description }}</td>
    </tr>
    <tr>
        <td style="padding: 10px; background-color: #f5f5f5; font-weight: bold;">Prazo:</td>
        <td style="padding: 10px;">{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') : 'Não definido' }}</td>
    </tr>
</table>

<p style="margin-top: 30px;">Atenciosamente,<br>Equipe</p>
@endsection