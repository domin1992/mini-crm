@extends('layouts.contract', ['contract' => $contract])

@section('content')
    <div class="row">
        <div class="col-sm-3">
            <img src="https://zencore.pl/wp-content/themes/zencore/img/logo.png" alt="Zencore" class="img-responsive">
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 text-center">
            <h4>Formularz umowa powierzenia przetwarzania danych osobowych</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <p>Z dniem {{ date('d.m.Y') }}, jako <strong>administrator danych osobowych</strong> <input type="text" class="form-control inline-text" name="company_name" placeholder="Nazwa firmy" value="{{ old('company_name') }}">, z siedzibą w <input type="text" class="form-control inline-text" name="company_address" placeholder="Adres firmy" value="{{ old('company_address') }}">, NIP: <input type="text" class="form-control inline-text" name="company_vat_number" placeholder="NIP firmy" value="{{ old('company_vat_number') }}">, reprezentowanym przez <input type="text" class="form-control inline-text" name="company_representative" placeholder="Imię i nazwisko" value="{{ old('company_representative') }}"> <input type="text" class="form-control inline-text" name="company_representative_title" placeholder="Funkcja w firmie" value="{{ old('company_representative_title') }}"> w ramach umowy korzystania z usług, powierza przetwarzanie danych osobowych procesorowi:</p>
            <p><strong>{{ $owner->name }}, NIP: {{ $owner->vat_number }}, {{ $owner->street }}, {{ $owner->postcode }} {{ $owner->city }}</strong></p>
            <p>Według następującej specyfikacji:</p>
            <h5>1. Powierzone dane osobowe</h5>
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="data_type_normal" name="data_type_normal"{{ (old('data_type_normal') ? ' checked' : '') }}> zwykłe
                </label>
                <small class="help-block">Przykłady danych zwykłych: imię, drugie imię, nazwisko, PESEL, Regon, NIP, adres zamieszkania / zameldowania, numer telefonu, e-mail, cookies, numer IP, bilingi, logi systemowedane geolokacyjne</small>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="data_type_sensitive" name="data_type_sensitive"{{ (old('data_type_sensitive') ? ' checked' : '') }}> wrażliwe
                </label>
                <small class="help-block">Przykłady danych wrażliwych: pochodzenie rasowe lub etniczne,poglądy polityczne,przekonania religijne lub światopoglądowe, przynależność do związków zawodowych, dane genetyczne, dane biometryczne siatkówka, linie papilarne, dane dotyczące zdrowia, seksualności lub orientacji seksualnej, danych dzieci poniżej 16 roku życia</small>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="data_type_law" name="data_type_law"{{ (old('data_type_law') ? ' checked' : '') }}> dotyczące wyroków skazujących i naruszeń prawa
                </label>
            </div>
            <h5>2. Kategorie osób, których dane dotyczą</h5>
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="person_category_client" name="person_category_client"{{ (old('person_category_client') ? ' checked' : '') }}> Klienci
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="person_category_subscriber" name="person_category_subscriber"{{ (old('person_category_subscriber') ? ' checked' : '') }}> Abonenci/Subskrybenci
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="person_category_contractor" name="person_category_contractor"{{ (old('person_category_contractor') ? ' checked' : '') }}> Kontrahenci
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="person_category_employee" name="person_category_employee"{{ (old('person_category_employee') ? ' checked' : '') }}> Pracownicy
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="person_category_recruiters" name="person_category_recruiters"{{ (old('person_category_recruiters') ? ' checked' : '') }}> Kandydaci do pracy
                </label>
            </div>
            <div class="form-group">
                <label for="person_category_custom">Inni</label>
                <input type="text" class="form-control" id="person_category_custom" name="person_category_custom" placeholder="Wymień po przecinku" style="width: 50%;" value="{{ old('person_category_custom') }}">
            </div>
            <h5>3. Dane kontaktowe</h5>
            <p>Dane kontaktowe przedstawiciela podmiotu przetwarzającego:</p>
            <div class="form-inline">
                <div class="form-group">
                    <input type="text" class="form-control" id="company_contact_representative_name" name="company_contact_representative_name" placeholder="Imię i nazwisko" value="{{ old('company_contact_representative_name') }}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="company_contact_representative_email" name="company_contact_representative_email" placeholder="Adres e-mail" value="{{ old('company_contact_representative_email') }}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="company_contact_representative_phone" name="company_contact_representative_phone" placeholder="Numer telefonu" value="{{ old('company_contact_representative_phone') }}">
                </div>
            </div>
            <p>Dane kontaktowe inspektora ochrony danych, jeżeli powołano:</p>
            <div class="form-inline">
                <div class="form-group">
                    <input type="text" class="form-control" id="company_contact_inspector_name" name="company_contact_inspector_name" placeholder="Imię i nazwisko" value="{{ old('company_contact_inspector_name') }}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="company_contact_inspector_email" name="company_contact_inspector_email" placeholder="Adres e-mail" value="{{ old('company_contact_inspector_email') }}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="company_contact_inspector_phone" name="company_contact_inspector_phone" placeholder="Numer telefonu" value="{{ old('company_contact_inspector_phone') }}">
                </div>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="decision_consaignment" name="decision_consaignment"{{ (old('decision_consaignment') ? ' checked' : '') }}> Jestem uprawniony/a do reprezentowania mojej firmy w zakresie powierzenia danych osobowych i zawierania w tym obszarze umów.
                </label>
            </div>
        </div>
    </div>
@endsection