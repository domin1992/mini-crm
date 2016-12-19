<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Carbon\Carbon;
use Auth;

use App\Http\Requests;

use App\Company;
use App\CompanyComment;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();

        return view('company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filePath = storage_path('uploads/');
        $fileName = 'companies.xml';
        $request->file('xml')->move($filePath, $fileName);
        $filesystem = new Filesystem;
        $fileContent = $filesystem->get($filePath . $fileName);

        $xml = simplexml_load_string($fileContent);

        $addCounter = 0;
        $updateCounter = 0;

        foreach($xml->InformacjaOWpisie as $wpis){
            if($wpis->DaneKontaktowe->AdresPocztyElektronicznej != '' || $wpis->DaneKontaktowe->Telefon != ''){
                $addCounter++;
                if($company = Company::where('vat_number', $wpis->DanePodstawowe->NIP)->first()){
                    $company->name = $wpis->DanePodstawowe->Firma;
                    $company->nbrn = $wpis->DanePodstawowe->REGON;
                    if($wpis->DaneKontaktowe->AdresPocztyElektronicznej != '')
                        $company->email = $wpis->DaneKontaktowe->AdresPocztyElektronicznej;
                    if($wpis->DaneKontaktowe->Telefon != '')
                        $company->phone = $wpis->DaneKontaktowe->Telefon;
                    if($wpis->DaneKontaktowe->AdresStronyInternetowej != '')
                        $company->website = $wpis->DaneKontaktowe->AdresStronyInternetowej;
                    $company->postcode = $wpis->DaneAdresowe->AdresGlownegoMiejscaWykonywaniaDzialalnosci->KodPocztowy;
                    $company->city = $wpis->DaneAdresowe->AdresGlownegoMiejscaWykonywaniaDzialalnosci->Poczta;
                    $company->street = str_replace('ul. ', '', $wpis->DaneAdresowe->AdresGlownegoMiejscaWykonywaniaDzialalnosci->Ulica).' '.$wpis->DaneAdresowe->AdresGlownegoMiejscaWykonywaniaDzialalnosci->Budynek;
                    $company->status = $wpis->DaneDodatkowe->Status;
                    $company->pkd_codes = $wpis->DaneDodatkowe->KodyPKD;
                }
                else{
                    $company = new Company;
                    $company->name = $wpis->DanePodstawowe->Firma;
                    $company->vat_number = $wpis->DanePodstawowe->NIP;
                    $company->nbrn = $wpis->DanePodstawowe->REGON;
                    $company->email = $wpis->DaneKontaktowe->AdresPocztyElektronicznej;
                    $company->phone = $wpis->DaneKontaktowe->Telefon;
                    $company->website = $wpis->DaneKontaktowe->AdresStronyInternetowej;
                    $company->postcode = $wpis->DaneAdresowe->AdresGlownegoMiejscaWykonywaniaDzialalnosci->KodPocztowy;
                    $company->city = $wpis->DaneAdresowe->AdresGlownegoMiejscaWykonywaniaDzialalnosci->Poczta;
                    $company->street = str_replace('ul. ', '', $wpis->DaneAdresowe->AdresGlownegoMiejscaWykonywaniaDzialalnosci->Ulica).' '.$wpis->DaneAdresowe->AdresGlownegoMiejscaWykonywaniaDzialalnosci->Budynek;
                    $company->status = $wpis->DaneDodatkowe->Status;
                    $company->pkd_codes = $wpis->DaneDodatkowe->KodyPKD;
                }
                $company->save();
            }
        }

        return redirect('/company');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        if(($companyComment = CompanyComment::where([['company_id', '=', $company->id], ['user_id', '=', Auth::User()->id]])->first()) != null){
          $company->comment = $companyComment->comment;
        }
        else{
          $company->comment = '';
        }

        return view('company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        if(($companyComment = CompanyComment::where([['company_id', '=', $company->id], ['user_id', '=', Auth::User()->id]])->first()) != null){
          $company->comment = $companyComment->comment;
        }
        else{
          $company->comment = '';
        }

        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        $company->update($request->all());
        if(($companyComment = CompanyComment::where([['company_id', '=', $company->id], ['user_id', '=', Auth::User()->id]])->first()) == null){
          $companyComment = new CompanyComment;
          $companyComment->company_id = $company->id;
          $companyComment->user_id = Auth::User()->id;
        }
        $companyComment->comment = $request->input('comment');
        $companyComment->save();

        return redirect('/company/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();

        return redirect('/company');
    }

    public function export()
    {
        return view('company.export');
    }

    public function makeExport(Request $request)
    {
        $tmp = explode(' - ', $request->input('range'));
        $range = array(
            'from' => $tmp[0],
            'to' => $tmp[1]
        );
        $range['from'] = Carbon::createFromFormat('m/d/Y', $range['from']);
        $range['to'] = Carbon::createFromFormat('m/d/Y', $range['to']);
        switch($request->input('filter')){
            case 'has_email':
                $companies = Company::where([['email', '<>', ''], ['created_at', '>=', $range['from']->toDateTimeString()], ['created_at', '<', $range['to']->toDateTimeString()]])->get()->toArray();
                break;
            case 'has_phone':
                $companies = Company::where([['phone', '<>', ''], ['created_at', '>=', $range['from']->toDateTimeString()], ['created_at', '<', $range['to']->toDateTimeString()]])->get()->toArray();
                break;
            case 'only_email':
                $companies = Company::where([['email', '<>', ''], ['phone', '=', ''], ['created_at', '>=', $range['from']->toDateTimeString()], ['created_at', '<', $range['to']->toDateTimeString()]])->get()->toArray();
                break;
            case 'only_phone':
                $companies = Company::where([['email', '=', ''], ['phone', '<>', ''], ['created_at', '>=', $range['from']->toDateTimeString()], ['created_at', '<', $range['to']->toDateTimeString()]])->get()->toArray();
                break;
            case 'all':
                $companies = Company::where([['created_at', '>=', $range['from']->toDateTimeString()], ['created_at', '<', $range['to']->toDateTimeString()]])->get()->toArray();
                break;
            default:
                $companies = Company::where([['created_at', '>=', $range['from']->toDateTimeString()], ['created_at', '<', $range['to']->toDateTimeString()]])->get()->toArray();
                break;
        }

        $out = fopen(storage_path('export/export.csv'), 'w');
        fputcsv($out, array_keys($companies[1]));
        foreach($companies as $line){
            fputcsv($out, $line);
        }
        fclose($out);

        return response()->download(storage_path('export/export.csv'));
    }
}
