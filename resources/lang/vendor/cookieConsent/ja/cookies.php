<?php
return [
    'title' => 'Cookieの使用について',
    'intro' => '当サイトでは、より快適にご利用いただくためにCookieを使用しています。',
    'link' => '詳しくは<a href=":url">Cookieポリシー</a>をご確認ください。',

    'essentials' => '必須のみ許可',
    'all' => 'すべて許可',
    'customize' => '設定を変更',
    'manage' => 'Cookieの設定',
    'details' => [
        'more' => '詳細を表示',
        'less' => '詳細を閉じる',
    ],
    'save' => '設定を保存',
    'cookie' => 'Cookie',
    'purpose' => '目的',
    'duration' => '保存期間',
    'year' => '年',
    'day' => '日',
    'hour' => '時間',
    'minute' => '分',

    'categories' => [
        'essentials' => [
            'title' => '必須Cookie',
            'description' => '一部のページを正しく表示するために必要なCookieです。そのため、同意は不要です。',
        ],
        'analytics' => [
            'title' => '分析Cookie',
            'description' => 'サービス改善のための社内調査に使用します。当サイトがどのように利用されているかを把握するためのCookieです。',
        ],
        'optional' => [
            'title' => '任意Cookie',
            'description' => '利便性を高める機能のためのCookieです。無効にしても、サイトの閲覧には影響しません。',
        ],
    ],

    'defaults' => [
        'consent' => 'Cookieの同意設定を保存するために使用します。',
        'session' => '閲覧セッションを識別するために使用します。',
        'csrf' => 'クロスサイトリクエストフォージェリ攻撃からお客様と当サイトを守るために使用します。',
        '_ga' => 'Google Analyticsの主要なCookieで、訪問者を区別するために使用します。',
        '_ga_ID' => 'Google Analyticsがセッションの状態を保持するために使用します。',
        '_gid' => 'Google Analyticsがユーザーを識別するために使用します。',
        '_gat' => 'Google Analyticsがリクエストの頻度を制御するために使用します。',
    ],
];
