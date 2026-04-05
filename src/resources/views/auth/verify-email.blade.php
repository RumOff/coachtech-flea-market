<h1>メール認証してください</h1>

<p>登録したメールアドレスに認証リンクを送っています。</p>

<form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit">認証メールを再送信</button>
</form>