<table class="invoice" border="0" cellpadding="0" cellspacing="0" align="center" style="min-width: 100%; width: 100%;">
	<tr>
		<td height="25" bgcolor="#FFFFFF" align="center" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;"></td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" align="center" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
			<p style="font-family: opensans; font-weight: bold; font-size: 13px; text-align: center;">
                Umowa powierzenia przetwarzania danych osobowych (zwana dalej „Umową”)</br />
                zawarta dnia {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $contract->signed_date)->format('d.m.Y') }} pomiędzy:
            </p>
		</td>
	</tr>
	<tr>
		<td height="35" bgcolor="#FFFFFF" align="center" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;"></td>
	</tr>
    <tr>
        <td bgcolor="#FFFFFF" align="left" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
            <p style="font-family: opensans; font-weight: normal; font-size: 13px; text-align: left;">
                {{ $request->company_name }}, {{ $request->company_address }}, NIP: {{ $request->company_vat_number }}, reprezentowaną przez {{ $request->company_representative }}, {{ $request->company_representative_title }} - zwaną/zwanym dalej "<strong>Administratorem</strong>"
                <br /><br />
            </p>
            <p style="font-family: opensans; font-weight: normal; font-size: 13px; text-align: left;">
                a
                <br /><br />
            </p>
            <p style="font-family: opensans; font-weight: normal; font-size: 13px; text-align: left;">
                {{ $owner->name }}, NIP: {{ $owner->vat_number }}, {{ $owner->street }}, {{ $owner->postcode }} {{ $owner->city }} - zwanym dalej "<strong>Przetwarzającym</strong>" lub "<strong>Procesorem</strong>"
                <br /><br />
            </p>
            <p style="font-family: opensans; font-weight: normal; font-size: 13px; text-align: left;">
                (dalej łącznie jako: "<strong>Strony</strong>" lub pojedynczo "<strong>Strona</strong>").
            </p>
        </td>
    </tr>
    <tr>
		<td height="35" bgcolor="#FFFFFF" align="center" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;"></td>
	</tr>
    <tr>
        <td bgcolor="#FFFFFF" align="left" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
            <p style="font-family: opensans; font-weight: bold; font-size: 13px; text-align: left;">
                § 1. Postanowienia ogólne – powierzenie przetwarzania danych osobowych.
                <br /><br />
            </p>
            <p style="font-family: opensans; font-weight: normal; font-size: 13px; text-align: left;">
                <ol>
                    <li>Na mocy Umowy o świadczenie usługi przez Przetwarzającego na rzecz Administratora danych (zwanej dalej "<strong>Umową Podstawową</strong>"), zawartej pomiędzy Stronami, Administrator powierza Przetwarzającemu dane osobowe do przetwarzania, w celu i na zasadach określonych w niniejszej Umowie.<br /><br /></li>
                    <li>Strony zawierając Umowę dążą do takiego uregulowania zasad przetwarzania Danych Osobowych, aby w pełni odpowiadały postanowieniom Rozporządzenia Parlamentu Europejskiego i Rady (UE) 2016/679 z 27.04.2016 r. w sprawie ochrony osób fizycznych w związku z przetwarzaniem danych osobowych i w sprawie swobodnego przepływu takich danych oraz uchylenia dyrektywy 95/46/WE (ogólne rozporządzenie o ochronie danych) (Dz.Urz. UE L 119, s. 1) – dalej "<strong>RODO</strong>".<br /><br /></li>
                    <li>Przetwarzający zobowiązuje się do przetwarzania powierzonych mu Danych zgodnie z Umową, RODO oraz innymi przepisami obowiązującego prawa.<br /><br /></li>
                    <li>Według art. 28 ust. 3 RODO na warunkach określonych niniejszą Umową oraz na podstawie świadczonej usługi przez Przetwarzającego na rzecz Administratora Danych, Administrator powierza Przetwarzającemu przetwarzanie (w rozumieniu RODO) dalej opisanych Danych Osobowych, pole-gające na ich przechowywaniu na serwerach stanowiących własność Przetwarzającego, gdzie Administrator osobiście zarządza i gromadzi Dane osobowe.<br /><br /></li>
                </ol>
            </p>
        </td>
    </tr>
    <tr>
		<td height="35" bgcolor="#FFFFFF" align="center" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;"></td>
	</tr>
    <tr>
        <td bgcolor="#FFFFFF" align="left" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
            <p style="font-family: opensans; font-weight: bold; font-size: 13px; text-align: left;">
                §2. Cel, charakter oraz czas przetwarzania danych osobowych.
                <br /><br />
            </p>
            <p style="font-family: opensans; font-weight: normal; font-size: 13px; text-align: left;">
                <ol>
                    <li>Zgodnie z art. 28 ust. 3 RODO przetwarzanie Danych będzie wykonywane w okresie obowiązywa-nia Umowy Podstawowej.<br /><br /></li>
                    <li>Charakter i cel przetwarzania wynikają z Umowy Podstawowej. Celem przetwarzania jest umoż-liwienie Administratorowi świadczenia drogą elektroniczną usług wchodzących w zakres działal-ności jego przedsiębiorstwa.<br /><br /></li>
                    <li>Cel i charakter przetwarzania Danych osobowych wynika z Umowy Podstawowej i ogranicza się jedynie do wykonywania przez Procesora obowiązków niezbędnych do świadczenia usługi na rzecz Administratora w związku z Umową Podstawową.<br /><br /></li>
                    <li>Zgodnie z art. 23 ust.3 RODO przetwarzanie Danych osobowych będzie się odbywało w czasie trwania Umowy Podstawowej.<br /><br /></li>
                </ol>
            </p>
        </td>
    </tr>
    <tr>
		<td height="35" bgcolor="#FFFFFF" align="center" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;"></td>
	</tr>
    <tr>
        <td bgcolor="#FFFFFF" align="left" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
            <p style="font-family: opensans; font-weight: bold; font-size: 13px; text-align: left;">
                §3. Dane osobowe.
                <br /><br />
            </p>
            <p style="font-family: opensans; font-weight: normal; font-size: 13px; text-align: left;">
                <ol>
                    <li>
                        W oparciu o art. 28 ust. 3 RODO przetwarzanie obejmować będzie następujące rodzaje danych osobowych ("<strong>Dane</strong>"):<br /><br />
                        @if($request->data_type_normal == 'on')
                            <p>
                                - Dane nie stanowiące szczególnej kategorii danych osobowych w rozumieniu art. 9 RODO<br /><br />
                            </p>
                        @endif
                        @if($request->data_type_sensitive == 'on')
                            <p>
                                - Dane stanowiące szczególną kategorię danych osobowych wg art. 9 RODO<br /><br />
                            </p>
                        @endif
                        @if($request->data_type_law == 'on')
                            <p>
                                - Dane dotyczące wyroków skazujących i naruszeń prawa<br /><br />
                            </p>
                        @endif
                        <p>
                            Dane zebrane przez Administratora, wymienione powyżej, za wyraźną i jednoznaczną zgodą osoby, której one dotyczą<br /><br />
                        </p>
                    </li>
                    <li>
                        Przetwarzanie Danych, w rozumieniu art. 28 ust. 3 RODO będzie dotyczyć następujących kategorii osób:<br /><br />
                        @if($request->person_category_client == 'on')
                            <p>
                                - Klienci<br /><br />
                            </p>
                        @endif
                        @if($request->person_category_subscriber == 'on')
                            <p>
                                - Abonenci/subskrybenci<br /><br />
                            </p>
                        @endif
                        @if($request->person_category_contractor == 'on')
                            <p>
                                - Kontrahenci<br /><br />
                            </p>
                        @endif
                        @if($request->person_category_employee == 'on')
                            <p>
                                - Pracownicy<br /><br />
                            </p>
                        @endif
                        @if($request->person_category_recruiters == 'on')
                            <p>
                                - Kandydaci do pracy<br /><br />
                            </p>
                        @endif
                        @if($request->person_category_custom != null && $request->person_category_custom != '')
                            <p>
                                - {{ $request->person_category_custom }}<br /><br />
                            </p>
                        @endif
                    </li>
                </ol>
            </p>
        </td>
    </tr>
    <tr>
		<td height="35" bgcolor="#FFFFFF" align="center" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;"></td>
	</tr>
    <tr>
        <td bgcolor="#FFFFFF" align="left" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
            <p style="font-family: opensans; font-weight: bold; font-size: 13px; text-align: left;">
                §4. Podpowierzenie.
                <br /><br />
            </p>
            <p style="font-family: opensans; font-weight: normal; font-size: 13px; text-align: left;">
                <ol>
                    <li>Przetwarzający nie ma prawa do podpowierzenia przetwarzania Danych objętych Umową.<br /><br /></li>
                    <li>Jedynym wyjątkiem jest sytuacja podpowierzenia Danych innym podmiotom przetwarzającym, zwanym dalej „Podwykonawcami”, tylko i wyłącznie w celu wykonywania obowiązków związa-nych z Umową Podstawową.<br /><br /></li>
                    <li>Przetwarzający podpowierzając dane Podwykonawcom zobowiązuje się do zawarcia z nimi sto-sownych umów powierzenia, gwarantujących poufność oraz tajność Danych oraz zapewniających stosowanie środków technicznych i organizacyjnych spełniających wymogi RODO. Procesor ponosi pełną odpowiedzialność wobec Administratora za czynności Podwykonawców.<br /><br /></li>
                </ol>
            </p>
        </td>
    </tr>
    <tr>
		<td height="35" bgcolor="#FFFFFF" align="center" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;"></td>
	</tr>
    <tr>
        <td bgcolor="#FFFFFF" align="left" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
            <p style="font-family: opensans; font-weight: bold; font-size: 13px; text-align: left;">
                §5. Obowiązki Przetwarzającego i odpowiedzialność.
                <br /><br />
            </p>
            <p style="font-family: opensans; font-weight: normal; font-size: 13px; text-align: left;">
                <ol>
                    <li>
                        Przetwarzający, w odniesieniu do art. 28 ust.3 RODO, ma następujące obowiązki:<br /><br />
                        <p>
                            a) Przetwarzający przetwarza Dane wyłącznie zgodnie z udokumentowanymi polece-niami lub instrukcjami wydanymi przez Administratora;<br /><br />
                        </p>
                        <p>
                            b) Przetwarzający oświadcza, że nie przekazuje Danych do państwa trzeciego (poza Eu-ropejski Obszar Gospodarczy - „EOG”); Przetwarzający oświadcza także, że nie korzy-sta z podwykonawców przekazujących Dane poza EOG;<br /><br />
                        </p>
                        <p>
                            c) jeżeli Przetwarzający ma zamiar lub obowiązek przekazywać Dane poza EOG, jest zobowiązany do poinformowania o tym Administratora, w celu umożliwienia Admini-stratorowi podjęcia decyzji i działań niezbędnych do zapewnienia zgodności przetwa-rzania z prawem lub zakończenia powierzenia przetwarzania;<br /><br />
                        </p>
                        <p>
                            d) Przetwarzający uzyskuje od Podwykonawców udokumentowane zobowiązania do zachowania tajemnicy, w zakresie przetwarzania Danych;<br /><br />
                        </p>
                        <p>
                            e) Przetwarzający w celu przetwarzania powierzonych mu Danych stosuje środki tech-niczne i organizacyjne, o których mowa w art.32 RODO, adekwatnie do rodzaju po-wierzonych mu Danych, przekazanych przez Administratora i w zakresie uprawnień nadanych przez Administratora Procesorowi;<br /><br />
                        </p>
                        <p>
                            f) Przetwarzający powiadamia Administratora Danych o każdym podejrzeniu narusze-nia ochrony jego Danych nie później niż w 48 godzin od pierwszego zgłoszenia, umoż-liwia Administratorowi uczestnictwo w czynnościach wyjaśniających i informuje Ad-ministratora o ustaleniach z chwilą ich dokonania, w szczególności o stwierdzeniu naruszenia drogą elektroniczną (wiadomość e-mail);<br /><br />
                        </p>
                        <p>
                            g) Przetwarzający zobowiązuje się wobec Administratora do współpracy przy realizacji praw jednostki w odniesieniu do powierzonych Danych, jeżeli będzie to konieczne do obsługi tych praw;<br /><br />
                        </p>
                        <p>
                            h) Przetwarzający pomaga Administratorowi w wywiązaniu się z obowiązku odpowia-dania na żądania osoby, której Dane dotyczą, w zakresie wykonywania jej praw okre-ślonych w RODO (wspiera w realizacji uprawnień osoby o charakterze informacyjnym, korekcyjnym i zakazowym);<br /><br />
                        </p>
                        <p>
                            i) Procesor pomaga Administratorowi w zabezpieczaniu danych, zgłaszaniu naruszeń organowi nadzorczemu, zawiadamianiu osoby, której Dane dotyczą, o naruszeniu ochrony Danych;<br /><br />
                        </p>
                        <p>
                            j) Jeżeli Przetwarzający będzie miał wątpliwości co do zgodności z prawem wydanych przez Administratora poleceń lub instrukcji, Przetwarzający natychmiast poinformuje Administratora o stwierdzonej wątpliwości (w sposób udokumentowany i z uzasadnieniem), pod rygorem utraty możliwości dochodzenia roszczeń przeciwko Administratorowi z tego tytułu.<br /><br />
                        </p>
                    </li>
                    <li>Jeżeli Dane określone przez Administratora w §3 zostały zgromadzone przez niego bez jednoznacznej zgody osoby, której dotyczą, Przetwarzający nie ponosi odpowiedzialności za nieprawidłowe zbieranie Danych przez Administratora, równocześnie przenosząc sankcje i od-powiedzialn*ość tylko na Administratora.<br /><br /></li>
                    <li>Zgodnie z art. 82 ust. 3 RODO Przetwarzający odpowiada za szkody spowodowane swoim działa-niem w związku z niedopełnieniem obowiązków, które RODO nakłada bezpośrednio na Przetwarza-jącego lub gdy działał poza zgodnymi z prawem instrukcjami Administratora lub wbrew tym in-strukcjom. Całkowite i maksymalne zobowiązanie Procesora wobec Administratora Danych nie może przekroczyć całkowitej kwoty rocznej, uiszczonej Procesorowi za usługę, której dotyczy rosz-czenie, z ostatnich dwunastu miesięcy przed zdarzeniem. Przetwarzający odpowiada w ten sposób za szkody spowodowane nieumyślnie.<br /><br />
                    Powyższe nie ma zastosowania w przypadku umyślnego spowodowania szkody lub zaniedbania ob-owiązków przez Procesora.<br /><br /></li>
                </ol>
            </p>
        </td>
    </tr>
    <tr>
		<td height="35" bgcolor="#FFFFFF" align="center" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;"></td>
	</tr>
    <tr>
        <td bgcolor="#FFFFFF" align="left" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
            <p style="font-family: opensans; font-weight: bold; font-size: 13px; text-align: left;">
                §6. Obowiązki i odpowiedzialność Administratora.
                <br /><br />
            </p>
            <p style="font-family: opensans; font-weight: normal; font-size: 13px; text-align: left;">
                <ol>
                    <li>Administrator zobowiązany jest współdziałać z Przetwarzającym w wykonaniu Umowy, udzielać Przetwarzającemu wyjaśnień w razie wątpliwości co do legalności poleceń Administratora, jak też wywiązywać się terminowo ze swoich szczegółowych obowiązków.<br /><br /></li>
                    <li>Administrator oświadcza, że jest uprawniony do przetwarzania Danych w zakresie, w jakim powie-rzył je Przetwarzającemu doprecyzowując je w §3 powyższej Umowy.<br /><br /></li>
                    <li>Administrator podmiotu, na wezwanie Procesora jest zobowiązany do wskazania i udokumentowa-nia podstawy przetwarzania danych osobowych w jak najkrótszym czasie.<br /><br /></li>
                    <li>Administrator zobowiązuje się do pełnego i rzetelnego wykonywania warunków RODO.<br /><br /></li>
                    <li>W przypadku braku zgodności organizacyjnych i technicznych środków zastosowanych w związku z nieprawidłowym bądź niekompletnym zadeklarowaniem przez Administratora rodzajem Danych w §3 Umowy, sankcje i odpowiedzialność za nieprawidłowości ponosi jedynie Administrator.<br /><br /></li>
                </ol>
            </p>
        </td>
    </tr>
    <tr>
		<td height="35" bgcolor="#FFFFFF" align="center" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;"></td>
	</tr>
    <tr>
        <td bgcolor="#FFFFFF" align="left" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
            <p style="font-family: opensans; font-weight: bold; font-size: 13px; text-align: left;">
                §7. Usunięcie Danych.
                <br /><br />
            </p>
            <p style="font-family: opensans; font-weight: normal; font-size: 13px; text-align: left;">
                <ol>
                    <li>Zgodnie z art. 28 RODO z chwilą rozwiązania Umowy Przetwarzający nie ma prawa do dalszego przetwarzania powierzonych mu Danych i jest zobowiązany nie później niż w przeciągu 30 dni od rozwiązania umowy do usunięcia Danych i wszelkich ich istniejących kopii, chyba że Administra-tor postanowi inaczej lub prawo Unii Europejskiej, lub prawo państwa członkowskiego nakazują dalsze przechowywanie Danych.<br /><br /></li>
                </ol>
            </p>
        </td>
    </tr>
    <tr>
		<td height="35" bgcolor="#FFFFFF" align="center" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;"></td>
	</tr>
    <tr>
        <td bgcolor="#FFFFFF" align="left" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
            <p style="font-family: opensans; font-weight: bold; font-size: 13px; text-align: left;">
                §8. Postanowienia Końcowe.
                <br /><br />
            </p>
            <p style="font-family: opensans; font-weight: normal; font-size: 13px; text-align: left;">
                <ol>
                    <li>W razie sprzeczności pomiędzy postanowieniami niniejszej Umowy Powierzenia a Umowami Pod-stawowymi, pierwszeństwo mają postanowienia Umowy Powierzenia. Oznacza to także, że kwe-stie dotyczące przetwarzania Danych osobowych pomiędzy Administratorem a Przetwarzającym należy regulować poprzez zmiany niniejszej Umowy.<br /><br /></li>
                    <li>Umowa została sporządzona w dwóch jednobrzmiących egzemplarzach, po jednym dla każdej ze Stron.<br /><br /></li>
                    <li>Umowa podlega prawu polskiemu oraz RODO, a w razie sporów związanych z Umową sprawę roz-strzygnie sąd właściwy ze względu na siedzibę pozwanego.<br /><br /></li>
                    <li>Jeżeli przed podpisaniem Umowy były zawarte jakieś inne umowy w zakresie przetwarzania i ochrony Danych, z dniem podpisania obecnej Umowy tracą one ważność na rzecz Umowy.<br /><br /></li>
                </ol>
            </p>
        </td>
    </tr>
    <tr>
		<td height="35" bgcolor="#FFFFFF" align="center" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;"></td>
	</tr>
    <tr>
        <td bgcolor="#FFFFFF" align="left" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
            <p style="font-family: opensans; font-weight: bold; font-size: 13px; text-align: left;">
                PODPIS
                <br /><br />
            </p>
            <p style="font-family: opensans; font-weight: normal; font-size: 13px; text-align: left;">
                Kod został wysłany na numer <strong>{{ $contract->phone }}</strong> w dniu <strong>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $contract->sms_code_sent_date)->format('m.d.Y H:i') }}</strong> i potwierdzony <strong>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $contract->signed_date)->format('m.d.Y H:i') }}</strong> tokenem o treści <strong>{{ $contract->sms_code }}</strong>.
            </p>
        </td>
    </tr>
	<tr>
		<td height="25" bgcolor="#FFFFFF" align="center" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;"></td>
	</tr>
</table>