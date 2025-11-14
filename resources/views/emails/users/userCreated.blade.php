@extends('emails.layouts.email')

@section('content')
    <h1>Bem-vindo!</h1>
    
    <p>Olá, {{ $user->name ?? 'Usuário' }}!</p>
    
    <p>Sua conta foi criada com sucesso em nosso sistema.</p>
    
    <p>Você já pode acessar nossa plataforma utilizando suas credenciais.</p>
    
    <p>Atenciosamente,<br>
    Equipe {{ config('app.name') }}</p>
@endsection