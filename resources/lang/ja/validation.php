<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attributeは受け入れられる必要があります。',
    'active_url' => ':attributeは有効なURLではありません。',
    'after' => ':attributeは:date以降の日付である必要があります。',
    'after_or_equal' => ':attributeは:date以降の日付である必要があります。',
    'alpha' => ':attributeは文字のみを含むことができます。',
    'alpha_dash' => ':attributeは文字、数字、ダッシュ、アンダースコアのみを含むことができます。',
    'alpha_num' => ':attributeは文字と数字のみを含むことができます。',
    'array' => ':attributeは配列である必要があります。',
    'before' => ':attributeは:dateより前の日付である必要があります。',
    'before_or_equal' => ':attributeは:dateより前の日付である必要があります。',
    'between' => [
        'numeric' => ':attributeは:minから:maxの間である必要があります。',
        'file' => ':attributeは:minから:maxキロバイト間である必要があります。',
        'string' => ':attributeは:minから:max文字の間である必要があります。',
        'array' => ':attributeは:minから:maxアイテム間である必要があります。',
    ],
    'boolean' => ':attributeフィールドはtrueまたはfalseである必要があります。',
    'confirmed' => ':attributeの確認が一致しません。',
    'date' => ':attributeは有効な日付ではありません。',
    'date_equals' => ':attributeは:dateと等しい日付である必要があります。',
    'date_format' => ':attributeは:format形式と一致しません。',
    'different' => ':attributeと:otherは異なる必要があります。',
    'digits' => ':attributeは:digits桁である必要があります。',
    'digits_between' => ':attributeは:minから:max桁の間である必要があります。',
    'dimensions' => ':attributeは無効な画像寸法です。',
    'distinct' => ':attributeフィールドに重複する値があります。',
    'email' => ':attributeは有効なメールアドレスである必要があります。',
    'ends_with' => ':attributeは以下の値のいずれかで終わる必要があります：:values',
    'exists' => '選択された:attributeは無効です。',
    'file' => ':attributeはファイルである必要があります。',
    'filled' => ':attributeフィールドは値を持つ必要があります。',
    'gt' => [
        'numeric' => ':attributeは:valueより大きい必要があります。',
        'file' => ':attributeは:valueキロバイトより大きい必要があります。',
        'string' => ':attributeは:value文字より大きい必要があります。',
        'array' => ':attributeは:valueより多くのアイテムを持つ必要があります。',
    ],
    'gte' => [
        'numeric' => ':attributeは:value以上である必要があります。',
        'file' => ':attributeは:valueキロバイト以上である必要があります。',
        'string' => ':attributeは:value文字以上である必要があります。',
        'array' => ':attributeは:valueアイテム以上を持つ必要があります。',
    ],
    'image' => ':attributeは画像である必要があります。',
    'in' => '選択された:attributeは無効です。',
    'in_array' => ':attributeフィールドは:otherに存在しません。',
    'integer' => ':attributeは整数である必要があります。',
    'ip' => ':attributeは有効なIPアドレスである必要があります。',
    'ipv4' => ':attributeは有効なIPv4アドレスである必要があります。',
    'ipv6' => ':attributeは有効なIPv6アドレスである必要があります。',
    'json' => ':attributeは有効なJSON文字列である必要があります。',
    'lt' => [
        'numeric' => ':attributeは:valueより小さい必要があります。',
        'file' => ':attributeは:valueキロバイトより小さい必要があります。',
        'string' => ':attributeは:value文字より小さい必要があります。',
        'array' => ':attributeは:valueより少ないアイテムを持つ必要があります。',
    ],
    'lte' => [
        'numeric' => ':attributeは:value以下である必要があります。',
        'file' => ':attributeは:valueキロバイト以下である必要があります。',
        'string' => ':attributeは:value文字以下である必要があります。',
        'array' => ':attributeは:valueを超えるアイテムを持つ必要があります。',
    ],
    'max' => [
        'numeric' => ':attributeは:maxを超えない可能性があります。',
        'file' => ':attributeは:maxキロバイト以下である必要があります。',
        'string' => ':attributeは:max文字以下である必要があります。',
        'array' => ':attributeは:maxを超えるアイテムを持つ必要があります。',
    ],
    'mimes' => ':attributeは:valuesの形式のファイルである必要があります。',
    'mimetypes' => ':attributeは:valuesの形式のファイルである必要があります。',
    'min' => [
        'numeric' => ':attributeは最低:minである必要があります。',
        'file' => ':attributeは最低:minキロバイトである必要があります。',
        'string' => ':attributeは最低:min文字である必要があります。',
        'array' => ':attributeは最低:minアイテムを持つ必要があります。',
    ],
    'not_in' => '選択された:attributeは無効です。',
    'not_regex' => ':attributeの形式は無効です。',
    'numeric' => ':attributeは数値である必要があります。',
    'password' => 'パスワードが正しくありません。',
    'present' => ':attributeフィールドは存在する必要があります。',
    'regex' => ':attributeの形式は無効です。',
    'required' => ':attributeは必須です。',
    'required_if' => ':otherが:valueの場合、:attributeフィールドは必須です。',
    'required_unless' => ':otherが:valuesにない限り、:attributeフィールドは必須です。',
    'required_with' => ':valuesが存在する場合、:attributeフィールドは必須です。',
    'required_with_all' => ':valuesが存在する場合、:attributeフィールドは必須です。',
    'required_without' => ':valuesが存在しない場合、:attributeフィールドは必須です。',
    'required_without_all' => ':valuesのいずれも存在しない場合、:attributeフィールドは必須です。',
    'same' => ':attributeと:otherは一致する必要があります。',
    'size' => [
        'numeric' => ':attributeは:sizeである必要があります。',
        'file' => ':attributeは:sizeキロバイトである必要があります。',
        'string' => ':attributeは:size文字である必要があります。',
        'array' => ':attributeは:sizeアイテムを含む必要があります。',
    ],
    'starts_with' => ':attributeは以下のいずれかで始まる必要があります：:values',
    'string' => ':attributeは文字列である必要があります。',
    'timezone' => ':attributeは有効なゾーンである必要があります。',
    'unique' => ':attributeはすでに使用されています。',
    'uploaded' => ':attributeのアップロードに失敗しました。',
    'url' => ':attributeの形式は無効です。',
    'uuid' => ':attributeは有効なUUIDである必要があります。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'email' => 'アドレスメール',
        'name' => '名前',
        'address1' => '住所',
        'first_name' => '名',
        'last_name' => '姓',
        'phone' => '電話',
        'current_password' => '現在のパスワード',
        'new_password' => '新しいパスワード',
        'new_confirm_password' => 'パスワード確認',
    ],

];
