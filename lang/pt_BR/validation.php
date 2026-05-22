<?php

return [

    'required' => 'O campo :attribute é obrigatório.',
    'string' => 'O campo :attribute deve ser um texto.',
    'integer' => 'O campo :attribute deve ser um número inteiro.',
    'numeric' => 'O campo :attribute deve ser um número.',
    'boolean' => 'O campo :attribute deve ser verdadeiro ou falso.',
    'array' => 'O campo :attribute deve ser uma lista.',
    'email' => 'O campo :attribute deve ser um endereço de e-mail válido.',
    'confirmed' => 'A confirmação do campo :attribute não confere.',
    'unique' => 'O valor informado para :attribute já está em uso.',
    'exists' => 'O valor selecionado em :attribute é inválido.',
    'image' => 'O campo :attribute deve ser uma imagem.',
    'mimes' => 'O arquivo :attribute deve ser do tipo: :values.',
    'file' => 'O campo :attribute deve ser um arquivo.',
    'in' => 'O valor selecionado para :attribute é inválido.',
    'date' => 'O campo :attribute deve ser uma data válida.',
    'before' => 'O campo :attribute deve ser uma data anterior a :date.',
    'after' => 'O campo :attribute deve ser uma data posterior a :date.',
    'same' => 'O campo :attribute deve ser igual a :other.',
    'different' => 'O campo :attribute deve ser diferente de :other.',
    'accepted' => 'O campo :attribute deve ser aceito.',

    'min' => [
        'string' => 'O campo :attribute deve ter pelo menos :min caracteres.',
        'numeric' => 'O campo :attribute deve ser no mínimo :min.',
        'file' => 'O arquivo :attribute deve ter no mínimo :min kilobytes.',
        'array' => 'O campo :attribute deve ter pelo menos :min itens.',
    ],

    'max' => [
        'string' => 'O campo :attribute não pode ter mais que :max caracteres.',
        'numeric' => 'O campo :attribute não pode ser maior que :max.',
        'file' => 'O arquivo :attribute não pode ter mais que :max kilobytes.',
        'array' => 'O campo :attribute não pode ter mais que :max itens.',
    ],

    'between' => [
        'string' => 'O campo :attribute deve ter entre :min e :max caracteres.',
        'numeric' => 'O campo :attribute deve estar entre :min e :max.',
        'file' => 'O arquivo :attribute deve ter entre :min e :max kilobytes.',
        'array' => 'O campo :attribute deve ter entre :min e :max itens.',
    ],

    'attributes' => [
        'name' => 'nome',
        'email' => 'e-mail',
        'password' => 'senha',
        'password_confirmation' => 'confirmação de senha',

        'title' => 'título',
        'description' => 'descrição',
        'category_id' => 'categoria',
        'category' => 'categoria',
        'priority' => 'prioridade',
        'status' => 'status',
        'assigned_to' => 'responsável',
        'comment' => 'comentário',
        'attachment' => 'anexo',
        'active' => 'ativo',
    ],

];