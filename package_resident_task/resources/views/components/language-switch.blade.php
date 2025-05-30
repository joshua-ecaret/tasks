<form action="{{ route('locale.change') }}" method="POST">
    @csrf
    <select name="locale" onchange="this.form.submit()">
        <option value="en"{{ app()->getLocale() == 'en' ? ' selected' : '' }}>English</option>
        <option value="es"{{ app()->getLocale() == 'es' ? ' selected' : '' }}>Español</option>
    </select>
</form>