@component('mail::message')
    <div>
        <p>Sayın {{ $form->company }}</p>
        <p>{{ $form->id }} no.lu başvuru formunuz tarafımıza ulaşmıştır. En kısa zamanda incelenerek geri dönüş yapılacaktır. İlginize teşekkür ederiz.</p>
        <hr>
        {!! setting('theme::company-name') !!}<br>
        {!! setting('theme::address') !!}<br>
        {{ setting('theme::phone') }}<br>
        {{ setting('theme::email') }}
    </div>
@endcomponent
